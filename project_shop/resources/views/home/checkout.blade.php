@extends('layouts.user')

@section('title', 'Checkout - Shop Application')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Checkout</h1>
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(count($cart) > 0)
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Shipping Information</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="zip" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" id="zip" required>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Payment Method</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" checked>
                            <label class="form-check-label" for="creditCard">
                                Credit Card
                            </label>
                        </div>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="paypal">
                            <label class="form-check-label" for="paypal">
                                PayPal
                            </label>
                        </div>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="cashOnDelivery">
                            <label class="form-check-label" for="cashOnDelivery">
                                Cash on Delivery
                            </label>
                        </div>
                        
                        <div id="creditCardForm">
                            <div class="mb-3">
                                <label for="cardName" class="form-label">Name on Card</label>
                                <input type="text" class="form-control" id="cardName" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="cardNumber" class="form-label">Card Number</label>
                                <input type="text" class="form-control" id="cardNumber" placeholder="0000 0000 0000 0000" required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="expiration" class="form-label">Expiration</label>
                                    <input type="text" class="form-control" id="expiration" placeholder="MM/YY" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cvv" class="form-label">CVV</label>
                                    <input type="text" class="form-control" id="cvv" placeholder="123" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        @foreach($cart as $id => $item)
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                    <span>{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                                </div>
                                <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </div>
                        @endforeach
                        
                        <hr>
                        
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
                        
                        <form action="{{ route('checkout.process') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="bi bi-lock"></i> Place Order
                            </button>
                        </form>
                        
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <i class="bi bi-shield-lock"></i> Secure SSL Encryption
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-cart-x" style="font-size: 4rem; color: #ccc;"></i>
            <h3 class="mt-3">Your cart is empty</h3>
            <p class="text-muted mb-4">You need to add items to your cart before checking out.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-shop"></i> Start Shopping
            </a>
        </div>
    @endif
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Payment method selection
    const paymentMethods = document.querySelectorAll('input[name="paymentMethod"]');
    const creditCardForm = document.getElementById('creditCardForm');
    
    paymentMethods.forEach(method => {
        method.addEventListener('change', function() {
            if (this.id === 'creditCard') {
                creditCardForm.style.display = 'block';
            } else {
                creditCardForm.style.display = 'none';
            }
        });
    });
});
</script>
@endsection