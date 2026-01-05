@extends('admin.partials.app')

@section('main-content')
    <div class="container-fluid">
        <form method="POST" action="{{ route('domestic.shipment.store') }}">
            @csrf
            <div class="row">

                {{-- Shipment Info --}}
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header fw-bold">
                            Shipment Info
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">

                            <!-- Date -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">
                                    Date<span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="shipment_date" name="shipment_date"
                                        placeholder="YYYY/MM/DD" required>
                                </div>
                            </div>

                            <!-- Courier -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">
                                    Courier<span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="courier" value="SELF">
                                </div>
                            </div>

                            <!-- Airway No -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">
                                    Airway No<span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="airway_no">
                                </div>
                            </div>

                            <!-- Risk Type -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">
                                    Risk Type<span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control form-select" name="risk_type">
                                        <option value="Customer">Customer</option>
                                        <option value="Transporter">Transporter</option>
                                        <option value="No Risk">No Risk</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Bill Type -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">
                                    Bill Type<span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control form-select" name="bill_type">
                                        <option value="Cash">Cash</option>
                                        <option value="TBB">TBB</option>
                                        <option value="To Pay">To Pay</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="row mb-2">
                                <label class="col-md-4 col-form-label">Description</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="discretion" rows="2"></textarea>
                                </div>
                            </div>

                            <!-- Vehicle No -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Vehicle No</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="vehicle_no">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Consigner --}}
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header fw-bold">
                            Consigner Detail
                        </div>

                        <div class="card-body">

                            <!-- Customer -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Customer</label>
                                <div class="col-md-8">
                                    <select class="form-control form-select" name="customer">
                                        <option>Select Customer</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Select Consigner -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">
                                    Select Consigner<span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control form-select" id="consignerSelect">
                                        <option value="">-Select Consigner-</option>
                                        @foreach ($consigners as $c)
                                            <option value="{{ $c->id }}">{{ $c->consigner_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Save to Address Book -->
                            <div class="row mb-3">
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="saveAddressBook"
                                            name="consigner_save_to_address_book" value="1">
                                        <label class="form-check-label" for="saveAddressBook">
                                            Save To Address Book.
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">
                                    Name<span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="consigner_name">
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="row mb-2">
                                <label class="col-md-4 col-form-label">Address</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="consigner_address" rows="2"></textarea>
                                </div>
                            </div>

                            <!-- Pincode -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">
                                    Pincode<span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="consigner_pincode">
                                </div>
                            </div>

                            <!-- State -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">
                                    State<span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control form-select" name="consigner_state" id="consignerState">
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->city_state }}">{{ $state->city_state }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- City -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">
                                    City<span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control form-select" name="consigner_city" id="consignerCity">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Contact -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">ContactNo.</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="consigner_contact">
                                </div>
                            </div>

                            <!-- Type of Doc -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">
                                    TypeOfDoc<span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8 d-flex">
                                    <select class="form-control me-2 form-select" style="width: 45%;">
                                        <option>GSTIN</option>
                                        <option>PAN</option>
                                    </select>
                                    <input type="text" class="form-control" name="consigner_type_of_doc">
                                </div>
                            </div>

                            <!-- Coll Type -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Coll Type</label>
                                <div class="col-md-8">
                                    <select class="form-control form-select" name="coll_type">
                                        <option>-Select-</option>
                                        <option>DOOR COLLATION</option>
                                        <option>GODOWN COLLATION</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Delivery Type -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Delivery Type</label>
                                <div class="col-md-8">
                                    <select class="form-control form-select" name="delivery_type">
                                        <option>-Select-</option>
                                        <option>DOOR DELIVERY</option>
                                        <option>GODOWN DELIVERY</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Consignee --}}
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header fw-bold">
                            Consignee Detail
                        </div>

                        <div class="card-body">

                            <!-- Select Consignee -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">
                                    Select Consignee<span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control" id="consigneeSelect">
                                        <option value="">-Select Consignee-</option>
                                        @foreach ($consignees as $c)
                                            <option value="{{ $c->id }}">
                                                {{ $c->consignee_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <!-- Save To Address Book -->
                            <div class="row mb-3">
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="saveConsigneeAddressBook"
                                            name="consignee_save_to_address_book" value="1">
                                        <label class="form-check-label" for="saveConsigneeAddressBook">
                                            Save To Address Book
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">
                                    Name<span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="consignee_name">
                                </div>
                            </div>

                            <!-- Company -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">
                                    Company<span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="consignee_company">
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="row mb-2">
                                <label class="col-md-4 col-form-label">Address</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="consignee_address" rows="2"></textarea>
                                </div>
                            </div>

                            <!-- Pincode -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">
                                    Pincode<span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="consignee_pincode" id="pincode"
                                        maxlength="6" placeholder="Enter Pincode">
                                </div>
                            </div>

                            <!-- State -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">
                                    State<span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control form-select" name="consignee_state" id="consigneeState">
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->city_state }}">{{ $state->city_state }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- City -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">
                                    City<span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control form-select" name="consignee_city" id="consigneeCity">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Zone -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Zone</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="zone">
                                </div>
                            </div>

                            <!-- Contact -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Contact No</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="consignee_contact">
                                </div>
                            </div>

                            <!-- GST No -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">GST No</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="gst_no">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- ================= INVOICE ================= --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between fw-bold">
                    <span>Invoice Details</span>
                </div>


                <div class="table-responsive">
                    <table class="table table-bordered mb-0" id="invoiceTable">
                        <thead>
                            <tr>
                                <th>Invoice No</th>
                                <th>Invoice Value</th>
                                <th>Invoice Date</th>
                                <th>Quantity</th>
                                <th>Type Of Parcel</th>
                                <th>Eway No</th>
                                <th>Eway Expiry Date</th>
                                <th> <button type="button" class="btn btn-info btn-sm"
                                        onclick="addInvoiceRow()">Add</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            {{-- ================= MEASUREMENT + CHARGES ================= --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header fw-bold">Measurement Units</div>
                        <div class="card-body">

                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">PKT</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="pkt">
                                </div>
                            </div>

                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">QTY</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="qty">
                                </div>
                            </div>

                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Actual Weight</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="actual_weight">
                                </div>
                            </div>

                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Chargeable Weight</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="chargeable_weight">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
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
                                                    name="charges[{{ $name }}]" value="0">
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
                                                    name="charges[{{ $name }}]" value="0">
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="row mb-2 align-items-center">
                                        <label class="col-md-6 col-form-label fw-bold">Total</label>
                                        <div class="col-md-6">
                                            <input class="form-control fw-bold bg-light" id="charges_total"
                                                name="sub_total" readonly value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            {{-- FINAL CHARGE --}}
                            <div class="fw-bold mb-3">Final Charge</div>
                            <div class="row mb-2">
                                {{--  <div class="col-md-6">
                                    <label>Sub Total</label>
                                    <input class="form-control bg-light" id="sub_total" name="sub_total" readonly
                                        value="0">
                                </div>  --}}
                                <div class="col-md-6">
                                    <label>Tax Type</label>
                                    <select class="form-control form-select" id="tax_type" name="tax_type">
                                        <option value="">-- Select Tax Type --</option>
                                        <option value="gst">CGST/SGST</option>
                                        <option value="igst">IGST</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Tax %</label>
                                    <select class="form-control form-select" id="tax" name="tax">
                                        <option value="">-- Select Tax --</option>
                                        <option value="0">0</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                                <div class="row mb-2 gst-field d-none">
                                    <div class="col-md-6">
                                        <label>CGST Tax</label>
                                        <input class="form-control bg-light" id="cgst" name="cgst" readonly
                                            value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6 gst-field d-none">
                                    <label>SGST Tax</label>
                                    <input class="form-control bg-light" id="sgst" name="sgst" readonly
                                        value="0">
                                </div>

                                <div class="col-md-6 igst-field d-none">
                                    <label>IGST Tax</label>
                                    <input class="form-control bg-light" id="igst" name="igst" readonly
                                        value="0">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="fw-bold">Grand Total</label>
                                    <input class="form-control fw-bold bg-light" id="grand_total" name="grand_total"
                                        readonly value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end mb-3">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const taxType = document.getElementById('tax_type');
        const taxPercent = document.getElementById('tax');

        taxType.addEventListener('change', toggleTaxFields);
        taxPercent.addEventListener('change', calculateCharges);
        document.addEventListener('input', calculateCharges);

        function toggleTaxFields() {

            document.querySelectorAll('.gst-field').forEach(el => el.classList.add('d-none'));
            document.querySelectorAll('.igst-field').forEach(el => el.classList.add('d-none'));

            cgst.value = sgst.value = igst.value = 0;

            if (taxType.value === 'gst') {
                document.querySelectorAll('.gst-field').forEach(el => el.classList.remove('d-none'));
            }

            if (taxType.value === 'igst') {
                document.querySelectorAll('.igst-field').forEach(el => el.classList.remove('d-none'));
            }

            calculateCharges();
        }

        function calculateCharges() {

            let total = 0;
            document.querySelectorAll('.charge-input').forEach(input => {
                total += parseFloat(input.value) || 0;
            });

            document.getElementById('charges_total').value = total.toFixed(2);

            let tax = parseFloat(taxPercent.value) || 0;

            let cgst = 0,
                sgst = 0,
                igst = 0;

            if (taxType.value === 'gst') {
                cgst = total * (tax / 2) / 100;
                sgst = total * (tax / 2) / 100;
            }

            if (taxType.value === 'igst') {
                igst = total * tax / 100;
            }

            document.getElementById('cgst').value = cgst.toFixed(2);
            document.getElementById('sgst').value = sgst.toFixed(2);
            document.getElementById('igst').value = igst.toFixed(2);

            document.getElementById('grand_total').value =
                (total + cgst + sgst + igst).toFixed(2);
        }
    });
