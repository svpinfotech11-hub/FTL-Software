@extends('admin.partials.app')
@section('main-content')
    <main class="app-main">
        <!-- Header -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Edit Vehicle</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Vehicle</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline mb-4">
                            <div class="card-header">
                                <div class="card-title">Update Vehicle Details</div>
                            </div>

                            <form method="POST" action="{{ route('vehicles.update', $vehicle->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="card-body">
                                    <div class="row g-3">

                                        <!-- Vehicle Number -->
                                        <div class="col-md-4">
                                            <label class="form-label">Vehicle Number</label>
                                            <input type="text" name="vehicle_number" class="form-control"
                                                value="{{ old('vehicle_number', $vehicle->vehicle_number) }}" required>
                                        </div>

                                        <!-- Registration -->
                                        <div class="col-md-4">
                                            <label class="form-label">Vehicle Registration</label>
                                            <input type="text" name="vehicle_registration" class="form-control"
                                                value="{{ old('vehicle_registration', $vehicle->vehicle_registration) }}">
                                        </div>

                                        <!-- Chassis -->
                                        <div class="col-md-4">
                                            <label class="form-label">Vehicle Chassis</label>
                                            <input type="text" name="vehicle_chesis" class="form-control"
                                                value="{{ old('vehicle_chesis', $vehicle->vehicle_chesis) }}">
                                        </div>

                                    </div>

                                    <div class="row g-3 mt-3">

                                        <!-- Model -->
                                        <div class="col-md-4">
                                            <label class="form-label">Vehicle Model</label>
                                            <input type="text" name="vehicle_model" class="form-control"
                                                value="{{ old('vehicle_model', $vehicle->vehicle_model) }}">
                                        </div>

                                        <!-- PUC Date -->
                                        <div class="col-md-4">
                                            <label class="form-label">PUC Date</label>
                                            <div class="input-group datepicker-group">
                                                <input type="text" name="vehicle_puc_date"
                                                    class="form-control datepicker" placeholder="YYYY-MM-DD"
                                                    value="{{ old('vehicle_puc_date', optional($vehicle->vehicle_puc_date)->format('Y-m-d')) }}">
                                                <span class="input-group-text calendar-icon">
                                                    <i class="bi bi-calendar"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Fitness Exp Date -->
                                        <div class="col-md-4">
                                            <label class="form-label">Fitness Exp Date</label>
                                            <div class="input-group datepicker-group">
                                                <input type="text" name="vehicle_fitness_exp_date"
                                                    class="form-control datepicker" placeholder="YYYY-MM-DD"
                                                    value="{{ old('vehicle_fitness_exp_date', optional($vehicle->vehicle_fitness_exp_date)->format('Y-m-d')) }}">
                                                <span class="input-group-text calendar-icon">
                                                    <i class="bi bi-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3 mt-3">

                                        <!-- Permit -->
                                        <div class="col-md-4">
                                            <label class="form-label">Permit Renewal Date</label>
                                            <div class="input-group datepicker-group">
                                                <input type="text" name="vehicle_permit_renewal_date"
                                                    class="form-control datepicker" placeholder="YYYY-MM-DD"
                                                    value="{{ old('vehicle_permit_renewal_date', optional($vehicle->vehicle_permit_renewal_date)->format('Y-m-d')) }}">
                                                <span class="input-group-text calendar-icon">
                                                    <i class="bi bi-calendar"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Insurance Renewal Date -->
                                        <div class="col-md-4">
                                            <label class="form-label">Insurance Renewal Date</label>
                                            <div class="input-group datepicker-group">
                                                <input type="text" name="vehicle_insurance_renew_date"
                                                    class="form-control datepicker" placeholder="YYYY-MM-DD"
                                                    value="{{ old('vehicle_insurance_renew_date', optional($vehicle->vehicle_insurance_renew_date)->format('Y-m-d')) }}">
                                                <span class="input-group-text calendar-icon">
                                                    <i class="bi bi-calendar"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Capacity -->
                                        <div class="col-md-4">
                                            <label class="form-label">Vehicle Capacity</label>
                                            <input type="text" name="vehicle_capacity" class="form-control"
                                                value="{{ old('vehicle_capacity', $vehicle->vehicle_capacity) }}"
                                                placeholder="e.g. 10 TON">
                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer text-end">
                                    <a href="{{ route('vehicles.index') }}" class="btn btn-outline-secondary me-2">
                                        <i class="bi bi-arrow-left"></i> Back
                                    </a>
                                    <button class="btn btn-primary">
                                        <i class="bi bi-check-lg"></i> Update Vehicle
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
