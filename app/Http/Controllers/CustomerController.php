<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customer::where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_code' => 'required|unique:customers,customer_code',
            'customer_name' => 'required|string|max:255',
            'phone'         => 'required|digits:10',    // 10 digits exactly
            'pincode'       => 'required|digits:6',     // 6 digits exactly
        ]);


        // Fetch State & City from Pincode table
        $pincode = DB::table('pincodes')
            ->where('pincode', $request->pincode)
            ->first();

        if (!$pincode) {
            return response()->json(['error' => 'Invalid Pincode'], 422);
        }

        $customer = Customer::create([
            'user_id' => auth()->id(),   // Important: Track which user created this record
            'customer_code' => $request->customer_code,
            'customer_name' => $request->customer_name,
            'contact_person' => $request->contact_person,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'pincode' => $request->pincode,
            'state' => $pincode->state,
            'city' => $pincode->city,
            'gst_no' => $request->gst_no,
            'gst_charges' => $request->gst_charges ?? 0,
            'credit_days' => $request->credit_days ?? 0,
        ]);

        return redirect('customers/index')->with('success', 'Customer created successfully');
    }

    public function destroy($id)
    {
        // Fetch customer only if it belongs to the logged-in user
        $customer = Customer::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$customer) {
            return back()->with('error', 'Customer not found or unauthorized');
        }

        $customer->delete();

        return back()->with('success', 'Customer deleted successfully');
    }
}
