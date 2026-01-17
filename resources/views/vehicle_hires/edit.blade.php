@extends('admin.partials.app')
@section('main-content')
<main class="app-main">

    <div class="app-content-header">
        <div class="container-fluid">
            <h3>Edit Vehicle Hire</h3>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="card-title">Update Vehicle Hire</div>
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

                            {{-- Vendor Dropdown --}}
                            <div class="col-md-4">
                                <label class="form-label">Vendor / Truck Owner</label>
                                <select name="vendor_id" id="vendor_id" class="form-control">
                                    <option value="">Select Vendor</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{ $vendor->id }}"
                                            {{ $vehicleHire->vendor_id == $vendor->id ? 'selected' : '' }}>
                                            {{ $vendor->vendor_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Vehicle Dropdown --}}
                            <div class="col-md-4">
                                <label class="form-label">Vehicle</label>
                                <select name="vehicle_id" id="vehicle_id" class="form-control">
                                    <option value="">Select Vehicle</option>
                                    @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}"
                                            {{ $vehicleHire->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                            {{ $vehicle->vehicle_number }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Driver Dropdown --}}
                            <div class="col-md-4">
                                <label class="form-label">Driver</label>
                                <select name="driver_id" id="driver_id" class="form-control">
                                    <option value="">Select Driver</option>
                                    @foreach($drivers as $driver)
                                        <option value="{{ $driver->id }}"
                                            {{ $vehicleHire->driver_id == $driver->id ? 'selected' : '' }}>
                                            {{ $driver->name }}
                                        </option>
                                    @endforeach
                                </select>
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
                                <input type="number" step="0.01" name="hire_rate"
                                    class="form-control"
                                    value="{{ old('hire_rate', $vehicleHire->hire_rate) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Advance Paid</label>
                                <input type="number" step="0.01" name="advance_paid"
                                    class="form-control"
                                    value="{{ old('advance_paid', $vehicleHire->advance_paid) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Balance Payable</label>
                                <input type="number" step="0.01" name="balance_payable"
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
                        <a href="{{ route('vehicle_hires.index') }}" class="btn btn-outline-secondary me-2">
                            Back
                        </a>
                        <button class="btn btn-primary">Update Vehicle Hire</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</main>

{{-- JS for dynamic fetch on dropdown change --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    // Vendor details on change
    $('#vendor_id').change(function(){
        let id = $(this).val();
        if(id){
            $.get('/vendor/' + id, function(data){
                console.log(data); // You can populate fields if needed
            });
        }
    });

    // Vehicle details on change
    $('#vehicle_id').change(function(){
        let id = $(this).val();
        if(id){
            $.get('/vehicle/' + id, function(data){
                console.log(data); // You can populate fields if needed
            });
        }
    });

    // Driver details on change
    $('#driver_id').change(function(){
        let id = $(this).val();
        if(id){
            $.get('/driver/' + id, function(data){
                console.log(data); // You can populate fields if needed
            });
        }
    });

});
</script>

@endsection
