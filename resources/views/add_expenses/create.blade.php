@extends('admin.partials.app')
@section('main-content')
<main class="app-main">

    <div class="app-content-header">
        <div class="container-fluid">
            <h3>Add Expense</h3>
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

                        {{-- Expense Date --}}
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>Expense Date</label>
                                <input type="date" name="expense_date" id="from_date" placeholder="YYYY-MM-DD" class="form-control"
                                    value="{{ old('expense_date') }}">
                            </div>

                            {{-- Expense Type --}}
                            <div class="col-md-4">
                                <label>Expense Type</label>
                                <select name="expense_type" class="form-control form-select">
                                    <option value="">-- Select Expense --</option>
                                    <option value="Diesel">Diesel / Fuel</option>
                                    <option value="Toll">Toll</option>
                                    <option value="Repairs">Repairs</option>
                                    <option value="Driver Bata">Driver Bata</option>
                                    <option value="Loading/Unloading">Loading / Unloading</option>
                                    <option value="Challan">Challan / Fine</option>
                                    <option value="Tyre">Tyre / Maintenance</option>
                                </select>
                            </div>
                       

                           
                            <div class="col-md-4">
                                <label>LR No</label>
                                <select name="lr_no" class="form-control form-select">
                                    <option value="">-- Select LR No --</option>
                                    @foreach ($airwayNos as $airway_no)
                                    <option value="{{ $airway_no }}">{{ $airway_no }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Amount</label>
                                <input type="number" step="0.01" name="amount"
                                    class="form-control">
                            </div>
                        

                     
                            <div class="col-md-4">
                                <label>Paid By</label>
                                <select name="paid_by" class="form-control form-select">
                                    <option value="Company">Company</option>
                                    <option value="Driver">Driver</option>
                                    <option value="Vendor">Vendor</option>
                                </select>
                            </div>

                            {{-- Attachment --}}
                            <div class="col-md-4">
                                <label>Attachment</label>
                                <input type="file" name="attachment" class="form-control">
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        </div>

                        {{-- Hidden Fields --}}
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

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
