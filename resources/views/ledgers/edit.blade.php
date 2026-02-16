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

        .form-control:focus {
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            outline: 0;
            box-shadow: var(--bs-box-shadow-inset), 0 0 0 0.25rem rgb(242 243 244 / 25%);
        }

        .form-control {
            border: 2px solid #a9abad;
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
                        <h3 class="mb-0 text-primary">Edit Ledger</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('ledgers.index') }}">Ledgers</a>
                            </li>
                            <li class="breadcrumb-item active text-primary">Edit</li>
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

                <div class="card border-primary border-4 shadow-sm">

                    <form action="{{ route('ledgers.update', $ledger->id) }}" method="POST" enctype="multipart/form-data"
                        id="ledgerEditForm">
                        @csrf
                        @method('PUT')

                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="bi bi-journal-text me-2"></i> Edit Ledger
                                </h5>
                            </div>

                            <div class="card-body">

                                <!-- ===== BASIC DETAILS ===== -->
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-header bg-light border-start border-4 border-primary">
                                        <strong><i class="bi bi-person-lines-fill me-2"></i> Basic Details</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                        title="Enter Party Name"></i> Party Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="party_name"
                                                    value="{{ old('party_name', $ledger->party_name) }}"
                                                    class="form-control required" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                        title="Enter Ledger Group"></i> Ledger Group</label>
                                                <input type="text" name="ledger_group"
                                                    value="{{ old('ledger_group', $ledger->ledger_group) }}"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="row g-3 mt-3">
                                            <div class="col-md-4">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                        title="Enter Party Alias"></i> Party Alias</label>
                                                <input type="text" name="party_alias"
                                                    value="{{ old('party_alias', $ledger->party_alias) }}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                        title="Enter GST No"></i> GST No</label>
                                                <input type="text" name="gst_no"
                                                    value="{{ old('gst_no', $ledger->gst_no) }}" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                        title="Enter PAN No"></i> PAN No</label>
                                                <input type="text" name="pan_no"
                                                    value="{{ old('pan_no', $ledger->pan_no) }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ===== ADDRESS ===== -->
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-header bg-light border-start border-4 border-success">
                                        <strong><i class="bi bi-geo-alt-fill me-2"></i> Address</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                        title="Enter Address 1"></i> Address 1</label>
                                                <input type="text" name="address1"
                                                    value="{{ old('address1', $ledger->address1) }}" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                        title="Enter Address 2"></i> Address 2</label>
                                                <input type="text" name="address2"
                                                    value="{{ old('address2', $ledger->address2) }}" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row g-3 mt-3">
                                            <div class="col-md-6">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                        title="State Name"></i> State Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="state_name"
                                                    value="{{ old('state_name', $ledger->state_name) }}"
                                                    class="form-control required" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                        title="Select City Name"></i> City Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="city_name"
                                                    value="{{ old('city_name', $ledger->city_name) }}"
                                                    class="form-control required" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ===== CONTACT ===== -->
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-header bg-light border-start border-4 border-info">
                                        <strong><i class="bi bi-telephone-fill me-2"></i> Contact Details</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <label><i class="bi bi-info-circle text-primary"
                                                        title="Enter Phone No"></i> Phone No</label>
                                                <input type="text" name="phone_no"
                                                    value="{{ old('phone_no', $ledger->phone_no) }}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label><i class="bi bi-info-circle text-primary"
                                                        title="Enter Mobile No"></i> Mobile No</label>
                                                <input type="text" name="mobile_no"
                                                    value="{{ old('mobile_no', $ledger->mobile_no) }}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label><i class="bi bi-info-circle text-primary" title="Enter Email"></i>
                                                    Email</label>
                                                <input type="email" name="email"
                                                    value="{{ old('email', $ledger->email) }}" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label><i class="bi bi-info-circle text-primary"
                                                        title="Enter License No"></i>License No</label>
                                                <input type="text" name="license_no"
                                                    value="{{ old('license_no', $ledger->license_no) }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ===== OTHER IDS ===== -->
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-header bg-light border-start border-4 border-warning">
                                        <strong><i class="bi bi-credit-card-2-front me-2"></i> Identification</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <label><i class="bi bi-info-circle text-primary" title="Enter IEC No"></i>
                                                    IEC No</label>
                                                <input type="text" name="iec_no"
                                                    value="{{ old('iec_no', $ledger->iec_no) }}" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label><i class="bi bi-info-circle text-primary"
                                                        title="Enter Aadhar No"></i> Aadhar No.</label>
                                                <input type="text" name="aadhar_no"
                                                    value="{{ old('aadhar_no', $ledger->aadhar_no) }}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label><i class="bi bi-info-circle text-primary"
                                                        title="Enter R.C. No"></i> R.C. No.</label>
                                                <input type="text" name="rc_no"
                                                    value="{{ old('rc_no', $ledger->rc_no) }}" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label><i class="bi bi-info-circle text-primary"
                                                        title="Enter ARN No"></i>ARN No</label>
                                                <input type="text" name="arn_no"
                                                    value="{{ old('arn_no', $ledger->arn_no) }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ===== OPENING BALANCE ===== -->
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-header bg-light border-start border-4 border-secondary">
                                        <strong><i class="bi bi-cash-stack me-2"></i> Opening Balance</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label>Opening Balance</label>
                                                <input type="number" step="0.01" name="opening_bal"
                                                    value="{{ old('opening_bal', $ledger->opening_bal) }}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <label><i class="bi bi-info-circle text-primary"
                                                        title="Select Opening Type"></i> Opening Type</label>
                                                <select name="opening_type" class="form-control">
                                                    <option value="DR"
                                                        {{ $ledger->opening_type == 'DR' ? 'selected' : '' }}>DR</option>
                                                    <option value="CR"
                                                        {{ $ledger->opening_type == 'CR' ? 'selected' : '' }}>CR</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ===== BANK DETAILS ===== -->
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-header bg-light border-start border-4 border-success">
                                        <strong><i class="bi bi-bank me-2"></i> Bank Details</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-3">
                                                <label><i class="bi bi-info-circle text-primary"
                                                        title="Enter Bank Name"></i> Bank Name</label>
                                                <input type="text" name="bank_name"
                                                    value="{{ old('bank_name', $ledger->bank_name) }}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label><i class="bi bi-info-circle text-primary"
                                                        title="Enter Account No"></i> Account No</label>
                                                <input type="text" name="account_no"
                                                    value="{{ old('account_no', $ledger->account_no) }}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label><i class="bi bi-info-circle text-primary"
                                                        title="Enter Branch Name"></i> Branch Name</label>
                                                <input type="text" name="branch_name"
                                                    value="{{ old('branch_name', $ledger->branch_name) }}"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label><i class="bi bi-info-circle text-primary"
                                                        title="Enter IFSC Code"></i> IFSC Code</label>
                                                <input type="text" name="ifsc_code"
                                                    value="{{ old('ifsc_code', $ledger->ifsc_code) }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ===== DOCUMENT UPLOADS ===== -->
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-header bg-light border-start border-4 border-dark">
                                        <strong>
                                            <i class="bi bi-folder2-open me-2"></i> Document Uploads
                                        </strong>
                                    </div>

                                    <div class="card-body">
                                        <div class="row g-3">

                                            @foreach ([
                                                    'pan' => 'Enter PAN Card',
                                                    'declaration' => 'Upload Declaration Document',
                                                    'aadhar' => 'Enter Aadhar Card',
                                                    'gst' => 'Enter GST Certificate',
                                                    'office_photo' => 'Upload Office Photo',
                                                ] as $doc => $title)
                                                <div class="col-md-4">
                                                    <label class="form-label text-capitalize">
                                                        <i class="bi bi-info-circle text-primary me-1"
                                                            title="{{ $title }}"></i>
                                                        {{ str_replace('_', ' ', $doc) }}
                                                    </label>

                                                    <input type="file" name="{{ $doc }}_upload"
                                                        class="form-control mb-1">

                                                    @if ($ledger->{$doc . '_upload'})
                                                        <a href="{{ asset($ledger->{$doc . '_upload'}) }}"
                                                            target="_blank" class="text-success">
                                                            <i class="bi bi-eye me-1"></i>
                                                            View {{ ucfirst(str_replace('_', ' ', $doc)) }}
                                                        </a>
                                                    @endif
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>


                            </div>

                            <!-- ===== FORM FOOTER ===== -->
                            <div class="card-footer text-end bg-light">
                                <a href="{{ route('ledgers.index') }}" class="btn btn-outline-secondary me-2">
                                    <i class="bi bi-arrow-left-circle me-1"></i> Back
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-1"></i> Update Ledger
                                </button>
                            </div>
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
