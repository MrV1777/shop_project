<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    // Admin methods
    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric|min:0',
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
    
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }
    
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image'
        ]);

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

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }
    
    public function destroy(Product $product)
    {
        if ($product->image && File::exists(public_path('images/'.$product->image))) {
            File::delete(public_path('images/'.$product->image));
        }

        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
    
    // Public product browsing methods
    public function publicIndex(Request $request)
    {
        $query = Product::query();
        
        // Handle search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        
        $products = $query->paginate(8);
        return view('home.public_products', compact('products'));
    }
    
    public function show(Product $product)
    {
        return view('home.product_detail', compact('product'));
    }
    
    /**
     * Display a listing of products for normal users.
     *
     * @return \Illuminate\Http\Response
     */
    public function userIndex(Request $request)
    {
        $query = Product::query();
        
        // Handle search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        
        $products = $query->paginate(8);
        
        // Get featured products for home page
        $featuredProducts = Product::inRandomOrder()->limit(4)->get();
        
        return view('home.user_products', compact('products', 'featuredProducts'));
    }
    
    // Cart methods
    public function cart()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('home.cart', compact('cart', 'total'));
    }
    
    public function addToCart(Product $product)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to add products to cart.');
        }
        
        $cart = session()->get('cart', []);
        
        // Check if product already exists in cart
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->quantity, // Using quantity field as price
                "image" => $product->image
            ];
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    
    public function removeFromCart(Product $product)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }
    
    public function updateCart(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Cart updated successfully!');
    }
    
    // Checkout methods
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty!');
        }
        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('home.checkout', compact('cart', 'total'));
    }
    
    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty!');
        }
        
        // In a real application, you would process payment here
        // For this example, we'll just clear the cart and show a success message
        
        session()->forget('cart');
        
        return redirect()->route('products.index')->with('success', 'Order placed successfully! Thank you for your purchase.');
    }
}
