<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

// Public Routes - Product browsing available to everyone
Route::get('/', [ProductController::class, 'publicIndex'])->name('home');
Route::get('/products', [ProductController::class, 'publicIndex'])->name('products.index');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('products.show');

// Authentication Routes
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Cart Routes (require authentication)
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/cart', [ProductController::class, 'cart'])->name('cart.index');
    Route::post('/cart/add/{product}', [ProductController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove/{product}', [ProductController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/update/{product}', [ProductController::class, 'updateCart'])->name('cart.update');
    
    // Checkout Routes (require authentication)
    Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout', [ProductController::class, 'processCheckout'])->name('checkout.process');
    
    // User Home
    Route::get('/home', [ProductController::class, 'userIndex'])->name('user.home');
});

// Admin group
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::resource('admin/users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
    
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/product/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/product/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/product/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/product/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/product/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});