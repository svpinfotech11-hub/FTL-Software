@extends('admin.partials.app')
@section('main-content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0 text-success">Loading Challans List</h3>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('loading-challan.create') }}" class="btn btn-success float-sm-end">
                            + Create Loading Challan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card border-success shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Loading Challans</h5>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-hover datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Challan No</th>
                                    <th>Vehicle No</th>
                                    <th>Broker</th>
                                    <th>Driver</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($challans as $c)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $c->challan_no }}</td>
                                        <td>{{ $c->vehicle_no }}</td>
                                        <td>{{ $c->broker->broker_name ?? '' }}</td>
                                        <td>{{ $c->driver->name ?? '' }}</td>
                                        <td>
                                            <a href="{{ route('loading-challan.edit', $c->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>

                                            <form action="{{ route('loading-challan.destroy', $c->id) }}" method="POST"
                                                style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
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
