@extends('layouts.app')

@section('title', 'User Home')

@section('styles')
<style type="text/css">
    .hero-section {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        padding: 100px 0;
        margin-bottom: 50px;
    }
    .feature-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .feature-icon {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: #0d6efd;
    }
</style>
@endsection

@section('content')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('user.home') }}">ShopApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('user.home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <span class="navbar-text me-3">Welcome, {{ Auth::user()->name }}</span>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="btn btn-outline-light"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Welcome to ShopApp</h1>
        <p class="lead">Discover amazing products at unbeatable prices</p>
        <div class="mt-4">
            <a href="#" class="btn btn-light btn-lg me-2">Shop Now</a>
            <a href="#" class="btn btn-outline-light btn-lg">View Categories</a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="container mb-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card feature-card text-center p-4">
                <div class="feature-icon">
                    <i class="bi bi-truck"></i>
                </div>
                <h5>Fast Delivery</h5>
                <p class="text-muted">Get your products delivered quickly and safely to your doorstep.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card feature-card text-center p-4">
                <div class="feature-icon">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h5>Secure Payment</h5>
                <p class="text-muted">Shop with confidence using our secure payment methods.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card feature-card text-center p-4">
                <div class="feature-icon">
                    <i class="bi bi-headset"></i>
                </div>
                <h5>24/7 Support</h5>
                <p class="text-muted">Our customer support team is always ready to help you.</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="container mb-5">
    <h2 class="text-center mb-4">Featured Products</h2>
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Product">
                <div class="card-body">
                    <h5 class="card-title">Product 1</h5>
                    <p class="card-text">This is a sample product description.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">$29.99</span>
                        <a href="#" class="btn btn-primary btn-sm">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Product">
                <div class="card-body">
                    <h5 class="card-title">Product 2</h5>
                    <p class="card-text">This is a sample product description.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">$39.99</span>
                        <a href="#" class="btn btn-primary btn-sm">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Product">
                <div class="card-body">
                    <h5 class="card-title">Product 3</h5>
                    <p class="card-text">This is a sample product description.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">$49.99</span>
                        <a href="#" class="btn btn-primary btn-sm">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Product">
                <div class="card-body">
                    <h5 class="card-title">Product 4</h5>
                    <p class="card-text">This is a sample product description.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">$59.99</span>
                        <a href="#" class="btn btn-primary btn-sm">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="#" class="btn btn-outline-primary">View All Products</a>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5>ShopApp</h5>
                <p>Your one-stop destination for all your shopping needs.</p>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white">Home</a></li>
                    <li><a href="#" class="text-white">Products</a></li>
                    <li><a href="#" class="text-white">About Us</a></li>
                    <li><a href="#" class="text-white">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Contact Us</h5>
                <ul class="list-unstyled">
                    <li>Email: info@shopapp.com</li>
                    <li>Phone: +1 (123) 456-7890</li>
                    <li>Address: 123 Main St, City, Country</li>
                </ul>
            </div>
        </div>
        <div class="text-center mt-4">
            <p>© 2026 ShopApp. All rights reserved.</p>
        </div>
    </div>
</footer>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.js"></script>
@endsection