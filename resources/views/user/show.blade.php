@extends('admin.partials.app')

@section('main-content')
    <main class="app-main">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Profile</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Contact</label>
                                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Country</label>
                                <input type="text" name="country" class="form-control" value="{{ $user->country }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>State</label>
                                <input type="text" name="state" class="form-control" value="{{ $user->state }}">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" value="{{ $user->city }}">
                            </div>
                        </div>

                        <hr>

                        <h5>Change Password</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>New Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>

                        <button class="btn btn-success">Update Profile</button>
                        <a href="{{ route('profile.show') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    @endsection
