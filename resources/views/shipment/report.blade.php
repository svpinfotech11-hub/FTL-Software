@extends('admin.partials.app')

@section('main-content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Domestic Shipment Profit & Loss Report</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shipment Report</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold">Domestic Shipment Report</h4>
                <div>
                    <a href="{{ route('domestic.shipment.reports.export', request()->query()) }}"
                        class="btn btn-dark btn-sm">
                        Download Report
                    </a>
                </div>
            </div>

            <!-- Filters -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Filters</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('domestic.shipment.reports') }}" id="filterForm">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">Customer</label>
                                <select class="form-control" name="customer_id">
                                    <option value="">All Customers</option>
                                    @foreach($customers ?? [] as $customer)
                                    <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->customer_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Consigner</label>
                                <select class="form-control" name="consigner_id">
                                    <option value="">All Consigners</option>
                                    @foreach($consigners ?? [] as $consigner)
                                    <option value="{{ $consigner->id }}" {{ request('consigner_id') == $consigner->id ? 'selected' : '' }}>
                                        {{ $consigner->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Consignee</label>
                                <select class="form-control" name="consignee_id">
                                    <option value="">All Consignees</option>
                                    @foreach($consignees ?? [] as $consignee)
                                    <option value="{{ $consignee->id }}" {{ request('consignee_id') == $consignee->id ? 'selected' : '' }}>
                                        {{ $consignee->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Date Range</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}">
                                    <span class="input-group-text">to</span>
                                    <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                <a href="{{ route('domestic.shipment.reports') }}" class="btn btn-secondary">Clear Filters</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle datatable">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Airway No</th>
                                        <th>Consigner</th>
                                        <th>Consignee</th>
                                        <th>Destination</th>
                                        <th>Vehicle Type</th>
                                        <th>Hire Register</th>
                                        <th class="text-end">Hire Rate</th>
                                        <th class="text-end">Expenses</th>
                                        <th class="text-end">Advance</th>
                                        <th class="text-end">Balance</th>
                                        <th class="text-end">Grand Total</th>
                                        <th class="text-end">Profit / Loss</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($shipments as $key => $row)
                                    <tr class="{{ $row->is_profit ? 'table-success' : 'table-danger' }}">
                                        <td class="text-center">{{ $key + 1 }}</td>

                                        <td class="text-center">
                                            {{ $row->shipment_date?->format('d/m/Y') ?? '-' }}
                                        </td>

                                        <td class="text-center">
                                            <span class="badge bg-primary px-3">
                                                {{ $row->airway_no }}
                                            </span>
                                        </td>

                                        <td>{{ $row->consigner?->name ?? '-' }}</td>
                                        <td>{{ $row->consignee?->name ?? '-' }}</td>
                                        <td>{{ $row->consignee?->city ?? '-' }}</td>

                                        <td class="text-center">
                                            <span class="badge bg-{{ $row->vehicle_type === 'rented' ? 'info' : 'secondary' }}">
                                                {{ ucfirst($row->vehicle_type ?? 'own') }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            {{ $row->vehicle_type === 'rented'
                        ? ($row->vehicleHire?->hire_register_id ?? '-')
                        : 'OWN'
                    }}
                                        </td>

                                        <td class="text-end">
                                            {{ $row->vehicleHire ? number_format($row->vehicleHire->hire_rate) : '0.00' }}
                                        </td>

                                        <td class="text-end">
                                            {{ number_format($row->expenses->sum('amount')) }}
                                        </td>

                                        <td class="text-end">
                                            {{ $row->vehicleHire ? number_format($row->vehicleHire->advance_paid) : '0.00' }}
                                        </td>

                                        <td class="text-end">
                                            {{ $row->vehicleHire ? number_format($row->vehicleHire->balance_payable) : '0.00' }}
                                        </td>

                                        <td class="text-end fw-bold">
                                            {{ number_format($row->grand_total) }}
                                        </td>

                                        <td class="text-end fw-bold {{ $row->is_profit ? 'text-success' : 'text-danger' }}">
                                            {{ $row->is_profit ? '+' : '' }}{{ number_format($row->profit_loss) }}
                                        </td>
                                    </tr>
                                    @empty
                                   
                                    @endforelse
                                </tbody>

                                @if($shipments->count())
                                <tfoot class="table-light fw-bold">
                                    <tr>
                                        <td colspan="12" class="text-end">Total</td>
                                        <td class="text-end">
                                            {{ number_format($shipments->sum('grand_total')) }}
                                        </td>
                                        <td class="text-end {{ $shipments->sum('profit_loss') >= 0 ? 'text-success' : 'text-danger' }}">
                                            {{ $shipments->sum('profit_loss') >= 0 ? '+' : '' }}
                                            {{ number_format($shipments->sum('profit_loss')) }}
                                        </td>
                                    </tr>
                                </tfoot>
                                @endif
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection