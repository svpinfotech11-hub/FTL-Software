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
                <div class="card shadow border-4 border-primary">

                    <div class="card-header bg-primary text-white">
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
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Challan No"></i> Challan No</label>
                                            <input type="text" name="challan_no"
                                                value="{{ old('challan_no', $loadingChallan->challan_no) }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Select Challan Date"></i> Challan Date</label>
                                            <input type="text" name="challan_date"
                                                value="{{ old('challan_date', $loadingChallan->challan_date) }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Vehicle No"></i> Vehicle No</label>
                                            <input type="text" name="vehicle_no"
                                                value="{{ old('vehicle_no', $loadingChallan->vehicle_no) }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Owner / Broker"></i> Owner / Broker</label>
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
                                    <strong>
                                        <i class="bi bi-box-arrow-in-right me-2"></i>Source Details
                                    </strong>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">

                                        @php
                                            $fields = [
                                                'source' => 'Enter Source Location Name',
                                                'source_state' => 'Enter Source State Name',
                                                'source_city' => 'Enter Source City Name',
                                                'source_district' => 'Enter Source District Name',
                                            ];
                                        @endphp

                                        @foreach ($fields as $field => $title)
                                            <div class="col-md-3">
                                                <label class="form-label">
                                                    <i class="bi bi-info-circle text-primary me-1"
                                                        title="{{ $title }}"></i>
                                                    {{ ucfirst(str_replace('_', ' ', $field)) }}
                                                </label>

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
                                    <strong>
                                        <i class="bi bi-geo-alt-fill me-2"></i>Destination Details
                                    </strong>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">

                                        @php
                                            $destFields = [
                                                'destination' => 'Enter Destination Location Name',
                                                'destination_state' => 'Enter Destination State Name',
                                                'destination_city' => 'Enter Destination City Name',
                                                'destination_district' => 'Enter Destination District Name',
                                            ];
                                        @endphp

                                        @foreach ($destFields as $field => $title)
                                            <div class="col-md-3">
                                                <label class="form-label">
                                                    <i class="bi bi-info-circle text-primary me-1"
                                                        title="{{ $title }}"></i>
                                                    {{ ucfirst(str_replace('_', ' ', $field)) }}
                                                </label>

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
                                    <strong>
                                        <i class="bi bi-plus-circle me-2"></i>Additional Details
                                    </strong>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">

                                        @php
                                            $extraFields = [
                                                'firm_branch' => 'Enter Firm Branch Name',
                                                'license_no' => 'Enter License Number',
                                                'remarks' => 'Enter Any Additional Remarks',
                                                'challan_type' => 'Enter Challan Type',
                                            ];
                                        @endphp

                                        @foreach ($extraFields as $field => $title)
                                            <div class="col-md-3">
                                                <label class="form-label">
                                                    <i class="bi bi-info-circle text-primary me-1"
                                                        title="{{ $title }}"></i>
                                                    {{ ucfirst(str_replace('_', ' ', $field)) }}
                                                </label>

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
                                            <label><i class="bi bi-info-circle text-primary" title="Select Broker"></i>
                                                Select Broker</label>
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
                                            <label><i class="bi bi-info-circle text-primary" title="Select Driver"></i>
                                                Select Driver</label>
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
                                            <label>
                                                <i class="bi bi-info-circle text-primary" title="Select LR No"></i>
                                                Select LR No.
                                            </label>

                                            <select name="lr_id" class="form-select">
                                                <option value="">Select LR No</option>
                                                @foreach ($lr_no as $l)
                                                    <option value="{{ $l->id }}"
                                                        {{ old('lr_id', $loadingChallan->lr_id) == $l->id ? 'selected' : '' }}>
                                                        {{ $l->lr_no }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>


                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary" title="Enter GR No"></i> GR
                                                No.</label>
                                            <input type="text" name="gr_no"
                                                value="{{ old('gr_no', $loadingChallan->gr_no) }}" class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- FREIGHT DETAILS --}}
                            <div class="card mb-3 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-danger">
                                    <strong>
                                        <i class="bi bi-cash-stack me-2"></i>Freight Details
                                    </strong>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">

                                        @php
                                            $freightFields = [
                                                'total_freight' => 'Enter Total Freight Amount',
                                                'truck_freight' => 'Enter Truck Freight Amount',
                                                'advance' => 'Enter Advance Paid Amount',
                                                'commission_amount' => 'Enter Commission Amount',
                                                'lc_charge' => 'Enter LC Charge',
                                                'dc_charge' => 'Enter DC Charge',
                                                'cf_charge' => 'Enter CF Charge',
                                                'tot_crossing' => 'Enter Total Crossing Charges',
                                                'net_amount' => 'Enter Final Net Amount',
                                            ];
                                        @endphp

                                        @foreach ($freightFields as $field => $title)
                                            <div class="col-md-3">
                                                <label class="form-label">
                                                    <i class="bi bi-info-circle text-primary me-1"
                                                        title="{{ $title }}"></i>
                                                    {{ ucfirst(str_replace('_', ' ', $field)) }}
                                                </label>

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
                                <i class="bi bi-arrow-left-circle me-1"></i> Update Loading Challan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </main>
@endsection
