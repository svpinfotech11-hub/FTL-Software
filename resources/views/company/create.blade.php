@extends('admin.partials.app')
@section('main-content')
    <main class="app-main">
        {{-- Header --}}
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0 text-secondary" style="font-weight: bold;">Add Company</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add Company</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="app-content">
            <div class="container-fluid">
                <div class="card card-primary card-outline mb-4">

                    <div class="card-header">
                        <div class="card-title">Company Details</div>
                    </div>

                    <form method="POST" action="{{ route('company.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="row g-3">

                                {{-- Checkbox --}}
                                <div class="col-md-4">
                                    <div class="form-check mt-4">
                                        <input type="checkbox" name="branch_wise_invoice"
                                            value="{{ old('branch_wise_invoice') }}" class="form-check-input">
                                        <label class="form-check-label">Branch Wise Invoice</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" name="company_name" value="{{ old('company_name') }}"
                                        class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Company Logo</label>
                                    <input type="file" name="logo" value="{{ old('logo') }}" class="form-control"
                                        accept="image/*">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Company Stamp</label>
                                    <input type="file" name="stamp" value="{{ old('stamp') }}" class="form-control"
                                        accept="image/*">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">TAN No</label>
                                    <input type="text" name="tan_no" value="{{ old('tan_no') }}" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">MSME No</label>
                                    <input type="text" name="msme_no" value="{{ old('msme_no') }}" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">ISO No</label>
                                    <input type="text" name="iso_no" value="{{ old('iso_no') }}" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Website</label>
                                    <input type="text" name="website" value="{{ old('website') }}" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Import Invoice Series</label>
                                    <input type="text" name="import_invoice_series"
                                        value="{{ old('import_invoice_series') }}" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Domestic Invoice Series</label>
                                    <input type="text" name="domestic_invoice_series"
                                        value="{{ old('domestic_invoice_series') }}" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Export Invoice Series</label>
                                    <input type="text" name="export_invoice_series"
                                        value="{{ old('export_invoice_series') }}" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Company Code</label>
                                    <input type="text" name="company_code" value="{{ old('company_code') }}"
                                        class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">UDYAM Code</label>
                                    <input type="text" name="udyam_code" value="{{ old('udyam_code') }}"
                                        class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Taxable Services</label>
                                    <input type="text" name="taxable_services" value="{{ old('taxable_services') }}"
                                        class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Invoice Terms & Condition</label>
                                    <textarea name="invoice_terms" id="invoice_term" class="form-control">{{ old('invoice_terms') }}</textarea>
                                </div>
                                <div class="card mt-4">
                                    <div class="card-header fw-bold">Bank Details</div>
                                    <div class="card-body row">

                                        <div class="col-md-4">
                                            <label>Account Name</label>
                                            <input type="text" name="account_name" value="{{ old('account_name') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Account Number</label>
                                            <input type="text" name="account_number"
                                                value="{{ old('account_number') }}" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label>IFSC</label>
                                            <input type="text" name="ifsc" value="{{ old('ifsc') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Bank Name</label>
                                            <input type="text" name="bank_name" value="{{ old('bank_name') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Branch Name</label>
                                            <input type="text" name="branch_name" value="{{ old('branch_name') }}"
                                                class="form-control">
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Bank Terms & Condition</label>
                                    <textarea name="bank_terms" id="bank_terms" class="form-control">{{ old('bank_terms') }}</textarea>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <a href="{{ route('company.index') }}" class="btn btn-outline-secondary"><i
                                    class="bi bi-arrow-left-circle me-1"></i> Back</a>
                            <button class="btn btn-secondary"><i class="bi bi-plus-circle me-1"></i> Add
                                Company</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
