@extends('admin.partials.app')
@section('main-content')
    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Edit Vendor</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Vendor</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">

                    <div class="col-md-12">
                        <div class="card card-primary card-outline mb-4">

                            <!--begin::Header-->
                            <div class="card-header">
                                <div class="card-title">Edit Vendor</div>
                            </div>
                            <!--end::Header-->

                            <!--begin::Form-->
                            <form method="POST" action="{{ route('vendors.update', $vendor->id) }}">
                                @csrf
                                @method('PUT')

                                <!--begin::Body-->
                                <div class="card-body">
                                    <div class="row g-3">

                                        <!-- Vendor Name -->
                                        <div class="col-md-4">
                                            <label class="form-label">Vendor Name</label>
                                            <input type="text" name="vendor_name" class="form-control"
                                                value="{{ old('vendor_name', $vendor->vendor_name) }}"
                                                placeholder="Enter vendor name" required>
                                        </div>

                                        <!-- Contact -->
                                        <div class="col-md-4">
                                            <label class="form-label">Contact Number</label>
                                            <input type="text" name="contact" class="form-control"
                                                value="{{ old('contact', $vendor->contact) }}"
                                                placeholder="Enter contact number" required>
                                        </div>

                                        <!-- City -->
                                        <div class="col-md-4">
                                            <label class="form-label">City</label>
                                            <input type="text" name="city" class="form-control"
                                                value="{{ old('city', $vendor->city) }}" placeholder="Enter city" required>
                                        </div>

                                    </div>

                                    <div class="row g-3 mt-3">

                                        <!-- State -->
                                        <div class="col-md-4">
                                            <label class="form-label">State</label>
                                            <input type="text" name="state" class="form-control"
                                                value="{{ old('state', $vendor->state) }}" placeholder="Enter state"
                                                required>
                                        </div>

                                        <!-- Pincode -->
                                        <div class="col-md-4">
                                            <label class="form-label">Pincode</label>
                                            <input type="number" name="pincode" class="form-control"
                                                value="{{ old('pincode', $vendor->pincode) }}" placeholder="Enter pincode"
                                                required>
                                        </div>

                                        <!-- Rate per KG -->
                                        <div class="col-md-4">
                                            <label class="form-label">Rate Per KG</label>
                                            <input type="number" step="0.01" name="rate_per_kg" class="form-control"
                                                value="{{ old('rate_per_kg', $vendor->rate_per_kg) }}"
                                                placeholder="Enter rate per kg" required>
                                        </div>

                                    </div>

                                    <div class="row g-3 mt-3">

                                        <!-- Minimum KG -->
                                        <div class="col-md-4">
                                            <label class="form-label">Minimum KG</label>
                                            <input type="number" step="0.01" name="minimum_kg" class="form-control"
                                                value="{{ old('minimum_kg', $vendor->minimum_kg) }}"
                                                placeholder="Enter minimum kg" required>
                                        </div>

                                        <!-- Address -->
                                        <div class="col-md-8">
                                            <label class="form-label">Address</label>
                                            <textarea name="address" class="form-control" rows="3" placeholder="Enter address" required>{{ old('address', $vendor->address) }}</textarea>
                                        </div>

                                    </div>
                                </div>
                                <!--end::Body-->

                                <!--begin::Footer-->
                                <div class="card-footer text-end">
                                    <a href="{{ route('vendors.index') }}" class="btn btn-outline-secondary me-2">
                                        <i class="bi bi-arrow-left"></i> Back
                                    </a>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-lg"></i> Update Vendor
                                    </button>
                                </div>
                                <!--end::Footer-->

                            </form>
                            <!--end::Form-->

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->
@endsection
