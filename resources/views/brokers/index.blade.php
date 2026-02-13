@extends('admin.partials.app')
@section('main-content')
    <main class="app-main">

        <div class="app-content-header">
            <div class="container-fluid">
                <h3>All Brokers</h3>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                <div class="card card-primary card-outline">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Brokers Table</h3>
                        <a href="{{ route('brokers.create') }}" class="btn btn-primary btn-sm">Add Broker</a>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Broker Name</th>
                                    <th>City</th>
                                    <th>Phone No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brokers as $key => $broker)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $broker->broker_name }}</td>
                                        <td>{{ $broker->city }}</td>
                                        <td>{{ $broker->phone_no }}</td>
                                        <td>
                                            <a href="{{ route('brokers.edit', $broker->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>

                                            <form action="{{ route('brokers.destroy', $broker->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Delete this broker?')">Delete</button>
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
