<?php

namespace App\Http\Controllers;

use App\Models\AddCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AddCompanyController extends Controller
{
    public function index()
    {
        $companies = AddCompany::with('user')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('company.index', compact('companies'));
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',

            'tan_no' => 'nullable|string|max:50',
            'msme_no' => 'nullable|string|max:50',
            'iso_no' => 'nullable|string|max:50',
            'website' => 'nullable|string|max:255',

            'import_invoice_series' => 'nullable|string|max:50',
            'domestic_invoice_series' => 'nullable|string|max:50',
            'export_invoice_series' => 'nullable|string|max:50',

            'company_code' => 'nullable|string|max:50',
            'udyam_code' => 'nullable|string|max:50',
            'taxable_services' => 'nullable|string',
            'invoice_terms' => 'nullable|string',

            'account_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:50',
            'ifsc' => 'nullable|string|max:20',
            'bank_name' => 'nullable|string|max:255',
            'branch_name' => 'nullable|string|max:255',
            'bank_terms' => 'nullable|string',

            'logo' => 'nullable|image|mimes:jpg,jpeg,png',
            'stamp' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $data['user_id'] = Auth::id();
        $data['branch_wise_invoice'] = $request->has('branch_wise_invoice');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('company/logo', 'public');
        }

        if ($request->hasFile('stamp')) {
            $data['stamp'] = $request->file('stamp')->store('company/stamp', 'public');
        }

        AddCompany::create($data);

        return redirect()->route('company.index')
            ->with('success', 'Company Added Successfully');
    }


    public function edit($id)
    {
        $company = AddCompany::findOrFail($id);
        return view('company.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = AddCompany::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $data = $request->validate([
            'company_name' => 'required|string|max:255',

            'tan_no' => 'nullable|string|max:50',
            'msme_no' => 'nullable|string|max:50',
            'iso_no' => 'nullable|string|max:50',
            'website' => 'nullable|string|max:255',

            'import_invoice_series' => 'nullable|string|max:50',
            'domestic_invoice_series' => 'nullable|string|max:50',
            'export_invoice_series' => 'nullable|string|max:50',

            'company_code' => 'nullable|string|max:50',
            'udyam_code' => 'nullable|string|max:50',
            'taxable_services' => 'nullable|string',
            'invoice_terms' => 'nullable|string',

            'account_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:50',
            'ifsc' => 'nullable|string|max:20',
            'bank_name' => 'nullable|string|max:255',
            'branch_name' => 'nullable|string|max:255',
            'bank_terms' => 'nullable|string',

            'logo' => 'nullable|image|mimes:jpg,jpeg,png',
            'stamp' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $data['branch_wise_invoice'] = $request->has('branch_wise_invoice');

        if ($request->hasFile('logo')) {
            if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }
            $data['logo'] = $request->file('logo')->store('company/logo', 'public');
        }

        if ($request->hasFile('stamp')) {
            if ($company->stamp && Storage::disk('public')->exists($company->stamp)) {
                Storage::disk('public')->delete($company->stamp);
            }
            $data['stamp'] = $request->file('stamp')->store('company/stamp', 'public');
        }

        $company->update($data);

        return redirect()
            ->route('company.index')
            ->with('success', 'Company Updated Successfully');
    }

    public function destroy($id)
    {
        AddCompany::findOrFail($id)->delete();
        return back()->with('success', 'Company Deleted Successfully');
    }
}
