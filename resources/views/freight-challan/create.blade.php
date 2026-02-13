@extends('admin.partials.app')

@section('main-content')
    <style>
        .form-control:focus {
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            outline: 0;
            box-shadow: var(--bs-box-shadow-inset), 0 0 0 0.25rem rgb(242 243 244 / 25%);
        }
    </style>

    <main class="app-main">

        <!-- HEADER -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0 text-success">Create Freight Challan</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('freight-challan.index') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active text-success">
                                Create Freight Challan
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow border-4 border-dark">

                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center flex-wrap">
                        <h5 class="mb-0">
                            <i class="bi bi-truck me-2"></i> Freight Challan Details
                        </h5>

                        <div class="d-flex gap-2 ms-auto flex-wrap">
                            <a href="{{ route('freight-challan.create') }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus-circle"></i> New
                            </a>

                            <a href="{{ route('freight-challan.index') }}" class="btn btn-sm btn-info text-white">
                                <i class="bi bi-eye"></i> Show
                            </a>

                            <button type="button" class="btn btn-sm btn-success">
                                <i class="bi bi-printer"></i> Print
                            </button>
                        </div>
                    </div>

                    <form action="{{ route('freight-challan.store') }}" method="POST">
                        @csrf

                        <div class="card-body">

                            {{-- ================= BASIC DETAILS ================= --}}
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-success">
                                    <strong><i class="bi bi-card-text me-2"></i>Basic Details</strong>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Challan No"></i>
                                                Challan No
                                            </label>
                                            <input type="text" name="challan_no" value="{{ old('challan_no') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Challan Date"></i> Challan
                                                Date</label>
                                            <div class="input-group datepicker-group">
                                                <input type="text" name="challan_date" value="{{ old('challan_date') }}"
                                                    class="form-control datepicker" placeholder="YYYY-MM-DD">
                                                <span class="input-group-text calendar-icon" style="cursor:pointer;">
                                                    <i class="bi bi-calendar"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Select Broker"></i> Select Broker</label>
                                            <select name="broker_id" class="form-select">
                                                <option value="">Select Broker</option>
                                                @foreach ($brokers as $b)
                                                    <option value="{{ $b->id }}">
                                                        {{ $b->broker_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Select Driver"></i> Select Driver</label>
                                            <select name="driver_id" class="form-select">
                                                <option value="">Select Driver</option>
                                                @foreach ($drivers as $d)
                                                    <option value="{{ $d->id }}">
                                                        {{ $d->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Licence No"></i> Licence
                                                No</label>
                                            <input type="text" name="licence_no" value="{{ old('licence_no') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Vehicle No"></i> Vehicle
                                                No</label>
                                            <input type="text" name="vehicle_no" value="{{ old('vehicle_no') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Vehicle Type"></i> Vehicle
                                                Type</label>
                                            <input type="text" name="vehicle_type" value="{{ old('vehicle_type') }}"
                                                class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>


                            {{-- ================= LR & WEIGHT DETAILS ================= --}}
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-primary">
                                    <strong><i class="bi bi-receipt me-2"></i>LR & Weight Details</strong>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter LR No"></i> LR
                                                No</label>
                                            <input type="text" name="lr_no" value="{{ old('lr_no') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Actual Wt"></i>
                                                Actual Wt</label>
                                            <input type="number" step="0.01" name="actual_wt"
                                                value="{{ old('actual_wt') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Charged Wt"></i>
                                                Charged Wt</label>
                                            <input type="number" step="0.01" name="charged_wt"
                                                value="{{ old('charged_wt') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Freight Rate"></i>
                                                Freight Rate</label>
                                            <input type="number" step="0.01" name="freight_rate"
                                                value="{{ old('freight_rate') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Rate Type"></i> Rate
                                                Type</label>
                                            <select name="rate_type" class="form-select">
                                                <option value="">--Select--</option>
                                                <option value="ActualWt">ActualWt</option>
                                                <option value="ChargeWt">ChargeWt</option>
                                                <option value="Fixed">Fixed</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Challan Amt"></i> Total
                                                Challan Amt</label>
                                            <input type="number" step="0.01" name="total_challan_amt"
                                                value="{{ old('total_challan_amt') }}" class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- ================= EXPENSE DETAILS ================= --}}
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-warning">
                                    <strong><i class="bi bi-cash-coin me-2"></i>Expense Details</strong>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Loading"></i>
                                                Loading</label>
                                            <input type="number" step="0.01" name="loading"
                                                value="{{ old('loading') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Unloading (ULD Amt)"></i>
                                                Unloading (ULD Amt)</label>
                                            <input type="number" step="0.01" name="uld_amt"
                                                value="{{ old('uld_amt') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Detention"></i>
                                                Detention</label>
                                            <input type="number" step="0.01" name="detention"
                                                value="{{ old('detention') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Border Exp"></i>
                                                Border Exp</label>
                                            <input type="number" step="0.01" name="border_exp"
                                                value="{{ old('border_exp') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Others"></i>
                                                Others</label>
                                            <input type="number" step="0.01" name="others"
                                                value="{{ old('others') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Deduction Amt"></i>
                                                Deduction Amt</label>
                                            <input type="number" step="0.01" name="deduction_amt"
                                                value="{{ old('deduction_amt') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Detention Place"></i>
                                                Detention Place</label>
                                            <input type="text" name="detent_place" value="{{ old('detent_place') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Payable At"></i>
                                                Payable At</label>
                                            <input type="text" name="payable_at" value="{{ old('payable_at') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Load Remarks"></i> Load
                                                Remarks</label>
                                            <input type="text" name="load_remarks" value="{{ old('load_remarks') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Other Remarks"></i> Other
                                                Remarks</label>
                                            <input type="text" name="other_remarks"
                                                value="{{ old('other_remarks') }}" class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>


                            {{-- ================= ADVANCE DETAILS ================= --}}
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-info">
                                    <strong><i class="bi bi-wallet2 me-2"></i>Advance Details</strong>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Party Name"></i> Party
                                                Name</label>
                                            <input type="text" name="party_name" value="{{ old('party_name') }}"
                                                class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Select Ledger" title="Select Ledger"></i> Select Ledger</label>
                                            <select name="ledger_id" class="form-select">
                                                <option value="">Select Ledger</option>
                                                @foreach ($ledgers as $l)
                                                    <option value="{{ $l->id }}">
                                                        {{ $l->party_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Supplier Name"></i>
                                                Supplier Name</label>
                                            <input type="text" name="supplier_name"
                                                value="{{ old('supplier_name') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Advance Type"></i>
                                                Advance Type</label>
                                            <input type="text" name="advance_type" value="{{ old('advance_type') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Bank Name"></i> Bank
                                                Name</label>
                                            <input type="text" name="bank_name" value="{{ old('bank_name') }}"
                                                class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Diesel Qty"></i>
                                                Diesel Qty</label>
                                            <input type="number" step="0.01" name="diesel_qty"
                                                value="{{ old('diesel_qty') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Diesel Rate"></i>
                                                Diesel Rate</label>
                                            <input type="number" step="0.01" name="diesel_rate"
                                                value="{{ old('diesel_rate') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Advance Amount"></i>
                                                Advance Amount</label>
                                            <input type="number" step="0.01" name="advance_amount"
                                                value="{{ old('advance_amount') }}" class="form-control">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Remarks"></i>
                                                Remarks</label>
                                            <input type="text" name="remarks" value="{{ old('remarks') }}"
                                                class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>


                            {{-- ================= ADD PAY DETAILS ================= --}}
                            <div class="card mb-3 shadow-sm">
                                <div class="card-header bg-light border-start border-4 border-danger">
                                    <strong><i class="bi bi-calculator me-2"></i>Add Pay Details</strong>
                                </div>

                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary"
                                                    title="Enter Total Freight"></i> Total Freight</label>
                                            <input type="number" step="0.01" name="total_freight"
                                                value="{{ old('total_freight') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary"
                                                    title="Enter Total Packing"></i> Total Packing</label>
                                            <input type="number" step="0.01" name="total_packing"
                                                value="{{ old('total_packing') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary" title="Enter Total Qty"></i>
                                                Total Qty</label>
                                            <input type="number" step="0.01" name="total_qty"
                                                value="{{ old('total_qty') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary"
                                                    title="Enter Total ActualWt"></i> Total ActualWt</label>
                                            <input type="number" step="0.01" name="total_actual_wt"
                                                value="{{ old('total_actual_wt') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary"
                                                    title="Enter Total ChargeWt"></i> Total ChargeWt</label>
                                            <input type="number" step="0.01" name="total_charge_wt"
                                                value="{{ old('total_charge_wt') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary" title="Enter BorderExp"></i>
                                                BorderExp</label>
                                            <input type="number" step="0.01" name="borderexp"
                                                value="{{ old('borderexp') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary" title="Enter OthersAmt"></i>
                                                OthersAmt</label>
                                            <input type="number" step="0.01" name="others_amt"
                                                value="{{ old('others_amt') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary"
                                                    title="Enter Advance Amt"></i> Advance Amt</label>
                                            <input type="number" step="0.01" name="advance_amt"
                                                value="{{ old('advance_amt') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary" title="Enter TDS %"></i> TDS
                                                %</label>
                                            <input type="number" step="0.01" name="tds_percent"
                                                value="{{ old('tds_percent') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary" title="Enter TDS Amt"></i>
                                                TDS Amt</label>
                                            <input type="number" step="0.01" name="tds_amt"
                                                value="{{ old('tds_amt') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary" title="Enter Manual Amt"></i>
                                                Manual Amt</label>
                                            <input type="number" step="0.01" name="manual_amt"
                                                value="{{ old('manual_amt') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary"
                                                    title="Enter Advance Amt"></i> Net Advance Amt</label>
                                            <input type="number" step="0.01" name="net_advance_amt"
                                                value="{{ old('net_advance_amt') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary"
                                                    title="Enter Balance Amt"></i> Balance Amt</label>
                                            <input type="number" step="0.01" name="balance_amt"
                                                value="{{ old('balance_amt') }}" class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><i class="bi bi-info-circle text-primary"
                                                    title="Enter Grand Total"></i> Grand Total</label>
                                            <input type="number" step="0.01" name="grand_total"
                                                value="{{ old('grand_total') }}" class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- FOOTER --}}
                        <div class="card-footer bg-light text-end">
                            <a href="{{ route('freight-challan.index') }}" class="btn btn-outline-secondary me-2">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-dark">
                                Save Freight Challan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </main>
@endsection
