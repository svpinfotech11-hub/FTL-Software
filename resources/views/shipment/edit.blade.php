@extends('admin.partials.app')

@section('main-content')
    <div class="container-fluid">

        {{-- ================= ERRORS & SUCCESS ================= --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('domestic.shipment.update', $shipment->id) }}">
            @csrf
            @method('PUT')

            <div class="row">

                {{-- ================= SHIPMENT INFO ================= --}}
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header fw-bold">Shipment Info</div>
                        <div class="card-body">

                            <div class="row mb-2">
                                <label class="col-md-4">Date *</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="shipment_date" name="shipment_date"
                                        value="{{ $shipment->shipment_date }}">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-md-4">Courier *</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="courier" value="{{ $shipment->courier }}">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-md-4">Airway No *</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="airway_no" value="{{ $shipment->airway_no }}">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-md-4">Risk Type *</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="risk_type">
                                        @foreach (['Customer', 'Transporter', 'No Risk'] as $r)
                                            <option value="{{ $r }}"
                                                {{ $shipment->risk_type == $r ? 'selected' : '' }}>{{ $r }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-md-4">Bill Type *</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="bill_type">
                                        @foreach (['Cash', 'TBB', 'To Pay'] as $b)
                                            <option value="{{ $b }}"
                                                {{ $shipment->bill_type == $b ? 'selected' : '' }}>{{ $b }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-md-4">Description</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="discretion">{{ $shipment->discretion }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-md-4">Vehicle No</label>
                                <div class="col-md-8">
                                    <input class="form-control" name="vehicle_no" value="{{ $shipment->vehicle_no }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- ================= CONSIGNER ================= --}}
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header fw-bold">Consigner Detail</div>
                        <div class="card-body">

                            <!-- Select Consigner -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">
                                    Select Consigner<span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control form-select" id="consignerSelect" name="consigner_id">
                                        <option value="">-Select Consigner-</option>
                                        @foreach ($consigners as $c)
                                            <option value="{{ $c->id }}"
                                                {{ $shipment->consigner_id == $c->id ? 'selected' : '' }}>
                                                {{ $c->consigner_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Name<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="consigner_name"
                                        value="{{ $shipment->consigner_name }}">
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="row mb-2">
                                <label class="col-md-4 col-form-label">Address</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="consigner_address">{{ $shipment->consigner_address }}</textarea>
                                </div>
                            </div>

                            <!-- Pincode -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Pincode<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="consigner_pincode"
                                        value="{{ $shipment->consigner_pincode }}">
                                </div>
                            </div>

                            <!-- State -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">State<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <select class="form-control form-select" id="consignerState" name="consigner_state">
                                        <option value="">Select State</option>
                                        @foreach ($states as $s)
                                            <option value="{{ $s->city_state }}"
                                                {{ $shipment->consigner_state == $s->city_state ? 'selected' : '' }}>
                                                {{ $s->city_state }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- City -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">City<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <select class="form-control form-select" id="consignerCity" name="consigner_city">
                                        <option value="{{ $shipment->consigner_city }}">{{ $shipment->consigner_city }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Contact -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Contact No</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="consigner_contact"
                                        value="{{ $shipment->consigner_contact }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- ================= CONSIGNEE ================= --}}
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header fw-bold">Consignee Detail</div>
                        <div class="card-body">

                            <!-- Select Consignee -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Select Consignee<span
                                        class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <select class="form-control form-select" id="consigneeSelect" name="consignee_id">
                                        <option value="">-Select Consignee-</option>
                                        @foreach ($consignees as $c)
                                            <option value="{{ $c->id }}"
                                                {{ $shipment->consignee_id == $c->id ? 'selected' : '' }}>
                                                {{ $c->consignee_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Name<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="consignee_name"
                                        value="{{ $shipment->consignee_name }}">
                                </div>
                            </div>

                            <!-- Company -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Company<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="consignee_company"
                                        value="{{ $shipment->consignee_company }}">
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="row mb-2">
                                <label class="col-md-4 col-form-label">Address</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="consignee_address">{{ $shipment->consignee_address }}</textarea>
                                </div>
                            </div>

                            <!-- Pincode -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Pincode<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="consignee_pincode"
                                        value="{{ $shipment->consignee_pincode }}">
                                </div>
                            </div>

                            <!-- State -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">State<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <select class="form-control form-select" id="consigneeState" name="consignee_state">
                                        <option value="">Select State</option>
                                        @foreach ($states as $s)
                                            <option value="{{ $s->city_state }}"
                                                {{ $shipment->consignee_state == $s->city_state ? 'selected' : '' }}>
                                                {{ $s->city_state }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- City -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">City<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <select class="form-control form-select" id="consigneeCity" name="consignee_city">
                                        <option value="{{ $shipment->consignee_city }}">{{ $shipment->consignee_city }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Zone -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Zone</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="zone"
                                        value="{{ $shipment->zone }}">
                                </div>
                            </div>

                            <!-- Contact -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Contact No</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="consignee_contact"
                                        value="{{ $shipment->consignee_contact }}">
                                </div>
                            </div>

                            <!-- GST No -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">GST No</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="gst_no"
                                        value="{{ $shipment->gst_no }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>

            {{-- ================= INVOICE ================= --}}
            <div class="card mb-3">
                <div class="card-header fw-bold">
                    Invoice Details
                </div>

                <table class="table table-bordered" id="invoiceTable">
                    <thead>
                        <tr>
                            <th>Invoice No</th>
                            <th>Invoice Value</th>
                            <th>Invoice Date</th>
                            <th>Quantity</th>
                            <th>Type Of Parcel</th>
                            <th>Eway No</th>
                            <th>Eway Expiry Date</th>
                            <th> <button type="button" class="btn btn-info btn-sm" id="addInvoiceBtn">Add</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shipment->invoices as $i => $inv)
                            <tr>
                                <td><input class="form-control" name="invoices[{{ $i }}][invoice_no]"
                                        value="{{ $inv->invoice_no }}"></td>
                                <td><input class="form-control" name="invoices[{{ $i }}][invoice_value]"
                                        value="{{ $inv->invoice_value }}"></td>
                                <td><input class="form-control invoice-date"
                                        name="invoices[{{ $i }}][invoice_date]"
                                        value="{{ $inv->invoice_date }}"></td>
                                <td><input class="form-control" name="invoices[{{ $i }}][quantity]"
                                        value="{{ $inv->quantity }}"></td>
                                <td>
                                    <select class="form-control" name="invoices[{{ $i }}][type_of_parcel]">
                                        <option {{ $inv->type_of_parcel == 'Box' ? 'selected' : '' }}>Box</option>
                                        <option {{ $inv->type_of_parcel == 'Carton' ? 'selected' : '' }}>Carton</option>
                                        <option {{ $inv->type_of_parcel == 'Pallet' ? 'selected' : '' }}>Pallet</option>
                                    </select>
                                </td>
                                <td><input class="form-control" name="invoices[{{ $i }}][eway_no]"
                                        value="{{ $inv->eway_no }}"></td>
                                <td><input class="form-control eway-date"
                                        name="invoices[{{ $i }}][eway_expiry]"
                                        value="{{ $inv->eway_expiry }}"></td>
                                <td><button type="button" class="btn btn-danger btn-sm"
                                        onclick="this.closest('tr').remove()">X</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- ================= MEASUREMENT UNITS (EDIT) ================= --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header fw-bold">Measurement Units</div>
                        <div class="card-body">

                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">PKT</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="pkt"
                                        value="{{ old('pkt', $shipment->pkt) }}">
                                </div>
                            </div>

                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">QTY</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="qty"
                                        value="{{ old('qty', $shipment->qty) }}">
                                </div>
                            </div>

                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Actual Weight</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="actual_weight"
                                        value="{{ old('actual_weight', $shipment->actual_weight) }}">
                                </div>
                            </div>

                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Chargeable Weight</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="chargeable_weight"
                                        value="{{ old('chargeable_weight', $shipment->chargeable_weight) }}">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- ================= CHARGES (EDIT) ================= --}}
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header fw-bold">Charges</div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6">
                                    @foreach ([
            'freight' => 'Freight',
            'door_collection' => 'Door Coll',
            'insurance' => 'Insurance',
            'awb_charge' => 'AWB Ch.',
            'hamali' => 'Hamali',
            'godown_collection' => 'Godown Coll Ch',
            'eway_charge' => 'Eway Ch.',
            'fuel_surcharge' => 'Fuel Surcharge',
        ] as $name => $label)
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-md-6 col-form-label">{{ $label }}</label>
                                            <div class="col-md-6">
                                                <input type="number" step="0.01" class="form-control charge-input"
                                                    name="{{ $name }}"
                                                    value="{{ old($name, $shipment->$name) }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="col-md-6">
                                    @foreach ([
            'handling_charge' => 'Handling Charge',
            'door_delivery' => 'Door Delivery',
            'cod' => 'COD',
            'other_charge' => 'Other Ch.',
            'appt_charge' => 'Appt Ch.',
            'godown_delivery' => 'Godown Del Ch',
            'fov_charge' => 'Fov Charges',
        ] as $name => $label)
                                        <div class="row mb-2 align-items-center">
                                            <label class="col-md-6 col-form-label">{{ $label }}</label>
                                            <div class="col-md-6">
                                                <input type="number" step="0.01" class="form-control charge-input"
                                                    name="{{ $name }}"
                                                    value="{{ old($name, $shipment->$name) }}">
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="row mb-2 align-items-center">
                                        <label class="col-md-6 col-form-label fw-bold">Total</label>
                                        <div class="col-md-6">
                                            <input class="form-control fw-bold bg-light" id="charges_total"
                                                name="sub_total" readonly value="{{ $shipment->sub_total }}">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr>

                            {{-- ================= FINAL CHARGE ================= --}}
                            <div class="fw-bold mb-3">Final Charge</div>

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label>Tax Type</label>
                                    <select class="form-control" id="tax_type" name="tax_type">
                                        <option value="">-- Select --</option>
                                        <option value="gst" {{ $shipment->cgst > 0 ? 'selected' : '' }}>CGST/SGST
                                        </option>
                                        <option value="igst" {{ $shipment->igst > 0 ? 'selected' : '' }}>IGST</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Tax %</label>
                                    <select class="form-control" id="tax" name="tax">
                                        <option value="0" {{ $shipment->tax == 0 ? 'selected' : '' }}>0</option>
                                        <option value="5" {{ $shipment->tax == 5 ? 'selected' : '' }}>5</option>
                                        <option value="10" {{ $shipment->tax == 10 ? 'selected' : '' }}>10</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-2 gst-field">
                                <div class="col-md-6">
                                    <label>CGST</label>
                                    <input class="form-control bg-light" id="cgst" name="cgst"
                                        value="{{ $shipment->cgst }}" readonly>
                                </div>

                                <div class="col-md-6">
                                    <label>SGST</label>
                                    <input class="form-control bg-light" id="sgst" name="sgst"
                                        value="{{ $shipment->sgst }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-2 igst-field">
                                <div class="col-md-6">
                                    <label>IGST</label>
                                    <input class="form-control bg-light" id="igst" name="igst"
                                        value="{{ $shipment->igst }}" readonly>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="fw-bold">Grand Total</label>
                                    <input class="form-control fw-bold bg-light" id="grand_total" name="grand_total"
                                        value="{{ $shipment->grand_total }}" readonly>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-success float-end mb-3">Update Shipment</button>

        </form>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const taxType = document.getElementById('tax_type');
        const taxPercent = document.getElementById('tax');

        function calculateCharges() {
            let total = 0;

            document.querySelectorAll('.charge-input').forEach(el => {
                total += parseFloat(el.value) || 0;
            });

            document.getElementById('charges_total').value = total.toFixed(2);

            let tax = parseFloat(taxPercent.value) || 0;
            let cgst = 0,
                sgst = 0,
                igst = 0;

            if (taxType.value === 'gst') {
                cgst = total * (tax / 2) / 100;
                sgst = total * (tax / 2) / 100;
                document.querySelector('.gst-field').style.display = 'flex';
                document.querySelector('.igst-field').style.display = 'none';
            }

            if (taxType.value === 'igst') {
                igst = total * tax / 100;
                document.querySelector('.igst-field').style.display = 'flex';
                document.querySelector('.gst-field').style.display = 'none';
            }

            document.getElementById('cgst').value = cgst.toFixed(2);
            document.getElementById('sgst').value = sgst.toFixed(2);
            document.getElementById('igst').value = igst.toFixed(2);

            document.getElementById('grand_total').value =
                (total + cgst + sgst + igst).toFixed(2);
        }

        document.addEventListener('input', calculateCharges);
        taxType.addEventListener('change', calculateCharges);
        taxPercent.addEventListener('change', calculateCharges);

        calculateCharges();
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const parcelOptions = `
        <option value="">-Select-</option>
        <option value="Wooden Box">Wooden Box</option>
        <option value="Carton">Carton</option>
        <option value="Drum">Drum</option>
        <option value="Plastic Wrap">Plastic Wrap</option>
        <option value="Gunny Bag">Gunny Bag</option>
        <option value="Pipe">Pipe</option>
        <option value="Bundle">Bundle</option>
        <option value="CAND">CAND</option>
        <option value="IBC">IBC</option>
        <option value="Box">Box</option>
        <option value="Pallet">Pallet</option>
        <option value="BKT">BKT</option>
        <option value="NOS">NOS</option>
    `;

    let invoiceTableBody = document.querySelector('#invoiceTable tbody');
    let invoiceIndex = invoiceTableBody.querySelectorAll('tr').length;

    flatpickr(".invoice-date", { dateFormat: "Y-m-d" });
    flatpickr(".eway-date", { dateFormat: "Y-m-d" });

    function addInvoiceRow() {
        invoiceTableBody.insertAdjacentHTML('beforeend', `
            <tr>
                <td><input class="form-control" name="invoices[${invoiceIndex}][invoice_no]"></td>
                <td><input type="number" class="form-control" name="invoices[${invoiceIndex}][invoice_value]"></td>
                <td><input type="text" class="form-control invoice-date" placeholder="Y-m-d" name="invoices[${invoiceIndex}][invoice_date]"></td>
                <td><input type="number" class="form-control" name="invoices[${invoiceIndex}][quantity]"></td>
                <td>
                    <select class="form-control" name="invoices[${invoiceIndex}][type_of_parcel]">
                        ${parcelOptions}
                    </select>
                </td>
                <td><input class="form-control" name="invoices[${invoiceIndex}][eway_no]"></td>
                <td><input type="text" class="form-control eway-date" placeholder="Y-m-d" name="invoices[${invoiceIndex}][eway_expiry]"></td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-invoice">X</button>
                </td>
            </tr>
        `);

        flatpickr(".invoice-date", { dateFormat: "Y-m-d" });
        flatpickr(".eway-date", { dateFormat: "Y-m-d" });

        invoiceIndex++;
    }

    document.getElementById('addInvoiceBtn').addEventListener('click', addInvoiceRow);

    invoiceTableBody.addEventListener('click', function(e) {
        if(e.target && e.target.classList.contains('remove-invoice')) {
            e.target.closest('tr').remove();
        }
    });

});
</script>
