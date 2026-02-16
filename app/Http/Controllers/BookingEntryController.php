<?php

namespace App\Http\Controllers;

use App\Models\BookingEntry;
use App\Models\Ledger;
use App\Models\Product;
use Illuminate\Http\Request;

class BookingEntryController extends Controller
{
    /**
     * Display listing
     */
    public function index()
    {
        $bookings = BookingEntry::with(['sourceLedger', 'destinationLedger', 'product'])
            ->latest()
            ->paginate(20);

        return view('booking_entries.index', compact('bookings'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $ledgers = Ledger::orderBy('party_name')->get();
        $products = Product::orderBy('product_name')->get();

        // Generate Next LR No
        $lastNumber = BookingEntry::max('lr_no');
        $nextLrNo = $lastNumber ? $lastNumber + 1 : 1000000001;

        return view('booking_entries.create', compact('ledgers', 'products', 'nextLrNo'));
    }

    /**
     * Store booking
     */
    public function store(Request $request)
    {
        // Validate required fields
        $validated = $request->validate([
            'lr_date' => 'required|date',
            'source_ledger_id' => 'required|exists:ledgers,id',
            'destination_ledger_id' => 'required|exists:ledgers,id',
            'product_id' => 'required|exists:products,id',
        ]);

        // Generate Auto Increment LR No
        $lastBooking = BookingEntry::orderBy('id', 'desc')->first();
        $newNumber = $lastBooking ? ((int) $lastBooking->lr_no + 1) : 1000000001;
        $validated['lr_no'] = $newNumber;

        // Copy all form fields manually
        $validated['ref_lr_no'] = $request->ref_lr_no;

        // Source Details
        $validated['source_address'] = $request->source_address;
        $validated['source_state'] = $request->source_state;
        $validated['source_city'] = $request->source_city;
        $validated['source_district'] = $request->source_district;

        // Destination Details
        $validated['destination_address'] = $request->destination_address;
        $validated['destination_state'] = $request->destination_state;
        $validated['destination_city'] = $request->destination_city;
        $validated['destination_district'] = $request->destination_district;

        // Consignor Details
        $validated['consignor_ledger_name'] = $request->consignor_ledger_name;
        $validated['consignor_address1'] = $request->consignor_address1;
        $validated['consignor_address2'] = $request->consignor_address2;
        $validated['consignor_state'] = $request->consignor_state;
        $validated['consignor_city'] = $request->consignor_city;
        $validated['consignor_gstin'] = $request->consignor_gstin;
        $validated['consignor_phone'] = $request->consignor_phone;
        $validated['consignor_mobile'] = $request->consignor_mobile;

        // Consignee Details
        $validated['consignee_ledger_name'] = $request->consignee_ledger_name;
        $validated['consignee_address1'] = $request->consignee_address1;
        $validated['consignee_address2'] = $request->consignee_address2;
        $validated['consignee_state'] = $request->consignee_state;
        $validated['consignee_city'] = $request->consignee_city;
        $validated['consignee_gstin'] = $request->consignee_gstin;
        $validated['consignee_phone'] = $request->consignee_phone;
        $validated['consignee_mobile'] = $request->consignee_mobile;

        // Vehicle Details
        $validated['vehicle_no'] = $request->vehicle_no;
        $validated['owner_name'] = $request->owner_name;

        // Invoice Details
        $validated['invoice_no'] = $request->invoice_no;
        $validated['invoice_date'] = $request->invoice_date;
        // $validated['value_of_goods'] = $request->value_of_goods;
        $validated['eway_bill_no'] = $request->eway_bill_no;
        $validated['ewb_exp_date'] = $request->ewb_exp_date;
        // $validated['value_of_goods'] = $request->value_of_goods;

        // Product
        $validated['product_id'] = $request->product_id;

        // Charges
        $charges = ['freight', 'hamali', 'pre_bhadha', 'bilty_charge', 'colle_charges', 'cpc', 'other_charge'];
        $total = 0;
        foreach ($charges as $field) {
            $validated[$field] = $request->$field ?? 0;
            $total += $validated[$field];
        }
        $validated['total'] = $total;

        // GST & Advance
        $validated['cgst'] = $request->cgst ?? 0;
        $validated['sgst'] = $request->sgst ?? 0;
        $validated['igst'] = $request->igst ?? 0;
        $validated['advance'] = $request->advance ?? 0;

        // Grand total
        $validated['grand_total'] = $total + $validated['cgst'] + $validated['sgst'] + $validated['igst'] - $validated['advance'];

        // Create the booking entry
        BookingEntry::create($validated);

        return redirect()->route('booking_entries.index')
            ->with('success', 'Booking created successfully!');
    }


    /**
     * Show edit form
     */
    public function edit($id)
    {
        $booking_entry = BookingEntry::findOrFail($id);
        $ledger = Ledger::orderBy('party_name')->get();
        $products = Product::orderBy('product_name')->get();

        return view('booking_entries.edit', [
            'booking_entry' => $booking_entry,
            'ledger' => $ledger,
            'products' => $products
        ]);
    }

    /**
     * Update booking
     */
    public function update(Request $request, $id)
    {
         $booking_entry = BookingEntry::findOrFail($id);
        $validated = $request->validate([
            'lr_no' => 'required|unique:booking_entries,lr_no,' . $booking_entry->id,
            'lr_date' => 'required|date',
        ]);

        // Recalculate charges
        $charges = [
            'freight',
            'hamali',
            'pre_bhadha',
            'bilty_charge',
            'colle_charges',
            'cpc',
            'other_charge'
        ];

        $total = 0;
        foreach ($charges as $field) {
            $validated[$field] = $request->$field ?? 0;
            $total += $validated[$field];
        }

        $validated['total'] = $total;

        $validated['cgst'] = $request->cgst ?? 0;
        $validated['sgst'] = $request->sgst ?? 0;
        $validated['igst'] = $request->igst ?? 0;
        $validated['advance'] = $request->advance ?? 0;

        $validated['grand_total'] =
            $total +
            $validated['cgst'] +
            $validated['sgst'] +
            $validated['igst'] -
            $validated['advance'];

        $booking_entry->update($validated);

        return redirect()->route('booking_entries.index')
            ->with('success', 'Booking updated successfully!');
    }

    /**
     * Delete booking
     */
    public function destroy(BookingEntry $booking_entry)
    {
        $booking_entry->delete();

        return redirect()->route('booking_entries.index')
            ->with('success', 'Booking deleted successfully!');
    }

    // public function indexMethod(){
    //     $bookingEntry = BookingEntry::all();
    //     return view('reports.lr-register', compact('bookingEntry'));
    // }


    public function indexMethod(Request $request)
{
    $query = BookingEntry::query();

    // Filter by dates
    if ($request->filled('from_date')) {
        $query->whereDate('booking_date', '>=', $request->from_date);
    }
    if ($request->filled('to_date')) {
        $query->whereDate('booking_date', '<=', $request->to_date);
    }

    // Filter by source
    if ($request->filled('source_address')) {
        $query->where('source_address', $request->source_address);
    }

    // Filter by destination
    if ($request->filled('destination_address')) {
        $query->where('destination_address', $request->destination_address);
    }

    // Filter by LR type
    if ($request->filled('lr_type')) {
        $query->where('lr_type', $request->lr_type);
    }

    // Filter by vehicle no
    if ($request->filled('vehicle_no')) {
        $query->where('vehicle_no', 'like', '%'.$request->vehicle_no.'%');
    }

    $bookingEntry = $query->get();

    // For dropdowns
    $sourceAddresses = BookingEntry::select('source_address')->distinct()->pluck('source_address');
    $destinationAddresses = BookingEntry::select('destination_address')->distinct()->pluck('destination_address');
    $lrTypes = BookingEntry::select('lr_type')->distinct()->pluck('lr_type');

    return view('reports.lr_register', compact(
        'bookingEntry', 
        'sourceAddresses', 
        'destinationAddresses', 
        'lrTypes'
    ));
}

}
