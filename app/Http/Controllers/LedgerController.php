<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LedgerController extends Controller
{
    // List all ledgers
    public function index()
    {
        $ledgers = Ledger::latest()->paginate(10);
        return view('ledgers.index', compact('ledgers'));
    }

    // Show create form
    public function create()
    {
        return view('ledgers.create');
    }

    // Store new ledger
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ledger_group' => 'nullable|string|max:255',
            'gst_no' => 'nullable|string|max:50',
            'party_name' => 'nullable|string|max:255',
            'party_alias' => 'nullable|string|max:255',
            'address1' => 'nullable|string|max:255',
            'address2' => 'nullable|string|max:255',
            'state_name' => 'nullable|string|max:100',
            'city_name' => 'nullable|string|max:100',
            'pan_no' => 'nullable|string|max:50',
            'iec_no' => 'nullable|string|max:50',
            'aadhar_no' => 'nullable|string|max:50',
            'rc_no' => 'nullable|string|max:50',
            'license_no' => 'nullable|string|max:50',
            'phone_no' => 'nullable|string|max:20',
            'mobile_no' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'opening_bal' => 'nullable|numeric',
            'opening_type' => 'nullable|in:DR,CR',
            'arn_no' => 'nullable|string|max:50',
            'exim_code' => 'nullable|string|max:50',
            'pan_upload' => 'nullable|file|mimes:jpg,png,pdf',
            'declaration_upload' => 'nullable|file|mimes:jpg,png,pdf',
            'aadhar_upload' => 'nullable|file|mimes:jpg,png,pdf',
            'gst_upload' => 'nullable|file|mimes:jpg,png,pdf',
            'office_photo' => 'nullable|file|mimes:jpg,png',
            'bank_name' => 'nullable|string|max:255',
            'account_no' => 'nullable|string|max:50',
            'branch_name' => 'nullable|string|max:255',
            'ifsc_code' => 'nullable|string|max:20',
        ]);

        // Handle file uploads directly to public/ledgers
        foreach (['pan_upload','declaration_upload','aadhar_upload','gst_upload','office_photo'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField);
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('ledgers'), $filename); 
                $validated[$fileField] = 'ledgers/' . $filename; // save relative path
            }
        }

        Ledger::create($validated);

        return redirect()->route('ledgers.index')->with('success', 'Ledger created successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $ledger = Ledger::findOrFail($id);
        return view('ledgers.edit', compact('ledger'));
    }

    // Update ledger
    public function update(Request $request, $id)
    {
        $ledger = Ledger::findOrFail($id);
        $validated = $request->validate([
            // same rules as store
        ]);

        // Handle file uploads like store
        foreach (['pan_upload','declaration_upload','aadhar_upload','gst_upload','office_photo'] as $fileField) {
        if ($request->hasFile($fileField)) {
            // Delete old file from public
            if ($ledger->$fileField && file_exists(public_path($ledger->$fileField))) {
                unlink(public_path($ledger->$fileField));
            }
            $file = $request->file($fileField);
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('ledgers'), $filename);
            $validated[$fileField] = 'ledgers/' . $filename;
        }
    }

        $ledger->update($validated);

        return redirect()->route('ledgers.index')->with('success', 'Ledger updated successfully!');
    }

    // Delete ledger
    public function destroy($id)
    {
        $ledger = Ledger::findOrFail($id);
        foreach (['pan_upload','declaration_upload','aadhar_upload','gst_upload','office_photo'] as $fileField) {
            if ($ledger->$fileField && file_exists(public_path($ledger->$fileField))) {
                unlink(public_path($ledger->$fileField));
            }
        }

        $ledger->delete();

        return redirect()
            ->route('ledgers.index')
            ->with('success', 'Ledger deleted successfully!');
    }

}
