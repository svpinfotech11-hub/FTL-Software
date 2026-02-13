@extends('admin.partials.app')
@section('main-content')
    <main class="app-main">

        <!-- Header -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Edit Brokers</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Brokers</li>
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
                        <div class="card-title">Edit Broker</div>
                    </div>
                    <form action="{{ route('brokers.update', $broker->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row g-3 mt-3">
                                <div class="col-md-4">
                                    <label>Broker Name *</label>
                                    <input type="text" name="broker_name" value="{{ $broker->broker_name }}"
                                        class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label>GST No</label>
                                    <input type="text" name="gst_no" value="{{ $broker->gst_no }}" class="form-control">
                                </div>
                                 <div class="col-md-4">
                                    <label>Address 1</label>
                                    <input type="text" name="address1" value="{{ $broker->address1 }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row g-3 mt-3">
                                <div class="col-md-4">
                                    <label>Address 2</label>
                                    <input type="text" name="address2" value="{{ $broker->address2 }}"
                                        class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>State</label>
                                    <input type="text" name="state" value="{{ $broker->state }}" class="form-control">
                                </div>
                                 <div class="col-md-4">
                                    <label>City</label>
                                    <input type="text" name="city" value="{{ $broker->city }}" class="form-control">
                                </div>
                            </div>
                            <div class="row g-3 mt-3">
                                <div class="col-md-4">
                                    <label>Phone No</label>
                                    <input type="text" name="phone_no" value="{{ $broker->phone_no }}"
                                        class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="card-footer text-end">
                                <button class="btn btn-primary">Update Broker</button>
                                <a href="{{ route('brokers.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
