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
                        <h3 class="mb-0 text-success">Create Loading Challan</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active text-success">Create Loading Challan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="card border-5 border-secondary shadow-sm">
                    <div class="card-header bg-secondary text-white d-flex align-items-center">

                        <h5 class="card-title mb-0">Loading Challan</h5>

                        <div class="ms-auto">
                            <div class="btn-group">
                                <a href="{{ route('loading-challan.create') }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-plus-circle"></i> New
                                </a>

                                <a href="#" class="btn btn-sm btn-warning text-white">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                <a href="{{ route('loading-challan.index') }}" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i> Show
                                </a>

                                <button type="button" class="btn btn-sm btn-success">
                                    <i class="bi bi-printer"></i> Print
                                </button>

                                <button type="button" class="btn btn-sm" style="background:#f39c12;color:white;">
                                    <i class="bi bi-envelope"></i> Send Mail
                                </button>
                            </div>
                        </div>

                    </div>


                    <form action="{{ route('loading-challan.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            {{-- ================= BASIC DETAILS ================= --}}
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-info-circle text-primary" title="Enter Challan No"></i>
                                        Challan No
                                    </label>
                                    <input type="text" name="challan_no" class="form-control"
                                        value="{{ old('challan_no') }}">
                                    @error('challan_no')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-calendar-date text-primary" title="Select Challan Date"></i>
                                        Challan Date
                                    </label>

                                    <div class="input-group datepicker-group">
                                        <input type="text" name="challan_date" value="{{ old('challan_date') }}"
                                            class="form-control datepicker" placeholder="YYYY-MM-DD">
                                        <span class="input-group-text calendar-icon" style="cursor:pointer;">
                                            <i class="bi bi-calendar-event"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-truck text-primary" title="Enter Vehicle Number"></i>
                                        Vehicle No
                                    </label>
                                    <input type="text" name="vehicle_no" value="{{ old('vehicle_no') }}"
                                        class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-person text-primary" title="Enter Vehicle Owner"></i>
                                        Owner / Broker
                                    </label>
                                    <input type="text" name="vehicle_owner" value="{{ old('vehicle_owner') }}"
                                        class="form-control">
                                </div>
                            </div>

                            {{-- ================= SOURCE DETAILS ================= --}}
                            <div class="row g-3">

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-geo-alt text-primary" title="Enter Source"></i>
                                        Source
                                    </label>
                                    <input type="text" name="source" value="{{ old('source') }}" class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-map text-primary" title="Enter Source State"></i>
                                        Source State
                                    </label>
                                    <input type="text" name="source_state" value="{{ old('source_state') }}"
                                        class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-building text-primary" title="Enter Source City"></i>
                                        Source City
                                    </label>
                                    <input type="text" name="source_city" value="{{ old('source_city') }}"
                                        class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-pin-map text-primary" title="Enter Source District"></i>
                                        Source District
                                    </label>
                                    <input type="text" name="source_district" value="{{ old('source_district') }}"
                                        class="form-control">
                                </div>

                            </div>

                            {{-- ================= DESTINATION DETAILS ================= --}}
                            <div class="row g-3">

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-geo text-primary" title="Enter Destination"></i>
                                        Destination
                                    </label>
                                    <input type="text" name="destination" value="{{ old('destination') }}"
                                        class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-map text-primary" title="Enter Destination State"></i>
                                        Destination State
                                    </label>
                                    <input type="text" name="destination_state"
                                        value="{{ old('destination_state') }}" class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-building text-primary" title="Enter City"></i>
                                        Destination City
                                    </label>
                                    <input type="text" name="destination_city" value="{{ old('destination_city') }}"
                                        class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-pin-map text-primary" title="Enter District"></i>
                                        Destination District
                                    </label>
                                    <input type="text" name="destination_district"
                                        value="{{ old('destination_district') }}" class="form-control">
                                </div>

                            </div>

                            <div class="row g-3">
                                <!-- Firm / Branch -->
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-building text-primary" title="Enter Firm / Branch"></i>
                                        Firm / Branch
                                    </label>
                                    <input type="text" name="firm_branch" value="{{ old('firm_branch') }}"
                                        class="form-control">
                                </div>

                                <!-- License No -->
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-card-text text-primary" title="Enter License No"></i>
                                        License No
                                    </label>
                                    <input type="text" name="license_no" value="{{ old('license_no') }}"
                                        class="form-control">
                                </div>

                                <!-- Remarks -->
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-chat-left-text text-primary" title="Enter Remarks"></i>
                                        Remarks
                                    </label>
                                    <input type="text" name="remarks" value="{{ old('remarks') }}"
                                        class="form-control">
                                </div>

                                <!-- Challan Type -->
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-list-check text-primary" title="Enter Challan Type"></i>
                                        Challan Type
                                    </label>
                                    <input type="text" name="challan_type" value="{{ old('challan_type') }}"
                                        class="form-control">
                                </div>

                            </div>

                            {{-- ================= BROKER DETAILS ================= --}}
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-person-badge text-primary" title="Select Broker"></i>
                                        Select Broker
                                    </label>
                                    <select name="broker_id" class="form-select form-control">
                                        <option value="">Select Broker</option>
                                        @foreach ($brokers as $b)
                                            <option value="{{ $b->id }}"
                                                {{ old('broker_id') == $b->id ? 'selected' : '' }}>
                                                {{ $b->broker_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                        <i class="bi bi-person text-primary" title="Select Driver"></i>
                                        Select Driver
                                    </label>
                                    <select name="driver_id" class="form-select form-control">
                                        <option value="">Select Driver</option>
                                        @foreach ($drivers as $d)
                                            <option value="{{ $d->id }}"
                                                {{ old('driver_id') == $d->id ? 'selected' : '' }}>
                                                {{ $d->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="card shadow-sm border-0 mb-3">
                                <div class="card-body">
                                    <div class="row align-items-center text-center">

                                        <!-- LR No -->
                                        <div class="col-md-2 fw-bold text-danger">
                                            LR No.
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="lr_no" value="{{ old('lr_no') }}"
                                                class="form-control border-secondary">
                                        </div>

                                        <!-- GR No -->
                                        <div class="col-md-2 fw-bold text-danger">
                                            GR No.
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="gr_no" value="{{ old('gr_no') }}"
                                                class="form-control border-secondary">
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- ================= FREIGHT DETAILS ================= --}}
                            <div class="card shadow-sm mb-4 border-0 challan-box">
                                <div class="card-header bg-white fw-semibold challan-heading">
                                    Challan Details
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <!-- Total Freight -->
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                                <i class="bi bi-cash-stack text-primary"></i>
                                                Total Freight
                                            </label>
                                            <input type="number" name="total_freight"
                                                value="{{ old('total_freight') }}" class="form-control">
                                        </div>

                                        <!-- Truck Freight -->
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                                <i class="bi bi-truck-front text-primary"></i>
                                                Truck Freight
                                            </label>
                                            <input type="number" name="truck_freight"
                                                value="{{ old('truck_freight') }}" class="form-control">
                                        </div>

                                        <!-- Advance -->
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                                <i class="bi bi-wallet2 text-primary"></i>
                                                Advance
                                            </label>
                                            <input type="number" name="advance" value="{{ old('advance') }}"
                                                class="form-control">
                                        </div>

                                        <!-- Commission Amount -->
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                                <i class="bi bi-percent text-primary"></i>
                                                Comm. Amt
                                            </label>
                                            <input type="number" name="commission_amount"
                                                value="{{ old('commission_amount') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row g-3 mt-1">
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                                <i class="bi bi-truck text-primary"></i>
                                                L.C. Chrg
                                            </label>
                                            <input type="number" name="lc_charge" value="{{ old('lc_charge') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                                <i class="bi bi-box-seam text-primary"></i>
                                                D.C. Chrg
                                            </label>
                                            <input type="number" name="dc_charge" value="{{ old('dc_charge') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                                <i class="bi bi-currency-rupee text-primary"></i>
                                                C.F. Chrg
                                            </label>
                                            <input type="number" name="cf_charge" value="{{ old('cf_charge') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                                <i class="bi bi-arrow-left-right text-primary"></i>
                                                Tot Crossing
                                            </label>
                                            <input type="number" name="tot_crossing" value="{{ old('tot_crossing') }}"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="row g-3 mt-1">
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold d-flex align-items-center gap-1">
                                                <i class="bi bi-currency-rupee text-success"></i>
                                                Net Amount
                                            </label>
                                            <input type="number" name="net_amount" value="{{ old('net_amount') }}"
                                                class="form-control">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <br>
                            <div class="card-footer text-end bg-light">
                                <a href="{{ route('loading-challan.index') }}"
                                    class="btn btn-outline-secondary">Cancel</a>
                                <button type="submit" class="btn btn-success px-4">Save Challan</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>
@endsection
