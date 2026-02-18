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

    @php
        function infoIcon($text)
        {
            return '<i class="bi bi-info-circle text-primary ms-1" title="' . $text . '"></i>';
        }
    @endphp

    <main class="app-main">

        <!-- HEADER -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0 text-secondary" style="font-weight: bold;">GST Billing</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('gst-billing.index') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active text-secondary">
                                Create GST Billing
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow border-4 border-primary">

                    <div
                        class="card-header bg-primary text-white d-flex justify-content-between align-items-center flex-wrap">
                        <h5 class="mb-0">
                            <i class="bi bi-receipt me-2"></i> GST Billing Details
                        </h5>

                        <div class="d-flex gap-2 ms-auto flex-wrap">
                            <a href="{{ route('gst-billing.create') }}" class="btn btn-sm btn-dark">
                                <i class="bi bi-plus-circle"></i> New
                            </a>

                            <a href="{{ route('gst-billing.index') }}" class="btn btn-sm btn-info text-white">
                                <i class="bi bi-eye"></i> Show
                            </a>

                            <button type="button" class="btn btn-sm btn-success">
                                <i class="bi bi-printer"></i> Print
                            </button>
                        </div>
                    </div>

                    <form action="{{ route('gst-billing.store') }}" method="POST">
                        @csrf

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
                                            <input type="text" name="invoice_no" value="{{ old('invoice_no') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label d-flex align-items-center gap-1">
                                                <i class="bi bi-info-circle text-primary" title="Select Invoice Date"></i>
                                                Invoice Date
                                            </label>
                                            <div class="input-group datepicker-group">
                                                <input type="text" name="invoice_date" value="{{ old('invoice_date') }}"
                                                    class="form-control datepicker" placeholder="YYYY-MM-DD">
                                                <span class="input-group-text calendar-icon" style="cursor:pointer;">
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
                                                        {{ old('consignor_id') == $c->id ? 'selected' : '' }}>
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
                                                        {{ old('consignee_id') == $c->id ? 'selected' : '' }}>
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
                                            <input type="text" name="po_no" value="{{ old('po_no') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="bi bi-info-circle text-primary" title="Enter Vehicle Number"></i>
                                                Vehicle No
                                            </label>
                                            <input type="text" name="vehicle_no" value="{{ old('vehicle_no') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="bi bi-info-circle text-primary" title="Enter Supply Place"></i>
                                                Supply Place
                                            </label>
                                            <input type="text" name="supply_place" value="{{ old('supply_place') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label d-flex align-items-center gap-1">
                                                <i class="bi bi-info-circle text-primary" title="Select Supply Date"></i>
                                                Supply Date
                                            </label>
                                            <div class="input-group datepicker-group">
                                                <input type="text" name="supply_date"
                                                    value="{{ old('supply_date') }}" class="form-control datepicker"
                                                    placeholder="YYYY-MM-DD">
                                                <span class="input-group-text calendar-icon" style="cursor:pointer;">
                                                    <i class="bi bi-calendar"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="bi bi-info-circle text-primary"
                                                    title="Enter Transport Mode"></i> Transport Mode
                                            </label>
                                            <input type="text" name="trans_mode" value="{{ old('trans_mode') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">
                                                <i class="bi bi-info-circle text-primary"
                                                    title="Select Reverse Charge Option"></i> Reverse Charge
                                            </label>
                                            <select name="reverse_charge" class="form-select">
                                                <option value="No"
                                                    {{ old('reverse_charge') == 'No' ? 'selected' : '' }}>No
                                                </option>
                                                <option value="Yes"
                                                    {{ old('reverse_charge') == 'Yes' ? 'selected' : '' }}>
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

                                        @php
                                            $fields = [
                                                'description',
                                                'uom',
                                                'hsn_code',
                                                'qty',
                                                'rate',
                                                'total',
                                                'disc_percent',
                                                'taxable_value',
                                                'gst_percent',
                                                'cgst_amt',
                                                'sgst_amt',
                                                'igst_amt',
                                                'total_amt',
                                            ];
                                        @endphp

                                        <div class="col-md-3">
                                            <label>
                                                <i class="bi bi-info-circle text-primary" title="Select Product Name"></i>
                                                Product Name
                                            </label>
                                            <select name="product_id" class="form-select">
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}"
                                                        {{ old('consignor_id') == $product->id ? 'selected' : '' }}>
                                                        {{ $product->product_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label>
                                                <i class="bi bi-info-circle text-primary" title="Enter Description"></i>
                                                Description
                                            </label>
                                            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary"
                                                    title="Enter Unit of Measurement"></i> UOM</label>
                                            <input type="text" name="uom" value="{{ old('uom') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary" title="Enter HSN Code"></i>
                                                HSN Code</label>
                                            <input type="text" name="hsn_code" value="{{ old('hsn_code') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary" title="Enter Quantity"></i>
                                                Qty</label>
                                            <input type="number" step="0.01" name="qty"
                                                value="{{ old('qty') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary" title="Enter Rate"></i>
                                                Rate</label>
                                            <input type="number" step="0.01" name="rate"
                                                value="{{ old('rate') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary" title="Enter Total"></i>
                                                Total</label>
                                            <input type="number" step="0.01" name="total"
                                                value="{{ old('total') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary"
                                                    title="Enter Discount Percentage"></i> Disc %</label>
                                            <input type="number" step="0.01" name="disc_percent"
                                                value="{{ old('disc_percent') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary"
                                                    title="Enter Taxable Value"></i> Taxable Value</label>
                                            <input type="number" step="0.01" name="taxable_value"
                                                value="{{ old('taxable_value') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary"
                                                    title="Enter GST Percentage"></i> GST %</label>
                                            <input type="number" step="0.01" name="gst_percent"
                                                value="{{ old('gst_percent') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary"
                                                    title="Enter CGST Amount"></i> CGST Amt</label>
                                            <input type="number" step="0.01" name="cgst_amt"
                                                value="{{ old('cgst_amt') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary"
                                                    title="Enter SGST Amount"></i> SGST Amt</label>
                                            <input type="number" step="0.01" name="sgst_amt"
                                                value="{{ old('sgst_amt') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary"
                                                    title="Enter IGST Amount"></i> IGST Amt</label>
                                            <input type="number" step="0.01" name="igst_amt"
                                                value="{{ old('igst_amt') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary"
                                                    title="Enter Total Amount"></i> Total Amt</label>
                                            <input type="number" step="0.01" name="total_amt"
                                                value="{{ old('total_amt') }}" class="form-control">
                                        </div>

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
                                                    value="{{ old($field) }}" class="form-control">
                                            </div>
                                        @endforeach

                                        <div class="col-md-6">
                                            <label>
                                                <i class="bi bi-info-circle text-primary"
                                                    title="Enter Narration Details"></i> Narration
                                            </label>
                                            <textarea name="narration" class="form-control">{{ old('narration') }}</textarea>
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
                                <i class="bi bi-plus-circle me-1"></i> Add GST Billing
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
