@extends('admin.partials.app')

@section('main-content')
    <style>
        .header-bg {
            background: linear-gradient(45deg, #1d3557, #457b9d);
            color: #fff;
        }

        .filter-card {
            background: #f8f9fa;
            border-left: 5px solid #0d6efd;
        }

        .table thead {
            background-color: #1d3557;
            color: white;
        }

        .total-row {
            background: #e9ecef;
            font-weight: bold;
        }
    </style>

    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>
                <i class="bi bi-clock-history text-danger me-2"></i>
                LR Pending Register (Freight Challan)
            </h4>

            <a href="#" class="btn btn-success btn-sm">
                <i class="bi bi-file-earmark-excel"></i> Export To Excel
            </a>
        </div>

        <div class="card filter-card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('lr-pending-register.pending') }}">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">
                                <i class="bi bi-calendar-event text-primary"></i> Date From
                            </label>
                            <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">
                                <i class="bi bi-calendar-event text-primary"></i> Date To
                            </label>
                            <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                        </div>

                        <div class="col-md-4 text-end align-self-end">
                            <button class="btn btn-primary">
                                <i class="bi bi-search"></i> Search
                            </button>

                            <a href="{{ route('lr-pending-register.pending') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-clockwise"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
