<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products_table', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|string|max:255',
        ]);

        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => (float) $request->price,
            'stock' => (int) $request->stock,
            'image' => $request->image,
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found!');
        }
        
        return view('product_edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found!');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|string|max:255',
        ]);

        $product->update([
            'name' => $request->name,
            'category' => $request->category,
            'price' => (float) $request->price,
            'stock' => (int) $request->stock,
            'image' => $request->image,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        
        if ($product) {
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
        }
        
        return redirect()->route('products.index')->with('error', 'Product not found!');
    }
}
