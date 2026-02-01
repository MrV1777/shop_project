@extends('layouts.public')

@section('title', 'Products - Shop Application')

@section('content')
<div class="container my-5">
    <!-- Hero Section -->
    <section class="text-center py-5 mb-5" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); border-radius: 15px; color: white;">
        <div class="container">
            <h1 class="display-4 fw-bold">Welcome to ShopApp</h1>
            <p class="lead">Discover amazing products at unbeatable prices</p>
            <div class="mt-4">
                <a href="#products" class="btn btn-light btn-lg me-2">Shop Now</a>
                <a href="#" class="btn btn-outline-light btn-lg">View Categories</a>
            </div>
        </div>
    </section>

    <!-- Search and Filter Section -->
    <section class="mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('products.index') }}" method="GET">
                    <div class="input-group search-bar">
                        <input type="text" class="form-control form-control-lg" placeholder="Search products..." name="search" value="{{ request('search') }}">
                        <button class="btn btn-primary btn-lg" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products">
        <h2 class="text-center mb-4">Our Products</h2>
        
        @if($products->count() > 0)
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-6 col-lg-3 mb-4">
                        <div class="card product-card">
                            @if($product->image)
                                <img src="{{ asset('images/' . $product->image) }}" class="card-img-top product-image" alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top product-image" alt="{{ $product->name }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($product->description, 60) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-primary">${{ number_format($product->quantity, 2) }}</span>
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-box-seam" style="font-size: 3rem; color: #ccc;"></i>
                <h4 class="mt-3">No products found</h4>
                <p class="text-muted">There are currently no products available.</p>
            </div>
        @endif
    </section>
</div>
@endsection