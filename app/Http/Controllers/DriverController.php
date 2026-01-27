<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = Driver::query();

        if ($user->hasRole('super_admin')) {
            // Super admin sees all drivers
            $drivers = $query->latest()->get();
        } elseif ($user->hasRole('admin')) {
            // Admin sees drivers created by themselves and their created users
            $userIds = \App\Models\User::where('created_by', $user->id)->orWhere('id', $user->id)->pluck('id');
            $drivers = $query->whereIn('user_id', $userIds)->latest()->get();
        } else {
            // Regular users see only their own drivers
            $drivers = $query->where('user_id', $user->id)->latest()->get();
        }

        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('drivers.create');
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $data = $request->all();
        $data['user_id'] = $userId;

        Driver::create($data);

        return redirect()->route('drivers.index')
            ->with('success', 'Driver added successfully');
    }

    public function edit($id)
    {
        $userId = Auth::id();

        $driver = Driver::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::id();

        $driver = Driver::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $driver->update($request->except('user_id'));

        return redirect()->route('drivers.index')
            ->with('success', 'Driver updated successfully');
    }

    public function destroy($id)
    {
        $userId = Auth::id();

        Driver::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail()
            ->delete();

        return redirect()->route('drivers.index')
            ->with('success', 'Driver deleted successfully');
    }
}
