@extends('admin.partials.app')

@section('main-content')
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">All Customer</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Customer</li>
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
                            <h3 class="card-title mb-0">Customer Table</h3>
                            <a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-lg"></i> Add New
                            </a>
                        </div>


                        <div class="card-body">
                            <!-- Add table-responsive wrapper -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Customer Code</th>
                                            <th>Customer Name</th>
                                            <th>Contact Person</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Pincode</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>GST No</th>
                                            <th>GST Charges</th>
                                            <th>Credit Days</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                            <th style="width: 120px">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customers as $index => $customer)
                                        <tr class="align-middle">
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $customer->customer_code }}</td>
                                            <td>{{ $customer->customer_name }}</td>
                                            <td>{{ $customer->contact_person }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->address }}</td>
                                            <td>{{ $customer->pincode }}</td>
                                            <td>{{ $customer->city }}</td>
                                            <td>{{ $customer->state }}</td>
                                            <td>{{ $customer->gst_no }}</td>
                                            <td>
                                                @if($customer->gst_charges)
                                                Yes
                                                @else
                                                No
                                                @endif
                                            </td>
                                            <td>{{ $customer->credit_days }}</td>
                                            <td>{{ optional($customer->user)->name }}</td> <!-- Created by -->
                                            <td>{{ $customer->created_at->format('d-M-Y') }}</td>
                                            <td>
                                                <form class="delete-customer-form" action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach

                                        @if($customers->isEmpty())
                                        <tr>
                                            <td colspan="16" class="text-center">No customers found.</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>

                            </div>
                            <!-- /.table-responsive -->
                        </div>

                        <div class="card-footer clearfix">
                            {{ $customers->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</main>
@endsection