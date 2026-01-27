<?php

namespace App\Http\Controllers;

use App\Models\AddCompany;
use App\Models\User;
use App\Models\UserDelete;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Company;
use App\Models\Vendor;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\AddExpense;
use App\Models\HireRegister;
use App\Models\DomesticShipment;
use App\Models\Report;
use App\Models\VehicleHire;

class UserController extends Controller
{
    // public function dashboard()
    // {
    //     $userId = auth()->id();
    //     return view('user.dashboard', compact('userId'));
    // }

    public function dashboard()
    {
        $userId = auth()->id();
        $user = auth()->user();

        $data = [
            'usersCount'        => User::where('created_by', $userId)->count(),
            'companiesCount'    => AddCompany::where('user_id', $userId)->count(),
            'vendorsCount'      => Vendor::where('user_id', $userId)->count(),
            'branchesCount'     => Branch::where('user_id', $userId)->count(),
            'customersCount'    => Customer::where('user_id', $userId)->count(),
            'vehiclesCount'     => Vehicle::where('user_id', $userId)->count(),
            'driversCount'      => Driver::where('user_id', $userId)->count(),
            'expenseCount'      => AddExpense::where('user_id', $userId)->sum('amount'),
            'hireCount'         => VehicleHire::where('user_id', $userId)->count(),
            'shipmentsCount'    => DomesticShipment::where('user_id', $userId)->count(),
            'reportsCount'      => DomesticShipment::where('user_id', $userId)->count(),
        ];

        if ($user->role === 'admin') {
            $data['adminUsers'] = User::where('role', 'admin')->get();
        }

        return view('user.dashboard', $data);
    }

    public function index()
    {
        $users = User::where('created_by', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.index', compact('users'));
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            $branches = \App\Models\Branch::all();
        } elseif ($user->hasRole('admin')) {
            $userIds = \App\Models\User::where('created_by', $user->id)->orWhere('id', $user->id)->pluck('id');
            $branches = \App\Models\Branch::whereIn('user_id', $userIds)->get();
        } else {
            $branches = \App\Models\Branch::where('user_id', $user->id)->get();
        }

        return view('user.create', compact('branches'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validate only required fields
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'branch_id' => 'required|exists:branches,id',
            'status' => 'required',
        ]);

        // Generate random password (you can email it later)
        $password = Str::random(8);

        // Create user (other fields are nullable)
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'branch_id' => $validated['branch_id'],
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

        // User created successfully with branch assignment
        // Role assignment removed - now using branch-based access control

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

    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'    => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'state'   => 'nullable|string',
            'city'    => 'nullable|string',
        ]);

        $user->update([
            'name'    => $request->name,
            'phone' => $request->phone,
            'email'   => $request->email,
            'address' => $request->address,
            'country' => $request->country,
            'state'   => $request->state,
            'city'    => $request->city,
        ]);

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');
    }

    public function changePassword()
    {
        return view('user.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate(
            ['password' => 'required|confirmed'],
            ['password.confirmed' => 'New Password and Confirm Password do not match']
        );

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully');
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
}
