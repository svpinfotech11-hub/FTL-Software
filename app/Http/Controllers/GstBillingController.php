<?php

namespace App\Http\Controllers;

use App\Models\Consignee;
use App\Models\Consigner;
use App\Models\GstBilling;
use App\Models\Product;
use Illuminate\Http\Request;

class GstBillingController extends Controller
{
    public function index()
    {
        $billings = GstBilling::with(['consigner', 'consignee', 'product'])->latest()->get();
        return view('gst_billing.index', compact('billings'));
    }

    public function create()
    {
        $consigners = Consigner::all();
        $consignees = Consignee::all();
        $products = Product::all();
        return view('gst_billing.create', compact('consigners', 'consignees', 'products'));
    }

    public function store(Request $request)
    {
        GstBilling::create($request->all());
        return redirect()->route('gst-billing.index')
            ->with('success', 'Invoice Created Successfully');
    }

    public function edit($id)
    {
        $gstBilling = GstBilling::findOrFail($id);
        $consigners = Consigner::all();
        $consignees = Consignee::all();
        $products = Product::all();
        return view('gst_billing.edit', compact('gstBilling', 'consigners', 'consignees', 'products'));
    }

    public function update(Request $request, $id)
    {
        $billing = GstBilling::findOrFail($id);
        $billing->update($request->all());

        return redirect()->route('gst-billing.index')
            ->with('success', 'Invoice Updated Successfully');
    }

    public function destroy($id)
    {
        GstBilling::destroy($id);
        return back()->with('success', 'Deleted Successfully');
    }
}
