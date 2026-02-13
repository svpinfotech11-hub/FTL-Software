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
                        <h3 class="mb-0 text-primary">Edit Loading Challan</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('loading-challan.index') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active text-primary">
                                Edit Loading Challan
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow border-4 border-dark">

                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">
                            <i class="bi bi-pencil-square me-2"></i> Edit Loading Challan Details
                        </h5>
                    </div>

                    <form action="{{ route('loading-challan.update', $loadingChallan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            {{-- ================= BASIC DETAILS ================= --}}
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-success">
                                    <strong><i class="bi bi-card-text me-2"></i>Basic Details</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-3">
                                            <label class="form-label">Challan No</label>
                                            <input type="text" name="challan_no"
                                                value="{{ old('challan_no', $loadingChallan->challan_no) }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Challan Date</label>
                                            <input type="text" name="challan_date"
                                                value="{{ old('challan_date', $loadingChallan->challan_date) }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Vehicle No</label>
                                            <input type="text" name="vehicle_no"
                                                value="{{ old('vehicle_no', $loadingChallan->vehicle_no) }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Owner / Broker</label>
                                            <input type="text" name="vehicle_owner"
                                                value="{{ old('vehicle_owner', $loadingChallan->vehicle_owner) }}"
                                                class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- SOURCE DETAILS --}}
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-primary">
                                    <strong><i class="bi bi-box-arrow-in-right me-2"></i>Source Details</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">

                                        @php
                                            $fields = ['source', 'source_state', 'source_city', 'source_district'];
                                        @endphp

                                        @foreach ($fields as $field)
                                            <div class="col-md-3">
                                                <label class="form-label">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                                <input type="text" name="{{ $field }}"
                                                    value="{{ old($field, $loadingChallan->$field) }}" class="form-control">
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                            {{-- DESTINATION DETAILS --}}
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-warning">
                                    <strong><i class="bi bi-geo-alt-fill me-2"></i>Destination Details</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">

                                        @php
                                            $destFields = [
                                                'destination',
                                                'destination_state',
                                                'destination_city',
                                                'destination_district',
                                            ];
                                        @endphp

                                        @foreach ($destFields as $field)
                                            <div class="col-md-3">
                                                <label class="form-label">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                                <input type="text" name="{{ $field }}"
                                                    value="{{ old($field, $loadingChallan->$field) }}"
                                                    class="form-control">
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                            {{-- ADDITIONAL DETAILS --}}
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-secondary">
                                    <strong><i class="bi bi-plus-circle me-2"></i>Additional Details</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">

                                        @php
                                            $extraFields = ['firm_branch', 'license_no', 'remarks', 'challan_type'];
                                        @endphp

                                        @foreach ($extraFields as $field)
                                            <div class="col-md-3">
                                                <label
                                                    class="form-label">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                                <input type="text" name="{{ $field }}"
                                                    value="{{ old($field, $loadingChallan->$field) }}"
                                                    class="form-control">
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                            {{-- BROKER & DRIVER --}}
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-info">
                                    <strong><i class="bi bi-people-fill me-2"></i>Broker & Driver</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-3">
                                            <label>Select Broker</label>
                                            <select name="broker_id" class="form-select">
                                                <option value="">Select Broker</option>
                                                @foreach ($brokers as $b)
                                                    <option value="{{ $b->id }}"
                                                        {{ old('broker_id', $loadingChallan->broker_id) == $b->id ? 'selected' : '' }}>
                                                        {{ $b->broker_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label>Select Driver</label>
                                            <select name="driver_id" class="form-select">
                                                <option value="">Select Driver</option>
                                                @foreach ($drivers as $d)
                                                    <option value="{{ $d->id }}"
                                                        {{ old('driver_id', $loadingChallan->driver_id) == $d->id ? 'selected' : '' }}>
                                                        {{ $d->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label>LR No.</label>
                                            <input type="text" name="lr_no"
                                                value="{{ old('lr_no', $loadingChallan->lr_no) }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label>GR No.</label>
                                            <input type="text" name="gr_no"
                                                value="{{ old('gr_no', $loadingChallan->gr_no) }}" class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- FREIGHT DETAILS --}}
                            <div class="card mb-3 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-danger">
                                    <strong><i class="bi bi-cash-stack me-2"></i>Freight Details</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">

                                        @php
                                            $freightFields = [
                                                'total_freight',
                                                'truck_freight',
                                                'advance',
                                                'commission_amount',
                                                'lc_charge',
                                                'dc_charge',
                                                'cf_charge',
                                                'tot_crossing',
                                                'net_amount',
                                            ];
                                        @endphp

                                        @foreach ($freightFields as $field)
                                            <div class="col-md-3">
                                                <label>{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                                <input type="number" name="{{ $field }}"
                                                    value="{{ old($field, $loadingChallan->$field) }}"
                                                    class="form-control">
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer bg-light text-end">
                            <a href="{{ route('loading-challan.index') }}" class="btn btn-outline-secondary me-2">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Update Challan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </main>
@endsection
