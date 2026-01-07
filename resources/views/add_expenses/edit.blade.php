@extends('admin.partials.app')
@section('main-content')
    <main class="app-main">

        <div class="app-content-header">
            <div class="container-fluid">
                <h3>Edit Expense</h3>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Edit Expense</h3>
                    </div>

                    <form action="{{ route('add-expenses.update', $expense->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Expense Date</label>
                                    <input type="date" name="expense_date" class="form-control"
                                        value="{{ $expense->expense_date }}" required>
                                </div>

                                <div class="col-md-4">
                                    <label>Driver Name</label>
                                    <select name="driver_id" class="form-control" required>
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}"
                                                {{ $expense->driver_id == $driver->id ? 'selected' : '' }}>
                                                {{ $driver->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-md-4">
                                    <label>Expense Type</label>
                                    <select name="expense_type" class="form-control form-select" required>
                                        @php
                                            $types = [
                                                'Diesel / Fuel',
                                                'Toll',
                                                'Repairs',
                                                'Driver Bata',
                                                'Loading/Unloading charges',
                                                'Challan/Fine',
                                                'Tyre / Maintenance',
                                            ];
                                        @endphp
                                        @foreach ($types as $type)
                                            <option value="{{ $type }}"
                                                {{ $expense->expense_type == $type ? 'selected' : '' }}>
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Vehicle Number</label>
                                    <select name="vehicle_no" class="form-control form-select" required>
                                        <option value="">-- Select Vehicle --</option>
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->vehicle_number }}"
                                                {{ $expense->vehicle_no == $vehicle->vehicle_number ? 'selected' : '' }}>
                                                {{ $vehicle->vehicle_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label>LR No</label>
                                    <input type="text" name="lr_no" class="form-control"
                                        value="{{ $expense->lr_no }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label>Amount</label>
                                    <input type="number" step="0.01" name="amount" class="form-control"
                                        value="{{ $expense->amount }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Attachment</label>
                                    <input type="file" name="attachment" class="form-control">
                                    @if ($expense->attachment)
                                        <small>
                                            <a href="{{ asset('storage/' . $expense->attachment) }}" target="_blank">
                                                View File
                                            </a>
                                        </small>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ $expense->description }}</textarea>
                            </div>

                        </div>

                        <div class="card-footer text-end">
                            <a href="{{ route('add-expenses.index') }}" class="btn btn-secondary">Back</a>
                            <button class="btn btn-primary">Update</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </main>
@endsection
