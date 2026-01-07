@extends('admin.partials.app')
@section('main-content')
    <main class="app-main">
        <!-- Header -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Create Vehicle</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Create Vehicle</li>
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
                                <div class="card-title">Vehicle Details</div>
                            </div>

                            <form method="POST" action="{{ route('vehicles.store') }}">
                                @csrf

                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-4">
                                            <label class="form-label">Vehicle Number</label>
                                            <input type="text" name="vehicle_number" class="form-control" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Vehicle Registration</label>
                                            <input type="text" name="vehicle_registration" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Vehicle Chassis</label>
                                            <input type="text" name="vehicle_chesis" class="form-control">
                                        </div>

                                    </div>

                                    <div class="row g-3 mt-3">

                                        <div class="col-md-4">
                                            <label class="form-label">Vehicle Model</label>
                                            <input type="text" name="vehicle_model" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">PUC Date</label>
                                            <div class="input-group">
                                               <input type="text" name="vehicle_puc_date" class="form-control datepicker" placeholder="YYYY-MM-DD">
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <label class="form-label">Fitness Exp Date</label>
                                            <input type="date" name="vehicle_fitness_exp_date" class="form-control datepicker" placeholder="YYYY-MM-DD">
                                        </div>

                                    </div>

                                    <div class="row g-3 mt-3">

                                        <div class="col-md-4">
                                            <label class="form-label">Permit Renewal Date</label>
                                            <input type="date" name="vehicle_permit_renewal_date" class="form-control datepicker" placeholder="YYYY-MM-DD">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Insurance Renewal Date</label>
                                            <input type="date" name="vehicle_insurance_renew_date" class="form-control datepicker" placeholder="YYYY-MM-DD">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Vehicle Capacity</label>
                                            <input type="text" name="vehicle_capacity" class="form-control"
                                                placeholder="e.g. 10 TON">
                                        </div>

                                    </div>
                                </div>

                                <div class="card-footer text-end">
                                    <a href="{{ route('vehicles.index') }}" class="btn btn-outline-secondary me-2">
                                        <i class="bi bi-arrow-left"></i> Back
                                    </a>
                                    <button class="btn btn-primary">
                                        <i class="bi bi-check-lg"></i> Save Vehicle
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
