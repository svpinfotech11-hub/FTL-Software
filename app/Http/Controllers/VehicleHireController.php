<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\VehicleHire;
use Illuminate\Http\Request;

class VehicleHireController extends Controller
{
    public function index()
    {
        $vehicleHires = VehicleHire::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('vehicle_hires.index', compact('vehicleHires'));
    }

    public function create()
    {
         $drivers = Driver::all(); 
        return view('vehicle_hires.create', compact('drivers'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'hire_date'        => 'nullable|date',
            'vendor_name'      => 'nullable|string|max:255',
            'vehicle_no'       => 'nullable|string|max:255',
            'driver_details'   => 'nullable|string|max:255',
            'route_from'       => 'nullable|string|max:255',
            'route_to'         => 'nullable|string|max:255',
            'lr_manifest_no'   => 'nullable|string|max:255',

            'hire_rate'        => 'required|numeric|min:0',
            'advance_paid'     => 'nullable|numeric|min:0|lte:hire_rate',
            'balance_payable'  => 'nullable|numeric|min:0',
            'payment_status'   => 'nullable|in:Pending,Partial,Paid',
        ]);

        VehicleHire::create([
            'user_id'          => auth()->id(),
            'hire_date'        => $request->hire_date,
            'vendor_name'      => $request->vendor_name,
            'vehicle_no'       => $request->vehicle_no,
            'driver_details'   => $request->driver_details,
            'route_from'       => $request->route_from,
            'route_to'         => $request->route_to,
            'lr_manifest_no'   => $request->lr_manifest_no,
            'hire_rate'        => $request->hire_rate,
            'advance_paid'     => $request->advance_paid,
            'balance_payable'  => $request->balance_payable,
            'payment_status'   => $request->payment_status,
        ]);

        return redirect()
            ->route('vehicle_hires.index')
            ->with('success', 'Vehicle hire entry created successfully.');
    }

    public function show(VehicleHire $vehicleHire)
    {
        return view('vehicle_hires.show', compact('vehicleHire'));
    }

    public function edit($id)
    {
        $vehicleHire = VehicleHire::findOrFail($id);

        return view('vehicle_hires.edit', compact('vehicleHire'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'hire_date'        => 'nullable|date',
            'vendor_name'      => 'nullable|string|max:255',
            'vehicle_no'       => 'nullable|string|max:255',
            'driver_details'   => 'nullable|string|max:255',
            'route_from'       => 'nullable|string|max:255',
            'route_to'         => 'nullable|string|max:255',
            'lr_manifest_no'   => 'nullable|string|max:255',

            'hire_rate'        => 'required|numeric|min:0',
            'advance_paid'     => 'nullable|numeric|min:0|lte:hire_rate',
            'balance_payable'  => 'nullable|numeric|min:0',
            'payment_status'   => 'nullable|in:Pending,Partial,Paid',
        ]);

        $vehicleHire = VehicleHire::findOrFail($id);

        $vehicleHire->update([
            'hire_date'         => $request->hire_date,
            'vendor_name'       => $request->vendor_name,
            'vehicle_no'        => $request->vehicle_no,
            'driver_details'    => $request->driver_details,
            'route_from'        => $request->route_from,
            'route_to'          => $request->route_to,
            'lr_manifest_no'    => $request->lr_manifest_no,
            'hire_rate'         => $request->hire_rate,
            'advance_paid'      => $request->advance_paid,
            'balance_payable'   => $request->balance_payable,
            'payment_status'    => $request->payment_status,
            'remarks'           => $request->remarks,
        ]);

        return redirect()
            ->route('vehicle_hires.index')
            ->with('success', 'Vehicle hire updated successfully.');
    }


    public function destroy(VehicleHire $vehicleHire)
    {
        $vehicleHire->delete();

        return back()->with('success', 'Vehicle hire deleted.');
    }
}
