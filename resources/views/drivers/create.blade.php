@extends('admin.partials.app')
@section('main-content')
    <main class="app-main">

        <!-- Header -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Create Driver</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Create Driver</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="app-content">
            <div class="container-fluid">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header">
                        <div class="card-title">Driver Details</div>
                    </div>

                    <form method="POST" action="{{ route('drivers.store') }}">
                        @csrf

                        <div class="card-body">
                            <div class="row g-3">

                                <div class="col-md-4">
                                    <label class="form-label">Driver Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Father Name</label>
                                    <input type="text" name="father_name" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Mother Name</label>
                                    <input type="text" name="mother_name" class="form-control">
                                </div>

                            </div>

                            <div class="row g-3 mt-3">

                                <div class="col-md-4">
                                    <label class="form-label">Mobile</label>
                                    <input type="text" name="mobile" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Mobile Alt</label>
                                    <input type="text" name="mobile_alt" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Salary</label>
                                    <input type="text" name="salary" class="form-control">
                                </div>

                            </div>

                            <div class="row g-3 mt-3">

                                <div class="col-md-4">
                                    <label class="form-label">Licence No</label>
                                    <input type="text" name="licence_no" class="form-control">
                                </div>

                                 <div class="col-md-4">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">State</label>
                                    <input type="text" name="state" class="form-control">
                                </div>

                                 <div class="col-md-4">
                                    <label class="form-label">Pincode</label>
                                    <input type="text" name="pincode" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Licence Expiry</label>
                                    <input type="date" name="licence_exp" class="form-control datepicker" placeholder="YYYY-MM-DD">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Joining Date</label>
                                    <input type="date" name="joining_date" class="form-control datepicker" placeholder="YYYY-MM-DD">
                                </div>

                            </div>

                            <div class="row g-3 mt-3">
                                <div class="col-md-4">
                                    <label class="form-label">Leaving Date</label>
                                    <input type="date" name="leaving_date" class="form-control datepicker" placeholder="YYYY-MM-DD">
                                </div>
                            </div>

                            <div class="row g-3 mt-3">

                                <div class="col-md-12">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" class="form-control"></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer text-end">
                            <a href="{{ route('drivers.index') }}" class="btn btn-outline-secondary me-2">
                                Back
                            </a>
                            <button class="btn btn-primary">Save Driver</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
