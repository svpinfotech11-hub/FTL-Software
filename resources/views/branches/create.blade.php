@extends('admin.partials.app')

@section('main-content')
    <div class="container-fluid">

        <div class="card">
            <div class="card-header fw-bold">Add Branch</div>

            <div class="card-body">
                <form action="{{ route('branches.store') }}" method="POST">
                    @csrf

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">Name:</label>
                        <div class="col-md-4">
                            <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>

                        <label class="col-md-2 col-form-label">Email:</label>
                        <div class="col-md-4">
                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">Address:</label>
                        <div class="col-md-4">
                            <input type="text" name="address" class="form-control" placeholder="Enter Address">
                        </div>

                        <label class="col-md-2 col-form-label">State:</label>
                        <div class="col-md-4">
                            <select name="state" class="form-control form-select state-select">
                                <option value="">Select State</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->city_state }}">
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
                                <option value="">Select City</option>
                            </select>

                        </div>

                        <label class="col-md-2 col-form-label">Pincode:</label>
                        <div class="col-md-4">
                            <input type="text" name="pincode" class="form-control" placeholder="Enter Pincode">
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">GST Number:</label>
                        <div class="col-md-4">
                            <input type="text" name="gst_number" class="form-control" placeholder="Enter GST No">
                        </div>

                        <label class="col-md-2 col-form-label">Contact No:</label>
                        <div class="col-md-4">
                            <input type="text" name="contact_no" class="form-control" placeholder="Enter Contact No">
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">Contact Person:</label>
                        <div class="col-md-4">
                            <input type="text" name="contact_person" class="form-control"
                                placeholder="Enter Contact Person">
                        </div>

                        <label class="col-md-2 col-form-label">Branch Code:</label>
                        <div class="col-md-4">
                            <input type="text" name="branch_code" class="form-control bg-light"
                                value="{{ $branchCode }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">Account Name:</label>
                        <div class="col-md-4">
                            <input type="text" name="account_name" class="form-control" placeholder="Account Name">
                        </div>

                        <label class="col-md-2 col-form-label">Account Number:</label>
                        <div class="col-md-4">
                            <input type="text" name="account_number" class="form-control" placeholder="Account Number">
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">IFSC:</label>
                        <div class="col-md-4">
                            <input type="text" name="ifsc" class="form-control" placeholder="Enter IFSC">
                        </div>

                        <label class="col-md-2 col-form-label">Branch Name:</label>
                        <div class="col-md-4">
                            <input type="text" name="branch_name" class="form-control" placeholder="Enter Branch Name">
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">Warehouse Branch Name:</label>
                        <div class="col-md-4">
                            <input type="text" name="warehouse_branch_name" class="form-control"
                                placeholder="Enter Warehouse Branch Name">
                        </div>

                        <label class="col-md-2 col-form-label">Account Bank Name:</label>
                        <div class="col-md-4">
                            <input type="text" name="account_bank_name" class="form-control"
                                placeholder="Enter Bank Name">
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">PAN:</label>
                        <div class="col-md-4">
                            <input type="text" name="pan" class="form-control" placeholder="Enter PAN Id">
                        </div>

                        <label class="col-md-2 col-form-label">Export International Invoice Series:</label>
                        <div class="col-md-4">
                            <input type="text" name="export_invoice_series" class="form-control"
                                placeholder="Enter Invoice Series">
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <label class="col-md-2 col-form-label">Import International Invoice Series:</label>
                        <div class="col-md-4">
                            <input type="text" name="import_invoice_series" class="form-control"
                                placeholder="Enter Invoice Series">
                        </div>

                        <label class="col-md-2 col-form-label">Domestic Invoice Series:</label>
                        <div class="col-md-4">
                            <input type="text" name="domestic_invoice_series" class="form-control"
                                placeholder="Enter Invoice Series">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label class="col-md-2 col-form-label">Domestic Booking Series:</label>
                        <div class="col-md-4">
                            <input type="text" name="domestic_booking_series" class="form-control"
                                placeholder="Enter Booking Series">
                        </div>

                        <label class="col-md-2 col-form-label">Domestic POD Series:</label>
                        <div class="col-md-4">
                            <input type="text" name="domestic_pod_series" class="form-control"
                                placeholder="Enter POD Series">
                        </div>
                    </div>

                    <button class="btn btn-primary">Add Branch</button>
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

                if (response.length === 0) {
                    cityDropdown.append('<option value="">No City Found</option>');
                }

                $.each(response, function(i, city) {
                    cityDropdown.append(
                        '<option value="' + city.city_name + '">' +
                        city.city_name +
                        '</option>'
                    );
                });
            },
            error: function() {
                alert('City loading failed');
            }
        });
    });
</script>
