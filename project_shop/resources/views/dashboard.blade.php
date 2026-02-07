<<<<<<< Updated upstream:project_shop/resources/views/dashboard.blade.php
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <section class="bg-light py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Dashboard</h5>
                        </div>
                        <div class="card-body">
                            <p>Welcome to your dashboard!</p>
                            <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
=======
@extends('layouts.app')
>>>>>>> Stashed changes:project_shop/resources/views/home/dashboard.blade.php

@section('title', 'Dashboard - Giftos')

@push('styles')
<style type="text/css">
  body {
    background: #F8F9FA;
  }
  .dashboard-section {
    padding: 60px 0;
  }
</style>
@endpush

@section('content')
<section class="dashboard-section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card shadow-sm">
          <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Dashboard</h5>
          </div>
          <div class="card-body">
            @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            <h6>Welcome, {{ Auth::user()->name }}!</h6>
            <p>You have successfully logged in to your dashboard.</p>
            
            <div class="mt-4">
              <h6>Quick Links:</h6>
              <ul class="list-group">
                <li class="list-group-item">
                  <a href="{{ route('home') }}">
                    <i class="fa fa-home"></i> Home
                  </a>
                </li>
                <li class="list-group-item">
                  <a href="{{ route('shop') }}">
                    <i class="fa fa-shopping-bag"></i> Shop
                  </a>
                </li>
                <li class="list-group-item">
                  <a href="{{ route('contact') }}">
                    <i class="fa fa-envelope"></i> Contact Us
                  </a>
                </li>
                @if(Auth::user()->role === 'admin')
                <li class="list-group-item">
                  <a href="{{ route('products.index') }}">
                    <i class="fa fa-cog"></i> Manage Products (Admin)
                  </a>
                </li>
                @endif
              </ul>
            </div>

            <div class="mt-4">
              <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">
                  <i class="fa fa-sign-out"></i> Logout
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
