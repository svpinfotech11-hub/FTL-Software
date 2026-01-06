@extends('admin.partials.app')
@section('main-content')
    <main class="app-main">

        <div class="app-content-header">
            <div class="container-fluid">
                <h3>Driver Expenses</h3>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                <div class="card card-primary card-outline">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Expenses Table</h3>
                        <a href="{{ route('add-expenses.create') }}" class="btn btn-primary btn-sm">Add Expense</a>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Driver</th>
                                    <th>Vehicle</th>
                                    <th>Expense Type</th>
                                    <th>Amount</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($expenses as $key => $expense)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $expense->expense_date }}</td>
                                        <td>{{ $expense->driver->name }}</td>
                                        <td>{{ $expense->vehicle_no }}</td>
                                        <td>{{ $expense->expense_type }}</td>
                                        <td>{{ $expense->amount }}</td>
                                        <td>
                                            <a href="{{ route('add-expenses.edit', $expense->id) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('add-expenses.destroy', $expense->id) }}" method="POST"
                                                class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button" class="btn btn-sm btn-danger delete-btn">
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
    </main>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                let form = this.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
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
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif

    });
</script>
