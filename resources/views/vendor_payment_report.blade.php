@extends('admin.partials.app')

@section('main-content')
<div class="container mt-4">
    <h1 class="mb-4">Vendor Payment Report</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('vendor.payment.export') }}" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>
            </div>

            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Vendor</th>
                        <th>Total Hires</th>
                        <th>Total Hire Amount</th>
                        <th>Total Advance Paid</th>
                        <th>Total Balance</th>
                        <th>Fully Paid Hires</th>
                        <th>Partially Paid Hires</th>

                        <th>Pending Hires</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($report as $vendor)
                    <tr>
                        <td>{{ $vendor['vendor_name'] }}</td>
                        <td>{{ $vendor['total_hires'] }}</td>
                        <td>{{ number_format($vendor['total_hire_amount'], 2) }}</td>
                        <td>{{ number_format($vendor['total_advance_paid'], 2) }}</td>
                        <td>{{ number_format($vendor['total_balance'], 2) }}</td>
                        <td>
                            <span class="badge bg-success">
                                {{ $vendor['fully_paid_hires'] }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-warning text-dark">
                                {{ $vendor['partially_paid_hires'] }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-danger">
                                {{ $vendor['pending_hires'] }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection