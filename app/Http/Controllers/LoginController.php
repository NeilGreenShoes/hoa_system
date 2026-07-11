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

use App\Http\Controllers\ActivityLogsController;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth/login');
    }

    private function getDashboardRoute($user)
    {
        return match ($user->role->roleName) {
            'Admin' => 'admin/dashboard',
            'Homeowner' => 'homeowner/dashboard',
            default => '/',
        };
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('loginEmail', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            if ($user->status !== 'Active') {
                ActivityLogsController::log(
                    $user->userID,
                    ($user->staff?->name ?? $user->loginEmail) . ' attempted to log in with an inactive account.'
                );

                return response()->json([
                    'status' => 'error',
                    'message' => 'Your account is inactive. Please contact the administrator.'
                ], 403);
            }

            $agentParser = new Agent();
            $currentAgent = $request->header('User-Agent');
            $currentIp = $request->ip();

            $knownDevice = UserLog::where('userID', $user->userID)
                ->where(function ($query) use ($currentAgent, $currentIp) {
                    $query->where('agent', $currentAgent)
                        ->orWhere('ip_address', $currentIp);
                })
                ->exists();

            if ($knownDevice) {
                Auth::login($user);

                $user->isLoggedIn = 1;
                $user->save();

                ActivityLogsController::log(
                    $user->userID,
                    ($user->staff?->name ?? $user->loginEmail) . ' has logged in successfully as ' . ($user->role->roleName) . '.',
                );

                $this->storeUserLog($user->userID, $request);

                return redirect($this->getDashboardRoute($user))->with('message', 'Login successful.');
            }

            $otp = (string) random_int(100000, 999999);

            session([
                'otp_code' => $otp,
                'otp_user_id' => $user->userID,
                'otp_expires_at' => now()->addMinutes(10)
            ]);

            Mail::to($user->loginEmail)->send(new SendOtpMail($otp));

            ActivityLogsController::log(
                $user->userID,
                ($user->staff?->name ?? $user->loginEmail) . ' attempted to log in from a new device. OTP sent.'
            );

            return response()->json([
                'status' => 'success',
                'redirect' => false,
                'message' => 'Credentials verified. New device detected. OTP sent.'
            ]);
        }

        if ($user) {
            ActivityLogsController::log(
                $user->userID,
                ($user->staff?->name ?? $user->loginEmail) . ' failed to log in due to an incorrect password.'
            );
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

        return redirect($this->getDashboardRoute($user))->with('message', 'Login successful.');
    }

    public function forgotPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $email = $validated['email'];

        $user = User::where('loginEmail', $email)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email address not found.'
            ], 404);
        }

        $otp = (string) random_int(100000, 999999);

        Cache::put('password_reset_otp_'.$email, $otp, now()->addMinutes(15));

        Mail::raw(
            "Your password reset code is: {$otp}. It expires in 15 minutes.",
            function ($message) use ($email) {
                $message->to($email)
                        ->subject('Password Reset OTP');
            }
        );

        return response()->json([
            'status' => 'success',
            'message' => 'OTP has been sent to your email.'
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|string|size:6',
        ]);

        $cacheKey = 'password_reset_otp_'.$validated['email'];

        $cachedOtp = Cache::get($cacheKey);

        if (!$cachedOtp) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP has expired.'
            ], 400);
        }

        if ($cachedOtp !== $validated['otp']) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid OTP.'
            ], 400);
        }

        Cache::put(
            'password_reset_verified_'.$validated['email'],
            true,
            now()->addMinutes(15)
        );

        return response()->json([
            'status' => 'success',
            'message' => 'OTP verified.'
        ]);
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Cache::get('password_reset_verified_'.$validated['email'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'OTP verification required.'
            ], 403);
        }

        $user = User::where('loginEmail', $validated['email'])->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ], 404);
        }

        $user->password = Hash::make($validated['password']);
        $user->save();

        Cache::forget('password_reset_verified_'.$validated['email']);
        Cache::forget('password_reset_otp_'.$validated['email']);

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully.'
        ]);
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

    public function register()
    {
        return view('auth.register');
    }

    
}
