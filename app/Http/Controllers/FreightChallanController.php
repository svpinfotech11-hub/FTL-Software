<?php

namespace App\Http\Controllers;

use App\Models\Broker;
use App\Models\Driver;
use App\Models\FreightChallan;
use App\Models\Ledger;
use Illuminate\Http\Request;

class FreightChallanController extends Controller
{
    public function index()
    {
        $challans = FreightChallan::with('broker', 'driver')->latest()->get();
        return view('freight-challan.index', compact('challans'));
    }

    public function create()
    {
        $brokers = Broker::all();
        $drivers = Driver::all();
        $ledgers = Ledger::all();
        return view('freight-challan.create', compact('brokers','drivers','ledgers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'challan_no' => 'required',
        ]);

        FreightChallan::create($request->all());
        return redirect()->route('freight-challan.index')
            ->with('success', 'Freight Challan Created Successfully');
    }

    public function edit($id)
    {
        $brokers = Broker::all();
        $drivers = Driver::all();
        $ledgers = Ledger::all();
        $freightChallan = FreightChallan::findOrFail($id);
        return view('freight-challan.edit', compact('freightChallan', 'brokers', 'drivers', 'ledgers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'challan_no' => 'required',
        ]);

        $challan = FreightChallan::findOrFail($id);
        $challan->update($request->all());

        return redirect()->route('freight-challan.index')
            ->with('success', 'Freight Challan Updated Successfully');
    }

    public function destroy($id)
    {
        FreightChallan::findOrFail($id)->delete();
        return back()->with('success', 'Deleted Successfully');
    }
}
