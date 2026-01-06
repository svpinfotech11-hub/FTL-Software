<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::latest()->get();
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('drivers.create');
    }

    public function store(Request $request)
    {
        Driver::create($request->all());

        return redirect()->route('drivers.index')
            ->with('success', 'Driver added successfully');
    }

    public function edit($id)
    {
        $driver = Driver::findOrFail($id);
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);
        $driver->update($request->all());

        return redirect()->route('drivers.index')
            ->with('success', 'Driver updated successfully');
    }

    public function destroy($id)
    {
        Driver::findOrFail($id)->delete();

        return redirect()->route('drivers.index')
            ->with('success', 'Driver deleted successfully');
    }
}
