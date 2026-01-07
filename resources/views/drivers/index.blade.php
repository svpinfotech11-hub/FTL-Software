@extends('admin.partials.app')
@section('main-content')
    <main class="app-main">

        <div class="app-content-header">
            <div class="container-fluid">
                <h3>All Drivers</h3>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                <div class="card card-primary card-outline">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Drivers Table</h3>
                        <a href="{{ route('drivers.create') }}" class="btn btn-primary btn-sm">Add Driver</a>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Salary</th>
                                    <th>Date Of Joining</th>
                                    <th>Date Of Leaving</th>
                                    <th>Father Name</th>
                                    <th>Mother Name</th>
                                    <th>Mobile</th>
                                    <th>Mobile Alt.</th>
                                    <th>Licance No.</th>
                                    <th>Licance Exp.</th>
                                    <th>Pincode</th>
                                    <th>State</th>
                                    <th>City</th>

                                    <th width="120">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($drivers as $key => $driver)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $driver->name }}</td>
                                        <td>{{ $driver->salary }}</td>
                                        <td>{{ $driver->joining_date }}</td>
                                        <td>{{ $driver->leaving_date }}</td>
                                        <td>{{ $driver->father_name }}</td>
                                        <td>{{ $driver->mother_name }}</td>
                                        <td>{{ $driver->mobile }}</td>
                                        <td>{{ $driver->mobile_alt }}</td>
                                        <td>{{ $driver->licence_no }}</td>
                                        <td>{{ $driver->licence_exp }}</td>
                                        <td>{{ $driver->pincode }}</td>
                                        <td>{{ $driver->state }}</td>
                                        <td>{{ $driver->city }}</td>

                                        <td>
                                            <a href="{{ route('drivers.edit', $driver->id) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST"
                                                class="d-inline delete-driver-form">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger delete-btn">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                @if ($drivers->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">No Drivers Found</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
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

                const form = this.closest('.delete-driver-form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
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

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        @endif

    });
</script>
