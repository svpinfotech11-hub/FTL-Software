@extends('admin.partials.app')
@section('main-content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Loading Challan</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('loading-challan.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Create Loading Challan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">Loading Challan List</div>
                        <a href="{{ route('loading-challan.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Add Loading
                            Challan</a>
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
                                        <td class="text-center">
                                            <a href="{{ route('loading-challan.edit', $c->id) }}"
                                                class="btn btn-sm btn-outline-warning me-1">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form action="{{ route('loading-challan.destroy', $c->id) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Are you sure to delete this loading challan?')">
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
