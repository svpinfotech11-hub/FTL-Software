<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\AdminUsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class SuperAdminController extends Controller
{
    public function getmethod()
    {
        if (Auth::check() && Auth::user()->role === 'super_admin') {
            return redirect()->route('superadmin.dashboard');
        }
        return view('admin.superadmin.login');
    }

    public function index()
    {
        $users = User::with('branch')
            ->where('role', 'admin')
            ->latest()
            ->get();

        return view('admin.superadmin.index', compact('users'));
    }

    public function dashboardpp()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('superadmin.login');
        }

        $usersCount = User::where('role', 'admin')->count();

        if ($user->role === 'super_admin') {

            $adminUsers = User::where('role', 'admin')->get();

            return view(
                'admin.superadmin.dashboard',
                compact('adminUsers', 'usersCount')
            );
        }

        if ($user->role === 'user') {
            return redirect()->route('pages.home');
        }

        Auth::logout();
        return redirect()->route('superadmin.login');
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
            if (Auth::user()->role !== 'super_admin') {
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

    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            $user->delete();
            return redirect()->back()->with('success', 'Admin deleted successfully!');
        }

        return redirect()->back()->with('error', 'You cannot delete this user!');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Admin user deleted successfully');
    }

    public function exportExcel()
    {
        return Excel::download(new AdminUsersExport, 'admin-users.xlsx');
    }

    public function exportPDF()
    {
        $users = User::where('role', 'admin')->get();
        $pdf = Pdf::loadView('admin.superadmin.export-pdf', compact('users'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('admin-users.pdf');
    }
}
