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
                                    <label class="form-label">Expense Date</label>
                                    <div class="input-group datepicker-group">
                                        <input type="text" name="expense_date"
                                            class="form-control datepicker" placeholder="YYYY-MM-DD"
                                            value="{{ old('expense_date', optional($expense->expense_date)->format('Y-m-d')) }}">
                                        <span class="input-group-text calendar-icon">
                                            <i class="bi bi-calendar"></i>
                                        </span>
                                    </div>
                                </div>

                                {{-- LR No (readonly) --}}
                                <div class="col-md-4">
                                    <label>LR No</label>
                                    <select name="lr_no" class="form-control form-select">
                                        <option value="">-- Select LR No --</option>
                                        @foreach ($airwayNos as $id => $lr_no)
                                            <option value="{{ $id }}"
                                                {{ isset($expense) && $expense->lr_no == $id ? 'selected' : '' }}>
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
                                    <input type="file" name="attachment[]" class="form-control" multiple>
                                    @if ($expense->attachment)
                                        @foreach ($expense->attachment as $file)
                                            <a href="{{ asset('uploads/expenses/' . $file) }}" target="_blank">
                                                {{ $file }}
                                            </a><br>
                                        @endforeach
                                    @endif

                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Expense Type</label>
                                    <div class="border rounded p-2" style="max-height: 180px; overflow-y:auto">

                                        <div class="form-check">
                                            <input type="checkbox" id="selectAllExpense" class="form-check-input">
                                            <label class="form-check-label fw-bold">Select All</label>
                                        </div>
                                        <hr class="my-1">

                                        @php
                                            $expenseTypes = [
                                                'Diesel' => 'Diesel / Fuel',
                                                'Toll' => 'Toll',
                                                'Repairs' => 'Repairs',
                                                'Driver Bata' => 'Driver Bata',
                                                'Loading/Unloading' => 'Loading / Unloading',
                                                'Challan' => 'Challan / Fine',
                                                'Tyre' => 'Tyre / Maintenance',
                                            ];

                                            $selectedExpenses = $expense->expense_type ?? [];
                                        @endphp

                                        @foreach ($expenseTypes as $key => $label)
                                            <div class="form-check">
                                                <input type="checkbox" name="expense_type[]" value="{{ $key }}"
                                                    class="form-check-input expenseCheckbox"
                                                    {{ in_array($key, $selectedExpenses) ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $label }}</label>
                                            </div>
                                        @endforeach

                                    </div>
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
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const selectAll = document.getElementById('selectAllExpense');
        const checkboxes = document.querySelectorAll('.expenseCheckbox');

        selectAll.checked = [...checkboxes].every(cb => cb.checked);

        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = this.checked);
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                selectAll.checked = [...checkboxes].every(c => c.checked);
            });
        });

    });
</script>
