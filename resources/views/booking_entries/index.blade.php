@extends('admin.partials.app')

@section('main-content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0 text-secondary" style="font-weight: bold;">Booking Entries</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('booking_entries.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Create Booking Entries</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">Booking Entries List</div>
                        <a href="{{ route('booking_entries.create') }}" class="btn btn-primary btn-sm"><i
                                class="bi bi-plus-lg"></i> Add Booking Entries
                        </a>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table align-middle table-hover datatable">
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
                                @foreach ($bookings as $booking)
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
                                                method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
