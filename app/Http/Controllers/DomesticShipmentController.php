<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DomesticShipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DomesticShipmentController extends Controller
{
    public function index()
    {
        $shipments = DomesticShipment::all();
        return view('shipment.index', compact('shipments'));
    }

   public function create()
{
    $userId = auth()->id(); // current logged-in user

    // Fetch consignees saved by this user
    $consignees = DomesticShipment::where('consignee_save_to_address_book', 1)
        ->where('user_id', $userId)
        ->select(
            'id',
            'consignee_name',
            'consignee_company',
            'consignee_address',
            'consignee_pincode',
            'consignee_state',
            'consignee_city',
            'zone',
            'consignee_contact',
            'gst_no'
        )
        ->get();

    // Fetch consigners saved by this user
    $consigners = DomesticShipment::where('consigner_save_to_address_book', 1)
        ->where('user_id', $userId)
        ->select(
            'id',
            'consigner_name',
            'consigner_address',
            'consigner_pincode',
            'consigner_state',
            'consigner_city',
            'consigner_contact',
            'coll_type',
            'delivery_type'
        )
        ->get();

    // Fetch states (no user filter needed)
    $states = DB::table('cities')
        ->select('city_state')
        ->distinct()
        ->orderBy('city_state')
        ->get();

        $customers = Customer::all();

    return view('shipment.create', compact('consignees', 'consigners', 'states', 'customers'));
}


    public function store(Request $request)
    {
        $request->validate(
            [
                'airway_no' => 'required|unique:domestic_shipments,airway_no',
            ],
            [
                'airway_no.required' => 'Airway Number is required.',
                'airway_no.unique'   => 'This Airway Number already exists.',
            ]
        );

        $data = $request->except(['invoices', 'charges']);

            $data['user_id'] = auth()->id(); // <-- Add this line

        if ($request->has('charges')) {
            foreach ($request->charges as $key => $value) {
                $data[$key] = $value;
            }
        }

        $shipment = DomesticShipment::create($data);

        if ($request->has('invoices')) {
            foreach ($request->invoices as $invoice) {
                $shipment->invoices()->create($invoice);
            }
        }

        return redirect()->back()->with('success', 'Shipment Added Successfully');
    }

    public function edit($id)
    {
        $shipment = DomesticShipment::with('invoices')->findOrFail($id);

        $consignees = DomesticShipment::where('consignee_save_to_address_book', 1)->get();
        $consigners = DomesticShipment::where('consigner_save_to_address_book', 1)->get();

        $states = DB::table('cities')
            ->select('city_state')
            ->distinct()
            ->orderBy('city_state')
            ->get();

        return view('shipment.edit', compact(
            'shipment',
            'consignees',
            'consigners',
            'states'
        ));
    }

    public function update(Request $request, $id)
    {
        $shipment = DomesticShipment::findOrFail($id);

        $request->validate(
            [
                'airway_no' => [
                    'required',
                    Rule::unique('domestic_shipments', 'airway_no')->ignore($shipment->id),
                ],
            ],
            [
                'airway_no.required' => 'Airway Number is required.',
                'airway_no.unique'   => 'This Airway Number already exists.',
            ]
        );

        $data = $request->except(['invoices', 'charges', '_method']);

        if ($request->has('charges')) {
            foreach ($request->charges as $key => $value) {
                $data[$key] = $value;
            }
        }

        $shipment->update($data);

        $shipment->invoices()->delete();

        if ($request->has('invoices')) {
            foreach ($request->invoices as $invoice) {
                $shipment->invoices()->create($invoice);
            }
        }

        return redirect()
            ->route('domestic.shipment.edit', $shipment->id)
            ->with('success', 'Shipment Updated Successfully');
    }

    public function destroy($id)
    {
        $shipment = DomesticShipment::findOrFail($id);
        $shipment->delete();

        return redirect()->route('domestic.shipment.index')
            ->with('success', 'Shipment deleted successfully.');
    }


   public function getCities($state)
{
    // Optional: Basic validation
    if (empty($state)) {
        return response()->json([]);
    }

    // Fetch cities matching the state
    $cities = DB::table('cities')
        ->where('city_state', $state)
        ->select('city_name')
        ->orderBy('city_name')
        ->get();

    return response()->json($cities);
}

}
