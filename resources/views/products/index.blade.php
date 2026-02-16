@extends('admin.partials.app')

@section('main-content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Products</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">
                    <div class="col-md-12">

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="card card-primary card-outline mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-title">Product List</div>
                                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm"><i
                                        class="bi bi-plus-lg"></i> Add Product</a>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body table-responsive">
                                <table class="table align-middle table-hover datatable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Actual Wt</th>
                                            <th class="text-center">Charge Wt</th>
                                            <th class="text-end">Amount</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr>
                                                <td class="fw-semibold text-muted">
                                                    {{ $product->id }}
                                                </td>

                                                <td>
                                                    <div class="fw-semibold">
                                                        {{ $product->product_name }}
                                                    </div>
                                                    <small class="text-muted">
                                                        {{ $product->description }}
                                                    </small>
                                                </td>

                                                <td class="text-center">
                                                    <span class="badge bg-secondary">
                                                        {{ $product->qty }}
                                                    </span>
                                                </td>

                                                <td class="text-center">
                                                    <span class="badge bg-info">
                                                        {{ $product->actual_wt ?? 0 }} KG
                                                    </span>
                                                </td>

                                                <td class="text-center">
                                                    <span class="badge bg-warning text-dark">
                                                        {{ $product->charge_wt ?? 0 }} KG
                                                    </span>
                                                </td>

                                                <td class="text-end fw-bold text-success">
                                                    ₹ {{ number_format($product->amount, 2) }}
                                                </td>

                                                <td class="text-center">
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                        class="btn btn-sm btn-outline-warning me-1">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>

                                                    <form action="{{ route('products.destroy', $product->id) }}"
                                                        method="POST" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('Are you sure to delete this product?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-5">
                                                    <i class="bi bi-inbox display-6 text-muted"></i>
                                                    <p class="mt-2 text-muted mb-0">No products found</p>
                                                    <a href="{{ route('products.create') }}"
                                                        class="btn btn-sm btn-primary mt-2">
                                                        Add First Product
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
