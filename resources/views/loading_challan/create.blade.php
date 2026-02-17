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
                        <h3 class="mb-0 text-primary">Create Loading Challan</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('loading-challan.index') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active text-primary">
                                Create Loading Challan
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
                        <!-- LEFT SIDE TITLE -->
                        <h5 class="mb-0">
                            <i class="bi bi-truck me-2"></i> Loading Challan Details
                        </h5>
                        <div class="d-flex gap-2 ms-auto flex-wrap">
                            <a href="{{ route('loading-challan.create') }}" class="btn btn-sm btn-dark">
                                <i class="bi bi-plus-circle"></i> New
                            </a>
                            <a href="{{ route('loading-challan.index') }}" class="btn btn-sm btn-info text-white">
                                <i class="bi bi-eye"></i> Show
                            </a>
                            <button type="button" class="btn btn-sm btn-success">
                                <i class="bi bi-printer"></i> Print
                            </button>
                            <button type="button" class="btn btn-sm text-white" style="background:#f39c12;">
                                <i class="bi bi-envelope"></i> Send Mail
                            </button>
                        </div>
                    </div>
                    <form action="{{ route('loading-challan.store') }}" method="POST">
                        @csrf

                        <div class="card-body">

                            {{-- ================= BASIC DETAILS ================= --}}
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-success">
                                    <strong><i class="bi bi-card-text me-2"></i>Basic Details</strong>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Challan No"></i>
                                                Challan No</label>
                                            <input type="text" name="challan_no" value="{{ old('challan_no') }}"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label d-flex align-items-center gap-1">
                                                <i class="bi bi-info-circle text-primary" title="Select Challan Date"></i>
                                                Challan Date
                                            </label>
                                            <div class="input-group datepicker-group">
                                                <input type="text" name="challan_date" value="{{ old('challan_date') }}"
                                                    class="form-control datepicker" placeholder="YYYY-MM-DD">
                                                <span class="input-group-text calendar-icon" style="cursor:pointer;">
                                                    <i class="bi bi-calendar"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Vehicle No"></i> Vehicle No</label>
                                            <input type="text" name="vehicle_no" value="{{ old('vehicle_no') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Owner / Broker"></i> Owner / Broker</label>
                                            <input type="text" name="vehicle_owner" value="{{ old('vehicle_owner') }}"
                                                class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- ================= SOURCE DETAILS ================= --}}
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-primary">
                                    <strong><i class="bi bi-box-arrow-in-right me-2"></i>Source Details</strong>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Source"></i> Source</label>
                                            <input type="text" name="source" value="{{ old('source') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Source State"></i> Source State</label>
                                            <input type="text" name="source_state" value="{{ old('source_state') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Source City"></i> Source City</label>
                                            <input type="text" name="source_city" value="{{ old('source_city') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Source District"></i> Source District</label>
                                            <input type="text" name="source_district"
                                                value="{{ old('source_district') }}" class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- ================= DESTINATION DETAILS ================= --}}
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-warning">
                                    <strong><i class="bi bi-geo-alt-fill me-2"></i>Destination Details</strong>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Destination"></i> Destination</label>
                                            <input type="text" name="destination" value="{{ old('destination') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Destination State"></i> Destination State</label>
                                            <input type="text" name="destination_state"
                                                value="{{ old('destination_state') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Destination City"></i> Destination City</label>
                                            <input type="text" name="destination_city"
                                                value="{{ old('destination_city') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Destination District"></i> Destination District</label>
                                            <input type="text" name="destination_district"
                                                value="{{ old('destination_district') }}" class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- ================= EXTRA DETAILS ================= --}}
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-secondary">
                                    <strong><i class="bi bi-plus-circle me-2"></i>Additional Details</strong>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Firm / Branch"></i> Firm / Branch</label>
                                            <input type="text" name="firm_branch" value="{{ old('firm_branch') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter License No"></i> License No</label>
                                            <input type="text" name="license_no" value="{{ old('license_no') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Remarks"></i> Remarks</label>
                                            <input type="text" name="remarks" value="{{ old('remarks') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Challan Type"></i> Challan Type</label>
                                            <input type="text" name="challan_type" value="{{ old('challan_type') }}"
                                                class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- ================= BROKER & DRIVER ================= --}}
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-info">
                                    <strong><i class="bi bi-people-fill me-2"></i>Broker & Driver</strong>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Select Broker"></i> Select Broker</label>
                                            <select name="broker_id" class="form-select">
                                                <option value="">Select Broker</option>
                                                @foreach ($brokers as $b)
                                                    <option value="{{ $b->id }}">
                                                        {{ $b->broker_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Select Driver"></i> Select Driver</label>
                                            <select name="driver_id" class="form-select">
                                                <option value="">Select Driver</option>
                                                @foreach ($drivers as $d)
                                                    <option value="{{ $d->id }}">
                                                        {{ $d->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Select LR No"></i> Select LR No.</label>
                                            <select name="lr_id" class="form-select">
                                                <option value="">Select LR No</option>
                                                @foreach ($lr_no as $l)
                                                    <option value="{{ $l->id }}">
                                                        {{ $l->lr_no }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter GR No"></i> GR No.</label>
                                            <input type="text" name="gr_no" value="{{ old('gr_no') }}"
                                                class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- ================= FREIGHT DETAILS ================= --}}
                            <div class="card mb-3 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-danger">
                                    <strong><i class="bi bi-cash-stack me-2"></i>Freight Details</strong>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Total Freight"></i> Total Freight</label>
                                            <input type="number" name="total_freight"
                                                value="{{ old('total_freight') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Truck Freight"></i> Truck Freight</label>
                                            <input type="number" name="truck_freight"
                                                value="{{ old('truck_freight') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Advance"></i> Advance</label>
                                            <input type="number" name="advance" value="{{ old('advance') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Commission Amount"></i> Commission Amount</label>
                                            <input type="number" name="commission_amount"
                                                value="{{ old('commission_amount') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter L.C. Charge"></i> L.C. Charge</label>
                                            <input type="number" name="lc_charge" value="{{ old('lc_charge') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter D.C. Charge"></i> D.C. Charge</label>
                                            <input type="number" name="dc_charge" value="{{ old('dc_charge') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter C.F. Charge"></i> C.F. Charge</label>
                                            <input type="number" name="cf_charge" value="{{ old('cf_charge') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Total Crossing"></i> Total Crossing</label>
                                            <input type="number" name="tot_crossing" value="{{ old('tot_crossing') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Net Amount"></i> Net Amount</label>
                                            <input type="number" name="net_amount" value="{{ old('net_amount') }}"
                                                class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- FOOTER --}}
                        <div class="card-footer bg-light text-end">
                            <a href="{{ route('loading-challan.index') }}" class="btn btn-outline-secondary me-2">
                                <i class="bi bi-arrow-left-circle me-1"></i> Back
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-arrow-left-circle me-1"></i> Add Loading Challan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </main>
@endsection
