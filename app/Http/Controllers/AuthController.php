<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\Role;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function sendPhoneOtp(Request $request)
    {
        $request->validate(['phone' => 'required|string']);

        Log::info('Send Phone OTP request', ['phone' => $request->phone]);

        if (User::where('phone', $request->phone)->exists()) {
            Log::info('Phone already exists', ['phone' => $request->phone]);
            return response()->json([
                'status' => false,
                'type' => 'exists',
                'message' => 'Phone number already registered'
            ]);
        }

        $otp = rand(100000, 999999);
        Log::info('Generated OTP', ['otp' => $otp]);

        // Save OTP in DB
        try {
            $otpRecord = \App\Models\Otp::create([
                'type' => 'phone',
                'value' => $request->phone,
                'otp' => $otp,
                'expires_at' => now()->addMinutes(10), // OTP valid for 10 mins
            ]);
            Log::info('OTP saved to DB', ['id' => $otpRecord->id]);
        } catch (\Exception $e) {
            Log::error('Failed to save OTP', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => false,
                'message' => 'Failed to save OTP'
            ]);
        }

        // Optional: also save in session
        session(['phone' => $request->phone, 'phone_otp' => $otp]);

        $smsResult = $this->sendOtpphone($request->phone, $otp);
        Log::info('SMS result', $smsResult);

        if (!$smsResult['success']) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to send SMS: ' . $smsResult['message']
            ]);
        }

        return response()->json(['status' => true, 'message' => 'OTP sent successfully']);
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

        Log::info('Sending SMS OTP', [
            'number' => $number,
            'otp' => $otp,
            'url' => $url
        ]);

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            Log::error('SMS Curl error', ['error' => $error]);
            curl_close($ch);

            return [
                'success' => false,
                'message' => $error
            ];
        }

        curl_close($ch);

        Log::info('SMS sent successfully', ['response' => $response]);

        return [
            'success' => true,
            'response' => $response
        ];
    }


    // STEP 2: Verify OTP
    public function verifyPhoneOtp(Request $request)
    {
        $request->validate(['otp' => 'required', 'phone' => 'required']);

        $otpRecord = \App\Models\Otp::where('type', 'phone')
            ->where('value', $request->phone)
            ->where('otp', $request->otp)
            ->where('verified', false)
            ->where('expires_at', '>=', now())
            ->first();

        if ($otpRecord) {
            $otpRecord->update(['verified' => true]);
            session(['phone_verified' => true]);
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false, 'message' => 'Invalid or expired OTP']);
    }

    // STEP 2: Email OTP
    public function sendEmailOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:users,email'
    ]);

    Log::info('Send Email OTP request', ['email' => $request->email]);

    $otp = rand(100000, 999999);

    try {
        \App\Models\Otp::create([
            'type' => 'email',
            'value' => $request->email,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);

        Log::info('Email OTP saved to DB', ['otp' => $otp]);

    } catch (\Exception $e) {
        Log::error('Failed to save email OTP', ['error' => $e->getMessage()]);
        return response()->json([
            'status' => false,
            'message' => 'Failed to save OTP'
        ], 500);
    }

    Session::put('email', $request->email);
    Session::put('email_otp', $otp);

    try {
        Mail::to($request->email)->send(new OtpMail($otp));
        Log::info('Email sent successfully', ['email' => $request->email]);
    } catch (\Exception $e) {
        Log::error('Failed to send email', ['error' => $e->getMessage()]);
        return response()->json([
            'status' => false,
            'message' => 'Failed to send email'
        ], 500);
    }

    return response()->json([
        'status' => true,
        'message' => 'OTP sent to email'
    ]);
}



    public function verifyEmailOtp(Request $request)
    {
        $request->validate(['otp' => 'required', 'email' => 'required|email']);

        $otpRecord = \App\Models\Otp::where('type', 'email')
            ->where('value', $request->email)
            ->where('otp', $request->otp)
            ->where('verified', false)
            ->where('expires_at', '>=', now())
            ->first();

        if ($otpRecord) {
            $otpRecord->update(['verified' => true]);
            Session::put('email_verified', true);
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false, 'message' => 'Invalid or expired OTP']);
    }


    public function register()
    {
        return view('user.register');
    }

    public function registerStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'phone' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string',
            'password' => 'nullable|string|min:6',
            'status' => 'required',
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
            'role' => 'admin',  // Set to admin since new users become tenant admins
            'phone_verified' => session('phone_verified', false),
            'email_verified' => Session::get('email_verified', false),
        ]);

        // Assign tenant owner role 'admin' in custom roles table
        try {
            Role::firstOrCreate(['name' => 'admin']);
            $user->assignRole('admin');
        } catch (\Throwable $e) {
            // ignore failures
        }

        auth()->login($user);

        return response()->json(['status' => true, 'message' => 'Registration successful']);
    }

    public function userLoginForm()
    {
        return view('user.login');
    }

    // public function userLogin(Request $request)
    // {
    //     $request->validate([
    //         'login' => 'required',
    //     ]);

    //     $login = $request->login;

    //     // Detect login type
    //     $isEmail = filter_var($login, FILTER_VALIDATE_EMAIL);

    //     $user = User::where(
    //         $isEmail ? 'email' : 'phone',
    //         $login
    //     )->first();

    //     if (!$user) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'User not found'
    //         ]);
    //     }

    //     // Generate OTP
    //     $otp = rand(100000, 999999);

    //     Cache::put('login_otp_' . $user->id, $otp, now()->addMinutes(5));

    //     // ✅ SEND OTP ONLY BASED ON INPUT TYPE
    //     if ($isEmail) {
    //         // Send EMAIL OTP
    //         Mail::to($user->email)->send(new OtpMail($otp));
    //     } else {
    //         // Send SMS OTP
    //         $sms = $this->sendOtpphone($user->phone, $otp);

    //         if (!$sms['success']) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Failed to send OTP via SMS'
    //             ]);
    //         }
    //     }

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'OTP sent successfully'
    //     ]);
    // }

        public function userLogin(Request $request)
    {
        $request->validate([
            'login' => 'required',
        ]);

        $login = $request->login;
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

        $otp = rand(100000, 999999);

        /* ---------------------------
        1️⃣ Invalidate old OTPs
        ---------------------------- */
        Otp::where('value', $login)
            ->where('verified', false)
            ->update(['verified' => true]);

        /* ---------------------------
        2️⃣ Save OTP in DB
        ---------------------------- */
        Otp::create([
            'type' => $isEmail ? 'email' : 'phone',
            'value' => $login,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(5),
        ]);

        /* ---------------------------
        3️⃣ Optional Cache (Fast)
        ---------------------------- */
        Cache::put('login_otp_' . $user->id, $otp, now()->addMinutes(5));

        /* ---------------------------
        4️⃣ Send OTP
        ---------------------------- */
        if ($isEmail) {
            Mail::to($user->email)->send(new OtpMail($otp));
        } else {
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

    // public function logout(Request $request)
    // {
    //     Auth::logout();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return redirect()->route('login');
    // }


    public function logout(Request $request)
    {
        // Capture role BEFORE logout
        $role = Auth::check() ? Auth::user()->role : null;

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect based on role
        if ($role === 'super_admin') {
            return redirect()->route('superadmin.login');
        }

        return redirect()->route('login');
    }

}
