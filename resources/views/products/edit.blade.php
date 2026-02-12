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
                    <h3 class="mb-0 text-success">Update Product</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Home</a></li>
                        <li class="breadcrumb-item active text-success">Update Product</li>
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

                    <div class="card border-secondary shadow-sm">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="card-title mb-0">Product Details</h5>
                        </div>

                        <form action="{{ route('products.update', $product->id) }}" method="POST" id="productForm">
                            @csrf
                            @method('PUT')

                            <div class="card-body">

                                <!-- Row 1: Name & Description -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="product_name" class="form-label" id="label_product_name">Product Name <span class="text-danger">*</span></label>
                                        <input type="text" name="product_name" id="product_name" value="{{ old('product_name', $product->product_name) }}" class="form-control" placeholder="Enter Product Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="description" class="form-label text-muted">Description (Optional)</label>
                                        <input type="text" name="description" id="description" value="{{ old('description', $product->description) }}" class="form-control border-secondary" placeholder="Enter Description">
                                    </div>
                                </div>

                                <!-- Row 2: Quantity & Weights -->
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="qty" class="form-label" id="label_qty">Quantity <span class="text-danger">*</span></label>
                                        <input type="number" id="qty" name="qty" value="{{ old('qty', $product->qty) }}" class="form-control" placeholder="Enter Quantity" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="actual_wt" class="form-label text-muted">Actual Weight (Optional)</label>
                                        <input type="number" step="0.01" id="actual_wt" name="actual_wt" value="{{ old('actual_wt', $product->actual_wt) }}" class="form-control border-secondary" placeholder="Enter Actual Weight">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="charge_wt" class="form-label text-muted">Charge Weight (Optional)</label>
                                        <input type="number" step="0.01" id="charge_wt" name="charge_wt" value="{{ old('charge_wt', $product->charge_wt) }}" class="form-control border-secondary" placeholder="Enter Charge Weight">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="unit_bag_rate" class="form-label" id="label_unit_bag_rate">Unit/BAG Rate <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" id="unit_bag_rate" name="unit_bag_rate" value="{{ old('unit_bag_rate', $product->unit_bag_rate) }}" class="form-control" placeholder="Enter Rate" required>
                                    </div>
                                </div>

                                <!-- Row 3: Rate Type & Amount -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="rate_type" class="form-label" id="label_rate_type">Rate Type <span class="text-danger">*</span></label>
                                        <select name="rate_type" class="form-select" id="rate_type" required>
                                            <option value="">Select Rate Type</option>
                                            @php
                                            $rateTypes = ['Qty', 'Actual Weight', 'Chargeable Weight', 'Fixed'];
                                            $selectedRate = old('rate_type', $product->rate_type ?? '');
                                            @endphp
                                            @foreach ($rateTypes as $rate)
                                            <option value="{{ $rate }}" {{ $selectedRate == $rate ? 'selected' : '' }}>{{ $rate }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="amount" class="form-label">Amount</label>
                                        <input type="number" step="0.01" id="amount" name="amount" value="{{ old('amount', $product->amount) }}" class="form-control" placeholder="Calculated Automatically" readonly>
                                    </div>
                                </div>

                                <!-- Row 4: Shortage -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="shortage_wt" class="form-label text-muted">Shortage Weight (Optional)</label>
                                        <input type="number" step="0.01" name="shortage_wt" id="shortage_wt" value="{{ old('shortage_wt', $product->shortage_wt) }}" class="form-control border-secondary" placeholder="Enter Shortage Weight">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="shortage_rate" class="form-label text-muted">Shortage Rate (Optional)</label>
                                        <input type="number" step="0.01" name="shortage_rate" id="shortage_rate" value="{{ old('shortage_rate', $product->shortage_rate) }}" class="form-control border-secondary" placeholder="Enter Shortage Rate">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="shortage_amt" class="form-label">Shortage Amount</label>
                                        <input type="number" step="0.01" name="shortage_amt" id="shortage_amt" value="{{ old('shortage_amt', $product->shortage_amt) }}" class="form-control" placeholder="Calculated Automatically" readonly>
                                    </div>
                                </div>

                                <!-- Row 5: Dimensions -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="length" class="form-label text-muted">Length (Optional)</label>
                                        <input type="number" step="0.01" name="length" id="length" value="{{ old('length', $product->length) }}" class="form-control border-secondary" placeholder="Enter Length">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="width" class="form-label text-muted">Width (Optional)</label>
                                        <input type="number" step="0.01" name="width" id="width" value="{{ old('width', $product->width) }}" class="form-control border-secondary" placeholder="Enter Width">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="height" class="form-label text-muted">Height (Optional)</label>
                                        <input type="number" step="0.01" name="height" id="height" value="{{ old('height', $product->height) }}" class="form-control border-secondary" placeholder="Enter Height">
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer text-end bg-light">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary me-2">Back</a>
                                <button type="submit" class="btn btn-secondary">Update Product</button>
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
            if(label) {
                label.classList.add('text-danger');
                label.classList.remove('text-success');
            }
        } else {
            field.classList.remove('border-danger');
            field.classList.add('border-success');
            if(label) {
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
        if(field) {
            field.addEventListener('input', () => {
                validateField(id);
                calculateAmount();
            });
        }
    });

    ['actual_wt', 'charge_wt', 'shortage_wt', 'shortage_rate', 'unit_bag_rate'].forEach(id => {
        const el = document.getElementById(id);
        if(el) el.addEventListener('input', calculateAmount);
    });

    // initial validation and calculation
    fields.forEach(id => validateField(id));
    calculateAmount();
</script>

@endsection
