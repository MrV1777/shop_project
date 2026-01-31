@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Admin Dashboard</h4>
                </div>
                <div class="card-body">
                    <h5>Welcome, {{ Auth::user()->name }}!</h5>
                    <p>You have successfully logged in as an Administrator.</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-4 mb-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Manage Users</h5>
                                    <p class="card-text">View, create, edit, and delete users.</p>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Go to Users</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Manage Products</h5>
                                    <p class="card-text">View, create, edit, and delete products.</p>
                                    <a href="{{ route('products.index') }}" class="btn btn-primary">Go to Products</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Reports</h5>
                                    <p class="card-text">View system reports and analytics.</p>
                                    <a href="#" class="btn btn-primary disabled">View Reports</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection