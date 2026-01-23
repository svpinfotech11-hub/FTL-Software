@extends('admin.partials.app')

@section('main-content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">All Vendors</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Vendors</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-primary card-outline mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">Vendors Table</h3>
                                <a href="{{ route('vendors.create') }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-lg"></i> Add New
                                </a>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Vendor Name</th>
                                                <th>Contact</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Pincode</th>
                                                <th>Rate/KG</th>
                                                <th>Minimum KG</th>
                                                <th>Created At</th>
                                                <th style="width: 140px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($vendors as $index => $vendor)
                                                <tr class="align-middle">
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $vendor->vendor_name }}</td>
                                                    <td>{{ $vendor->contact }}</td>
                                                    <td>{{ $vendor->city }}</td>
                                                    <td>{{ $vendor->state }}</td>
                                                    <td>{{ $vendor->pincode }}</td>
                                                    <td>{{ number_format($vendor->rate_per_kg, 2) }}</td>
                                                    <td>{{ number_format($vendor->minimum_kg, 2) }}</td>
                                                    <td>{{ $vendor->created_at->format('d-M-Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('vendors.edit', $vendor->id) }}"
                                                            class="btn btn-sm btn-warning mb-1">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>

                                                        <form class="d-inline delete-vendor-form"
                                                            action="{{ route('vendors.destroy', $vendor->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger mb-1">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>

                                                </tr>
                                            @endforeach

                                            @if ($vendors->isEmpty())
                                                <tr>
                                                    <td colspan="10" class="text-center">No vendors found.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer clearfix">
                                {{ $vendors->links('pagination::bootstrap-5') }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </main>
@endsection
