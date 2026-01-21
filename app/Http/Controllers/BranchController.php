<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $branches = Branch::where('user_id', $userId)
            ->latest()
            ->get();

        return view('branches.index', compact('branches'));
    }

    public function create()
    {
        $branchCode = 'BC' . str_pad(Branch::count() + 1, 4, '0', STR_PAD_LEFT);

        $states = DB::table('cities')
            ->select('city_state')
            ->distinct()
            ->orderBy('city_state')
            ->get();

        return view('branches.create', compact('branchCode', 'states'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        Branch::create([
            'user_id'                   => $userId,
            'name'                      => $request->name,
            'branch_name'               => $request->branch_name,
            'branch_code'               => $request->branch_code,
            'email'                     => $request->email,
            'contact_no'                => $request->contact_no,
            'contact_person'            => $request->contact_person,
            'address'                   => $request->address,
            'city'                      => $request->city,
            'state'                     => $request->state,
            'pincode'                   => $request->pincode,
            'gst_number'                => $request->gst_number,
            'pan'                       => $request->pan,
            'account_name'              => $request->account_name,
            'account_number'            => $request->account_number,
            'account_bank_name'         => $request->account_bank_name,
            'ifsc'                      => $request->ifsc,
            'warehouse_branch_name'     => $request->warehouse_branch_name,
            'export_invoice_series'     => $request->export_invoice_series,
            'import_invoice_series'     => $request->import_invoice_series,
            'domestic_invoice_series'   => $request->domestic_invoice_series,
            'domestic_booking_series'   => $request->domestic_booking_series,
            'domestic_pod_series'       => $request->domestic_pod_series,
        ]);

        return redirect()->route('branches.index')
            ->with('success', 'Branch Added Successfully');
    }

    public function edit($id)
    {
        $userId = Auth::id();

        $branch = Branch::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $states = DB::table('cities')
            ->select('city_state')
            ->distinct()
            ->orderBy('city_state')
            ->get();

        return view('branches.edit', compact('branch', 'states'));
    }

    public function update(Request $request, $id)
    {
        $userId = Auth::id();

        $branch = Branch::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        $branch->update([
            'name'                      => $request->name,
            'branch_name'               => $request->branch_name,
            'email'                     => $request->email,
            'contact_no'                => $request->contact_no,
            'contact_person'            => $request->contact_person,
            'address'                   => $request->address,
            'city'                      => $request->city,
            'state'                     => $request->state,
            'pincode'                   => $request->pincode,
            'gst_number'                => $request->gst_number,
            'pan'                       => $request->pan,
            'account_name'              => $request->account_name,
            'account_number'            => $request->account_number,
            'account_bank_name'         => $request->account_bank_name,
            'ifsc'                      => $request->ifsc,
            'warehouse_branch_name'     => $request->warehouse_branch_name,
            'export_invoice_series'     => $request->export_invoice_series,
            'import_invoice_series'     => $request->import_invoice_series,
            'domestic_invoice_series'   => $request->domestic_invoice_series,
            'domestic_booking_series'   => $request->domestic_booking_series,
            'domestic_pod_series'       => $request->domestic_pod_series,
        ]);

        return redirect()->route('branches.index')
            ->with('success', 'Branch Updated Successfully');
    }


    public function destroy($id)
    {
        $userId = Auth::id();

        Branch::where('id', $id)
            ->where('user_id', $userId)
            ->delete();

        return back()->with('deleted', 'Branch Deleted Successfully');
    }
}
