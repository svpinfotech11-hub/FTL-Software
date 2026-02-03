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
                                    <label class="form-label">Expense Date</label>
                                    <div class="input-group datepicker-group">
                                        <input type="text" name="expense_date"
                                            value="{{ old('expense_date') }}"
                                            class="form-control datepicker" placeholder="YYYY-MM-DD">
                                        <span class="input-group-text calendar-icon">
                                            <i class="bi bi-calendar"></i>
                                        </span>
                                    </div>
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
                                    <input type="number" step="0.01" name="amount" class="form-control">
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
                                    <input type="file" name="attachment[]" class="form-control" multiple>
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
                                        @endphp

                                        @foreach ($expenseTypes as $key => $label)
                                            <div class="form-check">
                                                <input type="checkbox" name="expense_type[]" value="{{ $key }}"
                                                    class="form-check-input expenseCheckbox">
                                                <label class="form-check-label">{{ $label }}</label>
                                            </div>
                                        @endforeach

                                    </div>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const selectAll = document.getElementById('selectAllExpense');
        const checkboxes = document.querySelectorAll('.expenseCheckbox');

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
