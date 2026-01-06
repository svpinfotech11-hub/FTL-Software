<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDelete;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->id();
        return view('user.dashboard', compact('userId'));
    }

    public function index()
    {
        $users = User::where('created_by', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.index', compact('users'));
    }


    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validate only required fields
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'role' => 'required|in:super_admin,branch_manager,booking_executive,accounts_user,fleet_manager,vendor_manager,viewer',
            'status' => 'required',
        ]);

        // Generate random password (you can email it later)
        $password = Str::random(8);

        // Create user (other fields are nullable)
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'role' => $validated['role'],
            'status' => $validated['status'],
            'password' => Hash::make($password),
            // Optional nullable fields can be null
            'pan' => $request->pan ?? null,
            'gst' => $request->gst ?? null,
            'country' => $request->country ?? null,
            'state' => $request->state ?? null,
            'city' => $request->city ?? null,
            'address' => $request->address ?? null,
            'phone_verified' => $request->phone_verified ?? false,
            'email_verified' => $request->email_verified ?? false,
            'created_by'     => auth()->id(), // ✅ track who created
        ]);

        return redirect()->route('user.index')
            ->with('success', 'User created successfully.');
    }

    public function destroy(User $user)
    {
        UserDelete::create([
            'deleted_by' => auth()->id(),
            'user_id'    => $user->id,
            'user_name'  => $user->name,
            'user_email' => $user->email,
            'deleted_at' => now(),
        ]);

        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully.');
    }
}
