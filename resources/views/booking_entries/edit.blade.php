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

                <form action="{{ route('booking_entries.update', $booking_entry->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    id="ledgerEditForm">
                    @csrf
                    @method('PUT')

                    <div class="card-body">


                        {{-- ================= LR DETAILS ================= --}}
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-light border-start border-4 border-success">
                                <strong>
                                    <i class="bi bi-file-earmark-text me-2"></i> LR Details
                                </strong>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            LR No
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Auto generated LR Number. Cannot be edited."></i>
                                        </label>
                                        <input type="text" name="lr_no" value="{{ $booking_entry->lr_no }}" class="form-control bg-light" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            LR Date *
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Select booking date of LR"></i>
                                        </label>
                                        <input type="date" name="lr_date" value="{{ $booking_entry->lr_date }}" class="form-control" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            Ref LR No
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter reference LR number if available"></i>
                                        </label>
                                        <input type="text" name="ref_lr_no" value="{{ $booking_entry->ref_lr_no }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ================= SOURCE & DESTINATION ================= --}}
                        <div class="card shadow-sm border-0 mb-4 rounded-3">
                            <div class="card-header bg-light border-start border-4 border-primary fw-bold">
                                <i class="bi bi-geo-alt me-2"></i> Route Details
                            </div>

                            <div class="card-body">
                                <div class="row g-4">

                                    {{-- ================= SOURCE ================= --}}
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">
                                            Source Ledger *
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Select the dispatching party (From Location)"></i>
                                        </label>
                                        <select name="source_ledger_id" class="form-select" required>
                                            <option value="">Select Source</option>
                                            @foreach($ledgers as $ledger)
                                            <option value="{{ $ledger->id }}">
                                                {{ $ledger->party_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">
                                            Source Address
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter pickup location full address"></i>
                                        </label>
                                        <input type="text" name="source_address" class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label fw-semibold">
                                            State
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter source state name"></i>
                                        </label>
                                        <input type="text" name="source_state" class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label fw-semibold">
                                            City
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter source city"></i>
                                        </label>
                                        <input type="text" name="source_city" class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label fw-semibold">
                                            District
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter source district"></i>
                                        </label>
                                        <input type="text" name="source_district" class="form-control">
                                    </div>


                                    {{-- ================= DESTINATION ================= --}}
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">
                                            Destination Ledger *
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Select the receiving party (To Location)"></i>
                                        </label>
                                        <select name="destination_ledger_id" class="form-select" required>
                                            <option value="">Select Destination</option>
                                            @foreach($ledgers as $ledger)
                                            <option value="{{ $ledger->id }}">
                                                {{ $ledger->party_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">
                                            Destination Address
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter delivery location full address"></i>
                                        </label>
                                        <input type="text" name="destination_address" class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label fw-semibold">
                                            State
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter destination state name"></i>
                                        </label>
                                        <input type="text" name="destination_state" class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label fw-semibold">
                                            City
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter destination city"></i>
                                        </label>
                                        <input type="text" name="destination_city" class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label fw-semibold">
                                            District
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter destination district"></i>
                                        </label>
                                        <input type="text" name="destination_district" class="form-control">
                                    </div>

                                </div>
                            </div>
                        </div>


                        {{-- ================= CONSIGNOR ================= --}}
                        <div class="card shadow-sm border-0 mb-4 rounded-3">
                            <div class="card-header bg-light border-start border-4 border-warning fw-bold">
                                <i class="bi bi-person-badge me-2"></i> Consignor Details
                            </div>

                            <div class="card-body">
                                <div class="row g-4">

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            Consignor Ledger Name
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter consignor company or person name"></i>
                                        </label>
                                        <input type="text" name="consignor_ledger_name" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            GSTIN
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter 15-digit GST Identification Number"></i>
                                        </label>
                                        <input type="text" name="consignor_gstin"
                                            class="form-control"
                                            maxlength="15"
                                            placeholder="22AAAAA0000A1Z5">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            Mobile
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter primary mobile number of consignor"></i>
                                        </label>
                                        <input type="text" name="consignor_mobile"
                                            class="form-control"
                                            maxlength="10"
                                            placeholder="Enter 10 digit mobile number">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                            Address 1
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter primary address (Street / Area)"></i>
                                        </label>
                                        <input type="text" name="consignor_address1" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                            Address 2
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter additional address details (Optional)"></i>
                                        </label>
                                        <input type="text" name="consignor_address2" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            State
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter consignor state name"></i>
                                        </label>
                                        <input type="text" name="consignor_state" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            City
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter consignor city"></i>
                                        </label>
                                        <input type="text" name="consignor_city" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            Phone
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter landline number (Optional)"></i>
                                        </label>
                                        <input type="text" name="consignor_phone" class="form-control">
                                    </div>

                                </div>
                            </div>
                        </div>


                        {{-- ================= CONSIGNEE ================= --}}
                        <div class="card shadow-sm border-0 mb-4 rounded-3">
                            <div class="card-header bg-light border-start border-4 border-info fw-bold">
                                <i class="bi bi-person-check me-2"></i> Consignee Details
                            </div>

                            <div class="card-body">
                                <div class="row g-4">

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            Consignee Ledger Name
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter consignee company or receiving party name"></i>
                                        </label>
                                        <input type="text" name="consignee_ledger_name" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            GSTIN
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter 15-digit GST number of consignee (if applicable)"></i>
                                        </label>
                                        <input type="text"
                                            name="consignee_gstin"
                                            class="form-control"
                                            maxlength="15"
                                            placeholder="22AAAAA0000A1Z5">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            Mobile
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter primary mobile number of consignee"></i>
                                        </label>
                                        <input type="text"
                                            name="consignee_mobile"
                                            class="form-control"
                                            maxlength="10"
                                            placeholder="Enter 10 digit mobile number">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                            Address 1
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter main delivery address (Street / Area)"></i>
                                        </label>
                                        <input type="text" name="consignee_address1" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                            Address 2
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter additional address details (Optional)"></i>
                                        </label>
                                        <input type="text" name="consignee_address2" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            State
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter consignee state name"></i>
                                        </label>
                                        <input type="text" name="consignee_state" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            City
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter consignee city"></i>
                                        </label>
                                        <input type="text" name="consignee_city" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            Phone
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter landline number (Optional)"></i>
                                        </label>
                                        <input type="text" name="consignee_phone" class="form-control">
                                    </div>

                                </div>
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