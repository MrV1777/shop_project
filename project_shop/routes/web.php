<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
<<<<<<< Updated upstream
    
// Authentication Routes
Route::get('/', [AuthController::class, 'index'])->name('login');
=======
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Public Home Routes
|--------------------------------------------------------------------------
| These routes are accessible to all users without authentication
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/testimonial', [HomeController::class, 'testimonial'])->name('testimonial');
Route::get('/why', [HomeController::class, 'why'])->name('why');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
| Routes for user login, registration, and logout
*/

Route::get('/login', [AuthController::class, 'index'])->name('index');
>>>>>>> Stashed changes
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

<<<<<<< Updated upstream
// Dashboard route (protected by auth middleware)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');
=======
/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
| These routes require authentication
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| These routes require authentication and admin role
*/

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});
>>>>>>> Stashed changes
