@extends('admin.partials.app')

@section('main-content')
    <style>
        .form-control:focus {
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            outline: 0;
            box-shadow: var(--bs-box-shadow-inset), 0 0 0 0.25rem rgb(242 243 244 / 25%);
        }
    </style>

    <main class="app-main">

        <!-- HEADER -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0 text-secondary fw-bold">Edit GST Billing</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('gst-billing.index') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active text-secondary">
                                Edit GST Billing
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow border-4 border-primary">

                    <div
                        class="card-header bg-primary text-white d-flex justify-content-between align-items-center flex-wrap">
                        <h5 class="mb-0">
                            <i class="bi bi-pencil-square me-2"></i> Edit GST Billing Details
                        </h5>
                    </div>

                    <form action="{{ route('gst-billing.update', $gstBilling->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            {{-- ================= BASIC DETAILS ================= --}}
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-primary">
                                    <strong><i class="bi bi-card-text me-2"></i>Basic Details</strong>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="bi bi-info-circle text-primary" title="Enter Invoice Number"></i>
                                                Invoice No
                                            </label>
                                            <input type="text" name="invoice_no"
                                                value="{{ old('invoice_no', $gstBilling->invoice_no) }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="bi bi-info-circle text-primary" title="Select Invoice Date"></i>
                                                Invoice Date
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="invoice_date"
                                                    value="{{ old('invoice_date', $gstBilling->invoice_date) }}"
                                                    class="form-control datepicker">
                                                <span class="input-group-text">
                                                    <i class="bi bi-calendar"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="bi bi-info-circle text-primary" title="Select Consignor"></i>
                                                Consignor
                                            </label>
                                            <select name="consignor_id" class="form-select">
                                                <option value="">Select Consignor</option>
                                                @foreach ($consigners as $c)
                                                    <option value="{{ $c->id }}"
                                                        {{ old('consignor_id', $gstBilling->consignor_id) == $c->id ? 'selected' : '' }}>
                                                        {{ $c->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="bi bi-info-circle text-primary" title="Select Consignee"></i>
                                                Consignee
                                            </label>
                                            <select name="consignee_id" class="form-select">
                                                <option value="">Select Consignee</option>
                                                @foreach ($consignees as $c)
                                                    <option value="{{ $c->id }}"
                                                        {{ old('consignee_id', $gstBilling->consignee_id) == $c->id ? 'selected' : '' }}>
                                                        {{ $c->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="bi bi-info-circle text-primary"
                                                    title="Enter Purchase Order Number"></i> PO No
                                            </label>
                                            <input type="text" name="po_no"
                                                value="{{ old('po_no', $gstBilling->po_no) }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="bi bi-info-circle text-primary" title="Enter Vehicle Number"></i>
                                                Vehicle No
                                            </label>
                                            <input type="text" name="vehicle_no"
                                                value="{{ old('vehicle_no', $gstBilling->vehicle_no) }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="bi bi-info-circle text-primary" title="Enter Supply Place"></i>
                                                Supply Place
                                            </label>
                                            <input type="text" name="supply_place"
                                                value="{{ old('supply_place', $gstBilling->supply_place) }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="bi bi-info-circle text-primary" title="Select Supply Date"></i>
                                                Supply Date
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="supply_date"
                                                    value="{{ old('supply_date', $gstBilling->supply_date) }}"
                                                    class="form-control datepicker">
                                                <span class="input-group-text">
                                                    <i class="bi bi-calendar"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="bi bi-info-circle text-primary" title="Enter Transport Mode"></i>
                                                Transport Mode
                                            </label>
                                            <input type="text" name="trans_mode"
                                                value="{{ old('trans_mode', $gstBilling->trans_mode) }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="bi bi-info-circle text-primary"
                                                    title="Select Reverse Charge Option"></i> Reverse Charge
                                            </label>
                                            <select name="reverse_charge" class="form-select">
                                                <option value="No"
                                                    {{ old('reverse_charge', $gstBilling->reverse_charge) == 'No' ? 'selected' : '' }}>
                                                    No</option>
                                                <option value="Yes"
                                                    {{ old('reverse_charge', $gstBilling->reverse_charge) == 'Yes' ? 'selected' : '' }}>
                                                    Yes</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- ================= PRODUCT DETAILS ================= --}}
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-warning">
                                    <strong><i class="bi bi-box-seam me-2"></i>Product Details</strong>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-3">
                                            <label>
                                                <i class="bi bi-info-circle text-primary" title="Select Product Name"></i>
                                                Product Name
                                            </label>
                                            <select name="product_id" class="form-select">
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}"
                                                        {{ old('product_id', $gstBilling->product_id) == $product->id ? 'selected' : '' }}>
                                                        {{ $product->product_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label>
                                                <i class="bi bi-info-circle text-primary"
                                                    title="Enter Description"></i> Description
                                            </label>
                                            <textarea name="description" class="form-control">{{ old('description', $gstBilling->description) }}</textarea>
                                        </div>

                                        @foreach (['uom', 'hsn_code', 'qty', 'rate', 'total', 'disc_percent', 'taxable_value', 'gst_percent', 'cgst_amt', 'sgst_amt', 'igst_amt', 'total_amt'] as $field)
                                            <div class="col-md-3">
                                                <label>
                                                    <i class="bi bi-info-circle text-primary"
                                                        title="Enter {{ ucwords(str_replace('_', ' ', $field)) }}"></i>
                                                    {{ ucwords(str_replace('_', ' ', $field)) }}
                                                </label>
                                                <input type="number" @if (in_array($field, ['uom', 'hsn_code'])) type="text" @endif
                                                    step="0.01" name="{{ $field }}"
                                                    value="{{ old($field, $gstBilling->$field) }}" class="form-control">
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                            {{-- ================= SUMMARY DETAILS ================= --}}
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-info">
                                    <strong><i class="bi bi-calculator me-2"></i>Summary Details</strong>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">

                                        @foreach (['disc_amt', 'total_tax_amt', 'tot_cgst_amt', 'tot_sgst_amt', 'tot_igst_amt', 'freight', 'others', 'tcs_percent', 'tcs_amt', 'grand_total', 'advance', 'net_amt'] as $field)
                                            <div class="col-md-3">
                                                <label>
                                                    <i class="bi bi-info-circle text-primary"
                                                        title="Enter {{ ucwords(str_replace('_', ' ', $field)) }}"></i>
                                                    {{ ucwords(str_replace('_', ' ', $field)) }}
                                                </label>
                                                <input type="number" step="0.01" name="{{ $field }}"
                                                    value="{{ old($field, $gstBilling->$field) }}" class="form-control">
                                            </div>
                                        @endforeach

                                        <div class="col-md-6">
                                            <label>
                                                <i class="bi bi-info-circle text-primary"
                                                    title="Enter Narration Details"></i> Narration
                                            </label>
                                            <textarea name="narration" class="form-control">{{ old('narration', $gstBilling->narration) }}</textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer bg-light text-end">
                            <a href="{{ route('gst-billing.index') }}" class="btn btn-outline-secondary me-2">
                                <i class="bi bi-arrow-left-circle me-1"></i> Back
                            </a>

                            <button type="submit" class="btn btn-secondary">
                                <i class="bi bi-check-circle me-1"></i> Update GST Billing
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </main>
@endsection
