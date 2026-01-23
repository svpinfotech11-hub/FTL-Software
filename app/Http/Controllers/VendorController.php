<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    // Show create form
    public function create()
    {
        return view('vendors.create');
    }

    // List vendors for the logged-in user
    public function index()
    {
        $vendors = Vendor::where('user_id', auth()->id()) // only user's vendors
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('vendors.index', compact('vendors'));
    }

    // Store a new vendor for the logged-in user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vendor_name' => 'required|string',
            'contact' => 'required|string',
            'address' => 'required|string',
            'pincode' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'rate_per_kg' => 'required|numeric',
            'minimum_kg' => 'required|numeric',
        ]);

        $validated['user_id'] = auth()->id(); // attach logged-in user

        Vendor::create($validated);

        return redirect()->route('vendors.index')
            ->with('success', 'Vendor Created Successfully!');
    }

    // Show a single vendor (only if belongs to user)
    public function show($id)
    {
        $vendor = Vendor::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return $vendor;
    }

    public function edit($id)
    {
        $vendor = Vendor::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('vendors.edit', compact('vendor'));
    }


    // Update vendor (only if belongs to user)
    public function update(Request $request, $id)
    {
        $vendor = Vendor::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $vendor->update($request->all());

        return redirect()->route('vendors.index')
            ->with('success', 'Vendor Updated Successfully!');
    }

    // Delete vendor (only if belongs to user)
    public function destroy($id)
    {
        $vendor = Vendor::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $vendor->delete();

        return response()->json(['message' => 'Vendor deleted successfully']);
    }
}
