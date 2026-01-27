<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = Vehicle::query();

        if ($user->hasRole('super_admin')) {
            // Super admin sees all vehicles
            $vehicles = $query->latest()->get();
        } elseif ($user->hasRole('admin')) {
            // Admin sees vehicles created by themselves and their created users
            $userIds = \App\Models\User::where('created_by', $user->id)->orWhere('id', $user->id)->pluck('id');
            $vehicles = $query->whereIn('user_id', $userIds)->latest()->get();
        } else {
            // Regular users see only their own vehicles
            $vehicles = $query->where('user_id', $user->id)->latest()->get();
        }

        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
{
    // Get the last vehicle
    $lastVehicle = Vehicle::orderBy('id', 'desc')->first();

    if ($lastVehicle && $lastVehicle->vehicle_number) {
        $lastNumber = intval(substr($lastVehicle->vehicle_number, 2));
        $newNumber = $lastNumber + 1;
    } else {
        $newNumber = 1;
    }

    // Format the number: VH0001, VH0002...
    // $vehicleNumber = 'VH' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

    // Pass it to the view
    return view('vehicles.create');
}


    public function store(Request $request)
    {
        $userId = Auth::id();

        $data = $request->all();
        $data['user_id'] = $userId;

        Vehicle::create($data);

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle added successfully');
    }

    public function edit($id)
    {
        $userId = Auth::id();

        $vehicle = Vehicle::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::id();

        $vehicle = Vehicle::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $vehicle->update($request->except('user_id'));

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle updated successfully');
    }

    public function destroy($id)
    {
        $userId = Auth::id();

        Vehicle::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail()
            ->delete();

        return redirect()->route('vehicles.index')
            ->with('success', 'Vehicle deleted successfully');
    }
}
