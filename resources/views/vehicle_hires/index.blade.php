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
                                <th>Hire Date</th>
                                <th>Vendor / Owner</th>
                                <th>Vehicle No</th>
                                <th>Driver Details</th>
                                <th>Route</th>
                                <th>LR / Manifest</th>
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
                                <td>{{ $hire->hire_date }}</td>
                                <td>{{ $hire->vendor_name }}</td>
                                <td>{{ $hire->vehicle_no }}</td>
                                <td>{{ $hire->driver_details }}</td>
                                <td>{{ $hire->route_from }} → {{ $hire->route_to }}</td>
                                <td>{{ $hire->lr_manifest_no }}</td>
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
                                <td colspan="12" class="text-center">No Vehicle Hire Records Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection