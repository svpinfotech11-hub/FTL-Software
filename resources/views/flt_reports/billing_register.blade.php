@extends('admin.partials.app')

@section('main-content')
    <style>
        .card-header-custom {
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
            background-color: #e9ecef;
            font-weight: bold;
        }
    </style>

    <div class="container-fluid mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4><i class="bi bi-receipt me-2 text-primary"></i>Billing Register</h4>

            <div class="d-flex gap-2">
                <a href="#" class="btn btn-success btn-sm">
                    <i class="bi bi-file-earmark-excel"></i> Export To Excel
                </a>
            </div>
        </div>

        <div class="card filter-card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('billing-register.billing') }}">
                    <div class="row g-3">

                        <div class="col-md-3">
                            <label class="form-label">
                                <i class="bi bi-calendar-date text-primary"></i> From
                            </label>
                            <input type="date" name="from_date" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">
                                <i class="bi bi-calendar-date text-primary"></i> To
                            </label>
                            <input type="date" name="to_date" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">
                                <i class="bi bi-people text-primary"></i> Party Type
                            </label>
                            <select name="party_type" class="form-select">
                                <option value="">Select Party Type</option>

                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">
                                <i class="bi bi-person text-primary"></i> Party Name
                            </label>
                            <select name="party_id" class="form-select">
                                <option value="">Select Party Name</option>
                            </select>
                        </div>

                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i> Search
                            </button>
                            <a href="{{ route('billing-register.billing') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-clockwise"></i> Reset
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
