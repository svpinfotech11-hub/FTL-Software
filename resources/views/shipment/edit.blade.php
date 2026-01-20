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
                                <label class="col-md-4">Mode *</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="mode">
                                        @foreach (['FTL', 'Road Transport'] as $m)
                                            <option value="{{ $m }}"
                                                {{ $shipment->mode == $m ? 'selected' : '' }}>{{ $m }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-md-4">Rate *</label>
                                <div class="col-md-8">
                                    <input type="number" step="0.01" class="form-control" name="rate" value="{{ $shipment->rate }}" placeholder="Enter rate">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label class="col-md-4">Description</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="discretion">{{ $shipment->description }}</textarea>
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


                        <div class="row mb-2 align-items-center">
                            <label class="col-md-4 col-form-label">Customer</label>
                            <div class="col-md-8">
                            <select class="form-control form-select"
                                name="customer_id"
                                id="customerSelect">

                            <option value="">Select Customer</option>

                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    {{ isset($shipment) && $shipment->customer_id == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->customer_name }}
                                </option>
                            @endforeach
                        </select>

                            </div>
                        </div>

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
                                                {{ $c->name }}
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
                                        value="{{ $shipment->consigner->name }}">
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="row mb-2">
                                <label class="col-md-4 col-form-label">Address</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="consigner_address">{{ $shipment->consigner->address }}</textarea>
                                </div>
                            </div>

                            <!-- Pincode -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Pincode<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="consignerPincode" name="consigner_pincode"
                                        value="{{ $shipment->consigner->pincode }}">
                                </div>
                            </div>

                            <!-- State -->
                           <div class="row mb-2 align-items-center">
                            <label class="col-md-4 col-form-label">
                                State <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-8">
                               
                               <input type="text" id="consigner_state" name="consigner_state" value="{{ $shipment->consigner->state }}" class="form-control">
                            </div>
                        </div>

                          <div class="row mb-2 align-items-center">
                            <label class="col-md-4 col-form-label">
                                City <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-8">
                               <input type="text" id="consigner_city" name="consigner_city" value="{{ $shipment->consigner->city }}" class="form-control">
                            </div>
                        </div>

                            <!-- Contact -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Contact No</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="consigner_contact"
                                        value="{{ $shipment->consigner->contact_no }}">
                                </div>
                            </div>

                            <!-- Coll Type -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Coll Type</label>
                                <div class="col-md-8">
                                    <select class="form-control form-select" name="coll_type" id="coll_type">
                                        <option>-Select-</option>
                                        <option {{ $shipment->consigner && $shipment->consigner->coll_type == 'DOOR COLLATION' ? 'selected' : '' }}>DOOR COLLATION</option>
                                        <option {{ $shipment->consigner && $shipment->consigner->coll_type == 'GODOWN COLLATION' ? 'selected' : '' }}>GODOWN COLLATION</option>
                                    </select>
                                </div>
                            </div>

                        <!-- Delivery Type -->
                        <div class="row mb-2 align-items-center">
                            <label class="col-md-4 col-form-label">Delivery Type</label>
                            <div class="col-md-8">
                                <select class="form-control form-select" name="delivery_type" id="delivery_type">
                                    <option>-Select-</option>
                                    <option {{ $shipment->consigner && $shipment->consigner->delivery_type == 'DOOR DELIVERY' ? 'selected' : '' }}>DOOR DELIVERY</option>
                                    <option {{ $shipment->consigner && $shipment->consigner->delivery_type == 'GODOWN DELIVERY' ? 'selected' : '' }}>GODOWN DELIVERY</option>
                                </select>
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
                                                {{ $c->name }}
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
                                        value="{{ $shipment->consignee->name }}">
                                </div>
                            </div>

                            <!-- Company -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Company<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="consignee_company"
                                        value="{{ $shipment->consignee->company }}">
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="row mb-2">
                                <label class="col-md-4 col-form-label">Address</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="consignee_address">{{ $shipment->consignee->address }}</textarea>
                                </div>
                            </div>

                            <!-- Pincode -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Pincode<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="consigneePincode" name="consignee_pincode"
                                        value="{{ $shipment->consignee->pincode }}">
                                </div>
                            </div>

                            <!-- State -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">State<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                 
                                <input type="text" id="consignee_state" name="consigneestate" value="{{ $shipment->consignee->state }}" class="form-control" readonly>
                                </div>
                            </div>

                            <!-- City -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">City<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                <input type="text" id="consignee_city" name="consignee_city" value="{{ $shipment->consignee->city }}" class="form-control" readonly>
                                </div>
                            
                            </div>

                            <!-- Zone -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Zone</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="zone"
                                        value="{{ $shipment->consignee->zone }}">
                                </div>
                            </div>

                            <!-- Contact -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">Contact No</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="consignee_contact"
                                        value="{{ $shipment->consignee->contact_no }}">
                                </div>
                            </div>

                            <!-- GST No -->
                            <div class="row mb-2 align-items-center">
                                <label class="col-md-4 col-form-label">GST No</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="gst_no"
                                        value="{{ $shipment->consignee->gst_no }}">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
$(document).ready(function () {

    $('#consignerPincode').on('keyup', function () {

        let pincode = $(this).val();

        if (pincode.length === 6) {
            $.get('/get-location/' + pincode, function (res) {

                // ✅ Set consigner state & city
                $('#consigner_state').val(res.state);
                $('#consigner_city').val(res.city);

            }).fail(function () {
                alert('Invalid Pincode');
            });
        }
    });

});
</script>


<script>
$(document).ready(function () {

    $('#consigneePincode').on('keyup', function () {

        let pincode = $(this).val();

        if (pincode.length === 6) {
            $.get('/get-location/' + pincode, function (res) {

                // ✅ Set consigner state & city
                $('#consignee_state').val(res.state);
                $('#consignee_city').val(res.city);

            }).fail(function () {
                alert('Invalid Pincode');
            });
        }
    });

});
</script>



