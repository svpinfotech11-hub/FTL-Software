<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // List all products
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        return view('products.create');
    }

    // Store new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name'   => 'required|string|max:255',
            'description'    => 'nullable|string',
            'qty'            => 'required|integer',
            'actual_wt'      => 'nullable|numeric',
            'charge_wt'      => 'nullable|numeric',
            'unit_bag_rate'  => 'nullable|numeric',
            'rate_type'      => 'nullable|string|max:50',
            'rec_weight'     => 'nullable|numeric',
            'shortage_wt'    => 'nullable|numeric',
            'shortage_rate'  => 'nullable|numeric',
            'shortage_amt'   => 'nullable|numeric',
            'amount'         => 'nullable|numeric',
            'length'         => 'nullable|numeric',
            'width'          => 'nullable|numeric',
            'height'         => 'nullable|numeric',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
                         ->with('success', 'Product created successfully.');
    }

    // Show single product (optional)
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Show edit form
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // Update product
    public function update(Request $request, $id)
    {

         $product = Product::findOrFail($id);
        $validated = $request->validate([
            'product_name'   => 'sometimes|required|string|max:255',
            'description'    => 'nullable|string',
            'qty'            => 'sometimes|required|integer',
            'actual_wt'      => 'nullable|numeric',
            'charge_wt'      => 'nullable|numeric',
            'unit_bag_rate'  => 'nullable|numeric',
            'rate_type'      => 'nullable|string|max:50',
            'rec_weight'     => 'nullable|numeric',
            'shortage_wt'    => 'nullable|numeric',
            'shortage_rate'  => 'nullable|numeric',
            'shortage_amt'   => 'nullable|numeric',
            'amount'         => 'nullable|numeric',
            'length'         => 'nullable|numeric',
            'width'          => 'nullable|numeric',
            'height'         => 'nullable|numeric',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
                         ->with('success', 'Product updated successfully.');
    }

    // Delete product
    public function destroy($id)
    {

    $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Product deleted successfully.');
    }
}
