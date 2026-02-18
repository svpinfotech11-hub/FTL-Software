<?php

namespace App\Http\Controllers;

use App\Models\BookingEntry;
use App\Models\Broker;
use App\Models\Driver;
use App\Models\LoadingChallan;
use Illuminate\Http\Request;

class LoadingChallanController extends Controller
{
    public function index()
    {
        $challans = LoadingChallan::with('broker', 'driver')->latest()->get();
        return view('loading_challan.index', compact('challans'));
    }

    public function create()
    {
        $brokers = Broker::all();
        $drivers = Driver::all();
        $lr_no = BookingEntry::all();
        return view('loading_challan.create', compact('brokers', 'drivers', 'lr_no'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'challan_no' => 'required',
        ]);

        LoadingChallan::create($request->all());

        return redirect()->route('loading-challan.index')
            ->with('success', 'Challan Created Successfully');
    }

    public function edit($id)
    {
        $loadingChallan = LoadingChallan::findOrFail($id);
        $brokers = Broker::all();
        $drivers = Driver::all();
        $lr_no = BookingEntry::all();

        return view(
            'loading_challan.edit',
            compact('loadingChallan', 'brokers', 'drivers', 'lr_no')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'challan_no' => 'required',
        ]);

        $challan = LoadingChallan::findOrFail($id);
        $challan->update($request->all());
        return redirect()->route('loading-challan.index')->with('success', 'Challan Updated Successfully');
    }

    public function destroy($id)
    {
        LoadingChallan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
