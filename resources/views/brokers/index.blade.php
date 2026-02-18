@extends('admin.partials.app')
@section('main-content')
    <main class="app-main">

        <div class="app-content-header">
            <div class="container-fluid">
                <h3 class="mb-0 text-secondary" style="font-weight: bold;">All Brokers</h3>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                <div class="card card-primary card-outline">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Brokers Table</h3>
                        <a href="{{ route('brokers.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i>
                            Add Broker</a>
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
                                        <td class="text-center">
                                             <a href="{{ route('brokers.edit', $broker->id) }}"
                                                 class="btn btn-sm btn-outline-warning me-1">
                                                 <i class="bi bi-pencil-square"></i>
                                             </a>

                                             <form action="{{ route('brokers.destroy', $broker->id) }}"
                                                 method="POST" class="d-inline-block">
                                                 @csrf
                                                 @method('DELETE')
                                                 <button type="submit" class="btn btn-sm btn-outline-danger"
                                                     onclick="return confirm('Are you sure to delete this broker?')">
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
