<?php

namespace App\Http\Controllers;

use App\Models\AddCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class AddCompanyController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = AddCompany::query();

        if ($user->hasRole('super_admin')) {
            // Super admin sees all companies
            $companies = $query->latest()->get();
        } elseif ($user->hasRole('admin')) {
            // Admin sees companies created by themselves and their created users
            $userIds = \App\Models\User::where('created_by', $user->id)->orWhere('id', $user->id)->pluck('id');
            $companies = $query->whereIn('user_id', $userIds)->latest()->get();
        } else {
            // Regular users see only their own companies
            $companies = $query->where('user_id', $user->id)->latest()->get();
        }

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

            'logo'  => 'nullable|image|mimes:jpg,jpeg,png',
            'stamp' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        // ✅ Save auth user id
        $data['user_id'] = Auth::id();
        $data['branch_wise_invoice'] = $request->has('branch_wise_invoice');

        /* ================= LOGO UPLOAD ================= */
        if ($request->hasFile('logo')) {
            $logoName = 'logo_' . time() . '.' . $request->logo->extension();
            $request->logo->move('uploads/company/logo', $logoName);
            $data['logo'] =  $logoName;
        }

        /* ================= STAMP UPLOAD ================= */
        if ($request->hasFile('stamp')) {
            $stampName = 'stamp_' . time() . '.' . $request->stamp->extension();
            $request->stamp->move('uploads/company/stamp', $stampName);
            $data['stamp'] =  $stampName;
        }

        AddCompany::create($data);

        return redirect()
            ->route('company.index')
            ->with('success', 'Company Added Successfully');
    }

    public function edit($id)
    {
        $company = AddCompany::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('company.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = AddCompany::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'logo'  => 'nullable|image|mimes:jpg,jpeg,png',
            'stamp' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $data['branch_wise_invoice'] = $request->has('branch_wise_invoice');

        /* ================= UPDATE LOGO ================= */
        if ($request->hasFile('logo')) {
            if ($company->logo && File::exists($company->logo)) {
                File::delete($company->logo);
            }

            $logoName = 'logo_' . time() . '.' . $request->logo->extension();
            $request->logo->move('uploads/company/logo', $logoName);
            $data['logo'] =  $logoName;
        }

        /* ================= UPDATE STAMP ================= */
        if ($request->hasFile('stamp')) {
            if ($company->stamp && File::exists($company->stamp)) {
                File::delete($company->stamp);
            }

            $stampName = 'stamp_' . time() . '.' . $request->stamp->extension();
            $request->stamp->move('uploads/company/stamp', $stampName);
            $data['stamp'] = $stampName;
        }

        $company->update($data);

        return redirect()
            ->route('company.index')
            ->with('success', 'Company Updated Successfully');
    }

    public function destroy($id)
    {
        $company = AddCompany::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($company->logo && File::exists($company->logo)) {
            File::delete($company->logo);
        }

        if ($company->stamp && File::exists($company->stamp)) {
            File::delete($company->stamp);
        }

        $company->delete();

        return back()->with('success', 'Company Deleted Successfully');
    }
}
