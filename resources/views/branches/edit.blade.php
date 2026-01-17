@extends('admin.partials.app')

@section('main-content')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Edit Branch</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Branch</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">
                    <div class="col-md-12">

                        <div class="card card-primary card-outline mb-4">
                            <div class="card-header">
                                <div class="card-title">Branch Details</div>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger m-3">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success m-3">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('branches.update', $branch->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card-body">
                                    <div class="row mb-3 align-items-center">
                                        <label class="col-md-2 col-form-label">Name</label>
                                        <div class="col-md-4">
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name', $branch->name) }}">
                                        </div>

                                        <label class="col-md-2 col-form-label">Email</label>
                                        <div class="col-md-4">
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email', $branch->email) }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <label class="col-md-2 col-form-label">Address</label>
                                        <div class="col-md-4">
                                            <input type="text" name="address" class="form-control"
                                                value="{{ old('address', $branch->address) }}">
                                        </div>

                                        <label class="col-md-2 col-form-label">State</label>
                                        <div class="col-md-4">
                                            <select name="state" class="form-select state-select">
                                                <option value="">Select State</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->city_state }}"
                                                        {{ old('state', $branch->state) == $state->city_state ? 'selected' : '' }}>
                                                        {{ $state->city_state }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <label class="col-md-2 col-form-label">City</label>
                                        <div class="col-md-4">
                                            <select name="city" class="form-select city-select">
                                                <option value="{{ $branch->city }}">{{ $branch->city }}</option>
                                            </select>
                                        </div>

                                        <label class="col-md-2 col-form-label">Pincode</label>
                                        <div class="col-md-4">
                                            <input type="text" name="pincode" class="form-control"
                                                value="{{ old('pincode', $branch->pincode) }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <label class="col-md-2 col-form-label">GST Number</label>
                                        <div class="col-md-4">
                                            <input type="text" name="gst_number" class="form-control"
                                                value="{{ old('gst_number', $branch->gst_number) }}">
                                        </div>

                                        <label class="col-md-2 col-form-label">Contact No</label>
                                        <div class="col-md-4">
                                            <input type="text" name="contact_no" class="form-control"
                                                value="{{ old('contact_no', $branch->contact_no) }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <label class="col-md-2 col-form-label">Contact Person</label>
                                        <div class="col-md-4">
                                            <input type="text" name="contact_person" class="form-control"
                                                value="{{ old('contact_person', $branch->contact_person) }}">
                                        </div>

                                        <label class="col-md-2 col-form-label">Branch Code</label>
                                        <div class="col-md-4">
                                            <input type="text" name="branch_code" class="form-control"
                                                value="{{ $branch->branch_code }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <label class="col-md-2 col-form-label">Account Name</label>
                                        <div class="col-md-4">
                                            <input type="text" name="account_name" class="form-control"
                                                value="{{ old('account_name', $branch->account_name) }}">
                                        </div>

                                        <label class="col-md-2 col-form-label">Account Number</label>
                                        <div class="col-md-4">
                                            <input type="text" name="account_number" class="form-control"
                                                value="{{ old('account_number', $branch->account_number) }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <label class="col-md-2 col-form-label">IFSC</label>
                                        <div class="col-md-4">
                                            <input type="text" name="ifsc" class="form-control"
                                                value="{{ old('ifsc', $branch->ifsc) }}">
                                        </div>

                                        <label class="col-md-2 col-form-label">Branch Name</label>
                                        <div class="col-md-4">
                                            <input type="text" name="branch_name" class="form-control"
                                                value="{{ old('branch_name', $branch->branch_name) }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <label class="col-md-2 col-form-label">Warehouse Branch</label>
                                        <div class="col-md-4">
                                            <input type="text" name="warehouse_branch_name" class="form-control"
                                                value="{{ old('warehouse_branch_name', $branch->warehouse_branch_name) }}">
                                        </div>

                                        <label class="col-md-2 col-form-label">Bank Name</label>
                                        <div class="col-md-4">
                                            <input type="text" name="account_bank_name" class="form-control"
                                                value="{{ old('account_bank_name', $branch->account_bank_name) }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <label class="col-md-2 col-form-label">PAN</label>
                                        <div class="col-md-4">
                                            <input type="text" name="pan" class="form-control"
                                                value="{{ old('pan', $branch->pan) }}">
                                        </div>

                                        <label class="col-md-2 col-form-label">Export Invoice Series</label>
                                        <div class="col-md-4">
                                            <input type="text" name="export_invoice_series" class="form-control"
                                                value="{{ old('export_invoice_series', $branch->export_invoice_series) }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <label class="col-md-2 col-form-label">Import Invoice Series</label>
                                        <div class="col-md-4">
                                            <input type="text" name="import_invoice_series" class="form-control"
                                                value="{{ old('import_invoice_series', $branch->import_invoice_series) }}">
                                        </div>

                                        <label class="col-md-2 col-form-label">Domestic Invoice Series</label>
                                        <div class="col-md-4">
                                            <input type="text" name="domestic_invoice_series" class="form-control"
                                                value="{{ old('domestic_invoice_series', $branch->domestic_invoice_series) }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-center">
                                        <label class="col-md-2 col-form-label">Domestic Booking Series</label>
                                        <div class="col-md-4">
                                            <input type="text" name="domestic_booking_series" class="form-control"
                                                value="{{ old('domestic_booking_series', $branch->domestic_booking_series) }}">
                                        </div>

                                        <label class="col-md-2 col-form-label">Domestic POD Series</label>
                                        <div class="col-md-4">
                                            <input type="text" name="domestic_pod_series" class="form-control"
                                                value="{{ old('domestic_pod_series', $branch->domestic_pod_series) }}">
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer text-end">
                                    <a href="{{ route('branches.index') }}" class="btn btn-outline-secondary me-2">
                                        Back
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        Update Branch
                                    </button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('change', '.state-select', function() {

        let state = $(this).val();
        let cityDropdown = $('.city-select');

        if (state === '') {
            cityDropdown.html('<option value="">Select City</option>');
            return;
        }

        cityDropdown.html('<option value="">Loading...</option>');

        $.ajax({
            url: "{{ url('/get-cities') }}/" + encodeURIComponent(state),
            type: 'GET',
            success: function(response) {

                cityDropdown.empty()
                    .append('<option value="">Select City</option>');

                $.each(response, function(i, city) {
                    cityDropdown.append(
                        '<option value="' + city.city_name + '">' +
                        city.city_name +
                        '</option>'
                    );
                });
            }
        });
    });
</script>
