<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    public function getmethod()
    {
        return view('admin.superadmin.login');
    }

    public function dashboardpp()
    {
        $user = Auth::user();

        // Safety check
        if (!$user) {
            return redirect()->route('login');
        }

        // Redirect based on role
        if ($user->role === 'superadmin') {
            return view('admin.superadmin.dashboard');   // superadmin dashboard
        }

        if ($user->role === 'user') {
            return redirect()->route('user.dashboard');
        }

        // Fallback (optional)
        Auth::logout();
        return redirect()->route('login');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 🔐 Only allow superadmin
            if (Auth::user()->role !== 'superadmin') {
                Auth::logout();

                return redirect()
                    ->route('superadmin.login')
                    ->withErrors(['email' => 'Unauthorized access']);
            }

            // ✅ SUCCESS REDIRECT
            return redirect()->route('superadmin.dashboard');
        }

        return back()
            ->withErrors(['email' => 'Invalid email or password'])
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('superadmin.login');
    }
}
