@extends('admin.partials.app')

@section('main-content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header fw-bold">Edit Branch</div>

            <div class="card-body">
                <form action="{{ route('branches.update', $branch->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">Name:</label>
                        <div class="col-md-4">
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $branch->name) }}">
                        </div>

                        <label class="col-md-2 col-form-label">Email:</label>
                        <div class="col-md-4">
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $branch->email) }}">
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">Address:</label>
                        <div class="col-md-4">
                            <input type="text" name="address" class="form-control"
                                value="{{ old('address', $branch->address) }}">
                        </div>

                        <label class="col-md-2 col-form-label">State:</label>
                        <div class="col-md-4">
                            <select name="state" class="form-control form-select state-select">
                                <option value="">Select State</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->city_state }}"
                                        {{ $branch->state == $state->city_state ? 'selected' : '' }}>
                                        {{ $state->city_state }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">City Name:</label>
                        <div class="col-md-4">
                            <select name="city" class="form-control form-select city-select">
                                <option value="{{ $branch->city }}">{{ $branch->city }}</option>
                            </select>
                        </div>

                        <label class="col-md-2 col-form-label">Pincode:</label>
                        <div class="col-md-4">
                            <input type="text" name="pincode" class="form-control"
                                value="{{ old('pincode', $branch->pincode) }}">
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">GST Number:</label>
                        <div class="col-md-4">
                            <input type="text" name="gst_number" class="form-control"
                                value="{{ old('gst_number', $branch->gst_number) }}">
                        </div>

                        <label class="col-md-2 col-form-label">Contact No:</label>
                        <div class="col-md-4">
                            <input type="text" name="contact_no" class="form-control"
                                value="{{ old('contact_no', $branch->contact_no) }}">
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">Contact Person:</label>
                        <div class="col-md-4">
                            <input type="text" name="contact_person" class="form-control"
                                value="{{ old('contact_person', $branch->contact_person) }}">
                        </div>

                        <label class="col-md-2 col-form-label">Branch Code:</label>
                        <div class="col-md-4">
                            <input type="text" name="branch_code" class="form-control bg-light"
                                value="{{ $branch->branch_code }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">Account Name:</label>
                        <div class="col-md-4">
                            <input type="text" name="account_name" class="form-control"
                                value="{{ old('account_name', $branch->account_name) }}">
                        </div>

                        <label class="col-md-2 col-form-label">Account Number:</label>
                        <div class="col-md-4">
                            <input type="text" name="account_number" class="form-control"
                                value="{{ old('account_number', $branch->account_number) }}">
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">IFSC:</label>
                        <div class="col-md-4">
                            <input type="text" name="ifsc" class="form-control"
                                value="{{ old('ifsc', $branch->ifsc) }}">
                        </div>

                        <label class="col-md-2 col-form-label">Branch Name:</label>
                        <div class="col-md-4">
                            <input type="text" name="branch_name" class="form-control"
                                value="{{ old('branch_name', $branch->branch_name) }}">
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">Warehouse Branch Name:</label>
                        <div class="col-md-4">
                            <input type="text" name="warehouse_branch_name" class="form-control"
                                value="{{ old('warehouse_branch_name', $branch->warehouse_branch_name) }}">
                        </div>

                        <label class="col-md-2 col-form-label">Account Bank Name:</label>
                        <div class="col-md-4">
                            <input type="text" name="account_bank_name" class="form-control"
                                value="{{ old('account_bank_name', $branch->account_bank_name) }}">
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">PAN:</label>
                        <div class="col-md-4">
                            <input type="text" name="pan" class="form-control"
                                value="{{ old('pan', $branch->pan) }}">
                        </div>

                        <label class="col-md-2 col-form-label">Export International Invoice Series:</label>
                        <div class="col-md-4">
                            <input type="text" name="export_invoice_series" class="form-control"
                                value="{{ old('export_invoice_series', $branch->export_invoice_series) }}">
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">Import International Invoice Series:</label>
                        <div class="col-md-4">
                            <input type="text" name="import_invoice_series" class="form-control"
                                value="{{ old('import_invoice_series', $branch->import_invoice_series) }}">
                        </div>

                        <label class="col-md-2 col-form-label">Domestic Invoice Series:</label>
                        <div class="col-md-4">
                            <input type="text" name="domestic_invoice_series" class="form-control"
                                value="{{ old('domestic_invoice_series', $branch->domestic_invoice_series) }}">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label class="col-md-2 col-form-label">Domestic Booking Series:</label>
                        <div class="col-md-4">
                            <input type="text" name="domestic_booking_series" class="form-control"
                                value="{{ old('domestic_booking_series', $branch->domestic_booking_series) }}">
                        </div>

                        <label class="col-md-2 col-form-label">Domestic POD Series:</label>
                        <div class="col-md-4">
                            <input type="text" name="domestic_pod_series" class="form-control"
                                value="{{ old('domestic_pod_series', $branch->domestic_pod_series) }}">
                        </div>
                    </div>

                    <button class="btn btn-primary">Update Branch</button>
                </form>
            </div>
        </div>

    </div>
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
