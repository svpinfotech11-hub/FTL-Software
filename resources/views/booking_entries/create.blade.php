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
                                        <strong>LR Details</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">LR No</label>
                                                <input type="text" name="lr_no" value="{{ $nextLrNo }}" class="form-control bg-light" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">LR Date *</label>
                                                <input type="date" name="lr_date" class="form-control" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Ref LR No</label>
                                                <input type="text" name="ref_lr_no" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ================= SOURCE & DESTINATION ================= --}}
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-light border-start border-4 border-primary">
                                        <strong>Route Details</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <label>Source Ledger *</label>
                                                <select name="source_ledger_id" class="form-select form-control" required>
                                                    <option value="">Select Source</option>
                                                    @foreach($ledgers as $ledger)
                                                    <option value="{{ $ledger->id }}">{{ $ledger->party_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Source Address</label>
                                                <input type="text" name="source_address" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label>State</label>
                                                <input type="text" name="source_state" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label>City</label>
                                                <input type="text" name="source_city" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label>District</label>
                                                <input type="text" name="source_district" class="form-control">
                                            </div>

                                            <div class="col-md-3">
                                                <label>Destination Ledger *</label>
                                                <select name="destination_ledger_id" class="form-select form-control" required>
                                                    <option value="">Select Destination</option>
                                                    @foreach($ledgers as $ledger)
                                                    <option value="{{ $ledger->id }}">{{ $ledger->party_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label>Destination Address</label>
                                                <input type="text" name="destination_address" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label>State</label>
                                                <input type="text" name="destination_state" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label>City</label>
                                                <input type="text" name="destination_city" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label>District</label>
                                                <input type="text" name="destination_district" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ================= CONSIGNOR ================= --}}
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-light border-start border-4 border-warning">
                                        <strong>Consignor Details</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label>Consignor Ledger Name</label>
                                                <input type="text" name="consignor_ledger_name" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label>GSTIN</label>
                                                <input type="text" name="consignor_gstin" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Mobile</label>
                                                <input type="text" name="consignor_mobile" class="form-control">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Address 1</label>
                                                <input type="text" name="consignor_address1" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Address 2</label>
                                                <input type="text" name="consignor_address2" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label>State</label>
                                                <input type="text" name="consignor_state" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label>City</label>
                                                <input type="text" name="consignor_city" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Phone</label>
                                                <input type="text" name="consignor_phone" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ================= CONSIGNEE ================= --}}
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-light border-start border-4 border-info">
                                        <strong>Consignee Details</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label>Consignee Ledger Name</label>
                                                <input type="text" name="consignee_ledger_name" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label>GSTIN</label>
                                                <input type="text" name="consignee_gstin" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Mobile</label>
                                                <input type="text" name="consignee_mobile" class="form-control">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Address 1</label>
                                                <input type="text" name="consignee_address1" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Address 2</label>
                                                <input type="text" name="consignee_address2" class="form-control">
                                            </div>

                                            <div class="col-md-4">
                                                <label>State</label>
                                                <input type="text" name="consignee_state" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label>City</label>
                                                <input type="text" name="consignee_city" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Phone</label>
                                                <input type="text" name="consignee_phone" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- ================= PRODUCT ================= --}}
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-light border-start border-4 border-secondary">
                                        <strong>Product Details</strong>
                                    </div>
                                    <div class="card-body row g-3">
                                        <!-- <label>Source Ledger *</label> -->
                                        <select name="product_id" class="form-select form-control" required>
                                            <option value="">Select Product</option>
                                            @foreach($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                {{-- ================= VEHICLE ================= --}}
                                <div class="card shadow-sm border-0 mb-4">
                                    <div class="card-header bg-light border-start border-4 border-secondary">
                                        <strong>Vehicle Details</strong>
                                    </div>
                                    <div class="card-body row g-3">
                                        <div class="col-md-6">
                                            <label>Vehicle No</label>
                                            <input type="text" name="vehicle_no" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Owner Name</label>
                                            <input type="text" name="owner_name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="card-footer text-end bg-light">
                        <a href="{{ route('booking_entries.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success px-4">Save Booking</button>
                    </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
    </div>
</main>



@endsection