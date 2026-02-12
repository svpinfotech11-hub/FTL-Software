@extends('admin.partials.app')

@section('main-content')

<style>
    /* Required field default (red) */
    .form-control.required,
    .form-select.required {
        border: 2px solid #dc3545;
    }

    /* Valid (green) */
    .form-control.required.is-valid,
    .form-select.required.is-valid {
        border: 2px solid #198754;
        box-shadow: none;
    }

    /* Invalid (red) */
    .form-control.required.is-invalid,
    .form-select.required.is-invalid {
        border: 2px solid #dc3545;
    }
</style>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-success">Edit Ledger</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('ledgers.index') }}">Ledgers</a>
                        </li>
                        <li class="breadcrumb-item active text-success">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

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
                    <h5 class="mb-0">Update Ledger</h5>
                </div>

                <form action="{{ route('ledgers.update', $ledger->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    id="ledgerEditForm">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <!-- ================= BASIC DETAILS ================= -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Party Name <span class="text-danger">*</span></label>
                                <input type="text" name="party_name"
                                    value="{{ old('party_name', $ledger->party_name) }}"
                                    class="form-control required" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Ledger Group</label>
                                <input type="text" name="ledger_group"
                                    value="{{ old('ledger_group', $ledger->ledger_group) }}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Party Alias</label>
                                <input type="text" name="party_alias"
                                    value="{{ old('party_alias', $ledger->party_alias) }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">GST No</label>
                                <input type="text" name="gst_no"
                                    value="{{ old('gst_no', $ledger->gst_no) }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">PAN No</label>
                                <input type="text" name="pan_no"
                                    value="{{ old('pan_no', $ledger->pan_no) }}"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- ================= ADDRESS ================= -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Address 1</label>
                                <input type="text" name="address1"
                                    value="{{ old('address1', $ledger->address1) }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Address 2</label>
                                <input type="text" name="address2"
                                    value="{{ old('address2', $ledger->address2) }}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">State <span class="text-danger">*</span></label>
                                <input type="text" name="state_name"
                                    value="{{ old('state_name', $ledger->state_name) }}"
                                    class="form-control required" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">City <span class="text-danger">*</span></label>
                                <input type="text" name="city_name"
                                    value="{{ old('city_name', $ledger->city_name) }}"
                                    class="form-control required" required>
                            </div>
                        </div>

                        <!-- ================= CONTACT ================= -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Phone No</label>
                                <input type="text" name="phone_no"
                                    value="{{ old('phone_no', $ledger->phone_no) }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Mobile No</label>
                                <input type="text" name="mobile_no"
                                    value="{{ old('mobile_no', $ledger->mobile_no) }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email"
                                    value="{{ old('email', $ledger->email) }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">License No</label>
                                <input type="text" name="license_no"
                                    value="{{ old('license_no', $ledger->license_no) }}"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- ================= OTHER IDS ================= -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">IEC No</label>
                                <input type="text" name="iec_no"
                                    value="{{ old('iec_no', $ledger->iec_no) }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Aadhar No</label>
                                <input type="text" name="aadhar_no"
                                    value="{{ old('aadhar_no', $ledger->aadhar_no) }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">RC No</label>
                                <input type="text" name="rc_no"
                                    value="{{ old('rc_no', $ledger->rc_no) }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">ARN No</label>
                                <input type="text" name="arn_no"
                                    value="{{ old('arn_no', $ledger->arn_no) }}"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- ================= OPENING BAL ================= -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Opening Balance</label>
                                <input type="number" step="0.01" name="opening_bal"
                                    value="{{ old('opening_bal', $ledger->opening_bal) }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Opening Type</label>
                                <select name="opening_type" class="form-control">
                                    <option value="DR" {{ $ledger->opening_type == 'DR' ? 'selected' : '' }}>DR</option>
                                    <option value="CR" {{ $ledger->opening_type == 'CR' ? 'selected' : '' }}>CR</option>
                                </select>
                            </div>
                        </div>

                        <!-- ================= BANK DETAILS ================= -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Bank Name</label>
                                <input type="text" name="bank_name"
                                    value="{{ old('bank_name', $ledger->bank_name) }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Account No</label>
                                <input type="text" name="account_no"
                                    value="{{ old('account_no', $ledger->account_no) }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Branch</label>
                                <input type="text" name="branch_name"
                                    value="{{ old('branch_name', $ledger->branch_name) }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">IFSC Code</label>
                                <input type="text" name="ifsc_code"
                                    value="{{ old('ifsc_code', $ledger->ifsc_code) }}"
                                    class="form-control">
                            </div>
                        </div>

                        <!-- ================= DOCUMENT UPLOADS ================= -->
                        <div class="row mb-3">
                            <div class="col-md-4">

                                <label class="form-label">PAN Upload</label>
                                <input type="file" name="pan_upload" class="form-control">
                                @if($ledger->pan_upload)
                                <a href="{{ asset($ledger->pan_upload) }}" target="_blank" class="text-success">
                                    View PAN
                                </a>
                                @endif
                                </div>

                                <div class="col-md-4">
                                <label class="form-label mt-2">Declaration Upload</label>
                                <input type="file" name="declaration_upload" class="form-control">
                                @if($ledger->declaration_upload)
                                <a href="{{ asset($ledger->declaration_upload) }}" target="_blank" class="text-success">
                                    View Declaration
                                </a>
                                @endif
                                </div>

                                <div class="col-md-4">
                                <label class="form-label mt-2">Aadhar Upload</label>
                                <input type="file" name="aadhar_upload" class="form-control">
                                @if($ledger->aadhar_upload)
                                <a href="{{ asset($ledger->aadhar_upload) }}" target="_blank" class="text-success">
                                    View Aadhar
                                </a>
                                @endif
                                </div>

                                <div class="col-md-4">
                                <label class="form-label mt-2">GST Upload</label>
                                <input type="file" name="gst_upload" class="form-control">
                                @if($ledger->gst_upload)
                                <a href="{{ asset($ledger->gst_upload) }}" target="_blank" class="text-success">
                                    View GST
                                </a>
                                @endif
                                </div>

                                <div class="col-md-4">
                                <label class="form-label mt-2">Office Photo</label>
                                <input type="file" name="office_photo" class="form-control">
                                @if($ledger->office_photo)
                                <a href="{{ asset($ledger->office_photo) }}" target="_blank" class="text-success">
                                    View Photo
                                </a>
                                @endif

                            </div>
                        </div>


                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ route('ledgers.index') }}" class="btn btn-outline-secondary me-2">Back</a>
                        <button class="btn btn-success">Update Ledger</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</main>

<!-- Live validation JS -->
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const requiredFields = document.querySelectorAll('.required');

        function validateField(field) {
            if (field.value.trim() !== '') {
                field.classList.add('is-valid');
                field.classList.remove('is-invalid');
            } else {
                field.classList.add('is-invalid');
                field.classList.remove('is-valid');
            }
        }

        requiredFields.forEach(field => {
            validateField(field);
            field.addEventListener('input', () => validateField(field));
            field.addEventListener('change', () => validateField(field));
        });

    });
</script>

@endsection