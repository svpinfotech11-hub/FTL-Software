<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\VehicleHire;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VehicleHireController extends Controller
{
    private function generateHireRegisterId()
    {
        $lastHire = VehicleHire::orderBy('id', 'desc')->first();
        $nextNumber = $lastHire ? intval(substr($lastHire->hire_register_id, 2)) + 1 : 1;
        return 'HR' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }
    public function index()
    {
     $vehicleHires = VehicleHire::with(['vendor', 'vehicle', 'driver'])->get();

        return view('vehicle_hires.index', compact('vehicleHires'));
    }

    public function create()
    {
        $drivers = Driver::all();
        $vehicles = Vehicle::all();
        $vendors = Vendor::all();
        $nextHireRegisterId = $this->generateHireRegisterId();
        return view('vehicle_hires.create', compact('drivers', 'vehicles', 'vendors', 'nextHireRegisterId'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'hire_date'        => 'nullable|date',
            'vendor_name'      => 'nullable|string|max:255',
            'vehicle_no'       => 'nullable|string|max:255',
            'driver_id' => 'nullable|integer|exists:drivers,id',
            'vendor_id' => 'nullable|integer|exists:vendors,id',
            'vehicle_id' => 'nullable|integer|exists:vehicles,id',
            'route_from'       => 'nullable|string|max:255',
            'route_to'         => 'nullable|string|max:255',
            'lr_manifest_no'   => 'nullable|string|max:255',

            'hire_rate'        => 'required|numeric|min:0',
            'advance_paid'     => 'nullable|numeric|min:0|lte:hire_rate',
            'balance_payable'  => 'nullable|numeric|min:0',
            'payment_status'   => 'nullable|in:Pending,Partial,Paid',
        ]);

        // Fetch vendor and vehicle details
        $vendor = $request->vendor_id ? Vendor::find($request->vendor_id) : null;
        $vehicle = $request->vehicle_id ? Vehicle::find($request->vehicle_id) : null;
        $driver = $request->driver_id ? Driver::find($request->driver_id) : null;

        VehicleHire::create([
            'user_id'          => auth()->id(),
            'hire_register_id' => $this->generateHireRegisterId(),
            'hire_date'        => $request->hire_date,
            'vendor_name'      => $vendor ? $vendor->vendor_name : $request->vendor_name,
            'vehicle_no'       => $vehicle ? $vehicle->vehicle_number : $request->vehicle_no,
            'vendor_id' => $request->vendor_id,
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'driver_details'   => $driver ? $driver->name . ' (' . $driver->contact_no . ')' : null,
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
$drivers = Driver::all();
        $vehicles = Vehicle::all();
        $vendors = Vendor::all();
        return view('vehicle_hires.edit', compact('vehicleHire', 'drivers', 'vehicles', 'vendors'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'hire_date'        => 'nullable|date',
            'vendor_name'      => 'nullable|string|max:255',
            'vehicle_no'       => 'nullable|string|max:255',
            'driver_id' => 'nullable|integer|exists:drivers,id',
            'vendor_id' => 'nullable|integer|exists:vendors,id',
            'vehicle_id' => 'nullable|integer|exists:vehicles,id',
            'route_from'       => 'nullable|string|max:255',
            'route_to'         => 'nullable|string|max:255',
            'lr_manifest_no'   => 'nullable|string|max:255',

            'hire_rate'        => 'required|numeric|min:0',
            'advance_paid'     => 'nullable|numeric|min:0|lte:hire_rate',
            'balance_payable'  => 'nullable|numeric|min:0',
            'payment_status'   => 'nullable|in:Pending,Partial,Paid',
        ]);

        $vehicleHire = VehicleHire::findOrFail($id);

        // Fetch vendor and vehicle details
        $vendor = $request->vendor_id ? Vendor::find($request->vendor_id) : null;
        $vehicle = $request->vehicle_id ? Vehicle::find($request->vehicle_id) : null;
        $driver = $request->driver_id ? Driver::find($request->driver_id) : null;

        $vehicleHire->update([
            'hire_date'         => $request->hire_date,
            'vendor_name'       => $vendor ? $vendor->vendor_name : $request->vendor_name,
            'vehicle_no'        => $vehicle ? $vehicle->vehicle_number : $request->vehicle_no,
            'vendor_id' => $request->vendor_id,
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'driver_details'    => $driver ? $driver->name . ' (' . $driver->contact_no . ')' : null,
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


    public function destroy($id)
    {
        $vehicleHire = VehicleHire::findOrFail($id);
        $vehicleHire->delete();

        return back()->with('success', 'Vehicle hire deleted.');
    }

    public function getVendor($id)
    {
        $vendor = Vendor::find($id);
        return response()->json($vendor);
    }

    public function getVehicle($id)
    {
        $vehicle = Vehicle::find($id);
        return response()->json($vehicle);
    }

    public function getDriver($id)
    {
        $driver = Driver::find($id);
        return response()->json($driver);
    }

}
