@extends('admin.partials.app')

@section('main-content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">My Roles & Permissions</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Roles & Permissions</li>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Your Assigned Roles & Permissions</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <!-- User Info -->
                                <div class="col-md-12 mb-4">
                                    <div class="card border-info">
                                        <div class="card-header bg-info text-white">
                                            <h5 class="card-title mb-0">
                                                <i class="bi bi-person-circle me-2"></i>
                                                User Information
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                                                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Phone:</strong> {{ Auth::user()->phone ?? 'Not provided' }}</p>
                                                    <p><strong>Status:</strong>
                                                        <span class="badge bg-{{ Auth::user()->status === 'active' ? 'success' : 'danger' }}">
                                                            {{ ucfirst(Auth::user()->status ?? 'Unknown') }}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Assigned Roles -->
                                <div class="col-md-6">
                                    <div class="card border-primary">
                                        <div class="card-header bg-primary text-white">
                                            <h5 class="card-title mb-0">
                                                <i class="bi bi-person-badge me-2"></i>
                                                Your Roles ({{ $userRoles->count() }})
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            @if($userRoles->count() > 0)
                                                <div class="row">
                                                    @foreach($userRoles as $role)
                                                        <div class="col-md-6 mb-3">
                                                            <div class="card h-100 border-primary">
                                                                <div class="card-body text-center">
                                                                    <i class="bi bi-person-badge fs-2 text-primary mb-2"></i>
                                                                    <h6 class="card-title">{{ $role->name }}</h6>
                                                                    <small class="text-muted">Assigned {{ $role->created_at->diffForHumans() }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="text-center text-muted py-4">
                                                    <i class="bi bi-person-badge fs-1 mb-2"></i>
                                                    <p>No roles assigned yet</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Assigned Permissions -->
                                <div class="col-md-6">
                                    <div class="card border-success">
                                        <div class="card-header bg-success text-white">
                                            <h5 class="card-title mb-0">
                                                <i class="bi bi-key me-2"></i>
                                                Your Permissions ({{ $userPermissions->count() }})
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            @if($userPermissions->count() > 0)
                                                <div class="row">
                                                    @foreach($userPermissions as $permission)
                                                        <div class="col-md-6 mb-3">
                                                            <div class="card h-100 border-success">
                                                                <div class="card-body text-center">
                                                                    <i class="bi bi-key fs-2 text-success mb-2"></i>
                                                                    <h6 class="card-title">{{ $permission->name }}</h6>
                                                                    <small class="text-muted">Granted {{ $permission->created_at->diffForHumans() }}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="text-center text-muted py-4">
                                                    <i class="bi bi-key fs-1 mb-2"></i>
                                                    <p>No permissions assigned yet</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Role-Permission Matrix -->
                            @if($userRoles->count() > 0)
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="card border-warning">
                                        <div class="card-header bg-warning text-dark">
                                            <h5 class="card-title mb-0">
                                                <i class="bi bi-diagram-3 me-2"></i>
                                                Role-Permission Details
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Role</th>
                                                            <th>Permissions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($userRoles as $role)
                                                            <tr>
                                                                <td>
                                                                    <strong>{{ $role->name }}</strong>
                                                                </td>
                                                                <td>
                                                                    @if($role->permissions->count() > 0)
                                                                        <div class="d-flex flex-wrap gap-1">
                                                                            @foreach($role->permissions as $perm)
                                                                                <span class="badge bg-secondary">{{ $perm->name }}</span>
                                                                            @endforeach
                                                                        </div>
                                                                    @else
                                                                        <span class="text-muted">No permissions assigned to this role</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection