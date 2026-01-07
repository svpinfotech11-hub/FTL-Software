<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $vehicles = Vehicle::where('user_id', $userId)->latest()->get();
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
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
