@extends('admin.partials.app')
@section('main-content')
    <main class="app-main">

        <div class="app-content-header">
            <div class="container-fluid">
                <h3>Add Driver Expense</h3>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Add Expense</h3>
                    </div>

                    <form action="{{ route('add-expenses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Expense Date</label>
                                    <input type="date" name="expense_date" class="form-control datepicker"
                                        placeholder="YYYY-MM-DD" value="{{ old('expense_date') }}" required>
                                </div>


                                <div class="col-md-4">
                                    <label>Driver Name</label>
                                    <select name="driver_id" class="form-control form-select" required>
                                        <option value="">-- Select Driver --</option>
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Expense Type</label>
                                    <select name="expense_type" class="form-control form-select" required>
                                        <option value="">-- Select Expense --</option>
                                        <option>Diesel / Fuel</option>
                                        <option>Toll</option>
                                        <option>Repairs</option>
                                        <option>Driver Bata</option>
                                        <option>Loading/Unloading charges</option>
                                        <option>Challan/Fine</option>
                                        <option>Tyre / Maintenance</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Vehicle Number</label>
                                    <select name="vehicle_no" class="form-control form-select" required>
                                        <option value="">-- Select Vehicle --</option>
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->vehicle_number }}">
                                                {{ $vehicle->vehicle_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>LR No</label>
                                    <input type="text" name="lr_no" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label>Amount</label>
                                    <input type="number" step="0.01" name="amount" class="form-control" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Attachment</label>
                                    <input type="file" name="attachment" class="form-control">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>

                        </div>

                        <div class="card-footer text-end">
                            <a href="{{ route('add-expenses.index') }}" class="btn btn-secondary">Back</a>
                            <button class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </main>
@endsection
