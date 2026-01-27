@extends('admin.partials.app')
@section('main-content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">All Vehicles</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Vehicles</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Vehicles Table</h3>
                        <a href="{{ route('vehicles.create') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-plus-lg"></i> Add Vehicle
                        </a>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vehicle No</th>
                                    <th>Model</th>
                                    <th>PUC</th>
                                    <th>Fitness</th>
                                    <th>Permit</th>
                                    <th>Insurance</th>
                                    <th>Capacity</th>
                                    <th width="130">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehicles as $key => $vehicle)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $vehicle->vehicle_number }}</td>
                                        <td>{{ $vehicle->vehicle_model }}</td>
                                        <td>{{ $vehicle->vehicle_puc_date }}</td>
                                        <td>{{ $vehicle->vehicle_fitness_exp_date }}</td>
                                        <td>{{ $vehicle->vehicle_permit_renewal_date }}</td>
                                        <td>{{ $vehicle->vehicle_insurance_renew_date }}</td>
                                        <td>{{ $vehicle->vehicle_capacity }}</td>
                                        <td>
                                            <a href="{{ route('vehicles.edit', $vehicle->id) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST"
                                                class="d-inline delete-vehicle-form">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger delete-btn">
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

