<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

    // public function register(Request $request)
    // {
    //     if (!Session::get('phone_verified') || !Session::get('email_verified')) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Phone and Email verification required'
    //         ]);
    //     }

    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'password' => 'required|min:6',
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'phone' => Session::get('phone'),
    //         'email' => Session::get('email'),
    //         'pan' => $request->pan,
    //         'gst' => $request->gst,
    //         'country' => $request->country,
    //         'state' => $request->state,
    //         'city' => $request->city,
    //         'address' => $request->address,
    //         'password' => Hash::make($request->password),
    //         'phone_verified' => true,
    //         'email_verified' => true,
    //     ]);

    //     // ✅ Login user (SESSION STORED AUTOMATICALLY)
    //     Auth::login($user);

    //     // clear temp session data
    //     Session::forget([
    //         'phone',
    //         'email',
    //         'phone_verified',
    //         'email_verified',
    //         'phone_otp',
    //         'email_otp'
    //     ]);

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Registered & logged in successfully'
    //     ]);
    // }



    public function register(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string',
            'password' => 'required|string|min:6',
            'status' => 'required',
            'role' => 'required|in:' . implode(',', array_keys($this->roles())),
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
        ]);

        auth()->login($user);

        return response()->json(['status' => true, 'message' => 'Registration successful']);
    }

    public function userLoginForm(){
         return view('user.login');
    }
    // public function userLogin(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();

    //         $user = Auth::user();

    //         // Default redirect
    //         $redirect = route('user.dashboard');

    //         // Role-based redirect
    //         if ($user->role === 'super_admin') {
    //             $redirect = route('admin.dashboard');
    //         } elseif ($user->role === 'user') {
    //             $redirect = route('user.dashboard');
    //         }

    //         return response()->json([
    //             'status'   => true,
    //             'message'  => 'Login successful',
    //             'role'     => $user->role,
    //             'redirect' => $redirect
    //         ]);
    //     }

    //     return response()->json([
    //         'status' => false,
    //         'message' => 'Invalid credentials'
    //     ]);
    // }


     protected function roles(): array
    {
        return [
            'super_admin'       => 'Super Admin',
            'branch_manager'    => 'Branch Manager',
            'booking_executive' => 'Booking Executive',
            'accounts_user'     => 'Accounts User',
            'fleet_manager'     => 'Fleet Manager',
            'vendor_manager'    => 'Vendor Manager',
            'viewer'            => 'Viewer / Reports Only',
        ];
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
