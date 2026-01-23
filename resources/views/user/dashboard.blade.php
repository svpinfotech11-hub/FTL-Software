@extends('admin.partials.app')
@section('main-content')

    @if (Auth::user()->role === 'admin')
        <!-- Admin Dashboard Content -->
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Admin Dashboard <br> {{ Auth::user()->name }} <br>
                            {{ Auth::user()->email }}
                        </h3>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">

                    <!-- Users -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-primary">
                            <div class="inner">
                                <h3>{{ $usersCount }}</h3>
                                <p>Users</p>
                            </div>
                            <i class="bi bi-people-fill small-box-icon"></i>
                            <a href="{{ route('user.index') }}" class="small-box-footer link-light">
                                More info <i class="bi bi-arrow-right-circle"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Companies -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-success">
                            <div class="inner">
                                <h3>{{ $companiesCount }}</h3>
                                <p>Companies</p>
                            </div>
                            <i class="bi bi-building small-box-icon"></i>
                            <a href="{{ route('company.index') }}" class="small-box-footer link-light">
                                More info <i class="bi bi-arrow-right-circle"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Vendors -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-warning">
                            <div class="inner">
                                <h3>{{ $vendorsCount }}</h3>
                                <p>Vendors</p>
                            </div>
                            <i class="bi bi-person-badge-fill small-box-icon"></i>
                            <a href="{{ route('vendors.index') }}" class="small-box-footer link-dark">
                                More info <i class="bi bi-arrow-right-circle"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Shipments -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-danger">
                            <div class="inner">
                                <h3>{{ $shipmentsCount }}</h3>
                                <p>Total Shipments</p>
                            </div>
                            <i class="bi bi-truck small-box-icon"></i>
                            <a href="{{ route('domestic.shipment.index') }}" class="small-box-footer link-light">
                                More info <i class="bi bi-arrow-right-circle"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Branches -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-info">
                            <div class="inner">
                                <h3>{{ $branchesCount }}</h3>
                                <p>Branches</p>
                            </div>
                            <i class="bi bi-diagram-3-fill small-box-icon"></i>
                            <a href="{{ route('branches.index') }}" class="small-box-footer link-light">More info</a>
                        </div>
                    </div>

                    <!-- Customers -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-secondary">
                            <div class="inner">
                                <h3>{{ $customersCount }}</h3>
                                <p>Customer Master</p>
                            </div>
                            <i class="bi bi-person-lines-fill small-box-icon"></i>
                            <a href="{{ route('customers.index') }}" class="small-box-footer link-light">More info</a>
                        </div>
                    </div>

                    <!-- Vehicles -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-info">
                            <div class="inner">
                                <h3>{{ $vehiclesCount }}</h3>
                                <p>Vehicles</p>
                            </div>
                            <i class="bi bi-car-front-fill small-box-icon"></i>
                            <a href="{{ route('vehicles.index') }}" class="small-box-footer link-light">More info</a>
                        </div>
                    </div>

                    <!-- Drivers -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-primary">
                            <div class="inner">
                                <h3>{{ $driversCount }}</h3>
                                <p>Drivers</p>
                            </div>
                            <i class="bi bi-person-wheelchair small-box-icon"></i>
                            <a href="{{ route('drivers.index') }}" class="small-box-footer link-light">More info</a>
                        </div>
                    </div>

                    <!-- Expense -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-danger">
                            <div class="inner">
                                <h3>₹ {{ number_format($expenseCount, 2) }}</h3>
                                <p>Total Expense</p>
                            </div>
                            <i class="bi bi-currency-rupee small-box-icon"></i>
                            <a href="{{ route('add-expenses.index') }}" class="small-box-footer link-light">More info</a>
                        </div>
                    </div>

                    <!-- Hire Register -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-success">
                            <div class="inner">
                                <h3>{{ $hireCount }}</h3>
                                <p>Total Hire Register</p>
                            </div>
                            <i class="bi bi-journal-check small-box-icon"></i>
                            <a href="{{ route('vehicle_hires.index') }}" class="small-box-footer link-light">More info</a>
                        </div>
                    </div>

                    <!-- Reports -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box text-bg-warning">
                            <div class="inner">
                                <h3>{{ $reportsCount }}</h3>
                                <p>Total Reports</p>
                            </div>
                            <i class="bi bi-bar-chart-fill small-box-icon"></i>
                            <a href="{{ route('domestic.shipment.reports') }}" class="small-box-footer link-dark">More info</a>
                        </div>
                    </div>

                </div>
                @if (auth()->user()->role === 'admin')
                    <h3>Admin Users</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($adminUsers as $admin)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        <form action="{{ route('users.delete', $admin->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this admin?');">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <!--end::Row-->
                <!--begin::Roles & Permissions Row-->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="bi bi-shield-lock me-2"></i>
                                    Roles & Permissions Management
                                </h3>
                                <div class="card-tools">
                                    <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-gear"></i> Manage Roles
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="info-box">
                                            <span class="info-box-icon text-primary">
                                                <i class="bi bi-people-fill"></i>
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Total Users</span>
                                                <span
                                                    class="info-box-number">{{ \App\Models\User::where('created_by', Auth::id())->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-box">
                                            <span class="info-box-icon text-success">
                                                <i class="bi bi-person-badge"></i>
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Roles Created</span>
                                                <span
                                                    class="info-box-number">{{ \App\Models\Role::where('user_id', Auth::id())->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-box">
                                            <span class="info-box-icon text-warning">
                                                <i class="bi bi-key"></i>
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Permissions</span>
                                                <span
                                                    class="info-box-number">{{ \App\Models\Permission::where('user_id', Auth::id())->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-box">
                                            <span class="info-box-icon text-info">
                                                <i class="bi bi-person-check"></i>
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Users with Roles</span>
                                                <span
                                                    class="info-box-number">{{ \App\Models\User::where('created_by', Auth::id())->whereNotNull('role')->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="card border-primary">
                                            <div class="card-header bg-primary text-white">
                                                <h6 class="card-title mb-0">
                                                    <i class="bi bi-person-badge me-1"></i>
                                                    Recent Roles
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                @php
                                                    $recentRoles = \App\Models\Role::where('user_id', Auth::id())
                                                        ->latest()
                                                        ->take(3)
                                                        ->get();
                                                @endphp
                                                @if ($recentRoles->count() > 0)
                                                    @foreach ($recentRoles as $role)
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <span>{{ $role->name }}</span>
                                                            <small
                                                                class="text-muted">{{ $role->created_at->diffForHumans() }}</small>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p class="text-muted mb-0">No roles created yet</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card border-success">
                                            <div class="card-header bg-success text-white">
                                                <h6 class="card-title mb-0">
                                                    <i class="bi bi-key me-1"></i>
                                                    Recent Permissions
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                @php
                                                    $recentPermissions = \App\Models\Permission::where(
                                                        'user_id',
                                                        Auth::id(),
                                                    )
                                                        ->latest()
                                                        ->take(3)
                                                        ->get();
                                                @endphp
                                                @if ($recentPermissions->count() > 0)
                                                    @foreach ($recentPermissions as $perm)
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2">
                                                            <span>{{ $perm->name }}</span>
                                                            <small
                                                                class="text-muted">{{ $perm->created_at->diffForHumans() }}</small>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p class="text-muted mb-0">No permissions created yet</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Roles & Permissions Row-->
            </div>
            <!--end::Container-->

            <!--end::App Content-->
        @else
            <!-- Regular User Dashboard Content -->
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">My Dashboard <br> {{ Auth::user()->name }} <br>
                                {{ Auth::user()->email }}
                            </h3>
                        </div>

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->

            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <!-- User Welcome Card -->
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <h4 class="card-title">Welcome back, {{ Auth::user()->name }}!</h4>
                                            <p class="card-text">Here's an overview of your account and recent activities.
                                            </p>
                                            <div class="row mt-3">
                                                <div class="col-md-4">
                                                    <div class="border rounded p-3 text-center">
                                                        <i class="bi bi-person-badge fs-1 text-primary"></i>
                                                        <h5 class="mt-2">{{ Auth::user()->roles->count() }}</h5>
                                                        <p class="text-muted mb-0">Assigned Roles</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="border rounded p-3 text-center">
                                                        <i class="bi bi-key fs-1 text-success"></i>
                                                        <h5 class="mt-2">
                                                            {{ Auth::user()->roles->sum(function ($role) {return $role->permissions->count();}) }}
                                                        </h5>
                                                        <p class="text-muted mb-0">Total Permissions</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="border rounded p-3 text-center">
                                                        <i class="bi bi-building fs-1 text-info"></i>
                                                        <h5 class="mt-2">{{ Auth::user()->branch ? 1 : 0 }}</h5>
                                                        <p class="text-muted mb-0">Branch Assignment</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center"
                                                style="width: 120px; height: 120px;">
                                                <i class="bi bi-person-circle fs-1 text-secondary"></i>
                                            </div>
                                            <p class="mt-3 mb-1"><strong>Status:</strong>
                                                <span
                                                    class="badge bg-{{ Auth::user()->status === 'active' ? 'success' : 'danger' }}">
                                                    {{ ucfirst(Auth::user()->status ?? 'Unknown') }}
                                                </span>
                                            </p>
                                            <p class="text-muted mb-0">Member since
                                                {{ Auth::user()->created_at->format('M Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Access Cards -->
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="bi bi-shield-lock me-2"></i>
                                        My Access
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('user.roles.permissions') }}"
                                        class="btn btn-outline-primary btn-sm mb-2 w-100">
                                        <i class="bi bi-eye me-1"></i>
                                        View My Roles & Permissions
                                    </a>
                                    <div class="mt-3">
                                        <h6>Current Roles:</h6>
                                        @if (Auth::user()->roles->count() > 0)
                                            @foreach (Auth::user()->roles as $role)
                                                <span class="badge bg-secondary me-1">{{ $role->name }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">No roles assigned</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        @hasPermission('view-shipment')
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="card-title mb-0">
                                            <i class="bi bi-box me-2"></i>
                                            Shipments
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">View and track shipment information.</p>
                                        <a href="{{ route('domestic.shipment.index') }}" class="btn btn-success btn-sm">
                                            <i class="bi bi-eye me-1"></i>
                                            View Shipments
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endhasPermission

                        @hasPermission('manage vendors')
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-header bg-info text-white">
                                        <h5 class="card-title mb-0">
                                            <i class="bi bi-truck me-2"></i>
                                            Vendors & Vehicles
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">Access vendor and vehicle information.</p>
                                        <div class="d-grid gap-2">
                                            <a href="{{ route('vendors.index') }}" class="btn btn-info btn-sm">
                                                <i class="bi bi-truck me-1"></i>
                                                View Vendors
                                            </a>
                                            <a href="{{ route('vehicles.index') }}" class="btn btn-info btn-sm">
                                                <i class="bi bi-car-front me-1"></i>
                                                View Vehicles
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endhasPermission
                    </div>
                </div>

                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    @endif


@endsection
