@extends('admin.partials.app')

@section('main-content')

<style>
    .form-control:focus {
        color: var(--bs-body-color);
        background-color: var(--bs-body-bg);
        outline: 0;
        box-shadow: var(--bs-box-shadow-inset), 0 0 0 0.25rem rgb(242 243 244 / 25%);
    }

    /* Required field default (red) */
    .form-control.required,
    .form-select.required {
        border: 2px solid #dc3545;
        /* red */
    }

    /* Valid filled field (green) */
    .form-control.required.is-valid,
    .form-select.required.is-valid {
        border: 2px solid #198754;
        /* green */
        box-shadow: none;
    }

    /* Invalid */
    .form-control.required.is-invalid,
    .form-select.required.is-invalid {
        border: 2px solid #dc3545;
        /* red */
    }

    hr.efkhksd {
        border: 1px solid #4e4d4d;
        margin-bottom: 40px;
        margin-top: 40px;
    }

    .form-control {
        border: var(--bs-border-width) solid #a9abad;
        border-radius: 0px;
        box-shadow: var(--bs-box-shadow-inset);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .bg-light {
        --bs-bg-opacity: 1;
        background-color: rgb(225 229 232 / 46%) !important;
    }
</style>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-success">Create Ledger</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('ledgers.index') }}">Home</a></li>
                        <li class="breadcrumb-item active text-success">Create Ledger</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="card border-5 border-secondary shadow-sm">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="card-title mb-0">Ledger Details</h5>
                        </div>

                        <form action="{{ route('booking_entries.store') }}" method="POST">
                            @csrf

                            <div class="card-body">

                                {{-- ================= LR DETAILS ================= --}}
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-light border-start border-4 border-success">
                                        <strong>
                                            <i class="bi bi-file-earmark-text me-2"></i> LR Details
                                        </strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">
                                                    LR No
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Auto generated LR Number. Cannot be edited."></i>
                                                </label>
                                                <input type="text" name="lr_no" value="{{ $nextLrNo }}" class="form-control bg-light" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">
                                                    LR Date *
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Select booking date of LR"></i>
                                                </label>
                                                <input type="date" name="lr_date" class="form-control" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">
                                                    Ref LR No
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter reference LR number if available"></i>
                                                </label>
                                                <input type="text" name="ref_lr_no" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ================= SOURCE & DESTINATION ================= --}}
                                <div class="card shadow-sm border-0 mb-4 rounded-3">
                                    <div class="card-header bg-light border-start border-4 border-primary fw-bold">
                                        <i class="bi bi-geo-alt me-2"></i> Route Details
                                    </div>

                                    <div class="card-body">
                                        <div class="row g-4">

                                            {{-- ================= SOURCE ================= --}}
                                            <div class="col-md-3">
                                                <label class="form-label fw-semibold">
                                                    Source Ledger *
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Select the dispatching party (From Location)"></i>
                                                </label>
                                                <select name="source_ledger_id" class="form-select" required>
                                                    <option value="">Select Source</option>
                                                    @foreach($ledgers as $ledger)
                                                    <option value="{{ $ledger->id }}">
                                                        {{ $ledger->party_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label fw-semibold">
                                                    Source Address
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter pickup location full address"></i>
                                                </label>
                                                <input type="text" name="source_address" class="form-control">
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label fw-semibold">
                                                    State
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter source state name"></i>
                                                </label>
                                                <input type="text" name="source_state" class="form-control">
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label fw-semibold">
                                                    City
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter source city"></i>
                                                </label>
                                                <input type="text" name="source_city" class="form-control">
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label fw-semibold">
                                                    District
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter source district"></i>
                                                </label>
                                                <input type="text" name="source_district" class="form-control">
                                            </div>


                                            {{-- ================= DESTINATION ================= --}}
                                            <div class="col-md-3">
                                                <label class="form-label fw-semibold">
                                                    Destination Ledger *
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Select the receiving party (To Location)"></i>
                                                </label>
                                                <select name="destination_ledger_id" class="form-select" required>
                                                    <option value="">Select Destination</option>
                                                    @foreach($ledgers as $ledger)
                                                    <option value="{{ $ledger->id }}">
                                                        {{ $ledger->party_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label fw-semibold">
                                                    Destination Address
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter delivery location full address"></i>
                                                </label>
                                                <input type="text" name="destination_address" class="form-control">
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label fw-semibold">
                                                    State
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter destination state name"></i>
                                                </label>
                                                <input type="text" name="destination_state" class="form-control">
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label fw-semibold">
                                                    City
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter destination city"></i>
                                                </label>
                                                <input type="text" name="destination_city" class="form-control">
                                            </div>

                                            <div class="col-md-2">
                                                <label class="form-label fw-semibold">
                                                    District
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter destination district"></i>
                                                </label>
                                                <input type="text" name="destination_district" class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                {{-- ================= CONSIGNOR ================= --}}
                                <div class="card shadow-sm border-0 mb-4 rounded-3">
                                    <div class="card-header bg-light border-start border-4 border-warning fw-bold">
                                        <i class="bi bi-person-badge me-2"></i> Consignor Details
                                    </div>

                                    <div class="card-body">
                                        <div class="row g-4">

                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">
                                                    Consignor Ledger Name
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter consignor company or person name"></i>
                                                </label>
                                                <input type="text" name="consignor_ledger_name" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">
                                                    GSTIN
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter 15-digit GST Identification Number"></i>
                                                </label>
                                                <input type="text" name="consignor_gstin"
                                                    class="form-control"
                                                    maxlength="15"
                                                    placeholder="22AAAAA0000A1Z5">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">
                                                    Mobile
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter primary mobile number of consignor"></i>
                                                </label>
                                                <input type="text" name="consignor_mobile"
                                                    class="form-control"
                                                    maxlength="10"
                                                    placeholder="Enter 10 digit mobile number">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">
                                                    Address 1
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter primary address (Street / Area)"></i>
                                                </label>
                                                <input type="text" name="consignor_address1" class="form-control">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">
                                                    Address 2
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter additional address details (Optional)"></i>
                                                </label>
                                                <input type="text" name="consignor_address2" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">
                                                    State
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter consignor state name"></i>
                                                </label>
                                                <input type="text" name="consignor_state" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">
                                                    City
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter consignor city"></i>
                                                </label>
                                                <input type="text" name="consignor_city" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">
                                                    Phone
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter landline number (Optional)"></i>
                                                </label>
                                                <input type="text" name="consignor_phone" class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                {{-- ================= CONSIGNEE ================= --}}
                                <div class="card shadow-sm border-0 mb-4 rounded-3">
                                    <div class="card-header bg-light border-start border-4 border-info fw-bold">
                                        <i class="bi bi-person-check me-2"></i> Consignee Details
                                    </div>

                                    <div class="card-body">
                                        <div class="row g-4">

                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">
                                                    Consignee Ledger Name
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter consignee company or receiving party name"></i>
                                                </label>
                                                <input type="text" name="consignee_ledger_name" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">
                                                    GSTIN
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter 15-digit GST number of consignee (if applicable)"></i>
                                                </label>
                                                <input type="text"
                                                    name="consignee_gstin"
                                                    class="form-control"
                                                    maxlength="15"
                                                    placeholder="22AAAAA0000A1Z5">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">
                                                    Mobile
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter primary mobile number of consignee"></i>
                                                </label>
                                                <input type="text"
                                                    name="consignee_mobile"
                                                    class="form-control"
                                                    maxlength="10"
                                                    placeholder="Enter 10 digit mobile number">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">
                                                    Address 1
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter main delivery address (Street / Area)"></i>
                                                </label>
                                                <input type="text" name="consignee_address1" class="form-control">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">
                                                    Address 2
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter additional address details (Optional)"></i>
                                                </label>
                                                <input type="text" name="consignee_address2" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">
                                                    State
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter consignee state name"></i>
                                                </label>
                                                <input type="text" name="consignee_state" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">
                                                    City
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter consignee city"></i>
                                                </label>
                                                <input type="text" name="consignee_city" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">
                                                    Phone
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Enter landline number (Optional)"></i>
                                                </label>
                                                <input type="text" name="consignee_phone" class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                {{-- ================= PRODUCT ================= --}}
                                <div class="card shadow-sm border-0 mb-4 rounded-3">
                                    <div class="card-header bg-light border-start border-4 border-secondary fw-bold">
                                        <i class="bi bi-box-seam me-2"></i> Product Details
                                    </div>

                                    <div class="card-body">
                                        <div class="row g-4">

                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">
                                                    Select Product *
                                                    <i class="bi bi-info-circle text-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="Select the product or goods being transported"></i>
                                                </label>

                                                <select name="product_id" class="form-select form-control" required>
                                                    <option value="">-- Select Product --</option>
                                                    @foreach($products as $product)
                                                    <option value="{{ $product->id }}">
                                                        {{ $product->product_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                                {{-- ================= VEHICLE ================= --}}
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-light border-start border-4 border-secondary">
                                        <strong>
                                            <i class="bi bi-truck me-2"></i> Vehicle Details
                                        </strong>
                                    </div>
                                    <div class="card-body row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">
                                                Vehicle No
                                                <i class="bi bi-info-circle text-primary"
                                                    data-bs-toggle="tooltip"
                                                    title="Enter Vehicle number (Optional)"></i>
                                            </label>
                                            <input type="text" name="vehicle_no" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">
                                                Owner Name
                                                <i class="bi bi-info-circle text-primary"
                                                    data-bs-toggle="tooltip"
                                                    title="Enter Vehicle number (Optional)"></i>
                                            </label>
                                            <input type="text" name="owner_name" class="form-control">
                                        </div>
                                    </div>
                                </div>


                                {{-- ================= INVOICE DETAILS ================= --}}
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-light border-start border-4 border-dark">
                                        <strong><i class="bi bi-receipt me-2"></i> Invoice Details</strong>
                                    </div>

                                    <div class="card-body row g-3">

                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">
                                                Invoice No
                                                <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip"
                                                    title="Enter supplier invoice number for this shipment"></i>
                                            </label>
                                            <input type="text" name="invoice_no" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">
                                                Invoice Date
                                                <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip"
                                                    title="Select the invoice issue date"></i>
                                            </label>
                                            <input type="date" name="invoice_date" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">
                                                Value of Goods
                                                <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip"
                                                    title="Enter total invoice value of goods"></i>
                                            </label>
                                            <input type="number" step="0.01" name="value_of_goods" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">
                                                E-Way Bill No
                                                <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip"
                                                    title="Enter E-Way Bill number (if applicable)"></i>
                                            </label>
                                            <input type="text" name="eway_bill_no" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">
                                                EWB Expiry Date
                                                <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip"
                                                    title="Select E-Way Bill expiry date"></i>
                                            </label>
                                            <input type="date" name="ewb_exp_date" class="form-control">
                                        </div>

                                    </div>
                                </div>


                                {{-- ================= CHARGES ================= --}}
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-light border-start border-4 border-danger">
                                        <strong><i class="bi bi-cash-stack me-2"></i> Charges Details</strong>
                                    </div>

                                    <div class="card-body row g-3">

                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">LR Type</label>
                                            <select name="lr_type" class="form-select form-control">
                                                <option value="Paid">Paid</option>
                                                <option value="To Pay">To Pay</option>
                                                <option value="TBB">TBB</option>
                                                <option value="FOC">FOC</option>
                                                <option value="Cancel">Cancel</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Print Freight?</label>
                                            <select name="print_freight" class="form-select form-control">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">Apply Gst</label>
                                            <select name="apply_gst" class="form-select form-control">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">
                                                CGST
                                                <i class="bi bi-info-circle text-primary"
                                                    data-bs-toggle="tooltip"
                                                    title="Central GST amount"></i>
                                            </label>
                                            <input type="number" step="0.01" name="cgst" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">
                                                SGST
                                                <i class="bi bi-info-circle text-primary"
                                                    data-bs-toggle="tooltip"
                                                    title="State GST amount"></i>
                                            </label>
                                            <input type="number" step="0.01" name="sgst" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold">
                                                IGST
                                                <i class="bi bi-info-circle text-primary"
                                                    data-bs-toggle="tooltip"
                                                    title="Integrated GST amount (for interstate transport)"></i>
                                            </label>
                                            <input type="number" step="0.01" name="igst" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">
                                                Freight
                                                <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip"
                                                    title="Main transportation charge"></i>
                                            </label>
                                            <input type="number" step="0.01" name="freight" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">
                                                Hamali
                                                <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip"
                                                    title="Loading / unloading labour charges"></i>
                                            </label>
                                            <input type="number" step="0.01" name="hamali" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">
                                                Pre Bhadha
                                                <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip"
                                                    title="Advance freight collected"></i>
                                            </label>
                                            <input type="number" step="0.01" name="pre_bhadha" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">
                                                Bilty Charge
                                                <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip"
                                                    title="LR / Bilty documentation charge"></i>
                                            </label>
                                            <input type="number" step="0.01" name="bilty_charge" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">
                                                Collection Charges
                                                <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip"
                                                    title="Collection handling charges"></i>
                                            </label>
                                            <input type="number" step="0.01" name="colle_charges" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">
                                                CPC
                                                <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip"
                                                    title="Central processing charge"></i>
                                            </label>
                                            <input type="number" step="0.01" name="cpc" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">
                                                Other Charges
                                                <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip"
                                                    title="Any additional charges"></i>
                                            </label>
                                            <input type="number" step="0.01" name="other_charge" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold">
                                                Total
                                                <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip"
                                                    title="Auto calculated total of all charges"></i>
                                            </label>
                                            <input type="number" step="0.01" name="total" class="form-control bg-light" readonly>
                                        </div>

                                    </div>
                                </div>


                                {{-- ================= FINAL PAYMENT ================= --}}
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-light border-start border-4 border-primary">
                                        <strong><i class="bi bi-calculator me-2"></i> Final Amount</strong>
                                    </div>

                                    <div class="card-body row g-3">

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">
                                                Advance
                                                <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip"
                                                    title="Advance amount received from customer"></i>
                                            </label>
                                            <input type="number" step="0.01" name="advance" class="form-control">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">
                                                Grand Total
                                                <i class="bi bi-info-circle text-primary" data-bs-toggle="tooltip"
                                                    title="Final payable amount after GST and advance adjustment"></i>
                                            </label>
                                            <input type="number" step="0.01" name="grand_total" class="form-control bg-light" readonly>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer text-end bg-light">
                                    <a href="{{ route('booking_entries.index') }}" class="btn btn-outline-secondary mt-3">Cancel</a>
                                    <button type="submit" class="btn btn-secondary mt-3">Save Booking</button>
                                </div>

                            </div>
                        </form>
                    </div>


                </div>

            </div>
        </div>
    </div>
    </div>
</main>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        function getValue(name) {
            let el = document.querySelector('[name="' + name + '"]');
            return el ? parseFloat(el.value) || 0 : 0;
        }

        function setValue(name, value) {
            let el = document.querySelector('[name="' + name + '"]');
            if (el) {
                el.value = value.toFixed(2);
            }
        }

        function calculate() {

            let total =
                getValue('freight') +
                getValue('hamali') +
                getValue('pre_bhadha') +
                getValue('bilty_charge') +
                getValue('colle_charges') +
                getValue('cpc') +
                getValue('other_charge');

            setValue('total', total);

            let gstTotal =
                getValue('cgst') +
                getValue('sgst') +
                getValue('igst');

            let grandTotal = total + gstTotal - getValue('advance');

            setValue('grand_total', grandTotal);
        }

        // Attach only to relevant inputs
        let inputs = document.querySelectorAll(
            '[name="freight"], [name="hamali"], [name="pre_bhadha"], [name="bilty_charge"], [name="colle_charges"], [name="cpc"], [name="other_charge"], [name="cgst"], [name="sgst"], [name="igst"], [name="advance"]'
        );

        inputs.forEach(function(input) {
            input.addEventListener('input', calculate);
        });

        // Run once initially
        calculate();

    });
</script>



@endsection
