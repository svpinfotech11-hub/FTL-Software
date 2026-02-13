@extends('admin.partials.app')
@section('main-content')
    <main class="app-main">

        <!-- Header -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Create Brokers</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Create Brokers</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="app-content">
            <div class="container-fluid">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header">
                        <div class="card-title">Add Broker</div>
                    </div>
                    <form action="{{ route('brokers.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row g-3 mt-3">
                                <div class="col-md-4">
                                    <label>Broker Name *</label>
                                    <input type="text" name="broker_name" value="{{ old('broker_name') }}"
                                        class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label>GST No</label>
                                    <input type="text" name="gst_no" value="{{ old('gst_no') }}" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>Address 1</label>
                                    <textarea name="address1" class="form-control">{{ old('address1') }}</textarea>
                                </div>
                            </div>
                            <div class="row g-3 mt-3">
                                <div class="col-md-4">
                                    <label>Address 2</label>
                                    <textarea name="address2" class="form-control">{{ old('address2') }}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label>State</label>
                                    <input type="text" name="state" value="{{ old('state') }}" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>City</label>
                                    <input type="text" name="city" value="{{ old('city') }}" class="form-control">
                                </div>
                            </div>
                            <div class="row g-3 mt-3">
                                <div class="col-md-4">
                                    <label>Phone No</label>
                                    <input type="text" name="phone_no" value="{{ old('phone_no') }}"
                                        class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="card-footer text-end">
                                <button class="btn btn-success">Save Broker</button>
                                <a href="{{ route('brokers.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
