@extends('admin.partials.app')

@section('main-content')

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-success">Booking Entries List</h3>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('booking_entries.create') }}" class="btn btn-success float-sm-end">
                        + Create Booking
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card border-success shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Booking Entries</h5>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>LR No</th>
                                <th>LR Date</th>
                                <th>Source</th>
                                <th>Destination</th>
                                <th>Product</th>
                                <th>Vehicle No</th>
                                <th>Grand Total</th>
                                <th width="150">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $booking->lr_no }}</td>
                                    <td>{{ $booking->lr_date }}</td>
                                    <td>{{ $booking->sourceLedger->party_name ?? '-' }}</td>
                                    <td>{{ $booking->destinationLedger->party_name ?? '-' }}</td>
                                    <td>{{ $booking->product->product_name ?? '-' }}</td>
                                    <td>{{ $booking->vehicle_no }}</td>
                                    <td>{{ number_format($booking->grand_total, 2) }}</td>
                                    <td>
                                        <a href="{{ route('booking_entries.edit', $booking->id) }}"
                                           class="btn btn-sm btn-primary">Edit</a>

                                        <form action="{{ route('booking_entries.destroy', $booking->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">
                                        No booking entries found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $bookings->links() }}
                </div>
            </div>

        </div>
    </div>
</main>

@endsection
