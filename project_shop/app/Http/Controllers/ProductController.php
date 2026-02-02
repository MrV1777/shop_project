<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }
    
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
    
    public function create()
    {
        return view('products.create');
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
        ]);
        
        Product::create($validatedData);
        
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
    
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }
    
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|string',
        ]);
        
        $product->update($validatedData);
        
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    
    public function purchase($id)
    {
        $product = Product::findOrFail($id);
        
        // In a real application, you would process the payment here
        // For this example, we'll just redirect back with a success message
        return redirect()->back()->with('success', 'Product purchased successfully!');
    }
}
