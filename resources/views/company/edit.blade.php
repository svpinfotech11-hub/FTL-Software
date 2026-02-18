@extends('admin.partials.app')

@section('main-content')
    <main class="app-main">

        {{-- Header --}}
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0 text-secondary" style="font-weight: bold;">Edit Company</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('company.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Company</li>
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
                    <form method="POST" action="{{ route('company.update', $company->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row g-3">

                                {{-- Checkbox --}}
                                <div class="col-md-4">
                                    <div class="form-check mt-4">
                                        <input type="checkbox" name="branch_wise_invoice" class="form-check-input"
                                            {{ $company->branch_wise_invoice ? 'checked' : '' }}>
                                        <label class="form-check-label">Branch Wise Invoice</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" name="company_name" class="form-control"
                                        value="{{ $company->company_name }}" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Company Logo</label>
                                    <input type="file" name="logo" class="form-control"
                                        accept="image/png, image/jpeg, image/jpg">

                                    @if ($company->logo)
                                        <small class="d-block mt-1">
                                            <a href="{{ asset('uploads/company/logo/' . $company->logo) }}" target="_blank">
                                                View Logo
                                            </a>
                                        </small>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Company Stamp</label>
                                    <input type="file" name="stamp" class="form-control"
                                        accept="image/png, image/jpeg, image/jpg">

                                    @if ($company->stamp)
                                        <small class="d-block mt-1">
                                            <a href="{{ asset('uploads/company/stamp/' . $company->stamp) }}"
                                                target="_blank">
                                                View Stamp
                                            </a>
                                        </small>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">TAN No</label>
                                    <input type="text" name="tan_no" class="form-control"
                                        value="{{ $company->tan_no }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">MSME No</label>
                                    <input type="text" name="msme_no" class="form-control"
                                        value="{{ $company->msme_no }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">ISO No</label>
                                    <input type="text" name="iso_no" class="form-control"
                                        value="{{ $company->iso_no }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Website</label>
                                    <input type="text" name="website" class="form-control"
                                        value="{{ $company->website }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Import Invoice Series</label>
                                    <input type="text" name="import_invoice_series" class="form-control"
                                        value="{{ $company->import_invoice_series }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Domestic Invoice Series</label>
                                    <input type="text" name="domestic_invoice_series" class="form-control"
                                        value="{{ $company->domestic_invoice_series }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Export Invoice Series</label>
                                    <input type="text" name="export_invoice_series" class="form-control"
                                        value="{{ $company->export_invoice_series }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Company Code</label>
                                    <input type="text" name="company_code" class="form-control"
                                        value="{{ $company->company_code }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">UDYAM Code</label>
                                    <input type="text" name="udyam_code" class="form-control"
                                        value="{{ $company->udyam_code }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Taxable Services</label>
                                    <input type="text" name="taxable_services" class="form-control"
                                        value="{{ $company->taxable_services }}">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Invoice Terms & Condition</label>
                                    <textarea name="invoice_terms" id="invoice_term" class="form-control">{{ $company->invoice_terms }}</textarea>
                                </div>

                                {{-- Bank Details --}}
                                <div class="card mt-4">
                                    <div class="card-header fw-bold">Bank Details</div>
                                    <div class="card-body row g-3">

                                        <div class="col-md-4">
                                            <label>Account Name</label>
                                            <input type="text" name="account_name" class="form-control"
                                                value="{{ $company->account_name }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Account Number</label>
                                            <input type="text" name="account_number" class="form-control"
                                                value="{{ $company->account_number }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label>IFSC</label>
                                            <input type="text" name="ifsc" class="form-control"
                                                value="{{ $company->ifsc }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Bank Name</label>
                                            <input type="text" name="bank_name" class="form-control"
                                                value="{{ $company->bank_name }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Branch Name</label>
                                            <input type="text" name="branch_name" class="form-control"
                                                value="{{ $company->branch_name }}">
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Bank Terms & Condition</label>
                                    <textarea name="bank_terms" id="bank_terms" class="form-control">{{ $company->bank_terms }}</textarea>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('company.index') }}" class="btn btn-outline-secondary"><i
                                    class="bi bi-arrow-left-circle me-1"></i> Back</a>
                            <button class="btn btn-secondary"><i class="bi bi-check-circle me-1"></i> Update
                                Company</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
