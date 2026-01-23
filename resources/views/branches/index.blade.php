@extends('admin.partials.app')

@section('main-content')
    <main class="app-main">

        <!-- App Content Header -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">All Branches</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">All Branches</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <!-- App Content -->
        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-primary card-outline mb-4">

                            <!-- Card Header -->
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">Branches Table</h3>
                                <a href="{{ route('branches.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-lg"></i> Add Branch
                                </a>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle">
                                        <thead>
                                            <tr>
                                                <th style="width:10px">#</th>
                                                <th>Branch Name</th>
                                                <th>Code</th>
                                                <th>Email</th>
                                                <th>Contact</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>GST</th>
                                                <th>Contact Person</th>
                                                <th style="width:120px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($branches as $index => $branch)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $branch->branch_name }}</td>
                                                    <td>{{ $branch->branch_code }}</td>
                                                    <td>{{ $branch->email }}</td>
                                                    <td>{{ $branch->contact_no }}</td>
                                                    <td>{{ $branch->city }}</td>
                                                    <td>{{ $branch->state }}</td>
                                                    <td>{{ $branch->gst_number }}</td>
                                                    <td>{{ $branch->contact_person }}</td>
                                                    <td>
                                                        <a href="{{ route('branches.edit', $branch->id) }}"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <form action="{{ route('branches.destroy', $branch->id) }}"
                                                            method="POST" class="d-inline delete-branch-form">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="button" class="btn btn-sm btn-danger delete-btn">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="10" class="text-center">
                                                        No branches found.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function() {

                let form = this.closest('.delete-branch-form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This branch will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
