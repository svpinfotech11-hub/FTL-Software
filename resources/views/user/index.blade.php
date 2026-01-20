@extends('admin.partials.app')

@section('main-content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">All Users</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card card-primary card-outline mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title mb-0">Users Table</h3>
                            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-lg"></i> Add New
                            </a>
                        </div>


                        <div class="card-body">
                            <!-- Add table-responsive wrapper -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Branch</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th style="width: 120px">Actions</th> <!-- new column -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $index => $user)
                                        <tr class="align-middle">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->branch ? $user->branch->branch_name . ' (' . $user->branch->branch_code . ')' : 'No Branch Assigned' }}</td>
                                            <td>
                                                @if($user->status === 'active')
                                                <span class="badge text-bg-success">Active</span>
                                                @else
                                                <span class="badge text-bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->created_at->format('d-M-Y') }}</td>
                                            <td>
                                                <form class="delete-user-form" action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                        @endforeach

                                        @if($users->isEmpty())
                                        <tr>
                                            <td colspan="8" class="text-center">No users found.</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>

                        <div class="card-footer clearfix">
                            {{ $users->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</main>
@endsection