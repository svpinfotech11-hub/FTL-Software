@extends('admin.partials.app')

@section('main-content')

    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Create New</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create New</li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row g-4">
                    <!--begin::Col-->

                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-12">
                        <!--begin::Quick Example-->
                        <div class="card card-primary card-outline mb-4">
                            <!--begin::Header-->
                            <div class="card-header">
                                <div class="card-title">Add Shipment</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Form-->

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <h1>{{ session('success') }}</h1>
                            @endif
                            <form method="POST" action="{{ route('domestic.shipment.store') }}">
                                @csrf
                                <!-- <input type="hidden" name="is_existing_consigner" id="is_existing_consigner"> -->
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
                                                        Date & Time <span class="text-danger">*</span>
                                                    </label>

                                                    <div class="col-md-8">
                                                        <div class="input-group datepicker-group" id="shipmentDatePicker">

                                                            <input type="text" class="form-control datetimepicker"
                                                                name="shipment_date" placeholder="YYYY-MM-DD HH:mm"
                                                                data-input>

                                                            <span class="input-group-text calendar-icon">
                                                                <i class="bi bi-calendar"></i>
                                                            </span>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Courier -->
                                                <div class="row mb-2 align-items-center">
                                                    <label class="col-md-4 col-form-label">
                                                        Courier<span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="courier"
                                                            value="SELF">
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

                                                <!-- Mode -->
                                                <div class="row mb-2 align-items-center">
                                                    <label class="col-md-4 col-form-label">
                                                        Mode<span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <select class="form-control form-select" name="mode">
                                                            <option value="FTL">FTL</option>
                                                            <option value="Road Transport">Road Transport</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Description -->
                                                <div class="row mb-2">
                                                    <label class="col-md-4 col-form-label">Description</label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" name="description" rows="2"></textarea>
                                                    </div>
                                                </div>

                                                <!-- Vehicle No -->
                                                <!-- <div class="row mb-2 align-items-center">
                                                                                        <label class="col-md-4 col-form-label">Vehicle No</label>
                                                                                        <div class="col-md-8">
                                                                                            <input type="text" class="form-control" name="vehicle_no">
                                                                                        </div>
                                                                                    </div> -->

                                                <div class="row mb-2 align-items-center">
                                                    <label class="col-md-4 col-form-label">
                                                        Vehicle Type<span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <select class="form-control form-select" name="vehicle_type"
                                                            id="vehicle_type">
                                                            <option value="">Select Value</option>
                                                            <option value="own">Own</option>
                                                            <option value="rented">Rented</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div id="ownFields" class="d-none">

                                                    <div class="row mb-2 align-items-center">
                                                        <label class="col-md-4 col-form-label">Driver Name</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control"
                                                                name="driver_name">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-2 align-items-center">
                                                        <label class="col-md-4 col-form-label">Driver Number</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control"
                                                                name="driver_number">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-2 align-items-center">
                                                        <label class="col-md-4 col-form-label">Vehicle Number</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control"
                                                                name="vehicle_number">
                                                        </div>
                                                    </div>

                                                </div>


                                                <div id="rentedFields" class="d-none">

                                                    <div class="row mb-2 align-items-center">
                                                        <label class="col-md-4 col-form-label">Vendor</label>
                                                        <div class="col-md-8">
                                                            <select class="form-control form-select" name="vendor_id"
                                                                id="vendor_id">
                                                                <option value="">Select Vendor</option>
                                                                @foreach ($vendors as $vendor)
                                                                    <option value="{{ $vendor->id }}">
                                                                        {{ $vendor->vendor_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-2 align-items-center">
                                                        <label class="col-md-4 col-form-label">Hire Register</label>
                                                        <div class="col-md-8">
                                                            {{--  <select class="form-control form-select"
                                                                name="vehicle_hire_id" id="vehicle_hire_id">
                                                                <option value="">Select Hire Register</option>
                                                                @foreach ($vehicleHires as $hire)
                                                                    <option value="{{ $hire->id }}"
                                                                        data-vendor="{{ $hire->vendor_id }}"
                                                                        data-vehicle="{{ $hire->vehicle_no }}"
                                                                        data-driver="{{ $hire->driver_details }}">
                                                                        {{ $hire->id }} - {{ $hire->vendor_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>  --}}
                                                            <select class="form-control form-select"
                                                                name="vehicle_hire_id" id="vehicle_hire_id">
                                                                <option value="">Select Hire Register</option>
                                                                @foreach ($vehicleHires as $hire)
                                                                    <option value="{{ $hire->id }}"
                                                                        data-vendor="{{ $hire->vendor_id }}"
                                                                        style="display:none;">
                                                                        {{ $hire->hire_register_id }} -
                                                                        {{ $hire->vendor_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                        </div>
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
                                                        <select class="form-control form-select" name="customer_id"
                                                            id="customerSelect">
                                                            <option value="">Select Customer</option>
                                                            @foreach ($customers as $customer)
                                                                <option value="{{ $customer->id }}">
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
                                                        <select name="consigner_id" class="form-control form-select"
                                                            id="consignerSelect">
                                                            <option value="" id="newConsignerOption">➕ New Consigner
                                                            </option>

                                                            @foreach ($consigners as $c)
                                                                <option value="{{ $c->id }}"
                                                                    data-name="{{ $c->name }}"
                                                                    data-address="{{ $c->address }}"
                                                                    data-pincode="{{ $c->pincode }}"
                                                                    data-state="{{ $c->state }}"
                                                                    data-city="{{ $c->city }}"
                                                                    data-coll_type="{{ $c->coll_type }}"
                                                                    data-delivery_type="{{ $c->delivery_type }}"
                                                                    data-doc_number="{{ $c->doc_number }}"
                                                                    data-type_of_doc="{{ $c->type_of_doc }}"
                                                                    data-contact="{{ $c->contact_no }}">
                                                                    {{ $c->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>


                                                <!-- Save to Address Book -->
                                                <div class="row mb-3">
                                                    <div class="col-md-8">
                                                        <div class="checkbox-box fw-bold">
                                                            <input type="checkbox" id="saveAddressBook"
                                                                name="save_consigner" value="1">
                                                            <label for="saveAddressBook">Save To Address Book</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Name -->
                                                <div class="row mb-2 align-items-center">
                                                    <label class="col-md-4 col-form-label">
                                                        Name<span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="consigner_name" class="form-control"
                                                            name="consigner_name">
                                                    </div>
                                                </div>

                                                <!-- Address -->
                                                <div class="row mb-2">
                                                    <label class="col-md-4 col-form-label">Address</label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" id="consigner_address" name="consigner_address" rows="2"></textarea>
                                                    </div>
                                                </div>

                                                <!-- Pincode -->
                                                <div class="row mb-2 align-items-center">
                                                    <label class="col-md-4 col-form-label">
                                                        Pincode<span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control"
                                                            name="consigner_pincode" value=""
                                                            id="consigner_pincode">

                                                    </div>
                                                </div>

                                                <!-- State -->
                                                <div class="row mb-2 align-items-center">
                                                    <label class="col-md-4 col-form-label">
                                                        State <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-md-8">

                                                        <input type="text" id="consigner_state" name="consigner_state"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row mb-2 align-items-center">
                                                    <label class="col-md-4 col-form-label">
                                                        City <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="consigner_city" name="consigner_city"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <!-- Contact -->
                                                <div class="row mb-2 align-items-center">
                                                    <label class="col-md-4 col-form-label">ContactNo.</label>
                                                    <div class="col-md-8">
                                                        <input type="number" id="consigner_contact" class="form-control"
                                                            name="consigner_contact">
                                                    </div>
                                                </div>

                                                <!-- Type of Doc -->
                                                <div class="row mb-2 align-items-center">
                                                    <label class="col-md-4 col-form-label">
                                                        TypeOfDoc<span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-md-8 d-flex">
                                                        <select class="form-control me-2 form-select"
                                                            name="consigner_type_of_doc" id="consigner_type_of_doc"
                                                            style="width: 45%;">
                                                            <option>GSTIN</option>
                                                            <option>PAN</option>
                                                        </select>
                                                        <input type="text" class="form-control"
                                                            name="consigner_doc_number" id="consigner_doc_number">
                                                    </div>
                                                </div>


                                                <!-- Coll Type -->
                                                <div class="row mb-2 align-items-center">
                                                    <label class="col-md-4 col-form-label">Coll Type</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control form-select" name="coll_type"
                                                            id="coll_type">
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
                                                        <select class="form-control form-select" name="delivery_type"
                                                            id="delivery_type">
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
                                                        <select name="consignee_id" class="form-control form-select"
                                                            id="consigneeSelect">
                                                            <option value="" id="newConsigneeOption">➕ New Consignee
                                                            </option>

                                                            @foreach ($consignees as $cp)
                                                                <option value="{{ $cp->id }}"
                                                                    data-name="{{ $cp->name }}"
                                                                    data-address="{{ $cp->address }}"
                                                                    data-pincode="{{ $cp->pincode }}"
                                                                    data-state="{{ $cp->state }}"
                                                                    data-city="{{ $cp->city }}"
                                                                    data-company="{{ $cp->company }}"
                                                                    data-contact="{{ $cp->contact_no }}">
                                                                    {{ $cp->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>

                                                <!-- Save To Address Book -->
                                                {{--  <div class="row mb-3">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-8">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="saveConsigneeAddressBook" name="save_consignee"
                                                                value="1">
                                                            <label class="form-check-label"
                                                                for="saveConsigneeAddressBook">
                                                                Save To Address Book
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>  --}}

                                                <div class="row mb-3">
                                                    <div class="col-md-8">
                                                        <div class="checkbox-box fw-bold">
                                                            <input type="checkbox" id="saveAddressBook"
                                                                name="save_consignee" value="1">
                                                            <label for="saveAddressBook">Save To Address Book</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Name -->
                                                <div class="row mb-2 align-items-center">
                                                    <label class="col-md-4 col-form-label">
                                                        Name<span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="consignee_name"
                                                            name="consignee_name">
                                                    </div>
                                                </div>

                                                <!-- Company -->
                                                <div class="row mb-2 align-items-center">
                                                    <label class="col-md-4 col-form-label">
                                                        Company<span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" id="consignee_company"
                                                            name="consignee_company">
                                                    </div>
                                                </div>

                                                <!-- Address -->
                                                <div class="row mb-2">
                                                    <label class="col-md-4 col-form-label">Address</label>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control" id="consignee_address" name="consignee_address" rows="2"></textarea>
                                                    </div>
                                                </div>

                                                <!-- Pincode -->
                                                <div class="row mb-2 align-items-center">
                                                    <label class="col-md-4 col-form-label">
                                                        Pincode<span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control"
                                                            name="consignee_pincode" id="consignee_pincode"
                                                            maxlength="6" placeholder="Enter Pincode">
                                                    </div>
                                                </div>

                                                <!-- State -->
                                                <div class="row mb-2 align-items-center">
                                                    <label class="col-md-4 col-form-label">State<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-8">

                                                        <input type="text" id="consignee_state" name="consignee_state"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <!-- City -->
                                                <div class="row mb-2 align-items-center">
                                                    <label class="col-md-4 col-form-label">City<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-md-8">
                                                        <input type="text" id="consignee_city" name="consignee_city"
                                                            class="form-control">
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
                                                        <input type="number" class="form-control"
                                                            name="consignee_contact" id="consignee_contact">
                                                    </div>
                                                </div>

                                                <!-- GST No -->
                                                <div class="row mb-2 align-items-center">
                                                    <label class="col-md-4 col-form-label">GST No</label>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="consignee_gst">
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
                                                        <input type="number" class="form-control"
                                                            name="chargeable_weight">
                                                    </div>
                                                </div>

                                                <!-- Rate -->
                                                <div class="row mb-2 align-items-center">
                                                    <label class="col-md-4 col-form-label">
                                                        Rate<span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-md-8">
                                                        <input type="number" step="0.01" class="form-control"
                                                            id="rate" name="rate" placeholder="Enter rate"
                                                            value="">
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
                                                            <!-- <div class="row mb-2 align-items-center">
                                                                                                <label class="col-md-6 col-form-label">{{ $label }}</label>
                                                                                                <div class="col-md-6">
                                                                                                    <input type="number" step="0.01" class="form-control charge-input"
                                                                                                        name="charges[{{ $name }}]" value="0">
                                                                                                </div>
                                                                                            </div> -->
                                                            <div class="row mb-2 align-items-center">
                                                                <label
                                                                    class="col-md-6 col-form-label">{{ $label }}</label>
                                                                <div class="col-md-6">
                                                                    <input type="number" step="0.01"
                                                                        class="form-control charge-input"
                                                                        name="{{ $name }}">
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
                                                                <label
                                                                    class="col-md-6 col-form-label">{{ $label }}</label>
                                                                <div class="col-md-6">
                                                                    <input type="number" step="0.01"
                                                                        class="form-control charge-input"
                                                                        name="charges[{{ $name }}]"
                                                                        value="0">
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        <div class="row mb-2 align-items-center">
                                                            <label class="col-md-6 col-form-label fw-bold">Total</label>
                                                            <div class="col-md-6">
                                                                <input class="form-control fw-bold bg-light"
                                                                    id="charges_total" name="sub_total" readonly
                                                                    value="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                {{-- FINAL CHARGE --}}
                                                <div class="fw-bold mb-3">Final Charge</div>
                                                <div class="row mb-2">
                                                    {{-- <div class="col-md-6">
                                    <label>Sub Total</label>
                                    <input class="form-control bg-light" id="sub_total" name="sub_total" readonly
                                        value="0">
                                </div>  --}}
                                                    <div class="col-md-6">
                                                        <label>Tax Type</label>
                                                        <select class="form-control form-select" id="tax_type"
                                                            name="tax_type">
                                                            <option value="">-- Select Tax Type --</option>
                                                            <option value="gst">CGST/SGST</option>
                                                            <option value="igst">IGST</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Tax %</label>
                                                        <select class="form-control form-select" id="tax"
                                                            name="tax">
                                                            <option value="">-- Select Tax --</option>
                                                            <option value="0">0</option>
                                                            <option value="5">5</option>
                                                            <option value="10">10</option>
                                                        </select>
                                                    </div>
                                                    <div class="row mb-2 gst-field d-none">
                                                        <div class="col-md-6">
                                                            <label>CGST Tax</label>
                                                            <input class="form-control bg-light" id="cgst"
                                                                name="cgst" readonly value="0">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 gst-field d-none">
                                                        <label>SGST Tax</label>
                                                        <input class="form-control bg-light" id="sgst"
                                                            name="sgst" readonly value="0">
                                                    </div>

                                                    <div class="col-md-6 igst-field d-none">
                                                        <label>IGST Tax</label>
                                                        <input class="form-control bg-light" id="igst"
                                                            name="igst" readonly value="0">
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-md-6">
                                                        <label class="fw-bold">Grand Total</label>
                                                        <input class="form-control fw-bold bg-light" id="grand_total"
                                                            name="grand_total" readonly value="0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mb-3">
                                    <button class="btn btn-primary">Submit</button>
                                    <a href="{{ route('domestic.shipment.index') }}"
                                        class="btn btn-outline-secondary me-2">
                                        <i class="bi bi-arrow-left"></i> Back
                                    </a>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Quick Example-->

                    </div>

                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const taxType = document.getElementById('tax_type');
            const taxPercent = document.getElementById('tax');

            function calculateCharges() {
                // Calculate freight = chargeable_weight * rate
                const chargeableWeight = parseFloat(document.querySelector('input[name="chargeable_weight"]')
                    .value) || 0;
                const rate = parseInt(document.querySelector('input[name="rate"]').value) || 0;
                const freight = chargeableWeight * rate;
                console.log('Chargeable Weight:', chargeableWeight);
                console.log('Rate:', rate);
                console.log('Calculated Freight:', freight);
                const freightInput = document.querySelector('input[name="freight"]');
                if (freightInput) {
                    freightInput.value = freight.toFixed(2);
                }

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
        $('#consignerSelect').on('change', function() {

            let option = $(this).find('option:selected');

            // ➕ NEW CONSIGNER
            if (option.attr('id') === 'newConsignerOption') {

                $('#consigner_name').val('');
                $('#consigner_address').val('');
                $('#consigner_pincode').val('');
                $('#consigner_state').val('');
                $('#consigner_city').val('');
                $('#consigner_contact').val('');

                $('#coll_type').val('');
                $('#delivery_type').val('');
                $('#consigner_doc_number').val('');
                $('#consigner_type_of_doc').val('');

                return;
            }

            // 🧾 EXISTING CONSIGNER
            $('#consigner_name').val(option.data('name') ?? '');
            $('#consigner_address').val(option.data('address') ?? '');
            $('#consigner_pincode').val(option.data('pincode') ?? '');
            $('#consigner_state').val(option.data('state') ?? '');
            $('#consigner_city').val(option.data('city') ?? '');
            $('#consigner_contact').val(option.data('contact') ?? '');

            $('#coll_type').val(option.data('coll_type') ?? '');
            $('#delivery_type').val(option.data('delivery_type') ?? '');

            $('#consigner_doc_number').val(option.data('doc_number') ?? '');
            $('#consigner_type_of_doc').val(option.data('type_of_doc') ?? '');

        });
    </script>

    <script>
        $('#consigneeSelect').on('change', function() {

            let option = $(this).find('option:selected');

            // ➕ NEW CONSIGNER
            if (option.attr('id') === 'newConsigneeOption') {

                $('#consignee_name').val('');
                $('#consignee_address').val('');
                $('#consignee_pincode').val('');
                $('#consignee_state').val('');
                $('#consignee_city').val('');
                $('#consignee_contact').val('');
                $('#consignee_company').val('');

                return;
            }

            // 🧾 EXISTING CONSIGNER
            $('#consignee_name').val(option.data('name') ?? '');
            $('#consignee_company').val(option.data('company') ?? '');
            $('#consignee_address').val(option.data('address') ?? '');
            $('#consignee_pincode').val(option.data('pincode') ?? '');
            $('#consignee_state').val(option.data('state') ?? '');
            $('#consignee_city').val(option.data('city') ?? '');
            $('#consignee_contact').val(option.data('contact') ?? '');

        });
    </script>

    <script>
        $(document).ready(function() {
            $('#consignerSelect').change(function() {
                $('#is_existing_consigner').val(1);
            });
        });
    </script>


    <script>
        $(document).ready(function() {

            function toggleVehicleFields(type) {

                // Disable & hide both
                $('#ownFields').addClass('d-none')
                    .find('input, select').prop('disabled', true);

                $('#rentedFields').addClass('d-none')
                    .find('input, select').prop('disabled', true);

                if (type === 'own') {
                    $('#ownFields').removeClass('d-none')
                        .find('input, select').prop('disabled', false);
                }

                if (type === 'rented') {
                    $('#rentedFields').removeClass('d-none')
                        .find('input, select').prop('disabled', false);
                }
            }

            // On change
            $('#vehicle_type').on('change', function() {
                toggleVehicleFields($(this).val());
            });

            // 🔥 VERY IMPORTANT: trigger once on page load
            toggleVehicleFields($('#vehicle_type').val());
        });
    </script>

    <script>
        $(document).ready(function() {
            // Handle vendor selection for filtering hire registers
            $('#vendor_id').on('change', function() {
                var selectedVendorId = $(this).val();
                var hireSelect = $('#vehicle_hire_id');

                // Clear current selection
                hireSelect.val('');

                if (selectedVendorId) {
                    // Show only hire registers for selected vendor
                    hireSelect.find('option').each(function() {
                        var vendorId = $(this).data('vendor');
                        if ($(this).val() === '' || vendorId == selectedVendorId) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                } else {
                    // Show all hire registers if no vendor selected
                    hireSelect.find('option').show();
                }
            });

            // Reset vendor and hire register when vehicle type changes
            $('#vehicle_type').on('change', function() {
                if ($(this).val() !== 'rented') {
                    $('#vendor_id').val('');
                    $('#vehicle_hire_id').val('');
                    $('#vehicle_hire_id').find('option').show();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#customerSelect').change(function() {

                let customerId = $(this).val();
                console.log("cusomter id", customerId);
                if (!customerId) return;

                $.get('/customer/' + customerId, function(data) {

                    // Fill Consigner fields from Customer Master
                    $('#consigner_name').val(data.customer_name);
                    $('#consigner_address').val(data.address);
                    $('#consigner_pincode').val(data.pincode);
                    $('#consigner_state').val(data.state);
                    $('#consigner_contact').val(data.phone);
                    $('#consigner_gst').val(data.gst_no);
                    $('#phone').val(data.phone);
                    $('#consigner_city').val(data.city);

                    // City (select)
                    // $('#consigner_city').html(
                    //     `<option value="${data.city}" selected>${data.city}</option>`
                    // );
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('#consigner_pincode').on('keyup', function() {

                let pincode = $(this).val();

                if (pincode.length === 6) {
                    $.get('/get-location/' + pincode, function(res) {

                        // ✅ Set consigner state & city
                        $('#consigner_state').val(res.state);
                        $('#consigner_city').val(res.city);

                    }).fail(function() {
                        alert('Invalid Pincode');
                    });
                }
            });

        });
    </script>


    <script>
        $(document).ready(function() {

            $('#consignee_pincode').on('keyup', function() {

                let pincode = $(this).val();

                if (pincode.length === 6) {
                    $.get('/get-location/' + pincode, function(res) {

                        // ✅ Set consignee state & city
                        $('#consignee_state').val(res.state);
                        $('#consignee_city').val(res.city);

                    }).fail(function() {
                        alert('Invalid Pincode');
                    });
                }
            });

        });
    </script>
    <script>
        function addInvoiceRow() {
            const tableBody = document.querySelector('#invoiceTable tbody');
            const rowCount = tableBody.rows.length;
            const newRow = tableBody.insertRow();

            newRow.innerHTML = `
            <td><input type="text" class="form-control" name="invoices[${rowCount}][invoice_no]" required></td>
            <td><input type="number" step="0.01" class="form-control" name="invoices[${rowCount}][invoice_value]" required></td>
            <td><input type="date" class="form-control" name="invoices[${rowCount}][invoice_date]" required></td>
            <td><input type="number" class="form-control" name="invoices[${rowCount}][quantity]" required></td>
            <td><input type="text" class="form-control" name="invoices[${rowCount}][type_of_parcel]" required></td>
            <td><input type="text" class="form-control" name="invoices[${rowCount}][eway_no]"></td>
            <td><input type="date" class="form-control" name="invoices[${rowCount}][eway_expiry_date]"></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeInvoiceRow(this)">Remove</button></td>
        `;
        }

        function removeInvoiceRow(button) {
            const row = button.closest('tr');
            row.remove();
            // Re-index remaining rows
            const rows = document.querySelectorAll('#invoiceTable tbody tr');
            rows.forEach((row, index) => {
                const inputs = row.querySelectorAll('input');
                inputs.forEach(input => {
                    const name = input.name.replace(/\[\d+\]/, `[${index}]`);
                    input.name = name;
                });
            });
        }
    </script>
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
        $(document).ready(function() {
            // Vehicle Type Toggle
            $("#vehicle_type").on("change", function() {
                var vehicleType = $(this).val();

                if (vehicleType === "own") {
                    $("#ownFields").removeClass("d-none");
                    $("#rentedFields").addClass("d-none");
                } else if (vehicleType === "rented") {
                    $("#rentedFields").removeClass("d-none");
                    $("#ownFields").addClass("d-none");
                } else {
                    $("#ownFields").addClass("d-none");
                    $("#rentedFields").addClass("d-none");
                }
            });

            // Vendor Change - Filter Hire Register
            $("#vendor_id").on("change", function() {
                var selectedVendorId = $(this).val();
                var hireSelect = $("#vehicle_hire_id");

                if (selectedVendorId) {
                    hireSelect.find("option").each(function() {
                        var vendorId = $(this).data("vendor");
                        if ($(this).val() === "" || vendorId == selectedVendorId) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                    hireSelect.val("");
                } else {
                    hireSelect.find("option").show();
                    hireSelect.val("");
                }
            });

            // Hire Register Change - Update Fields
            $("#vehicle_hire_id").on("change", function() {
                var selectedOption = $(this).find("option:selected");
                var vendorId = selectedOption.data("vendor");
                $("#vendor_id").val(vendorId);
            });
        });
    </script>

    <script>
        document.getElementById('vendor_id').addEventListener('change', function() {
            let vendorId = this.value;
            let hireSelect = document.getElementById('vehicle_hire_id');
            let options = hireSelect.querySelectorAll('option');

            hireSelect.value = "";

            options.forEach(option => {
                if (option.value === "") return;

                let optionVendor = option.getAttribute('data-vendor');

                if (vendorId && optionVendor === vendorId) {
                    option.style.display = "block";
                } else {
                    option.style.display = "none";
                }
            });
        });
    </script>





@endsection
