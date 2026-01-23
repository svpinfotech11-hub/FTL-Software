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
                            {{-- Expense Date --}}
                            <div class="col-md-4">
                                <label>Expense Date</label>
                                <input type="date" name="expense_date" class="form-control"
                                    value="{{ $expense->expense_date }}" required>
                            </div>

                            {{-- Expense Type --}}
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

                            {{-- LR No (readonly) --}}
                            <div class="col-md-4">
                                <label>LR No</label>
                                <select name="lr_no" class="form-control form-select">
                                    <option value="">-- Select LR No --</option>
                                    @foreach ($airwayNos as $id => $lr_no)
                                    <option value="{{ $id }}"
                                        {{ (isset($expense) && $expense->lr_no == $id) ? 'selected' : '' }}>
                                        {{ $lr_no }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>


                            {{-- Amount --}}
                            <div class="col-md-4">
                                <label>Amount</label>
                                <input type="number" step="0.01" name="amount" class="form-control"
                                    value="{{ $expense->amount }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            {{-- Paid By --}}
                            <div class="col-md-4">
                                <label>Paid By</label>
                                <select name="paid_by" class="form-control form-select">
                                    @php
                                    $paidOptions = ['Company', 'Driver', 'Vendor'];
                                    @endphp
                                    @foreach ($paidOptions as $option)
                                    <option value="{{ $option }}"
                                        {{ $expense->paid_by == $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Attachment --}}
                            <div class="col-md-4">
                                <label>Attachment</label>
                                <input type="file" name="attachment" class="form-control">
                                @if ($expense->attachment)
                                <small>
                                    <a href="{{ asset('uploads/expenses/' .$expense->attachment) }}" target="_blank">
                                        View File
                                    </a>
                                </small>
                                @endif
                            </div>
                        </div>

                        {{-- Description --}}
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