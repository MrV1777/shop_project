@extends('layouts.public')

@section('title', $product->name . ' - Shop Application')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            @if($product->image)
                <img src="{{ asset('images/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
            @else
                <img src="https://via.placeholder.com/600x400?text=No+Image" class="img-fluid rounded" alt="{{ $product->name }}">
            @endif
        </div>
        <div class="col-md-6">
            <h1 class="mb-3">{{ $product->name }}</h1>
            <p class="lead text-primary fw-bold fs-4">${{ number_format($product->quantity, 2) }}</p>
            
            <div class="mb-4">
                <h5>Description</h5>
                <p>{{ $product->description ?? 'No description available for this product.' }}</p>
            </div>
            
            <div class="mb-4">
                <h5>Availability</h5>
                @if($product->quantity > 0)
                    <span class="badge bg-success">In Stock</span>
                    <p class="mt-2">({{ $product->quantity }} items available)</p>
                @else
                    <span class="badge bg-danger">Out of Stock</span>
                @endif
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                @auth
                    @if(Auth::user()->role === 'user')
                        @if($product->quantity > 0)
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-lg me-md-2">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        @else
                            <button class="btn btn-secondary btn-lg" disabled>
                                <i class="bi bi-cart-x"></i> Out of Stock
                            </button>
                        @endif
                    @else
                        <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-gear"></i> Manage Products
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-box-arrow-in-right"></i> Login to Purchase
                    </a>
                @endauth
                
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg">
                    <i class="bi bi-arrow-left"></i> Back to Products
                </a>
            </div>
        </div>
    </div>
    
    <!-- Related Products Section -->
    <section class="mt-5">
        <h3 class="mb-4">Related Products</h3>
        <div class="row">
            @foreach(App\Models\Product::where('id', '!=', $product->id)->take(4)->get() as $relatedProduct)
                <div class="col-md-3 mb-4">
                    <div class="card product-card">
                        @if($relatedProduct->image)
                            <img src="{{ asset('images/' . $relatedProduct->image) }}" class="card-img-top product-image" alt="{{ $relatedProduct->name }}">
                        @else
                            <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top product-image" alt="{{ $relatedProduct->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary">${{ number_format($relatedProduct->quantity, 2) }}</span>
                                <a href="{{ route('products.show', $relatedProduct) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection