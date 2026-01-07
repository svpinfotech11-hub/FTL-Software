@extends('admin.partials.app')
@section('main-content')
    <main class="app-main">

        <div class="app-content-header">
            <div class="container-fluid">
                <h3>Edit Driver</h3>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="card-title">Update Driver</div>
                    </div>

                    <form method="POST" action="{{ route('drivers.update', $driver->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="row g-3">

                                @foreach ([
            'name' => 'Driver Name',
            'father_name' => 'Father',
            'mother_name' => 'Mother',
            'mobile' => 'Mobile',
            'mobile_alt' => 'Mobile Alt',
            'salary' => 'Salary',
            'licence_no' => 'Licence No',
            'city' => 'City',
            'state' => 'State',
            'pincode' => 'Pincode',
        ] as $field => $label)
                                    <div class="col-md-4">
                                        <label class="form-label">{{ $label }}</label>
                                        <input type="text" name="{{ $field }}" class="form-control"
                                            value="{{ old($field, $driver->$field) }}">
                                    </div>
                                @endforeach

                                <div class="col-md-4">
                                    <label>Licence Exp</label>
                                    <input type="date" name="licence_exp" class="form-control datepicker"
                                        placeholder="YYYY-MM-DD"
                                        value="{{ old('licence_exp', optional($driver->licence_exp)->format('Y-m-d')) }}">
                                </div>

                                <div class="col-md-4">
                                    <label>Joining Date</label>
                                    <input type="date" name="joining_date" class="form-control datepicker"
                                        placeholder="YYYY-MM-DD"
                                        value="{{ old('joining_date', optional($driver->joining_date)->format('Y-m-d')) }}">
                                </div>

                                <div class="col-md-4">
                                    <label>Leaving Date</label>
                                    <input type="date" name="leaving_date" class="form-control datepicker"
                                        placeholder="YYYY-MM-DD"
                                        value="{{ old('leaving_date', optional($driver->leaving_date)->format('Y-m-d')) }}">
                                </div>

                                <div class="col-md-12">
                                    <label>Address</label>
                                    <textarea name="address" class="form-control">{{ old('address', $driver->address) }}</textarea>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <a href="{{ route('drivers.index') }}" class="btn btn-outline-secondary">Back</a>
                            <button class="btn btn-primary">Update Driver</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
