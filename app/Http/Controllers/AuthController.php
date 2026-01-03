<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    // STEP 1: Send OTP to Phone
    public function sendPhoneOtp(Request $request)
    {
        // Validate phone input
        $request->validate(['phone' => 'required|string']);

        $phone = $request->phone;

        // Check if phone already exists
        if (User::where('phone', $phone)->exists()) {
            return response()->json([
                'status' => false,
                'type' => 'exists',
                'message' => 'Phone number already registered'
            ]);
        }

        // Generate OTP
        $otp = rand(100000, 999999);

        // Store phone and OTP in session
        session([
            'phone' => $phone,
            'phone_otp' => $otp
        ]);

        // Send OTP via SMS
        $smsResult = $this->sendOtpphone($phone, $otp);

        if (!$smsResult['success']) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to send SMS: ' . $smsResult['message']
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'OTP sent successfully'
        ]);
    }

    // Helper function to send SMS using Cell24x7
    private function sendOtpphone(string $number, int $otp)
    {
        $templateId = 1107172845189433045;
        $message = "Hi, Your Verification {$otp} code, NOKA";
        $encodedMessage = urlencode($message);

        $url = "https://sms.cell24x7.in/mspProducerM/sendSMS?"
            . "user=noka"
            . "&pwd=123456789"
            . "&sender=NOKAFW"
            . "&mobile={$number}"
            . "&msg={$encodedMessage}"
            . "&mt=0"
            . "&tempId={$templateId}";

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return [
                'success' => false,
                'message' => $error
            ];
        }

        curl_close($ch);

        return [
            'success' => true,
            'response' => $response
        ];
    }

    // STEP 2: Verify OTP
    public function verifyPhoneOtp(Request $request)
    {
        $request->validate(['otp' => 'required']);

        if ($request->otp == session('phone_otp')) {
            session(['phone_verified' => true]);
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false, 'message' => 'Invalid OTP']);
    }

    // STEP 2: Email OTP
    public function sendEmailOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|unique:users']);

        $otp = rand(100000, 999999);
        Session::put('email_otp', $otp);
        Session::put('email', $request->email);

        // Send OTP email
        Mail::to($request->email)->send(new OtpMail($otp));

        return response()->json(['status' => true, 'message' => 'OTP sent to email']);
    }

    public function verifyEmailOtp(Request $request)
    {
        if ($request->otp == Session::get('email_otp')) {
            Session::put('email_verified', true);
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }

    public function register()
    {
        return view('user.register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string',
            'password' => 'nullable|string|min:6',
            'status' => 'required',
            // 'role' => $request->role ?? 'user',
        ]);

        if (!session('phone_verified')) {
            return response()->json(['status' => false, 'message' => 'Phone not verified']);
        }

        $user = User::create([
            'phone' => $request->phone,
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'pan' => $request->pan,
            'gst' => $request->gst,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->address,
             'role'     => 'user', // ✅ DEFAULT ROLE
        ]);

        auth()->login($user);

        return response()->json(['status' => true, 'message' => 'Registration successful']);
    }

    public function userLoginForm()
    {
        return view('user.login');
    }
    public function userLogin(Request $request)
    {
        $request->validate([
            'login' => 'required',
        ]);

        $login = $request->login;

        // Detect login type
        $isEmail = filter_var($login, FILTER_VALIDATE_EMAIL);

        $user = User::where(
            $isEmail ? 'email' : 'phone',
            $login
        )->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ]);
        }

        // Generate OTP
        $otp = rand(100000, 999999);

        Cache::put('login_otp_' . $user->id, $otp, now()->addMinutes(5));

        // ✅ SEND OTP ONLY BASED ON INPUT TYPE
        if ($isEmail) {
            // Send EMAIL OTP
            Mail::to($user->email)->send(new OtpMail($otp));
        } else {
            // Send SMS OTP
            $sms = $this->sendOtpphone($user->phone, $otp);

            if (!$sms['success']) {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to send OTP via SMS'
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'OTP sent successfully'
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'login' => 'nullable', // email or phone
            'otp' => 'required|numeric',
        ]);

        $user = User::where('email', $request->login)
            ->orWhere('phone', $request->login)
            ->first();

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not found']);
        }

        $cachedOtp = Cache::get('login_otp_' . $user->id);

        if ($request->otp == $cachedOtp) {
            Auth::login($user);
            Cache::forget('login_otp_' . $user->id);

            $redirect = $user->role === 'super_admin' ? route('admin.dashboard') : route('user.dashboard');

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'redirect' => $redirect
            ]);
        }

        return response()->json(['status' => false, 'message' => 'Invalid OTP']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
