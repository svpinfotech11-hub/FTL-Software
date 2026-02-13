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
        border: 2px solid #dc3545;
        /* red */
    }

    /* Valid filled field (green) */
    .form-control.required.is-valid,
    .form-select.required.is-valid {
        border: 2px solid #198754;
        /* green */
        box-shadow: none;
    }

    /* Invalid */
    .form-control.required.is-invalid,
    .form-select.required.is-invalid {
        border: 2px solid #dc3545;
        /* red */
    }

    .form-control {
        border: var(--bs-border-width) solid #a9abad;
        border-radius: 0px;
        box-shadow: var(--bs-box-shadow-inset);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
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

                    <div class="card border-primary border-4 shadow-sm">
                        <!-- <div class="card-header bg-success text-white">
                            <h5 class="card-title mb-0">Ledger Details</h5>
                        </div> -->

                        <form action="{{ route('ledgers.store') }}" method="POST" enctype="multipart/form-data" id="ledgerForm">
                            @csrf
                            <div class="card shadow-sm border-0">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">
                                        <i class="bi bi-journal-text me-2"></i> Create New Ledger
                                    </h5>
                                </div>
                                <div class="card-body">

                                    <!-- ===== Ledger & GST Details ===== -->
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-header bg-light border-start border-4 border-primary">
                                            <strong><i class="bi bi-tags me-2"></i> Ledger Info</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Ledger Group</label>
                                                    <input type="text" name="ledger_group" value="{{ old('ledger_group') }}" class="form-control" placeholder="Enter Ledger Group">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">GST No.</label>
                                                    <input type="text" name="gst_no" value="{{ old('gst_no') }}" class="form-control" placeholder="Enter GST No">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ===== Party Details ===== -->
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-header bg-light border-start border-4 border-success">
                                            <strong><i class="bi bi-person-lines-fill me-2"></i> Party Details</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
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
                                                        <option value="Maharashtra">Maharashtra</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row g-3 mt-3">
                                                <div class="col-md-4">
                                                    <label class="form-label">City Name *</label>
                                                    <select name="city_name" class="form-control" required>
                                                        <option value="">Select City</option>
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
                                        </div>
                                    </div>

                                    <!-- ===== Identification Numbers ===== -->
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-header bg-light border-start border-4 border-warning">
                                            <strong><i class="bi bi-credit-card-2-front me-2"></i> Identification</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-3">
                                                    <label>PAN No.</label>
                                                    <input type="text" name="pan_no" value="{{ old('pan_no') }}" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>IEC No.</label>
                                                    <input type="text" name="iec_no" value="{{ old('iec_no') }}" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Aadhar No.</label>
                                                    <input type="text" name="aadhar_no" value="{{ old('aadhar_no') }}" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>R.C. No.</label>
                                                    <input type="text" name="rc_no" value="{{ old('rc_no') }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ===== Contact Details ===== -->
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-header bg-light border-start border-4 border-info">
                                            <strong><i class="bi bi-telephone-fill me-2"></i> Contact</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label>Phone No.</label>
                                                    <input type="text" name="phone_no" value="{{ old('phone_no') }}" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Mobile No.</label>
                                                    <input type="text" name="mobile_no" value="{{ old('mobile_no') }}" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>E-Mail</label>
                                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ===== Opening Balance ===== -->
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-header bg-light border-start border-4 border-secondary">
                                            <strong><i class="bi bi-cash-stack me-2"></i> Opening Balance</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label>Opening Balance</label>
                                                    <input type="number" step="0.01" name="opening_bal" value="{{ old('opening_bal') }}" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Opening Type</label>
                                                    <select name="opening_type" class="form-control">
                                                        <option value="DR">DR</option>
                                                        <option value="CR">CR</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ===== Documents & Uploads ===== -->
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-header bg-light border-start border-4 border-dark">
                                            <strong><i class="bi bi-folder2-open me-2"></i> Documents & Uploads</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-3">
                                                    <label>ARN No.</label>
                                                    <input type="text" name="arn_no" value="{{ old('arn_no') }}" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Exim Code</label>
                                                    <input type="text" name="exim_code" value="{{ old('exim_code') }}" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>PAN Upload</label>
                                                    <input type="file" name="pan_upload" class="form-control mb-1">
                                                    <label>Declaration Upload</label>
                                                    <input type="file" name="declaration_upload" class="form-control mb-1">
                                                    <label>Aadhar Upload</label>
                                                    <input type="file" name="aadhar_upload" class="form-control mb-1">
                                                    <label>GST Upload</label>
                                                    <input type="file" name="gst_upload" class="form-control mb-1">
                                                    <label>Office Photo</label>
                                                    <input type="file" name="office_photo" class="form-control mb-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ===== Bank Details ===== -->
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-header bg-light border-start border-4 border-success">
                                            <strong><i class="bi bi-bank me-2"></i> Bank Details</strong>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-3">
                                                    <label>Bank Name</label>
                                                    <input type="text" name="bank_name" value="{{ old('bank_name') }}" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Account No.</label>
                                                    <input type="text" name="account_no" value="{{ old('account_no') }}" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>Branch Name</label>
                                                    <input type="text" name="branch_name" value="{{ old('branch_name') }}" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>IFSC Code</label>
                                                    <input type="text" name="ifsc_code" value="{{ old('ifsc_code') }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Form Footer -->
                                <div class="card-footer text-end bg-light">
                                    <a href="{{ route('ledgers.index') }}" class="btn btn-outline-secondary me-2">
                                        <i class="bi bi-arrow-left-circle me-1"></i> Back
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle me-1"></i> Create Ledger
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</main>


<script>
    document.addEventListener('DOMContentLoaded', function() {

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
            field.addEventListener('input', function() {
                validateField(field);
            });

            field.addEventListener('change', function() {
                validateField(field);
            });
        });

    });
</script>

@endsection