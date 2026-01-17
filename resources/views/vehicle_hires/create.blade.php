@extends('admin.partials.app')
@section('main-content')
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Create Hire Register</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Create Hire Register</li>
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
                    <div class="card-title">Hire Register</div>
                </div>

                <form method="POST" action="{{ route('vehicle_hires.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <div class="row g-3">

                            <div class="col-md-4">
                                <label class="form-label">Hire Date</label>
                                <input type="date" name="hire_date" value="{{ old('hire_date') }}" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Vendor Details</label>
                                <select name="vendor_id" class="form-control">
                                    <option value="">Select Vendor</option>
                                    @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->id }}"
                                        {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>
                                        {{ $vendor->vendor_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Vehicle Details</label>
                                <select name="vehicle_id" class="form-control">
                                    <option value="">Select Vehicle</option>
                                    @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}"
                                        {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->vehicle_number }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label class="form-label">Driver Details</label>
                                <select name="driver_id" class="form-control">
                                    <option value="">Select Driver</option>
                                    @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}"
                                        {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                        {{ $driver->name }}
                                    </option>
                                    @endforeach
                                </select>

                            </div>


                            <div class="col-md-4">
                                <label class="form-label">Route From</label>
                                <input type="text" name="route_from" class="form-control" value="{{ old('route_from') }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Route To</label>
                                <input type="text" name="route_to" class="form-control" value="{{ old('route_to') }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">LR / Manifest No</label>
                                <input type="text" name="lr_manifest_no" class="form-control" value="{{ old('lr_manifest_no') }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Hire Rate</label>
                                <input type="number" step="0.01" name="hire_rate" id="hire_rate" class="form-control" value="{{ old('hire_rate') }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Advance Paid</label>
                                <input type="number" step="0.01" name="advance_paid" id="advance_paid" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Balance Payable</label>
                                <input type="number" step="0.01" name="balance_payable" id="balance_payable" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Payment Status</label>
                                <select name="payment_status" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Partial">Partial</option>
                                    <option value="Paid">Paid</option>
                                </select>
                            </div>

                        </div>

                        {{-- Attachments --}}
                        <hr class="my-3">
                        <div class="row g-3">

                            <div class="col-md-4">
                                <label class="form-label">RC Document</label>
                                <input type="file" name="rc_document" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Insurance Document</label>
                                <input type="file" name="insurance_document" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">PAN Document</label>
                                <input type="file" name="pan_document" class="form-control">
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ route('vehicle_hires.index') }}" class="btn btn-outline-secondary me-2">
                            Back
                        </a>
                        <button class="btn btn-primary">Save Vehicle Hire</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>


<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        let hireRate = parseFloat(document.querySelector('[name="hire_rate"]').value || 0);
        let advance = parseFloat(document.querySelector('[name="advance_paid"]').value || 0);

        if (advance > hireRate) {
            alert('Advance Paid cannot be greater than Hire Rate');
            e.preventDefault();
        }
    });
</script>

@endsection