@extends('admin.partials.app')

@section('main-content')
<main class="app-main">
  <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">All Domestic Shipment</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Domestic Shipment</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Domestic Shipment</h4>
            <div>
                <a href="{{ route('domestic.shipment.create') }}" class="btn btn-primary btn-sm">
                    Add Domestic Shipment
                </a>
                <button class="btn btn-dark btn-sm">Print Selected Shipment</button>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body row g-2">

                <div class="col-md-2">
                    <label>Courier</label>
                    <select class="form-control">
                        <option>ALL</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Mode</label>
                    <select class="form-control">
                        <option>ALL</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Filter</label>
                    <select class="form-control">
                        <option>Select Filter</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Filter Value</label>
                    <input type="text" class="form-control">
                </div>

                <div class="col-md-2">
                    <label>Customer</label>
                    <select class="form-control">
                        <option>Select Customer</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>From Date</label>
                    <input type="date" class="form-control">
                </div>

                <div class="col-md-2">
                    <label>To Date</label>
                    <input type="date" class="form-control">
                </div>

                <div class="col-md-4 d-flex align-items-end gap-2">
                    <button class="btn btn-primary">Submit</button>
                    <button class="btn btn-info text-white">Reset</button>
                    <button class="btn btn-dark">Download Report</button>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
    <thead class="table-light">
        <tr>
            <th><input type="checkbox" id="checkAll"></th>
            <th>Sr.No</th>
            <th>AWB No</th>
            <th>Sender</th>
            <th>Receiver</th>
            <th>Receiver City</th>
            <th>Pincode</th>
            <th>Forwarder</th>
            <th>Booking Date</th>
            <th>Mode</th>
            <th>Pay Mode</th>
            <th>Amount</th>
            <th>Weight</th>
            <th>QTY</th>
            <th>PKT</th>
            <th>Branch</th>
            <th>User</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @forelse($shipments as $key => $row)
            <tr>
                <td>
                    <input type="checkbox" name="ids[]" value="{{ $row->id }}">
                </td>

                <td>{{ $key + 1 }}</td>

                <td>
                    <span class="badge bg-primary">
                        {{ $row->airway_no }}
                    </span>
                </td>

                {{-- Sender (Consigner) --}}
                <td>
                    {{ $row->consigner?->name ?? '-' }}
                </td>

                {{-- Receiver (Consignee) --}}
                <td>
                    {{ $row->consignee?->name ?? '-' }}
                </td>

                {{-- Receiver City --}}
                <td>
                    {{ $row->consignee?->city ?? '-' }}
                </td>

                {{-- Pincode --}}
                <td>
                    {{ $row->consignee?->pincode ?? '-' }}
                </td>

                {{-- Forwarder --}}
                <td>
                    {{ $row->courier ?? 'SELF' }}
                </td>

                {{-- Booking Date --}}
                <td>
                    {{ \Carbon\Carbon::parse($row->shipment_date)->format('d-m-Y') }}
                </td>

                {{-- Mode --}}
                <td>
                    {{ $row->risk_type ?? '-' }}
                </td>

                {{-- Pay Mode --}}
                <td>
                    {{ $row->bill_type }}
                </td>

                {{-- Amount --}}
                <td>
                    {{ number_format($row->grand_total, 2) }}
                </td>

                {{-- Weight --}}
                <td>
                    {{ $row->chargeable_weight ?? '-' }}
                </td>

                {{-- QTY --}}
                <td>
                    {{ $row->qty }}
                </td>

                {{-- PKT --}}
                <td>
                    {{ $row->pkt }}
                </td>

                {{-- Branch --}}
                <td>
                    {{ $row->branch_name ?? 'BHIWANDI HO' }}
                </td>

                {{-- User --}}
                <td>
                    {{ optional($row->user)->name ?? 'Admin' }}
                </td>

                {{-- Action --}}
                <td>
                    <div class="btn-group-vertical">
                        <a href="{{ route('domestic.shipment.edit', $row->id) }}"
                           class="btn btn-sm btn-warning" title="Edit">
                            ✏️
                        </a>

                        <form action="{{ route('domestic.shipment.destroy', $row->id) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this shipment?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-sm btn-danger"
                                    title="Delete">
                                🗑️
                            </button>
                        </form>

                        <a href="{{ route('domestic.shipment.pod', $row->id) }}"
                           target="_blank"
                           class="btn btn-sm btn-secondary"
                           title="View POD">
                            📄
                        </a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="18" class="text-center text-muted">
                    No records found
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

            </div>
        </div>
    </div>
    </div>
    </main>


    
@endsection

