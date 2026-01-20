@extends('admin.partials.app')
@section('main-content')

@if(Auth::user()->role === 'admin')
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
      <!--begin::Col-->
      <div class="col-lg-3 col-6">
        <!--begin::Small Box Widget 1-->
        <div class="small-box text-bg-primary">
          <div class="inner">
            <h3>150</h3>
            <p>New Orders</p>
          </div>
          <svg
            class="small-box-icon"
            fill="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true">
            <path
              d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"></path>
          </svg>
          <a
            href="#"
            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
            More info <i class="bi bi-link-45deg"></i>
          </a>
        </div>
        <!--end::Small Box Widget 1-->
      </div>
      <!--end::Col-->
      <div class="col-lg-3 col-6">
        <!--begin::Small Box Widget 2-->
        <div class="small-box text-bg-success">
          <div class="inner">
            <h3>53<sup class="fs-5">%</sup></h3>
            <p>Bounce Rate</p>
          </div>
          <svg
            class="small-box-icon"
            fill="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true">
            <path
              d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"></path>
          </svg>
          <a
            href="#"
            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
            More info <i class="bi bi-link-45deg"></i>
          </a>
        </div>
        <!--end::Small Box Widget 2-->
      </div>
      <!--end::Col-->
      <div class="col-lg-3 col-6">
        <!--begin::Small Box Widget 3-->
        <div class="small-box text-bg-warning">
          <div class="inner">
            <h3>{{ \App\Models\User::where('created_by', Auth::id())->count() }}</h3>
            <p>Total Users</p>
          </div>
          <svg
            class="small-box-icon"
            fill="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true">
            <path
              d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"></path>
          </svg>
          <a
            href="{{ route('user.index') }}"
            class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
            More info <i class="bi bi-link-45deg"></i>
          </a>
        </div>
        <!--end::Small Box Widget 3-->
      </div>
      <!--end::Col-->
      <div class="col-lg-3 col-6">
        <!--begin::Small Box Widget 4-->
        <div class="small-box text-bg-danger">
          <div class="inner">
            <h3>{{ \App\Models\DomesticShipment::where('user_id', Auth::id())->count() }}</h3>
            <p>Total Shipments</p>
          </div>
          <svg
            class="small-box-icon"
            fill="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true">
            <path
              clip-rule="evenodd"
              fill-rule="evenodd"
              d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"></path>
            <path
              clip-rule="evenodd"
              fill-rule="evenodd"
              d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"></path>
          </svg>
          <a
            href="{{ route('domestic.shipment.index') }}"
            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
            More info <i class="bi bi-link-45deg"></i>
          </a>
        </div>
        <!--end::Small Box Widget 4-->
      </div>
    </div>
    <!--end::Row-->
  </div>
  <!--end::Container-->
</div>
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
                <p class="card-text">Here's an overview of your account and recent activities.</p>
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
                      <h5 class="mt-2">{{ Auth::user()->roles->sum(function($role) { return $role->permissions->count(); }) }}</h5>
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
                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                  <i class="bi bi-person-circle fs-1 text-secondary"></i>
                </div>
                <p class="mt-3 mb-1"><strong>Status:</strong>
                  <span class="badge bg-{{ Auth::user()->status === 'active' ? 'success' : 'danger' }}">
                    {{ ucfirst(Auth::user()->status ?? 'Unknown') }}
                  </span>
                </p>
                <p class="text-muted mb-0">Member since {{ Auth::user()->created_at->format('M Y') }}</p>
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
            <a href="{{ route('user.roles.permissions') }}" class="btn btn-outline-primary btn-sm mb-2 w-100">
              <i class="bi bi-eye me-1"></i>
              View My Roles & Permissions
            </a>
            <div class="mt-3">
              <h6>Current Roles:</h6>
              @if(Auth::user()->roles->count() > 0)
              @foreach(Auth::user()->roles as $role)
              <span class="badge bg-secondary me-1">{{ $role->name }}</span>
              @endforeach
              @else
              <span class="text-muted">No roles assigned</span>
              @endif
            </div>
          </div>
        </div>
      </div>

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
    </div>
    <!--end::Row-->
  </div>
  <!--end::Container-->

<!--end::App Content-->
@endif
<!--end::Col-->

<!--end::Row-->

@if(Auth::user()->role === 'admin')
<!--begin::Roles & Permissions Row-->
<div class="row">
  <div class="col-10">
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
                <span class="info-box-number">{{ \App\Models\User::where('created_by', Auth::id())->count() }}</span>
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
                <span class="info-box-number">{{ \App\Models\Role::where('user_id', Auth::id())->count() }}</span>
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
                <span class="info-box-number">{{ \App\Models\Permission::where('user_id', Auth::id())->count() }}</span>
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
                <span class="info-box-number">{{ \App\Models\User::where('created_by', Auth::id())->whereNotNull('role')->count() }}</span>
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
                $recentRoles = \App\Models\Role::where('user_id', Auth::id())->latest()->take(3)->get();
                @endphp
                @if($recentRoles->count() > 0)
                @foreach($recentRoles as $role)
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span>{{ $role->name }}</span>
                  <small class="text-muted">{{ $role->created_at->diffForHumans() }}</small>
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
                $recentPermissions = \App\Models\Permission::where('user_id', Auth::id())->latest()->take(3)->get();
                @endphp
                @if($recentPermissions->count() > 0)
                @foreach($recentPermissions as $perm)
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span>{{ $perm->name }}</span>
                  <small class="text-muted">{{ $perm->created_at->diffForHumans() }}</small>
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
</div>

<!--end::Roles & Permissions Row-->
@endif

<!--begin::Row-->

<!-- /.row (main row) -->
</div>
<!--end::Container-->
</div>
<!--end::App Content-->

@endsection