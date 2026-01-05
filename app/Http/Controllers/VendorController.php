<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
     public function create()
    {
        return view('vendors.create');
    }

     public function index()
    {
        $vendors = Vendor::paginate(10);
        return view('vendors.index', compact('vendors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vendor_name' => 'required|string',
            'contact' => 'required|string',
            'address' => 'required|string',
            'pincode' => 'required',
            'state' => 'required',
            'city' => 'required',
            'rate_per_kg' => 'required|numeric',
            'minimum_kg' => 'required|numeric',
        ]);

     Vendor::create($validated);

     return redirect('vendors/index')->with('success', 'Vendor Created SuccessFully!');
    }

    public function show($id)
    {
        return Vendor::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update($request->all());
        return $vendor;
    }

    public function destroy($id)
    {
        Vendor::findOrFail($id)->delete();
        return response()->json(['message' => 'Vendor deleted']);
    }
}
