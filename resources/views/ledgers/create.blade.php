@extends('admin.partials.app')

@section('main-content')

<style>
    .form-control:focus {
        color: var(--bs-body-color);
        background-color: var(--bs-body-bg);
        outline: 0;
        box-shadow: var(--bs-box-shadow-inset), 0 0 0 0.25rem rgb(242 243 244 / 25%);
    }
    /* Required field default (red) */
    .form-control.required,
    .form-select.required {
        border: 2px solid #dc3545; /* red */
    }

    /* Valid filled field (green) */
    .form-control.required.is-valid,
    .form-select.required.is-valid {
        border: 2px solid #198754; /* green */
        box-shadow: none;
    }

    /* Invalid */
    .form-control.required.is-invalid,
    .form-select.required.is-invalid {
        border: 2px solid #dc3545; /* red */
    }

</style>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-success">Create Ledger</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('ledgers.index') }}">Home</a></li>
                        <li class="breadcrumb-item active text-success">Create Ledger</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card border-success shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title mb-0">Ledger Details</h5>
                        </div>

                        <form action="{{ route('ledgers.store') }}" method="POST" enctype="multipart/form-data" id="ledgerForm">
                            @csrf
                            <div class="card-body">

                                <!-- Row 1: Ledger Group & GST -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Ledger Group</label>
                                        <input type="text" name="ledger_group" value="{{ old('ledger_group') }}" class="form-control" placeholder="Enter Ledger Group">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">GST No.</label>
                                        <input type="text" name="gst_no" value="{{ old('gst_no') }}" class="form-control" placeholder="Enter GST No">
                                    </div>
                                </div>

                                <!-- Row 2: Party Details -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Party Name *</label>
                                        <input type="text" name="party_name" value="{{ old('party_name') }}" class="form-control" placeholder="Enter Party Name" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Party Alias</label>
                                        <input type="text" name="party_alias" value="{{ old('party_alias') }}" class="form-control" placeholder="Enter Party Alias">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">State Name *</label>
                                        <select name="state_name" class="form-control" required>
                                            <option value="">Select State</option>
                                            <!-- Add options dynamically if needed -->
                                            <option value="Maharashtra">Maharashtra</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Row 3: City & Address -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">City Name *</label>
                                        <select name="city_name" class="form-control" required>
                                            <option value="">Select City</option>
                                            <!-- Add options dynamically -->
                                            <option value="Mumbai">Mumbai</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Address 1</label>
                                        <input type="text" name="address1" value="{{ old('address1') }}" class="form-control" placeholder="Enter Address 1">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Address 2</label>
                                        <input type="text" name="address2" value="{{ old('address2') }}" class="form-control" placeholder="Enter Address 2">
                                    </div>
                                </div>

                                <!-- Row 4: Identification Numbers -->
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">PAN No.</label>
                                        <input type="text" name="pan_no" value="{{ old('pan_no') }}" class="form-control" placeholder="Enter PAN No">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">IEC No.</label>
                                        <input type="text" name="iec_no" value="{{ old('iec_no') }}" class="form-control" placeholder="Enter IEC No">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Aadhar No.</label>
                                        <input type="text" name="aadhar_no" value="{{ old('aadhar_no') }}" class="form-control" placeholder="Enter Aadhar No">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">R.C. No.</label>
                                        <input type="text" name="rc_no" value="{{ old('rc_no') }}" class="form-control" placeholder="Enter R.C. No">
                                    </div>
                                </div>

                                <!-- Row 5: Contact -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Phone No.</label>
                                        <input type="text" name="phone_no" value="{{ old('phone_no') }}" class="form-control" placeholder="Enter Phone No">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Mobile No.</label>
                                        <input type="text" name="mobile_no" value="{{ old('mobile_no') }}" class="form-control" placeholder="Enter Mobile No">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">E-Mail</label>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter Email Address">
                                    </div>
                                </div>

                                <!-- Row 6: Opening Balance -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Opening Balance</label>
                                        <input type="number" step="0.01" name="opening_bal" value="{{ old('opening_bal') }}" class="form-control" placeholder="Enter Opening Balance">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Opening Type</label>
                                        <select name="opening_type" class="form-control">
                                            <option value="DR">DR</option>
                                            <option value="CR">CR</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Row 7: Other IDs & File Uploads -->
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">ARN No.</label>
                                        <input type="text" name="arn_no" value="{{ old('arn_no') }}" class="form-control" placeholder="Enter ARN No">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Exim Code</label>
                                        <input type="text" name="exim_code" value="{{ old('exim_code') }}" class="form-control" placeholder="Enter Exim Code">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">PAN Upload</label>
                                        <input type="file" name="pan_upload" class="form-control">
                                        <label class="form-label">Declaration Upload</label>
                                        <input type="file" name="declaration_upload" class="form-control mt-1">
                                        <label class="form-label">Aadhar Upload</label>
                                        <input type="file" name="aadhar_upload" class="form-control mt-1">
                                        <label class="form-label">GST Upload</label>
                                        <input type="file" name="gst_upload" class="form-control mt-1">
                                        <label class="form-label">Office Photo</label>
                                        <input type="file" name="office_photo" class="form-control mt-1">
                                    </div>
                                </div>

                                <!-- Row 8: Bank Details -->
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Bank Name</label>
                                        <input type="text" name="bank_name" value="{{ old('bank_name') }}" class="form-control" placeholder="Enter Bank Name">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Account No.</label>
                                        <input type="text" name="account_no" value="{{ old('account_no') }}" class="form-control" placeholder="Enter Account No">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Branch Name</label>
                                        <input type="text" name="branch_name" value="{{ old('branch_name') }}" class="form-control" placeholder="Enter Branch Name">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">IFSC Code</label>
                                        <input type="text" name="ifsc_code" value="{{ old('ifsc_code') }}" class="form-control" placeholder="Enter IFSC Code">
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer text-end bg-light">
                                <a href="{{ route('ledgers.index') }}" class="btn btn-outline-secondary me-2">Back</a>
                                <button type="submit" class="btn btn-success">Create Ledger</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const requiredFields = document.querySelectorAll('.required');

    function validateField(field) {
        if (field.value.trim() !== '') {
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');
        } else {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
        }
    }

    requiredFields.forEach(field => {

        // Initial check
        validateField(field);

        // Live validation
        field.addEventListener('input', function () {
            validateField(field);
        });

        field.addEventListener('change', function () {
            validateField(field);
        });
    });

});
</script>

@endsection
