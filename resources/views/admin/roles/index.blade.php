@extends('admin.roles.layouts.master')

@section('content')
<div class="row mb-4">
    <!-- Statistics Cards -->
    <div class="col-md-3">
        <div class="card stats-card text-white">
            <div class="card-body text-center">
                <i class="bi bi-people-fill fs-1 mb-2"></i>
                <h3 class="card-title mb-1">{{ $users->count() }}</h3>
                <p class="card-text mb-0">Total Users</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card text-white">
            <div class="card-body text-center">
                <i class="bi bi-person-badge fs-1 mb-2"></i>
                <h3 class="card-title mb-1">{{ $roles->count() }}</h3>
                <p class="card-text mb-0">Total Roles</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card text-white">
            <div class="card-body text-center">
                <i class="bi bi-key fs-1 mb-2"></i>
                <h3 class="card-title mb-1">{{ $permissions->count() }}</h3>
                <p class="card-text mb-0">Total Permissions</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stats-card text-white">
            <div class="card-body text-center">
                <i class="bi bi-building fs-1 mb-2"></i>
                <h3 class="card-title mb-1">{{ $users->where('role', 'admin')->count() }}</h3>
                <p class="card-text mb-0">Admin Users</p>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row">
    <!-- Create Role -->
    <div class="col-md-6">
        <div class="card roles-card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-plus-circle me-2"></i>
                    Create New Role
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="role_name" class="form-label">Role Name</label>
                        <input type="text" name="name" id="role_name" class="form-control" required
                               placeholder="Enter role name (e.g., manager, employee)">
                        <div class="form-text">Choose a descriptive name for the role</div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>
                        Create Role
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Create Permission -->
    <div class="col-md-6">
        <div class="card roles-card">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-key-plus me-2"></i>
                    Create New Permission
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('permissions.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="permission_name" class="form-label">Permission Name</label>
                        <input type="text" name="name" id="permission_name" class="form-control" required
                               placeholder="Enter permission name (e.g., create-users, view-reports)">
                        <div class="form-text">Use lowercase with hyphens (e.g., manage-users)</div>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-key-plus me-2"></i>
                        Create Permission
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Assign Role to User -->
    <div class="col-md-6">
        <div class="card roles-card">
            <div class="card-header bg-warning text-dark">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person-plus me-2"></i>
                    Assign Role to User
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.assign') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_select" class="form-label">Select User</label>
                        <select name="user_id" id="user_select" class="form-select" required>
                            <option value="">Choose a user...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="role_select" class="form-label">Select Role</label>
                        <select name="role" id="role_select" class="form-select" required>
                            <option value="">Choose a role...</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-person-plus me-2"></i>
                        Assign Role
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Assign Permission to User -->
    <div class="col-md-6">
        <div class="card roles-card">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-link me-2"></i>
                    Assign Permission to User
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.permission.assign') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="user_perm_select" class="form-label">Select User</label>
                        <select name="user_id" id="user_perm_select" class="form-select" required>
                            <option value="">Choose a user...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select Permissions</label>
                        <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                            @if($permissions->count() > 0)
                                @foreach($permissions as $perm)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $perm->name }}" id="perm_{{ $perm->id }}">
                                        <label class="form-check-label" for="perm_{{ $perm->id }}">
                                            {{ $perm->name }}
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted mb-0">No permissions available. Create some permissions first.</p>
                            @endif
                        </div>
                        <div class="form-text">
                            Select one or more permissions to assign to the selected user.
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-outline-secondary btn-sm me-2" onclick="selectAllPermissions()">
                            <i class="bi bi-check-all me-1"></i>
                            Select All
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="clearAllPermissions()">
                            <i class="bi bi-x-circle me-1"></i>
                            Clear All
                        </button>
                    </div>
                    <button type="submit" class="btn btn-info">
                        <i class="bi bi-link me-2"></i>
                        Assign Permissions
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Roles List -->
    <div class="col-md-6">
        <div class="card roles-card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person-badge me-2"></i>
                    Available Roles ({{ $roles->count() }})
                </h5>
            </div>
            <div class="card-body">
                @if($roles->count() > 0)
                    <div class="row">
                        @foreach($roles as $role)
                            <div class="col-md-6 mb-2">
                                <span class="role-badge">
                                    <i class="bi bi-person-badge me-1"></i>
                                    {{ $role->name }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-person-badge fs-1 mb-2"></i>
                        <p>No roles created yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Permissions List -->
    <div class="col-md-6">
        <div class="card roles-card">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-key me-2"></i>
                    Available Permissions ({{ $permissions->count() }})
                </h5>
            </div>
            <div class="card-body">
                @if($permissions->count() > 0)
                    <div class="row">
                        @foreach($permissions as $perm)
                            <div class="col-md-6 mb-2">
                                <span class="permission-badge">
                                    <i class="bi bi-key me-1"></i>
                                    {{ $perm->name }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-key fs-1 mb-2"></i>
                        <p>No permissions created yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- User Roles Overview -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card roles-card">
            <div class="card-header bg-secondary text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-people me-2"></i>
                    User Roles Overview
                </h5>
            </div>
            <div class="card-body">
                @if($users->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-person"></i> User</th>
                                    <th><i class="bi bi-envelope"></i> Email</th>
                                    <th><i class="bi bi-person-badge"></i> Current Role</th>
                                    <th><i class="bi bi-calendar"></i> Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="role-badge">
                                                {{ $user->role ?? 'No Role Assigned' }}
                                            </span>
                                        </td>
                                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-people fs-1 mb-2"></i>
                        <p>No users found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    // Form validation feedback
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const inputs = form.querySelectorAll('input[required], select[required]');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                }
            });

            if (!isValid) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Required Fields',
                    text: 'Please fill in all required fields.',
                    confirmButtonColor: '#007bff'
                });
            }
        });
    });
</script>
@endpush