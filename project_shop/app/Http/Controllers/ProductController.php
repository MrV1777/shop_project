<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image'
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'_'.uniqid().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        Product::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'image' => $imageName
        ]);

        return redirect()->back()->with('success', 'Product added successfully.');
    }
    
    public function index()
    {
        $products = Product::paginate(10);
        return view('product.Listproduct', compact('products'));
    }
    
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image'
        ]);
        
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($product->image && File::exists(public_path('images/'.$product->image))) {
                File::delete(public_path('images/'.$product->image));
            }

            $imageName = time().'_'.uniqid().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        $product->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'image' => $product->image
        ]);

        return redirect('/products')->with('success', 'Product updated successfully.');
    }
    
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image && File::exists(public_path('images/'.$product->image))) {
            File::delete(public_path('images/'.$product->image));
        }

        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

}

