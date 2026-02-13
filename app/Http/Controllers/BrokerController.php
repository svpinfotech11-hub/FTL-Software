<?php

namespace App\Http\Controllers;

use App\Models\Broker;
use Illuminate\Http\Request;

class BrokerController extends Controller
{
    public function index()
    {
        $brokers = Broker::latest()->get();
        return view('brokers.index', compact('brokers'));
    }

    public function create()
    {
        return view('brokers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'broker_name' => 'required',
        ]);

        Broker::create($request->all());

        return redirect()->route('brokers.index')->with('success', 'Broker Added Successfully');
    }

    public function edit($id)
    {
        $broker = Broker::findOrFail($id);
        return view('brokers.edit', compact('broker'));
    }

    public function update(Request $request, $id)
    {
        $broker = Broker::findOrFail($id);

        $request->validate([
            'broker_name' => 'required',
        ]);

        $broker->update($request->all());

        return redirect()->route('brokers.index')->with('success', 'Broker Updated Successfully');
    }

    public function destroy($id)
    {
        $broker = Broker::findOrFail($id);
        $broker->delete();

        return redirect()->route('brokers.index')->with('success', 'Broker Deleted Successfully');
    }
}
