@extends('admin.partials.app')

@section('main-content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Edit Profile</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item active">Edit Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card card-primary card-outline mb-4">

                    <div class="card-header">
                        <div class="card-title">User Profile</div>
                    </div>
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf

                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                </div>

                                <div class="col-md-4">
                                    <label>Contact</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                                </div>

                                <div class="col-md-4">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                                </div>

                                <div class="col-md-4">
                                    <label>Address</label>
                                    <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                                </div>

                                <div class="col-md-4">
                                    <label>Country</label>
                                    <input type="text" name="country" class="form-control" value="{{ $user->country }}">
                                </div>

                                <div class="col-md-4">
                                    <label>State</label>
                                    <input type="text" name="state" class="form-control" value="{{ $user->state }}">
                                </div>

                                <div class="col-md-4">
                                    <label>City</label>
                                    <input type="text" name="city" class="form-control" value="{{ $user->city }}">
                                </div>
                            </div>

                           <br>

                            <div class="card-footer text-end">
                                <button class="btn btn-primary">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
