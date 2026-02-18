@extends('admin.partials.app')

@section('main-content')
    <main class="app-main">

        {{-- Header --}}
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0 text-secondary" style="font-weight: bold;">All Companies</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">All Companies</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-primary card-outline mb-4">

                            {{-- Card Header --}}
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">Company Table</h3>
                                <a href="{{ route('company.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-lg"></i> Add Company
                                </a>
                            </div>

                            {{-- Card Body --}}
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle datatable">
                                        <thead>
                                            <tr>
                                                <th style="width:10px">#</th>
                                                <th>Company Name</th>
                                                <th>Address</th>
                                                <th>Contact No</th>
                                                <th>Email</th>
                                                <th>Logo</th>
                                                <th style="width:140px">Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($companies as $index => $company)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>

                                                    <td>{{ $company->company_name }}</td>

                                                    <td>{{ $company->user->address ?? 'N/A' }}</td>

                                                    <td>{{ $company->user->phone ?? 'N/A' }}</td>

                                                    <td>{{ $company->user->email ?? 'N/A' }}</td>

                                                    <td>
                                                        @if ($company->logo)
                                                            <img src="{{ asset('storage/' . $company->logo) }}"
                                                                height="35">
                                                        @else
                                                            <span class="text-muted">N/A</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('company.edit', $company->id) }}"
                                                            class="btn btn-sm btn-outline-warning me-1">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>

                                                        <form action="{{ route('company.destroy', $company->id) }}"
                                                            method="POST" class="d-inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                onclick="return confirm('Are you sure to delete this freight challan?')">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
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
            </div>
        </div>

    </main>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                let form = this.closest('.delete-company-form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This company will be deleted!",
                    icon: 'warning',
                    showCancelButton: true,
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