</script>

<script>
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

    let invoiceIndex = 0;

    function addInvoiceRow() {
        document.querySelector('#invoiceTable tbody').insertAdjacentHTML('beforeend', `
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
                <button type="button" class="btn btn-danger btn-sm"
                    onclick="this.closest('tr').remove()">Remove</button>
            </td>
        </tr>
    `);

        flatpickr(".invoice-date", {
            dateFormat: "Y-m-d"
        });
        flatpickr(".eway-date", {
            dateFormat: "Y-m-d"
        });

        invoiceIndex++;
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('consigneeSelect').addEventListener('change', function() {

            let id = this.value;
            if (!id) return;

            fetch('/consignee-details/' + id)
                .then(response => response.json())
                .then(data => {

                    console.log(data);

                    document.querySelector('[name="consignee_name"]').value = data.consignee_name ??
                        '';
                    document.querySelector('[name="consignee_company"]').value = data
                        .consignee_company ?? '';
                    document.querySelector('[name="consignee_address"]').value = data
                        .consignee_address ?? '';
                    document.querySelector('[name="consignee_pincode"]').value = data
                        .consignee_pincode ?? '';
                    document.querySelector('[name="consignee_state"]').value = data
                        .consignee_state ?? '';
                    document.querySelector('[name="consignee_city"]').value = data.consignee_city ??
                        '';
                    document.querySelector('[name="zone"]').value = data.zone ?? '';
                    document.querySelector('[name="consignee_contact"]').value = data
                        .consignee_contact ?? '';
                    document.querySelector('[name="gst_no"]').value = data.gst_no ?? '';
                })
                .catch(err => console.error(err));
        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('consignerSelect').addEventListener('change', function() {

            let id = this.value;
            if (!id) return;

            fetch('/consigner-details/' + id)
                .then(response => response.json())
                .then(data => {

                    console.log(data);

                    document.querySelector('[name="consigner_name"]').value = data.consigner_name ??
                        '';
                    document.querySelector('[name="consigner_address"]').value = data
                        .consigner_address ?? '';
                    document.querySelector('[name="consigner_pincode"]').value = data
                        .consigner_pincode ?? '';
                    document.querySelector('[name="consigner_state"]').value = data
                        .consigner_state ?? '';
                    document.querySelector('[name="consigner_city"]').value = data.consigner_city ??
                        '';
                    document.querySelector('[name="consigner_contact"]').value = data
                        .consigner_contact ?? '';
                    document.querySelector('[name="consigner_doc_no"]').value = data
                        .consigner_doc_no ?? '';
                    document.querySelector('[name="coll_type"]').value = data.coll_type ?? '';
                    document.querySelector('[name="delivery_type"]').value = data.delivery_type ??
                        '';
                })
                .catch(err => console.error(err));
        });

    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {

        $('#consigneeState').change(function() {
            var state = $(this).val();
            if (state) {
                $.get('/get-cities/' + encodeURIComponent(state), function(data) {
                    $('#consigneeCity').empty().append('<option value="">Select City</option>');
                    $.each(data, function(i, city) {
                        $('#consigneeCity').append('<option value="' + city.city_name +
                            '">' + city.city_name + '</option>');
                    });
                });
            } else {
                $('#consigneeCity').empty().append('<option value="">Select City</option>');
            }
        });

        $('#consignerState').change(function() {
            var state = $(this).val();
            if (state) {
                $.get('/get-cities/' + encodeURIComponent(state), function(data) {
                    $('#consignerCity').empty().append('<option value="">Select City</option>');
                    $.each(data, function(i, city) {
                        $('#consignerCity').append('<option value="' + city.city_name +
                            '">' + city.city_name + '</option>');
                    });
                });
            } else {
                $('#consignerCity').empty().append('<option value="">Select City</option>');
            }
        });

    });
</script>
