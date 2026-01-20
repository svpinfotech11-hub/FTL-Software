<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Customer;
use App\Models\Consignee;
use App\Models\Consigner;
use App\Models\VehicleHire;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\DomesticShipment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DomesticShipmentController extends Controller
{
    public function index()
    {
        $shipments = DomesticShipment::with([
            'consigner:id,name',
            'consignee:id,name,city,pincode',
            'user:id,name',
            'vehicleHire:id,vendor_name'
        ])
            ->where('user_id', auth()->id()) // 🔑 filter by auth user
            ->latest()
            ->get();

        return view('shipment.index', compact('shipments'));
    }


    // public function create()
    // {
    //     $userId = auth()->id(); // current logged-in user

    //     // Fetch consignees saved by this user
    //     $consignees = DomesticShipment::where('consignee_save_to_address_book', 1)
    //         ->where('user_id', $userId)
    //         ->select(
    //             'id',
    //             'consignee_name',
    //             'consignee_company',
    //             'consignee_address',
    //             'consignee_pincode',
    //             'consignee_state',
    //             'consignee_city',
    //             'zone',
    //             'consignee_contact',
    //             'gst_no'
    //         )
    //         ->get();

    //     // Fetch consigners saved by this user
    //     $consigners = DomesticShipment::where('consigner_save_to_address_book', 1)
    //         ->where('user_id', $userId)
    //         ->select(
    //             'id',
    //             'consigner_name',
    //             'consigner_address',
    //             'consigner_pincode',
    //             'consigner_state',
    //             'consigner_city',
    //             'consigner_contact',
    //             'coll_type',
    //             'delivery_type'
    //         )
    //         ->get();

    //     // Fetch states (no user filter needed)
    //     $states = DB::table('cities')
    //         ->select('city_state')
    //         ->distinct()
    //         ->orderBy('city_state')
    //         ->get();
    // }




    public function create()
    {
        $userId = auth()->id();

        $consigners = Consigner::where('user_id', $userId)
            ->where('is_saved', 1)
            ->get();

        // dd($consigners);

        $consignees = Consignee::where('user_id', $userId)
            ->where('is_saved', 1)
            ->get();

        $states = DB::table('cities')
            ->select('city_state')
            ->distinct()
            ->orderBy('city_state')
            ->get();

        $customers = Customer::where('user_id', $userId)->get();

        $vehicleHires = VehicleHire::where('user_id', $userId)->get();

        $drivers = Driver::all();

        return view('shipment.create', compact(
            'consigners',
            'consignees',
            'states',
            'customers',
            'vehicleHires',
            'drivers'
        ));
    }


    public function store(Request $request)
    {
        Log::info('🚚 Shipment store started', [
            'user_id' => auth()->id(),
            'payload' => $request->all(),
        ]);

        $request->validate([
            'vehicle_type' => 'required|in:own,rented',
        ]);

        if ($request->vehicle_type === 'own') {
            $request->validate([
                'vehicle_number' => 'required',
                'driver_name'    => 'required',
                'driver_number'  => 'required',
            ]);
        }

        if ($request->vehicle_type === 'rented') {
            $request->validate([
                'vehicle_hire_id' => 'required|exists:vehicle_hires,id',
            ]);
        }

        DB::beginTransaction();

        try {

            /* =======================
            | 1️⃣ HANDLE CONSIGNER
            =======================*/

            $consignerId = null;

            Log::info('📦 Consigner input', [
                'consigner_id'   => $request->consigner_id,
                'save_consigner' => $request->save_consigner,
            ]);

            // EXISTING CONSIGNER
            if (!empty($request->consigner_id)) {
                $consignerId = $request->consigner_id;

                Log::info('✅ Existing consigner used', [
                    'consigner_id' => $consignerId,
                ]);
            }

            // NEW CONSIGNER (save OR temp)
            if (empty($request->consigner_id)) {

                $request->validate([
                    'consigner_name'    => 'required',
                    'consigner_address' => 'required',
                    'consigner_pincode' => 'required',
                    'consigner_state'   => 'required',
                    'consigner_city'    => 'required',
                    'consigner_contact' => 'required',
                ]);

                $consigner = Consigner::create([
                    'user_id'       => auth()->id(),
                    'customer_id'   => $request->customer_id,
                    'name'          => $request->consigner_name,
                    'address'       => $request->consigner_address,
                    'pincode'       => $request->consigner_pincode,
                    'state'         => $request->consigner_state,
                    'city'          => $request->consigner_city,
                    'contact_no'    => $request->consigner_contact,
                    'type_of_doc'   => $request->consigner_type_of_doc,
                    'consigner_doc_number'    => $request->consigner_doc_number,
                    'gst_no'        => $request->gst_no,
                    // 'coll_type'     => $request->coll_type,
                    // 'delivery_type' => $request->delivery_type,
                    'is_saved'      => $request->save_consigner ? 1 : 0,
                ]);

                $consignerId = $consigner->id;

                Log::info('🆕 New consigner created', [
                    'consigner_id' => $consignerId,
                    'is_saved'     => $request->save_consigner ? 1 : 0,
                ]);
            }

            /* =======================
            | 2️⃣ HANDLE CONSIGNEE
            =======================*/

            $consigneeId = null;

            Log::info('📦 Consignee input', [
                'consignee_id'   => $request->consignee_id,
                'save_consignee' => $request->save_consignee,
            ]);

            // EXISTING CONSIGNEE
            if (!empty($request->consignee_id)) {
                $consigneeId = $request->consignee_id;

                Log::info('✅ Existing consignee used', [
                    'consignee_id' => $consigneeId,
                ]);
            }

            // NEW CONSIGNEE (save OR temp)
            if (empty($request->consignee_id)) {

                $request->validate([
                    'consignee_name'    => 'required',
                    'consignee_address' => 'required',
                    'consignee_pincode' => 'required',
                    'consignee_state'   => 'required',
                    'consignee_city'    => 'required',
                    'consignee_contact' => 'required',
                ]);

                $consignee = Consignee::create([
                    'user_id'    => auth()->id(),
                    'name'       => $request->consignee_name,
                    'company'    => $request->consignee_company,
                    'address'    => $request->consignee_address,
                    'pincode'    => $request->consignee_pincode,
                    'state'      => $request->consignee_state,
                    'city'       => $request->consignee_city,
                    'zone'       => $request->zone,
                    'contact_no' => $request->consignee_contact,
                    'gst_no'     => $request->consignee_gst,
                    'is_saved'   => $request->save_consignee ? 1 : 0,
                ]);

                $consigneeId = $consignee->id;

                Log::info('🆕 New consignee created', [
                    'consignee_id' => $consigneeId,
                    'is_saved'     => $request->save_consignee ? 1 : 0,
                ]);
            }

            /* =======================
            | 3️⃣ SAVE SHIPMENT
            =======================*/

            Log::info('🚛 Creating shipment', [
                'user_id'      => auth()->id(),
                'customer_id'  => $request->customer_id,
                'consigner_id' => $consignerId,
                'consignee_id' => $consigneeId,
            ]);

            /* =======================
            | 3️⃣ VEHICLE TYPE LOGIC
            =======================*/

            Log::info('🚚 Vehicle type handling', [
                'vehicle_type' => $request->vehicle_type,
            ]);

            $data = [
                'vehicle_type' => $request->vehicle_type,
            ];

            if ($request->vehicle_type === 'own') {
                $data['vehicle_number'] = $request->vehicle_number;
                $data['driver_name']    = $request->driver_name;
                $data['driver_number']  = $request->driver_number;
                $data['vehicle_hire_id'] = null;
            }

            if ($request->vehicle_type === 'rented') {
                $hire = VehicleHire::findOrFail($request->vehicle_hire_id);

                $data['vehicle_hire_id'] = $hire->id;
                $data['vehicle_number'] = $hire->vehicle_no;
                $data['driver_name']    = $hire->driver_details;
                $data['driver_number']  = null;
            }

            // DomesticShipment::create([
            //     'user_id'           => auth()->id(),
            //     'customer_id'       => $request->customer_id,
            //     'consigner_id'      => $consignerId,
            //     'consignee_id'      => $consigneeId,
            //     'shipment_date'     => $request->shipment_date,
            //     'courier'           => $request->courier,
            //     'airway_no'         => $request->airway_no,
            //     'risk_type'         => $request->risk_type,
            //     'bill_type'         => $request->bill_type,
            //     'driver_details'         => $request->driver_details,
            //     'description'       => $request->description,
            //     'vehicle_no'        => $request->vehicle_no,
            //     'pkt'               => $request->pkt,
            //     'qty'               => $request->qty,
            //     'actual_weight'     => $request->actual_weight,
            //     'chargeable_weight' => $request->chargeable_weight,
            //     'sub_total'         => $request->sub_total,
            //     'tax_type'          => $request->tax_type,
            //     'tax'               => $request->tax,
            //     'cgst'              => $request->cgst,
            //     'sgst'              => $request->sgst,
            //     'igst'              => $request->igst,
            //     'grand_total'       => $request->grand_total,
            // ]);


            DomesticShipment::create(array_merge([
                'user_id'           => auth()->id(),
                'customer_id'       => $request->customer_id,
                'consigner_id'      => $consignerId,
                'consignee_id'      => $consigneeId,
                'shipment_date'     => $request->shipment_date,
                'courier'           => $request->courier,
                'airway_no'         => $request->airway_no,
                'risk_type'         => $request->risk_type,
                'bill_type'         => $request->bill_type,
                // 'description'       => $request->description,
                'pkt'               => $request->pkt,
                'qty'               => $request->qty,
                'actual_weight'     => $request->actual_weight,
                'chargeable_weight' => $request->chargeable_weight,
                'sub_total'         => $request->sub_total,
                // 'tax_type'          => $request->tax_type,
                'tax'               => $request->tax,
                'cgst'              => $request->cgst,
                'sgst'              => $request->sgst,
                'igst'              => $request->igst,
                'grand_total'       => $request->grand_total,
            ], $data));


            DB::commit();

            Log::info('✅ Shipment stored successfully');

            return redirect()
                ->route('domestic.shipment.index')
                ->with('success', 'Shipment saved successfully!');
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('❌ Shipment store failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $userId = auth()->id();
        $shipment = DomesticShipment::with([
            'invoices',
            'consigner',
            'consignee'
        ])->findOrFail($id);

        // dd($shipment);
        // Fetch saved consigners
        $consigners = Consigner::where('user_id', auth()->id())
            ->where('is_saved', 1)
            ->get();

        // dd($consigners);

        // Fetch saved consignees
        $consignees = Consignee::where('user_id', auth()->id())
            ->where('is_saved', 1)
            ->get();

        $customers = Customer::where('user_id', $userId)->get();

        return view('shipment.edit', compact(
            'shipment',
            'consigners',
            'consignees',
            'customers'
        ));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $shipment = DomesticShipment::findOrFail($id);

            /* =====================================================
         | 1️⃣ HANDLE CONSIGNER
         ===================================================== */

            if ($request->consigner_id) {

                // Existing consigner selected
                $consignerId = $request->consigner_id;
            } elseif ($request->save_consigner) {

                // Create NEW consigner & save to address book
                $consigner = Consigner::create([
                    'user_id'     => auth()->id(),
                    'customer_id' => $request->customer_id,
                    'name'        => $request->consigner_name,
                    'address'     => $request->consigner_address,
                    'pincode'     => $request->consigner_pincode,
                    'state'       => $request->consigner_state,
                    'city'        => $request->consigner_city,
                    'contact_no'  => $request->consigner_contact,
                    'type_of_doc' => $request->consigner_type_of_doc,
                    'gst_no'      => $request->consigner_type_of_doc,
                    'is_saved'    => 1,
                ]);

                $consignerId = $consigner->id;
            } else {
                // Use existing linked consigner (no change)
                $consignerId = $shipment->consigner_id;
            }


            /* =====================================================
         | 2️⃣ HANDLE CONSIGNEE
         ===================================================== */

            if ($request->consignee_id) {

                // Existing consignee selected
                $consigneeId = $request->consignee_id;
            } elseif ($request->save_consignee) {

                // Create NEW consignee & save to address book
                $consignee = Consignee::create([
                    'user_id'    => auth()->id(),
                    'name'       => $request->consignee_name,
                    'company'    => $request->consignee_company,
                    'address'    => $request->consignee_address,
                    'pincode'    => $request->consignee_pincode,
                    'state'      => $request->consignee_state,
                    'city'       => $request->consignee_city,
                    'zone'       => $request->zone,
                    'contact_no' => $request->consignee_contact,
                    'gst_no'     => $request->consignee_gst,
                    'is_saved'   => 1,
                ]);

                $consigneeId = $consignee->id;
            } else {
                // Keep existing consignee
                $consigneeId = $shipment->consignee_id;
            }


            /* =====================================================
         | 3️⃣ UPDATE SHIPMENT
         ===================================================== */

            $shipment->update([
                'customer_id'       => $request->customer_id,
                'consigner_id'      => $consignerId,
                'consignee_id'      => $consigneeId,
                'shipment_date'     => $request->shipment_date,
                'courier'           => $request->courier,
                'airway_no'         => $request->airway_no,
                'risk_type'         => $request->risk_type,
                'bill_type'         => $request->bill_type,
                'description'       => $request->description,
                'vehicle_no'        => $request->vehicle_no,
                'pkt'               => $request->pkt,
                'qty'               => $request->qty,
                'actual_weight'     => $request->actual_weight,
                'chargeable_weight' => $request->chargeable_weight,
                'sub_total'         => $request->sub_total,
                'tax_type'          => $request->tax_type,
                'tax'               => $request->tax,
                'cgst'              => $request->cgst,
                'sgst'              => $request->sgst,
                'igst'              => $request->igst,
                'grand_total'       => $request->grand_total,
            ]);

            DB::commit();

            return redirect()
                ->route('domestic.shipment.index')
                ->with('success', 'Shipment updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }
    }


    public function destroy($id)
    {
        $shipment = DomesticShipment::findOrFail($id);

        $shipment->delete(); // Soft delete

        return redirect()
            ->route('domestic.shipment.index')
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

    // public function show($id)
    // {
    //     $shipment = DomesticShipment::with([
    //         'invoices'
    //     ])->findOrFail($id);

    //     return view('shipment.pod', compact('shipment'));
    // }

    public function show($id)
    {

        $shipment = DomesticShipment::with(['invoices', 'consigner', 'consignee'])->findOrFail($id);

        $shipment = DomesticShipment::with([
            'invoices',
            'consigner',
            'consignee',
            'company',
            'user'
        ])->findOrFail($id);


        $company = Auth::user()->company;

        // dd($company);
        return view('shipment.pod', compact('shipment', 'company'));
    }
}
