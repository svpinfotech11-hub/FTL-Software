<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $drivers = Driver::where('user_id', $userId)->latest()->get();
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
