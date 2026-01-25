<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});
use App\Http\Controllers\AuthController;

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');

Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::post('logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('login');
})->name('logout');

Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.post');