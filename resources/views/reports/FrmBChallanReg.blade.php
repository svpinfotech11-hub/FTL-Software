@extends('admin.partials.app')

@section('main-content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0 text-secondary" style="font-weight: bold;">Challan Register</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item active">Challan Register</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">
                    <div class="col-md-12">

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="card card-primary card-outline mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-title">Challan Register</div>
                            </div>

                            <!-- Filter Form -->
                            <div class="card-body">
                                <!-- Filter Form -->
                                <form method="GET" action="{{ route('reports.FrmBChallanReg') }}" class="row g-3">
                                    <div class="col-md-3">
                                        <label for="from_date" class="form-label">From Date</label>
                                        <input type="date" id="from_date" name="from_date" class="form-control"
                                            value="{{ request('from_date') }}">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="to_date" class="form-label">To Date</label>
                                        <input type="date" id="to_date" name="to_date" class="form-control"
                                            value="{{ request('to_date') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="broker_id" class="form-label">Broker</label>
                                        <select id="broker_id" name="broker_id" class="form-select">
                                            <option value="">-- Select Broker --</option>
                                            @foreach ($brokers as $broker)
                                                <option value="{{ $broker->id }}"
                                                    {{ request('broker_id') == $broker->id ? 'selected' : '' }}>
                                                    {{ $broker->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                                        <a href="{{ route('reports.FrmBChallanReg') }}"
                                            class="btn btn-danger ms-2">Reset</a>
                                    </div>
                                </form>

                            </div>


                        </div>


                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
