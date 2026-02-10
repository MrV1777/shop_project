<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Shop System</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Dashboard.css') }}">
</head>
<body>
    @include('components.header')

    <div class="container">
        <!-- Beautiful Dashboard Header -->
        <div class="page-header dashboard">
            <div class="page-header-content">
                <h1>📊 Dashboard Overview</h1>
                <p>Welcome back! Here's what's happening with your store today.</p>
                
                <div class="header-stats">
                    <div class="header-stat">
                        <div class="stat-value">{{ $totalProducts }}</div>
                        <div class="stat-label">Total Products</div>
                    </div>
                    <div class="header-stat">
                        <div class="stat-value">{{ $totalOrders }}</div>
                        <div class="stat-label">Total Orders</div>
                    </div>
                    <div class="header-stat">
                        <div class="stat-value">฿{{ number_format($totalRevenue, 0) }}</div>
                        <div class="stat-label">Total Revenue</div>
                    </div>
                    <div class="header-stat">
                        <div class="stat-value">{{ $recentOrders->where('status', 'pending')->count() }}</div>
                        <div class="stat-label">Pending Orders</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Title & Navigation -->
        <div class="page-title-section">
            <h2>📈 Analytics Dashboard</h2>
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>›</span>
                <span>Dashboard</span>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="nav-tabs">
            <a href="{{ route('dashboard.index') }}" class="tab-link active">📊 Overview</a>
            <a href="{{ route('dashboard.products') }}" class="tab-link">📦 Products</a>
            <a href="{{ route('dashboard.orders') }}" class="tab-link">📈 Orders</a>
            <a href="{{ route('dashboard.users') }}" class="tab-link">👥 Users</a>
        </div>

        <!-- Dashboard Content Cards -->
        <div class="dashboard-content">
            <!-- Recent Orders -->
            <div class="beautiful-card">
                <div class="card-header">
                    <h3>
                        <span class="card-icon" style="background: #e3f2fd;">🕐</span>
                        Recent Orders
                    </h3>
                    <a href="{{ route('order.index') }}" class="btn-view-all">View All →</a>
                </div>
                <div class="card-body">
                    @if($recentOrders->count() > 0)
                        <div class="activity-timeline">
                            @foreach($recentOrders as $order)
                                <div class="activity-item {{ $order->status }}">
                                    <div class="activity-time">{{ $order->created_at->format('d M Y, H:i') }}</div>
                                    <div class="activity-content">
                                        Order {{ $order->order_id }}
                                        @php
                                            $shipping = is_array($order->shipping_info) ? $order->shipping_info : (array)$order->shipping_info;
                                        @endphp
                                        - {{ $shipping['name'] ?? 'Customer' }}
                                    </div>
                                    <div class="activity-amount">฿{{ number_format($order->total_price, 2) }}</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">📦</div>
                            <p>No orders yet</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="beautiful-card">
                <div class="card-header">
                    <h3>
                        <span class="card-icon" style="background: #fff3e0;">⚡</span>
                        Quick Actions
                    </h3>
                </div>
                <div class="card-body">
                    <div class="quick-actions">
                        <a href="{{ route('product.add') }}" class="quick-action-btn">
                            <span class="action-icon">➕</span>
                            <span class="action-label">Add Product</span>
                        </a>
                        <a href="{{ route('order.add') }}" class="quick-action-btn">
                            <span class="action-icon">🛒</span>
                            <span class="action-label">Create Order</span>
                        </a>
                        <a href="{{ route('dashboard.products') }}" class="quick-action-btn">
                            <span class="action-icon">📊</span>
                            <span class="action-label">Product Stats</span>
                        </a>
                        <a href="{{ route('dashboard.orders') }}" class="quick-action-btn">
                            <span class="action-icon">📈</span>
                            <span class="action-label">Order Stats</span>
                        </a>
                        <a href="{{ route('dashboard.users') }}" class="quick-action-btn">
                            <span class="action-icon">👥</span>
                            <span class="action-label">User Stats</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- MongoDB Status -->
        <div class="beautiful-card" style="margin-top: 25px;">
            <div class="card-header" style="background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);">
                <h3>
                    <span class="card-icon" style="background: white; color: #10b981;">✓</span>
                    MongoDB Connected
                </h3>
            </div>
            <div class="card-body" style="padding: 15px 25px;">
                <p style="margin: 0; color: #666; font-size: 14px;">
                    Database: <strong>project_shop</strong> | Collections: <strong>products</strong>, <strong>orders</strong>, <strong>users</strong>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
