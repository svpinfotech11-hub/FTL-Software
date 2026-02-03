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
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                        required>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Father Name</label>
                                    <input type="text" name="father_name" value="{{ old('father_name') }}"
                                        class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Mother Name</label>
                                    <input type="text" name="mother_name" value="{{ old('mother_name') }}"
                                        class="form-control">
                                </div>

                            </div>

                            <div class="row g-3 mt-3">

                                <div class="col-md-4">
                                    <label class="form-label">Mobile</label>
                                    <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Mobile Alt</label>
                                    <input type="text" name="mobile_alt" value="{{ old('mobile_alt') }}"
                                        class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Salary</label>
                                    <input type="text" name="salary" value="{{ old('salary') }}" class="form-control">
                                </div>

                            </div>

                            <div class="row g-3 mt-3">

                                <div class="col-md-4">
                                    <label class="form-label">Licence No</label>
                                    <input type="text" name="licence_no" value="{{ old('licence_no') }}"
                                        class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city" value="{{ old('city') }}" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">State</label>
                                    <input type="text" name="state" value="{{ old('state') }}" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Pincode</label>
                                    <input type="text" name="pincode" value="{{ old('pincode') }}" class="form-control">
                                </div>


                                <!-- Licence Expiry -->
                                <div class="col-md-4">
                                    <label class="form-label">Licence Expiry</label>
                                    <div class="input-group datepicker-group">
                                        <input type="text" name="licence_exp" value="{{ old('licence_exp') }}"
                                            class="form-control datepicker" placeholder="YYYY-MM-DD">
                                        <span class="input-group-text calendar-icon">
                                            <i class="bi bi-calendar"></i>
                                        </span>
                                    </div>
                                </div>

                                <!-- Joining Date -->
                                <div class="col-md-4">
                                    <label class="form-label">Joining Date</label>
                                    <div class="input-group datepicker-group">
                                        <input type="text" name="joining_date" value="{{ old('joining_date') }}"
                                            class="form-control datepicker" placeholder="YYYY-MM-DD">
                                        <span class="input-group-text calendar-icon">
                                            <i class="bi bi-calendar"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Leaving Date</label>
                                <div class="input-group datepicker-group">
                                    <input type="text" name="leaving_date" value="{{ old('leaving_date') }}"
                                        class="form-control datepicker" placeholder="YYYY-MM-DD">
                                    <span class="input-group-text calendar-icon">
                                        <i class="bi bi-calendar"></i>
                                    </span>
                                </div>
                            </div>


                            <div class="row g-3 mt-3">

                                <div class="col-md-12">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" class="form-control">{{ old('address') }}</textarea>
                                </div>
                            </div>

                        </div>
                        <br>

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
