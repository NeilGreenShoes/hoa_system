<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Homeowners;
use App\Models\Address;
use App\Mail\OtpVerificationMail; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage; 

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

   public function sendOtp(Request $request)
    {
        $validated = $request->validate([
            'firstname'        => 'required|string|max:100',
            'middlename'       => 'nullable|string|max:100',
            'lastname'         => 'required|string|max:100',
            'gender'           => 'required|in:Male,Female',
            'contact'          => 'required|string|max:11',
            'email'            => 'required|email|unique:users,loginEmail|unique:homeowners,email|max:150',
            'dob'              => 'required|date|before:today',
            'marital'          => 'required|in:Married,Single,Widowed,Seperated',
            'religion'         => 'required|string|max:100',
            'profile'          => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'street'           => 'required|string|max:255',
            'barangay'         => 'required|string|max:150',
            'city'             => 'required|string|max:150',
            'province'         => 'required|string|max:150',
            'password'         => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        try {
            $otpCode = (string) rand(100000, 999999);
    
            if ($request->hasFile('profile')) {
                $image = $request->file('profile');
                $tempName = time() . '_temp.' . $image->getClientOriginalExtension();
                
                // Move the file out of temporary system memory immediately
                $image->storeAs('public/profiles/temp', $tempName);
                
                // Store ONLY the plain string name key inside the payload array
                $validated['profile_temp_name'] = $tempName;
            }
            
            unset($validated['profile']);
            
            session([
                'registration_payload' => $validated,
                'registration_otp'     => $otpCode,
                'otp_expires_at'       => now()->addMinutes(10)
            ]);

            Mail::to($validated['email'])->send(new OtpVerificationMail($validated['firstname'], $otpCode));

            return response()->json(['success' => true, 'message' => 'OTP dispatched successfully.']);

        } catch (\Exception $e) {
            Log::error('OTP Generation Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Failed to dispatch verification code.'], 500);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|string|size:6'
        ]);

        if (!session()->has('registration_otp') || !session()->has('registration_payload')) {
            return redirect()->route('register')->withErrors(['error' => 'Registration session expired. Please start over.']);
        }

        if (now()->isAfter(session('otp_expires_at'))) {
            session()->forget(['registration_payload', 'registration_otp', 'otp_expires_at']);
            return redirect()->route('register')->withErrors(['error' => 'Verification code expired. Please request a new code.']);
        }

        if ($request->otp_code !== session('registration_otp')) {
            return back()->withErrors(['otp_error' => 'Invalid verification code entered. Please verify code digits.']);
        }

        $validated = session('registration_payload');
        
        DB::beginTransaction();

        try {
            $homeownerRoleID = 2; 

            $user = User::create([
                'loginEmail' => $validated['email'],
                'password'   => Hash::make($validated['password']),
                'status'     => 'Active',
                'isLoggedIn' => false,
                'roleID'     => $homeownerRoleID,
            ]);

            $address = Address::create([
                'street'   => $validated['street'],
                'barangay' => $validated['barangay'],
                'city'     => $validated['city'],
                'province' => $validated['province'],
            ]);

            $imageName = null;
            if (isset($validated['profile_temp_name'])) {
                $tempPath = 'public/profiles/temp/' . $validated['profile_temp_name'];
                $imageName = time() . '_' . $user->getKey() . '.' . pathinfo($validated['profile_temp_name'], PATHINFO_EXTENSION);
                $permanentPath = 'public/profiles/' . $imageName;
                
                if (Storage::exists($tempPath)) {
                    Storage::move($tempPath, $permanentPath);
                }
            }

            Homeowners::create([
                'firstName'     => $validated['firstname'],
                'middleName'    => $validated['middlename'],
                'lastName'      => $validated['lastname'],
                'dateOfBirth'   => $validated['dob'],
                'gender'        => $validated['gender'],
                'religion'      => $validated['religion'],
                'maritalStatus' => $validated['marital'],
                'contactNumber' => $validated['contact'],
                'email'         => $validated['email'],
                'profileImage'  => $imageName,
                'userID'        => $user->getKey(),     
                'addressID'     => $address->getKey(),
            ]);

            DB::commit();

            session()->forget(['registration_payload', 'registration_otp', 'otp_expires_at']);

            return redirect()->route('download')->with('success', 'Registration complete! Welcome aboard.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration Execution Error: ' . $e->getMessage());

            return back()->withErrors(['error' => 'An error occurred during final database registration setup.']);
        }
    
    }
}