@extends('admin.partials.app')

@section('main-content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <h5>All Branches</h5>
            <a href="{{ route('branches.create') }}" class="btn btn-primary">Add Branch</a>
        </div>

        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Branch Name</th>
                    <th>Branch Code</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Pincode</th>
                    <th>GST</th>
                    <th>Contact Person</th>
                    <th width="120">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($branches as $branch)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $branch->branch_name }}</td>
                        <td>{{ $branch->branch_code }}</td>
                        <td>{{ $branch->email }}</td>
                        <td>{{ $branch->contact_no }}</td>
                        <td>{{ $branch->address }}</td>
                        <td>{{ $branch->city }}</td>
                        <td>{{ $branch->state }}</td>
                        <td>{{ $branch->pincode }}</td>
                        <td>{{ $branch->gst_number }}</td>
                        <td>{{ $branch->contact_person }}</td>
                        <td>
                            <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-sm btn-warning">✏</a>
                            <form action="{{ route('branches.destroy', $branch->id) }}" method="POST"
                                class="d-inline delete-branch-form">
                                @csrf
                                @method('DELETE')

                                <button type="button" class="btn btn-sm btn-danger delete-btn">
                                    🗑
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const form = this.closest('.delete-branch-form');

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

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        @endif

    });
</script>
