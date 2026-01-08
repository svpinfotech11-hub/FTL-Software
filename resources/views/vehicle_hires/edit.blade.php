@extends('admin.partials.app')
@section('main-content')
<main class="app-main">

    <div class="app-content-header">
        <div class="container-fluid">
            <h3>Edit Driver</h3>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="card-title">Update Driver</div>
                </div>

                <form method="POST"
                    action="{{ route('vehicle_hires.update', $vehicleHire->id) }}"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row g-3">

                            <div class="col-md-4">
                                <label class="form-label">Hire Date</label>
                                <input type="date" name="hire_date"
                                    class="form-control"
                                    value="{{ old('hire_date', $vehicleHire->hire_date) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Vendor / Truck Owner Name</label>
                                <input type="text" name="vendor_name"
                                    class="form-control"
                                    value="{{ old('vendor_name', $vehicleHire->vendor_name) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Vehicle No</label>
                                <input type="text" name="vehicle_no"
                                    class="form-control"
                                    value="{{ old('vehicle_no', $vehicleHire->vehicle_no) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Driver Details</label>
                                <input type="text" name="driver_details"
                                    class="form-control"
                                    value="{{ old('driver_details', $vehicleHire->driver_details) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Route From</label>
                                <input type="text" name="route_from"
                                    class="form-control"
                                    value="{{ old('route_from', $vehicleHire->route_from) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Route To</label>
                                <input type="text" name="route_to"
                                    class="form-control"
                                    value="{{ old('route_to', $vehicleHire->route_to) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">LR / Manifest No</label>
                                <input type="text" name="lr_manifest_no"
                                    class="form-control"
                                    value="{{ old('lr_manifest_no', $vehicleHire->lr_manifest_no) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Hire Rate</label>
                                <input type="number" step="0.01"
                                    name="hire_rate"
                                    class="form-control"
                                    value="{{ old('hire_rate', $vehicleHire->hire_rate) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Advance Paid</label>
                                <input type="number" step="0.01"
                                    name="advance_paid"
                                    class="form-control"
                                    value="{{ old('advance_paid', $vehicleHire->advance_paid) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Balance Payable</label>
                                <input type="number" step="0.01"
                                    name="balance_payable"
                                    class="form-control"
                                    value="{{ old('balance_payable', $vehicleHire->balance_payable) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Payment Status</label>
                                <select name="payment_status" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Pending" {{ $vehicleHire->payment_status=='Pending'?'selected':'' }}>Pending</option>
                                    <option value="Partial" {{ $vehicleHire->payment_status=='Partial'?'selected':'' }}>Partial</option>
                                    <option value="Paid" {{ $vehicleHire->payment_status=='Paid'?'selected':'' }}>Paid</option>
                                </select>
                            </div>

                        </div>

                        {{-- Attachments --}}
                        <hr class="my-3">
                        <div class="row g-3">

                            <div class="col-md-4">
                                <label class="form-label">RC Document</label>
                                <input type="file" name="rc_document" class="form-control">
                                @if($vehicleHire->rc_document)
                                <small class="text-muted">
                                    Existing: <a href="{{ asset('storage/'.$vehicleHire->rc_document) }}" target="_blank">View</a>
                                </small>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Insurance Document</label>
                                <input type="file" name="insurance_document" class="form-control">
                                @if($vehicleHire->insurance_document)
                                <small class="text-muted">
                                    Existing: <a href="{{ asset('storage/'.$vehicleHire->insurance_document) }}" target="_blank">View</a>
                                </small>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">PAN Document</label>
                                <input type="file" name="pan_document" class="form-control">
                                @if($vehicleHire->pan_document)
                                <small class="text-muted">
                                    Existing: <a href="{{ asset('storage/'.$vehicleHire->pan_document) }}" target="_blank">View</a>
                                </small>
                                @endif
                            </div>

                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ route('vehicle_hires.index') }}"
                            class="btn btn-outline-secondary me-2">
                            Back
                        </a>
                        <button class="btn btn-primary">Update Vehicle Hire</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>
@endsection