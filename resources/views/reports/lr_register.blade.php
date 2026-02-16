@extends('admin.partials.app')

@section('main-content')

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Filter LR Bookinng</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item active">Filter LR Bookinng</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-md-12">

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">LR Register List</div>
                        </div>

                        <!-- Filter Form -->
                        <div class="card-body">
                            <form action="{{ route('reports.lr_register') }}" method="GET" class="row g-3">
                                @csrf
                                <div class="col-md-2">
                                    <label>From Date</label>
                                    <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                                </div>
                                <div class="col-md-2">
                                    <label>To Date</label>
                                    <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                                </div>
                                <div class="col-md-2">
                                    <label>Source Address</label>
                                    <select name="source_address" class="form-select">
                                        <option value="">All</option>
                                        @foreach($addresses as $address)
                                        <option value="{{ $address }}" {{ request('source_address') == $address ? 'selected' : '' }}>{{ $address }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Destination Address</label>
                                    <select name="destination_address" class="form-select">
                                        <option value="">All</option>
                                        @foreach($addresses as $address)
                                        <option value="{{ $address }}" {{ request('destination_address') == $address ? 'selected' : '' }}>{{ $address }}</option>
                                        @endforeachpw
                                    </select>
                                </div>
                                <div class="col-md-2">
    <label>LR Type</label>
    <select name="lr_type" class="form-select">
        <option value="">All</option>
        @foreach($lrTypes as $type)
            <option value="{{ $type }}" {{ request('lr_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
        @endforeach
    </select>
</div>

                                <div class="col-md-2">
                                    <label>Vehicle No</label>
                                    <input type="text" name="vehicle_no" class="form-control" value="{{ request('vehicle_no') }}">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="" class="btn btn-secondary">Reset</a>
                                </div>
                            </form>
                        </div>

                        <!-- Table Body -->
                        <div class="card-body table-responsive mt-3">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Source</th>
                                        <th>Destination</th>
                                        <th>LR Type</th>
                                        <th>Vehicle No</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($bookingEntry as $entry)
                                    <tr>
                                        <td>{{ $entry->id }}</td>
                                        <td>{{ $entry->booking_date }}</td>
                                        <td>{{ $entry->source_address }}</td>
                                        <td>{{ $entry->destination_address }}</td>
                                        <td>{{ $entry->lr_type }}</td>
                                        <td>{{ $entry->vehicle_no }}</td>
                                        <td>
                                            <!-- Actions like view/edit -->
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No records found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</main>

@endsection