@extends('admin.partials.app')

@section('main-content')
    <style>
        .form-control:focus {
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            outline: 0;
            box-shadow: var(--bs-box-shadow-inset), 0 0 0 0.25rem rgb(242 243 244 / 25%);
        }

        .form-control {
            border: var(--bs-border-width) solid #a9abad;
            border-radius: 0px;
            box-shadow: var(--bs-box-shadow-inset);
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .bg-light {
            background-color: rgb(225 229 232 / 46%) !important;
        }

        label i {
            background: #eef3ff;
            padding: 3px 6px;
            border-radius: 5px;
            font-size: 13px;
        }

        .challan-box {
            border-radius: 8px;
            border-left: 4px solid #0dcaf0;
        }

        .challan-heading {
            font-size: 16px;
            padding: 10px 15px;
            border-bottom: 2px solid #0dcaf0;
        }
    </style>

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0 text-primary">Edit Loading Challan</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active text-primary">Edit Loading Challan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card border-5 border-primary shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Edit Loading Challan Details</h5>
                    </div>

                    <form action="{{ route('loading-challan.update', $challan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            {{-- ================= BASIC DETAILS ================= --}}
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-info-circle text-primary"></i>
                                        Challan No
                                    </label>
                                    <input type="text" name="challan_no" class="form-control"
                                        value="{{ old('challan_no', $challan->challan_no) }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-calendar-date text-primary"></i>
                                        Challan Date
                                    </label>
                                    <div class="input-group datepicker-group">
                                        <input type="text" name="challan_date" class="form-control datepicker"
                                            value="{{ old('challan_date', $challan->challan_date) }}"
                                            placeholder="YYYY-MM-DD">
                                        <span class="input-group-text calendar-icon" style="cursor:pointer;">
                                            <i class="bi bi-calendar-event"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-truck text-primary"></i>
                                        Vehicle No
                                    </label>
                                    <input type="text" name="vehicle_no" class="form-control"
                                        value="{{ old('vehicle_no', $challan->vehicle_no) }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-person text-primary"></i>
                                        Owner / Broker
                                    </label>
                                    <input type="text" name="vehicle_owner" class="form-control"
                                        value="{{ old('vehicle_owner', $challan->vehicle_owner) }}">
                                </div>
                            </div>

                            {{-- ================= SOURCE DETAILS ================= --}}
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-geo-alt text-primary"></i>
                                        Source
                                    </label>
                                    <input type="text" name="source" class="form-control"
                                        value="{{ old('source', $challan->source) }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-map text-primary"></i>
                                        Source State
                                    </label>
                                    <input type="text" name="source_state" class="form-control"
                                        value="{{ old('source_state', $challan->source_state) }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-building text-primary"></i>
                                        Source City
                                    </label>
                                    <input type="text" name="source_city" class="form-control"
                                        value="{{ old('source_city', $challan->source_city) }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-pin-map text-primary"></i>
                                        Source District
                                    </label>
                                    <input type="text" name="source_district" class="form-control"
                                        value="{{ old('source_district', $challan->source_district) }}">
                                </div>
                            </div>

                            {{-- ================= DESTINATION DETAILS ================= --}}
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-geo text-primary"></i>
                                        Destination
                                    </label>
                                    <input type="text" name="destination" class="form-control"
                                        value="{{ old('destination', $challan->destination) }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-map text-primary"></i>
                                        Destination State
                                    </label>
                                    <input type="text" name="destination_state" class="form-control"
                                        value="{{ old('destination_state', $challan->destination_state) }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-building text-primary"></i>
                                        Destination City
                                    </label>
                                    <input type="text" name="destination_city" class="form-control"
                                        value="{{ old('destination_city', $challan->destination_city) }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-pin-map text-primary"></i>
                                        Destination District
                                    </label>
                                    <input type="text" name="destination_district" class="form-control"
                                        value="{{ old('destination_district', $challan->destination_district) }}">
                                </div>
                            </div>

                            {{-- ================= OTHER DETAILS ================= --}}
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-building text-primary"></i>
                                        Firm / Branch
                                    </label>
                                    <input type="text" name="firm_branch" class="form-control"
                                        value="{{ old('firm_branch', $challan->firm_branch) }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-card-text text-primary"></i>
                                        License No
                                    </label>
                                    <input type="text" name="license_no" class="form-control"
                                        value="{{ old('license_no', $challan->license_no) }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-chat-left-text text-primary"></i>
                                        Remarks
                                    </label>
                                    <input type="text" name="remarks" class="form-control"
                                        value="{{ old('remarks', $challan->remarks) }}">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-list-check text-primary"></i>
                                        Challan Type
                                    </label>
                                    <input type="text" name="challan_type" class="form-control"
                                        value="{{ old('challan_type', $challan->challan_type) }}">
                                </div>
                            </div>

                            {{-- ================= BROKER & DRIVER ================= --}}
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-person-badge text-primary"></i>
                                        Select Broker
                                    </label>
                                    <select name="broker_id" class="form-select form-control">
                                        <option value="">Select Broker</option>
                                        @foreach ($brokers as $b)
                                            <option value="{{ $b->id }}"
                                                {{ $challan->broker_id == $b->id ? 'selected' : '' }}>
                                                {{ $b->broker_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-person text-primary"></i>
                                        Select Driver
                                    </label>
                                    <select name="driver_id" class="form-select form-control">
                                        <option value="">Select Driver</option>
                                        @foreach ($drivers as $d)
                                            <option value="{{ $d->id }}"
                                                {{ $challan->driver_id == $d->id ? 'selected' : '' }}>
                                                {{ $d->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-body">
                                    <div class="row align-items-center text-center">

                                        <!-- LR No -->
                                        <div class="col-md-2 fw-bold text-danger">
                                            LR No.
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="lr_no" class="form-control border-secondary"
                                                value="{{ old('lr_no', $challan->lr_no ?? '') }}">
                                        </div>

                                        <!-- GR No -->
                                        <div class="col-md-2 fw-bold text-danger">
                                            GR No.
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="gr_no" class="form-control border-secondary"
                                                value="{{ old('gr_no', $challan->gr_no ?? '') }}">
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- ================= CHALLAN DETAILS ================= --}}
                            <div class="card shadow-sm mb-4 border-0 challan-box">
                                <div class="card-header bg-white fw-semibold challan-heading">
                                    Challan Details
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                                <i class="bi bi-cash-stack text-primary"></i>
                                                Total Freight
                                            </label>
                                            <input type="number" name="total_freight" class="form-control"
                                                value="{{ old('total_freight', $challan->total_freight) }}">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                                <i class="bi bi-truck-front text-primary"></i>
                                                Truck Freight
                                            </label>
                                            <input type="number" name="truck_freight" class="form-control"
                                                value="{{ old('truck_freight', $challan->truck_freight) }}">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                                <i class="bi bi-wallet2 text-primary"></i>
                                                Advance
                                            </label>
                                            <input type="number" name="advance" class="form-control"
                                                value="{{ old('advance', $challan->advance) }}">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                                <i class="bi bi-percent text-primary"></i>
                                                Comm. Amt
                                            </label>
                                            <input type="number" name="commission_amount" class="form-control"
                                                value="{{ old('commission_amount', $challan->commission_amount) }}">
                                        </div>
                                    </div>

                                    <div class="row g-3 mt-1">
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                                <i class="bi bi-truck text-primary"></i>
                                                L.C. Chrg
                                            </label>
                                            <input type="number" name="lc_charge" class="form-control"
                                                value="{{ old('lc_charge', $challan->lc_charge) }}">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                                <i class="bi bi-box-seam text-primary"></i>
                                                D.C. Chrg
                                            </label>
                                            <input type="number" name="dc_charge" class="form-control"
                                                value="{{ old('dc_charge', $challan->dc_charge) }}">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                                <i class="bi bi-currency-rupee text-primary"></i>
                                                C.F. Chrg
                                            </label>
                                            <input type="number" name="cf_charge" class="form-control"
                                                value="{{ old('cf_charge', $challan->cf_charge) }}">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                                <i class="bi bi-arrow-left-right text-primary"></i>
                                                Tot Crossing
                                            </label>
                                            <input type="number" name="tot_crossing" class="form-control"
                                                value="{{ old('tot_crossing', $challan->tot_crossing) }}">
                                        </div>
                                    </div>

                                    <div class="row g-3 mt-1">
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                                <i class="bi bi-currency-rupee text-success"></i>
                                                Net Amount
                                            </label>
                                            <input type="number" name="net_amount" class="form-control"
                                                value="{{ old('net_amount', $challan->net_amount) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-end bg-light">
                                <a href="{{ route('loading-challan.index') }}" class="btn btn-outline-secondary">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary px-4">
                                    Update Challan
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
