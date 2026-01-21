@extends('admin.partials.app')
@section('main-content')
<main class="app-main">

    <div class="app-content-header">
        <div class="container-fluid">
            <h3>All Hire Register</h3>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <div class="card card-primary card-outline">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title">Vehicle Hire Register</h3>
                    <a href="{{ route('vehicle_hires.create') }}" class="btn btn-primary btn-sm">
                        Add Vehicle Hire
                    </a>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Hire Register ID</th>
                                <th>Hire Date</th>
                                <th>Vendor Details</th>
                                <th>Vehicle Details</th>
                                <th>Driver Details</th>
                                <th>Route</th>
                                <!-- <th>LR / Manifest</th> -->
                                <th>Hire Rate</th>
                                <th>Advance Paid</th>
                                <th>Balance</th>
                                <th>Payment Status</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($vehicleHires as $key => $hire)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><strong>{{ $hire->hire_register_id }}</strong></td>
                                <td>{{ $hire->hire_date }}</td>
                                <td>
                                    <a href="javascript:void(0)" class="vendor-detail" data-id="{{ $hire->vendor_id }}">
                                        {{ $hire->vendor ? $hire->vendor->vendor_name : '' }}
                                    </a>
                                </td>

                                <td>
                                    <a href="javascript:void(0)" class="vehicle-detail" data-id="{{ $hire->vehicle_id }}">
                                        {{ $hire->vehicle ? $hire->vehicle->vehicle_number : '' }}
                                    </a>
                                </td>

                                <td>
                                    <a href="javascript:void(0)" class="driver-detail" data-id="{{ $hire->driver_id }}">
                                        {{ $hire->driver ? $hire->driver->name : '' }}
                                    </a>
                                </td>


                                <td>{{ $hire->route_from }} → {{ $hire->route_to }}</td>
                                <!-- <td>{{ $hire->lr_manifest_no }}</td> -->
                                <td>{{ number_format($hire->hire_rate, 2) }}</td>
                                <td>{{ number_format($hire->advance_paid, 2) }}</td>
                                <td>{{ number_format($hire->balance_payable, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ 
                                $hire->payment_status == 'Paid' ? 'success' : 
                                ($hire->payment_status == 'Partial' ? 'warning' : 'danger') 
                            }}">
                                        {{ $hire->payment_status }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('vehicle_hires.edit', $hire->id) }}"
                                        class="btn btn-sm btn-success">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('vehicle_hires.destroy', $hire->id) }}"
                                        method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="13" class="text-center">No Vehicle Hire Records Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Details Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalBody">
        Loading...
      </div>
    </div>
  </div>
</div>

</main>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    // Vendor details
    $('.vendor-detail').click(function() {
        let id = $(this).data('id');
        $.get('/vendor/' + id, function(data) {
            $('#modalTitle').text('Vendor Details');
            let html = `
                <p><strong>Name:</strong> ${data.vendor_name}</p>
                <p><strong>Contact:</strong> ${data.contact}</p>
                <p><strong>Address:</strong> ${data.address}, ${data.city}, ${data.state} - ${data.pincode}</p>
                <p><strong>Rate per kg:</strong> ${data.rate_per_kg}</p>
            `;
            $('#modalBody').html(html);
            $('#detailsModal').modal('show');
        });
    });

    // Vehicle details
    $('.vehicle-detail').click(function() {
        let id = $(this).data('id');
        $.get('/vehicle/' + id, function(data) {
            $('#modalTitle').text('Vehicle Details');
            let html = `
                <p><strong>Vehicle Number:</strong> ${data.vehicle_number}</p>
                <p><strong>Model:</strong> ${data.vehicle_model}</p>
                <p><strong>Capacity:</strong> ${data.vehicle_capacity}</p>
                <p><strong>PUC Date:</strong> ${data.vehicle_puc_date}</p>
                <p><strong>Insurance Expiry:</strong> ${data.vehicle_insurance_renew_date}</p>
            `;
            $('#modalBody').html(html);
            $('#detailsModal').modal('show');
        });
    });

    // Driver details
    $('.driver-detail').click(function() {
        let id = $(this).data('id');
        $.get('/driver/' + id, function(data) {
            $('#modalTitle').text('Driver Details');
            let html = `
                <p><strong>Name:</strong> ${data.name}</p>
                <p><strong>Mobile:</strong> ${data.mobile}</p>
                <p><strong>License:</strong> ${data.licence_no} (Exp: ${data.licence_exp})</p>
                <p><strong>Address:</strong> ${data.address}, ${data.city}, ${data.state} - ${data.pincode}</p>
            `;
            $('#modalBody').html(html);
            $('#detailsModal').modal('show');
        });
    });

});
</script>


@endsection