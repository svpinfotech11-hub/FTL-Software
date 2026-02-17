@extends('admin.partials.app')

@section('main-content')

<style>
    .form-control:focus {
        color: var(--bs-body-color);
        background-color: var(--bs-body-bg);
        outline: 0;
        box-shadow: var(--bs-box-shadow-inset), 0 0 0 0.25rem rgb(198 255 198 / 45%);
    }
</style>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-primary">Update Product</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Home</a></li>
                        <li class="breadcrumb-item active text-primary">Update Product</li>
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

                        <!-- Header -->
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="bi bi-pencil-square me-2"></i> Update Product
                            </h5>
                            <span class="badge bg-light text-dark">
                                ID: {{ $product->id }}
                            </span>
                        </div>

                        <form action="{{ route('products.update', $product->id) }}" method="POST" id="productForm">
                            @csrf
                            @method('PUT')

                            <div class="card-body">

                                <!-- ================= BASIC INFO ================= -->
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-header bg-light border-start border-4 border-primary">
                                        <strong><i class="bi bi-box-seam me-2"></i> Basic Information</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">

                                            <div class="col-md-6">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Product Name"></i> Product Name <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    name="product_name"
                                                    value="{{ old('product_name', $product->product_name) }}"
                                                    class="form-control"
                                                    required>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label text-muted"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Description"></i> Description</label>
                                                <input type="text"
                                                    name="description"
                                                    value="{{ old('description', $product->description) }}"
                                                    class="form-control border-secondary">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- ================= QUANTITY & RATE ================= -->
                                <div class="card mb-4 shadow-sm">
                                    <div class="card-header bg-light border-start border-4 border-success">
                                        <strong><i class="bi bi-calculator me-2"></i> Quantity & Rate Details</strong>
                                    </div>
                                    <div class="card-body">

                                        <div class="row g-3">

                                            <div class="col-md-3">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Quantity"></i> Quantity *</label>
                                                <input type="number"
                                                    name="qty"
                                                    id="qty"
                                                    value="{{ old('qty', $product->qty) }}"
                                                    class="form-control"
                                                    required>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label text-muted"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Actual Weight"></i> Actual Weight</label>
                                                <div class="input-group">
                                                    <input type="number" step="0.01"
                                                        name="actual_wt"
                                                        id="actual_wt"
                                                        value="{{ old('actual_wt', $product->actual_wt) }}"
                                                        class="form-control border-secondary">
                                                    <span class="input-group-text">KG</span>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label text-muted"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Charge Weight"></i> Charge Weight</label>
                                                <div class="input-group">
                                                    <input type="number" step="0.01"
                                                        name="charge_wt"
                                                        id="charge_wt"
                                                        value="{{ old('charge_wt', $product->charge_wt) }}"
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
                                                        name="unit_bag_rate"
                                                        id="unit_bag_rate"
                                                        value="{{ old('unit_bag_rate', $product->unit_bag_rate) }}"
                                                        class="form-control"
                                                        required>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row g-3 mt-3">

                                            <div class="col-md-6">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Select Rate Type"></i> Rate Type *</label>
                                                <select name="rate_type"
                                                    class="form-select"
                                                    id="rate_type"
                                                    required>
                                                    <option value="">Select Rate Type</option>
                                                    @php
                                                    $rateTypes = ['Qty', 'Actual Weight', 'Chargeable Weight', 'Fixed'];
                                                    $selectedRate = old('rate_type', $product->rate_type ?? '');
                                                    @endphp
                                                    @foreach ($rateTypes as $rate)
                                                    <option value="{{ $rate }}" {{ $selectedRate == $rate ? 'selected' : '' }}>
                                                        {{ $rate }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Amount"></i> Amount</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-success text-white">₹</span>
                                                    <input type="number" step="0.01"
                                                        name="amount"
                                                        id="amount"
                                                        value="{{ old('amount', $product->amount) }}"
                                                        class="form-control bg-light fw-bold"
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
                                                    value="{{ old('shortage_wt', $product->shortage_wt) }}"
                                                    class="form-control border-secondary">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label text-muted"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Shortage Rate"></i> Shortage Rate</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">₹</span>
                                                    <input type="number" step="0.01"
                                                        name="shortage_rate"
                                                        id="shortage_rate"
                                                        value="{{ old('shortage_rate', $product->shortage_rate) }}"
                                                        class="form-control border-secondary">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Shortage Amount"></i> Shortage Amount</label>
                                                <div class="input-group">
                                                    <span class="input-group-text bg-warning">₹</span>
                                                    <input type="number" step="0.01"
                                                        name="shortage_amt"
                                                        id="shortage_amt"
                                                        value="{{ old('shortage_amt', $product->shortage_amt) }}"
                                                        class="form-control bg-light fw-bold"
                                                        readonly>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- ================= DIMENSIONS ================= -->
                                <div class="card shadow-sm">
                                    <div class="card-header bg-light border-start border-4 border-secondary">
                                        <strong><i class="bi bi-aspect-ratio me-2"></i> Dimensions</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <label class="form-label text-muted"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Length"></i> Length</label>
                                                <input type="number" step="0.01"
                                                    name="length"
                                                    value="{{ old('length', $product->length) }}"
                                                    class="form-control border-secondary">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label text-muted"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Width"></i> Width</label>
                                                <input type="number" step="0.01"
                                                    name="width"
                                                    value="{{ old('width', $product->width) }}"
                                                    class="form-control border-secondary">
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label text-muted"><i class="bi bi-info-circle text-primary"
                                                    title="Enter Height"></i> Height</label>
                                                <input type="number" step="0.01"
                                                    name="height"
                                                    value="{{ old('height', $product->height) }}"
                                                    class="form-control border-secondary">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Footer -->
                            <div class="card-footer bg-light text-end">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary me-2">
                                    <i class="bi bi-arrow-left-circle me-1"></i> Back
                                </a>

                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-check-circle me-1"></i> Update Product
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
        if (!field.value || (field.type === 'number' && parseFloat(field.value) <= 0)) {
            field.classList.add('border-danger');
            field.classList.remove('border-success');
            if (label) {
                label.classList.add('text-danger');
                label.classList.remove('text-success');
            }
        } else {
            field.classList.remove('border-danger');
            field.classList.add('border-success');
            if (label) {
                label.classList.remove('text-danger');
                label.classList.add('text-success');
            }
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
        if (field) {
            field.addEventListener('input', () => {
                validateField(id);
                calculateAmount();
            });
        }
    });

    ['actual_wt', 'charge_wt', 'shortage_wt', 'shortage_rate', 'unit_bag_rate'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener('input', calculateAmount);
    });

    // initial validation and calculation
    fields.forEach(id => validateField(id));
    calculateAmount();
</script>

@endsection
