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
                    <h3 class="mb-0 text-secondary" style="font-weight: bold;">Edit Booking Entries</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('booking_entries.index') }}">Booking Entries</a>
                        </li>
                        <li class="breadcrumb-item active text-secondary">Edit</li>
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
                    <h5 class="mb-0">Update Booking Entries </h5>
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
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Auto generated LR Number. Cannot be edited."></i> LR No

                                        </label>
                                        <input type="text" name="lr_no" value="{{ $booking_entry->lr_no }}" class="form-control bg-light" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                             <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Select booking date of LR"></i> LR Date *

                                        </label>
                                        <input type="date" name="lr_date" value="{{ $booking_entry->lr_date }}" class="form-control" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                           <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter reference LR number if available"></i> Ref LR No

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
                                           <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Select the dispatching party (From Location)"></i> Source Ledger *

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
                                           <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter pickup location full address"></i> Source Address

                                        </label>
                                        <input type="text" name="source_address" class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label fw-semibold">
                                          <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter source state name"></i> State

                                        </label>
                                        <input type="text" name="source_state" class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter source city"></i> City

                                        </label>
                                        <input type="text" name="source_city" class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label fw-semibold">
                                           <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter source district"></i> District

                                        </label>
                                        <input type="text" name="source_district" class="form-control">
                                    </div>


                                    {{-- ================= DESTINATION ================= --}}
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Select the receiving party (To Location)"></i> Destination Ledger *

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
                                           <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter delivery location full address"></i> Destination Address

                                        </label>
                                        <input type="text" name="destination_address" class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter destination state name"></i> State

                                        </label>
                                        <input type="text" name="destination_state" class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label fw-semibold">
                                          <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter destination city"></i> City

                                        </label>
                                        <input type="text" name="destination_city" class="form-control">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label fw-semibold">
                                             <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter destination district"></i> District

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
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter consignor company or person name"></i> Consignor Ledger Name

                                        </label>
                                        <input type="text" name="consignor_ledger_name" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                           <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter 15-digit GST Identification Number"></i> GSTIN

                                        </label>
                                        <input type="text" name="consignor_gstin"
                                            class="form-control"
                                            maxlength="15"
                                            placeholder="22AAAAA0000A1Z5">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                           <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter primary mobile number of consignor"></i> Mobile

                                        </label>
                                        <input type="text" name="consignor_mobile"
                                            class="form-control"
                                            maxlength="10"
                                            placeholder="Enter 10 digit mobile number">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                           <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter primary address (Street / Area)"></i> Address 1

                                        </label>
                                        <input type="text" name="consignor_address1" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                           <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter additional address details (Optional)"></i> Address 2

                                        </label>
                                        <input type="text" name="consignor_address2" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                           <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter consignor state name"></i> State

                                        </label>
                                        <input type="text" name="consignor_state" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter consignor city"></i> City

                                        </label>
                                        <input type="text" name="consignor_city" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter landline number (Optional)"></i> Phone

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
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter consignee company or receiving party name"></i> Consignee Ledger Name

                                        </label>
                                        <input type="text" name="consignee_ledger_name" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter 15-digit GST number of consignee (if applicable)"></i> GSTIN

                                        </label>
                                        <input type="text"
                                            name="consignee_gstin"
                                            class="form-control"
                                            maxlength="15"
                                            placeholder="22AAAAA0000A1Z5">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                          <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter primary mobile number of consignee"></i> Mobile

                                        </label>
                                        <input type="text"
                                            name="consignee_mobile"
                                            class="form-control"
                                            maxlength="10"
                                            placeholder="Enter 10 digit mobile number">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                           <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter main delivery address (Street / Area)"></i> Address 1

                                        </label>
                                        <input type="text" name="consignee_address1" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter additional address details (Optional)"></i> Address 2

                                        </label>
                                        <input type="text" name="consignee_address2" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                           <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter consignee state name"></i> State

                                        </label>
                                        <input type="text" name="consignee_state" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                           <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter consignee city"></i> City

                                        </label>
                                        <input type="text" name="consignee_city" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-info-circle text-primary"
                                                data-bs-toggle="tooltip"
                                                title="Enter landline number (Optional)"></i> Phone

                                        </label>
                                        <input type="text" name="consignee_phone" class="form-control">
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ route('booking_entries.index') }}" class="btn btn-outline-secondary me-2"><i class="bi bi-arrow-left-circle me-1"></i> Back</a>
                        <button class="btn btn-secondary"><i class="bi bi-check-circle me-1"></i> Update Booking</button>
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
