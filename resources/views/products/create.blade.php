@extends('admin.partials.app')

@section('main-content')

<style>
    .form-control:focus {
        color: var(--bs-body-color);
        background-color: var(--bs-body-bg);
        /* border-color: rgb(134, 182.5, 254); */
        outline: 0;
        box-shadow: var(--bs-box-shadow-inset), 0 0 0 0.25rem rgb(242 243 244 / 25%);
    }
</style>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-secondary" style="font-weight: bold;">Create Product</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Home</a></li>
                        <li class="breadcrumb-item active text-secondary">Create Product</li>
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

                    <div class="card shadow border-4 border-primary">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-box-seam me-2"></i> Product Details
                            </h5>
                        </div>

                        <form action="{{ route('products.store') }}" method="POST" id="productForm">
                            @csrf

                            <div class="card-body">

                                <!-- ================= BASIC INFO ================= -->
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-header bg-light border-start border-4 border-success">
                                        <strong><i class="bi bi-info-circle me-2"></i> Basic Information</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">

                                            <div class="col-md-6">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Product Name"></i> Product Name <span class="text-danger">*</span></label>
                                                <input type="text" name="product_name" id="product_name"
                                                    value="{{ old('product_name') }}"
                                                    class="form-control"
                                                    placeholder="Enter Product Name" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label text-muted"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Description"></i> Description</label>
                                                <input type="text" name="description"
                                                    value="{{ old('description') }}"
                                                    class="form-control border-secondary"
                                                    placeholder="Optional Description">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- ================= QUANTITY & RATE ================= -->
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-header bg-light border-start border-4 border-primary">
                                        <strong><i class="bi bi-calculator me-2"></i> Quantity & Rate</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">

                                            <div class="col-md-3">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Quantity"></i> Quantity *</label>
                                                <input type="number" id="qty" name="qty"
                                                    value="{{ old('qty') }}"
                                                    class="form-control"
                                                    placeholder="Qty" required>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label text-muted"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Actual Weight"></i> Actual Weight</label>
                                                <div class="input-group">
                                                    <input type="number" step="0.01" id="actual_wt"
                                                        name="actual_wt"
                                                        value="{{ old('actual_wt') }}"
                                                        class="form-control border-secondary">
                                                    <span class="input-group-text">KG</span>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label text-muted"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Charge Weight"></i> Charge Weight</label>
                                                <div class="input-group">
                                                    <input type="number" step="0.01" id="charge_wt"
                                                        name="charge_wt"
                                                        value="{{ old('charge_wt') }}"
                                                        class="form-control border-secondary">
                                                    <span class="input-group-text">KG</span>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Unit / BAG Rate"></i> Unit / BAG Rate *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">₹</span>
                                                    <input type="number" step="0.01"
                                                        id="unit_bag_rate"
                                                        name="unit_bag_rate"
                                                        value="{{ old('unit_bag_rate') }}"
                                                        class="form-control"
                                                        required>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row g-3 mt-3">
                                            <div class="col-md-6">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Select Rate Type"></i> Rate Type *</label>
                                                <select name="rate_type" class="form-select" id="rate_type" required>
                                                    <option value="">Select Rate Type</option>
                                                    @php
                                                    $rateTypes = ['Qty', 'Actual Weight', 'Chargeable Weight', 'Fixed'];
                                                    @endphp
                                                    @foreach ($rateTypes as $rate)
                                                    <option value="{{ $rate }}">{{ $rate }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Amount"></i> Amount</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-success text-white">₹</span>
                                                    <input type="number" step="0.01"
                                                        id="amount"
                                                        name="amount"
                                                        class="form-control bg-light"
                                                        readonly>
                                                </div>
                                                <small class="text-muted">Auto calculated</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ================= SHORTAGE ================= -->
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-header bg-light border-start border-4 border-warning">
                                        <strong><i class="bi bi-exclamation-triangle me-2"></i> Shortage Details</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label text-muted"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Shortage Weight"></i> Shortage Weight</label>
                                                <input type="number" step="0.01"
                                                    name="shortage_wt"
                                                    id="shortage_wt"
                                                    class="form-control border-secondary">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label text-muted"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Shortage Rate"></i> Shortage Rate</label>
                                                <input type="number" step="0.01"
                                                    name="shortage_rate"
                                                    id="shortage_rate"
                                                    class="form-control border-secondary">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Shortage Amount"></i> Shortage Amount</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-warning">₹</span>
                                                    <input type="number" step="0.01"
                                                        name="shortage_amt"
                                                        id="shortage_amt"
                                                        class="form-control bg-light"
                                                        readonly>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- ================= DIMENSIONS ================= -->
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-header bg-light border-start border-4 border-secondary">
                                        <strong><i class="bi bi-aspect-ratio me-2"></i> Dimensions (Optional)</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label text-muted"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Length"></i> Length</label>
                                                <input type="number" step="0.01"
                                                    name="length"
                                                    class="form-control border-secondary">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label text-muted"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Width"></i> Width</label>
                                                <input type="number" step="0.01"
                                                    name="width"
                                                    class="form-control border-secondary">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label text-muted"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Height"></i> Height</label>
                                                <input type="number" step="0.01"
                                                    name="height"
                                                    class="form-control border-secondary">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- ================= FOOTER ================= -->
                            <div class="card-footer bg-light text-end">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary me-2">
                                    <i class="bi bi-arrow-left-circle me-1"></i> Back
                                </a>
                                <button type="submit" class="btn btn-secondary">
                                    <i class="bi bi-plus-circle me-1"></i> Add Product
                                </button>
                            </div>

                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
</main>

<!-- JS: Live Validation & Amount Calculation -->
<script>
    const fields = ['product_name', 'qty', 'unit_bag_rate', 'rate_type'];

    function validateField(id) {
        const field = document.getElementById(id);
        const label = document.getElementById('label_' + id);
        if (!field.value || (field.type === 'number' && field.value <= 0)) {
            field.classList.add('border-danger');
            field.classList.remove('border-success');
            label.classList.add('text-danger');
            label.classList.remove('text-success');
        } else {
            field.classList.remove('border-danger');
            field.classList.add('border-success');
            label.classList.remove('text-danger');
            label.classList.add('text-success');
        }
    }

    function calculateAmount() {
        let rateType = document.getElementById('rate_type').value;
        let qty = parseFloat(document.getElementById('qty').value) || 0;
        let actualWt = parseFloat(document.getElementById('actual_wt').value) || 0;
        let chargeWt = parseFloat(document.getElementById('charge_wt').value) || 0;
        let rate = parseFloat(document.getElementById('unit_bag_rate').value) || 0;
        let amount = 0;

        if (rateType === 'Qty') amount = qty * rate;
        else if (rateType === 'Actual Weight') amount = actualWt * rate;
        else if (rateType === 'Chargeable Weight') amount = chargeWt * rate;
        else if (rateType === 'Fixed') amount = rate;

        document.getElementById('amount').value = amount.toFixed(2);

        // Shortage Amount
        let shortageWt = parseFloat(document.getElementById('shortage_wt').value) || 0;
        let shortageRate = parseFloat(document.getElementById('shortage_rate').value) || 0;
        document.getElementById('shortage_amt').value = (shortageWt * shortageRate).toFixed(2);
    }

    fields.forEach(id => {
        const field = document.getElementById(id);
        field.addEventListener('input', () => {
            validateField(id);
            calculateAmount();
        });
    });

    ['actual_wt', 'charge_wt', 'shortage_wt', 'shortage_rate', 'unit_bag_rate'].forEach(id => {
        document.getElementById(id).addEventListener('input', calculateAmount);
    });

    // initial validation
    fields.forEach(id => validateField(id));
</script>

@endsection
