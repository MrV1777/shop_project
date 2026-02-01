@extends('layouts.user')

@section('title', 'Shopping Cart - Shop Application')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Shopping Cart</h1>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(count($cart) > 0)
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $id => $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($item['image'])
                                                        <img src="{{ asset('images/' . $item['image']) }}" class="rounded me-3" style="width: 80px; height: 80px; object-fit: cover;" alt="{{ $item['name'] }}">
                                                    @else
                                                        <img src="https://via.placeholder.com/80x80?text=No+Image" class="rounded me-3" style="width: 80px; height: 80px; object-fit: cover;" alt="{{ $item['name'] }}">
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0">{{ $item['name'] }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>${{ number_format($item['price'], 2) }}</td>
                                            <td>
                                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex align-items-center">
                                                    @csrf
                                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control form-control-sm w-50 me-2">
                                                    <button type="submit" class="btn btn-outline-primary btn-sm">Update</button>
                                                </form>
                                            </td>
                                            <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                            <td>
                                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Cart Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span><strong>Total</strong></span>
                            <span><strong>${{ number_format($total, 2) }}</strong></span>
                        </div>
                        <div class="d-grid gap-2">
                            <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-lg">Proceed to Checkout</a>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-cart-x" style="font-size: 4rem; color: #ccc;"></i>
            <h3 class="mt-3">Your cart is empty</h3>
            <p class="text-muted mb-4">Looks like you haven't added any items to your cart yet.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-shop"></i> Start Shopping
            </a>
        </div>
    @endif
</div>
@endsection