<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Analytics - Shop System</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Dashboard.css') }}">
</head>
<body>
    @include('components.header')

    <div class="container">
        <!-- User Analytics Header -->
        <div class="page-header" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
            <div class="page-header-content">
                <h1>👥 User Analytics</h1>
                <p>Track your top purchasing customers.</p>
                
                <div class="header-stats">
                    <div class="header-stat">
                        <div class="stat-value">{{ count($userPurchases) }}</div>
                        <div class="stat-label">Total Users</div>
                    </div>
                    <div class="header-stat">
                        <div class="stat-value">{{ count($topPurchasers) }}</div>
                        <div class="stat-label">Top Buyers</div>
                    </div>
                    @php
                        $totalUserOrders = array_sum(array_column($userPurchases, 'total_orders'));
                        $totalUserSpent = array_sum(array_column($userPurchases, 'total_spent'));
                    @endphp
                    <div class="header-stat">
                        <div class="stat-value">{{ $totalUserOrders }}</div>
                        <div class="stat-label">User Orders</div>
                    </div>
                    <div class="header-stat">
                        <div class="stat-value">฿{{ number_format($totalUserSpent, 0) }}</div>
                        <div class="stat-label">Total Spent</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Title & Navigation -->
        <div class="page-title-section">
            <h2>🏆 Top Purchasing Users</h2>
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>›</span>
                <a href="{{ route('dashboard.index') }}">Dashboard</a>
                <span>›</span>
                <span>Users</span>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="nav-tabs">
            <a href="{{ route('dashboard.index') }}" class="tab-link">📊 Overview</a>
            <a href="{{ route('dashboard.products') }}" class="tab-link">📦 Products</a>
            <a href="{{ route('dashboard.orders') }}" class="tab-link">📈 Orders</a>
            <a href="{{ route('dashboard.users') }}" class="tab-link active">👥 Users</a>
        </div>

        <!-- Ranking Section -->
        <div class="ranking-section">
            <!-- Top Purchasing Users -->
            <div class="ranking-card best">
                <div class="card-header">
                    <span class="card-icon">🏆</span>
                    <div>
                        <h3>Top Purchasing Users</h3>
                        <small style="opacity: 0.8;">Most active customers</small>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($topPurchasers) > 0)
                        <ul class="product-list">
                            @foreach($topPurchasers as $index => $item)
                                <li>
                                    <div class="product-info">
                                        @php
                                            $rankClass = 'default';
                                            if ($index == 0) $rankClass = 'gold';
                                            elseif ($index == 1) $rankClass = 'silver';
                                            elseif ($index == 2) $rankClass = 'bronze';
                                        @endphp
                                        <span class="rank-badge {{ $rankClass }}">{{ $index + 1 }}</span>
                                        <div class="product-icon">👤</div>
                                        <div class="product-details">
                                            <div class="product-name">{{ $item['user']->name }}</div>
                                            <div class="product-price">{{ $item['user']->email }}</div>
                                        </div>
                                    </div>
                                    <div class="product-stats">
                                        <div class="sales-count">{{ $item['total_orders'] }}</div>
                                        <div class="sales-label">orders</div>
                                        <div class="revenue" style="font-size: 12px; color: #10b981;">฿{{ number_format($item['total_spent'], 2) }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">👥</div>
                            <p>No user purchase data yet</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- All Users Statistics -->
            <div class="ranking-card" style="background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); overflow: hidden;">
                <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <span class="card-icon">📊</span>
                    <div>
                        <h3>User Statistics</h3>
                        <small style="opacity: 0.8;">Overview of all users</small>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($userPurchases) > 0)
                        <ul class="product-list">
                            @foreach($userPurchases as $index => $item)
                                <li>
                                    <div class="product-info">
                                        <span class="rank-badge default">{{ $index + 1 }}</span>
                                        <div class="product-icon">👤</div>
                                        <div class="product-details">
                                            <div class="product-name">{{ $item['user']->name }}</div>
                                            <div class="product-price">{{ $item['user']->email }}</div>
                                        </div>
                                    </div>
                                    <div class="product-stats">
                                        <div class="sales-count">{{ $item['total_orders'] }}</div>
                                        <div class="sales-label">orders</div>
                                        <div class="revenue" style="font-size: 12px; color: #667eea;">฿{{ number_format($item['total_spent'], 2) }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">👥</div>
                            <p>No users found</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions" style="margin-top: 30px;">
            <a href="{{ route('user.index') }}" class="quick-action-btn">
                <span class="action-icon">👥</span>
                <span class="action-label">Manage Users</span>
            </a>
            <a href="{{ route('dashboard.index') }}" class="quick-action-btn">
                <span class="action-icon">📊</span>
                <span class="action-label">Overview</span>
            </a>
            <a href="{{ route('order.index') }}" class="quick-action-btn">
                <span class="action-icon">📦</span>
                <span class="action-label">All Orders</span>
            </a>
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
                    Database: <strong>project_shop</strong> | Collection: <strong>users</strong>, <strong>orders</strong>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
