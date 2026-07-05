<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use App\Models\UserLog;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth/login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('loginEmail', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            
            $agentParser = new Agent();
            $currentAgent = $request->header('User-Agent');
            $currentIp = $request->ip();

            $knownDevice = UserLog::where('userID', $user->userID)
                ->where(function($query) use ($currentAgent, $currentIp) {
                    $query->where('agent', $currentAgent)
                        ->orWhere('ip_address', $currentIp);
                })
                ->exists();

            if ($knownDevice) {
                Auth::login($user);

                $user->isLoggedIn = 1;
                $user->save();

                $this->storeUserLog($user->userID, $request);

                return redirect('admin/dashboard')->with('success', 'Login successful.');
            }

            $otp = (string) random_int(100000, 999999);
            
            session([
                'otp_code' => $otp,
                'otp_user_id' => $user->userID,
                'otp_expires_at' => now()->addMinutes(10)
            ]);

            Mail::to($user->loginEmail)->send(new SendOtpMail($otp));

            return response()->json([
                'status' => 'success',
                'redirect' => false,
                'message' => 'Credentials verified. New device detected. OTP sent.'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid email or password. Please try again.'
        ], 401);
    }

    public function logout(Request $request){
        if (Auth::check()) {
            $user = User::find(Auth::user()->userID);
            if ($user) {
                $user->lastSession = now();
                $user->isLoggedIn = 0;
                $user->save();
            }
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'successfully logged out!');
    }

    public function submitOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        $expectedOtp = session('otp_code');
        $userId = session('otp_user_id');
        $expiresAt = session('otp_expires_at');

        if (!$userId || !$expectedOtp || now()->isAfter($expiresAt) || $request->input('otp') !== $expectedOtp) {
            return redirect()->back()->withErrors(['otp' => 'Invalid or expired OTP. Please try logging in again.']);
        }

        session()->forget(['otp_code', 'otp_user_id', 'otp_expires_at']);

        Auth::loginUsingId($userId);

        $user = User::find($userId);
        if ($user) {
            $user->isLoggedIn = 1;
            $user->save();
        }

        $this->storeUserLog($userId, $request);

        $request->session()->regenerate();

        return redirect('admin/dashboard')->with('success', 'Login successful.');
    }

    public function forgotPassword(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email = $validatedData['email'];
        $user = User::where('loginEmail', $email)->first();

        if ($user) {
            $otp = (string) random_int(100000, 999999);
            $cacheKey = 'password_reset_otp_' . $email;

            Cache::put($cacheKey, $otp, 900);

            Mail::raw("Your password reset code is: {$otp}. It will expire in 15 minutes.", function ($message) use ($email) {
                $message->to($email)
                        ->subject('Your Password Reset OTP');
            });
            
            return response()->json([
                'status' => 'success',
                'message' => 'An OTP code has been sent to your email.'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Email address not found in our records.'
        ], 404);
    }

    public function verifyOtp(Request $request)
    {
        $validatedData = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'otp'      => 'required|string|size:6',
        ]);

        $email = $validatedData['email'];
        $otp = $validatedData['otp'];

        $cacheKey = 'password_reset_otp_' . $email;
        $cachedOtp = Cache::get($cacheKey);

        if (!$cachedOtp) {
            return response()->json([
                'status' => 'error',
                'message' => 'The OTP code has expired. Please request a new one.'
            ], 400);
        }

        if ($cachedOtp !== $otp) {
            return response()->json([
                'status' => 'error',
                'message' => 'The validation code you entered is incorrect.'
            ], 400);
        }

        $user = User::where('loginEmail', $email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tracking error.'
            ], 404);
        }

        $user->password = Hash::make($validatedData['password']);
        $user->save();

        Cache::forget($cacheKey);

        return response()->json([
            'status' => 'success',
            'message' => 'Your password has been updated successfully!'
        ], 200);
    }
    
    private function storeUserLog($userId, Request $request)
    {
        $agentParser = new Agent();
        
        UserLog::create([
            'userID'     => $userId,
            'device'     => $agentParser->device(),
            'agent'      => $request->header('User-Agent'),
            'ip_address' => $request->ip(),
        ]);
    }
}
