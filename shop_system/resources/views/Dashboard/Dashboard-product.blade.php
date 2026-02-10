<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Analytics - Shop System</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Dashboard.css') }}">
</head>
<body>
    @include('components.header')

    <div class="container">
        <!-- Product Analytics Header -->
        <div class="page-header products">
            <div class="page-header-content">
                <h1>📦 Product Analytics</h1>
                <p>Track your best and worst performing products.</p>
                
                <div class="header-stats">
                    <div class="header-stat">
                        <div class="stat-value">{{ count($productSales) }}</div>
                        <div class="stat-label">Total Products</div>
                    </div>
                    <div class="header-stat">
                        <div class="stat-value">{{ count($bestSelling) }}</div>
                        <div class="stat-label">Best Sellers</div>
                    </div>
                    <div class="header-stat">
                        <div class="stat-value">{{ count($leastSelling) }}</div>
                        <div class="stat-label">Need Attention</div>
                    </div>
                    @php
                        $totalSales = array_sum(array_column($productSales, 'sales_count'));
                    @endphp
                    <div class="header-stat">
                        <div class="stat-value">{{ $totalSales }}</div>
                        <div class="stat-label">Total Sales</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Title & Navigation -->
        <div class="page-title-section">
            <h2>🏆 Product Rankings</h2>
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>›</span>
                <a href="{{ route('dashboard.index') }}">Dashboard</a>
                <span>›</span>
                <span>Products</span>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="nav-tabs">
            <a href="{{ route('dashboard.index') }}" class="tab-link">📊 Overview</a>
            <a href="{{ route('dashboard.products') }}" class="tab-link active">📦 Products</a>
            <a href="{{ route('dashboard.orders') }}" class="tab-link">📈 Orders</a>
            <a href="{{ route('dashboard.users') }}" class="tab-link">👥 Users</a>
        </div>

        <!-- Ranking Section -->
        <div class="ranking-section">
            <!-- Best Selling Products -->
            <div class="ranking-card best">
                <div class="card-header">
                    <span class="card-icon">🏆</span>
                    <div>
                        <h3>Best Selling Products</h3>
                        <small style="opacity: 0.8;">Top performing products</small>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($bestSelling) > 0)
                        <ul class="product-list">
                            @foreach($bestSelling as $index => $item)
                                <li>
                                    <div class="product-info">
                                        @php
                                            $rankClass = 'default';
                                            if ($index == 0) $rankClass = 'gold';
                                            elseif ($index == 1) $rankClass = 'silver';
                                            elseif ($index == 2) $rankClass = 'bronze';
                                        @endphp
                                        <span class="rank-badge {{ $rankClass }}">{{ $index + 1 }}</span>
                                        <div class="product-icon">📦</div>
                                        <div class="product-details">
                                            <div class="product-name">{{ $item['product']->name }}</div>
                                            <div class="product-price">฿{{ number_format($item['product']->price ?? 0, 2) }}</div>
                                        </div>
                                    </div>
                                    <div class="product-stats">
                                        <div class="sales-count">{{ $item['sales_count'] }}</div>
                                        <div class="sales-label">sold</div>
                                        <div class="revenue" style="font-size: 12px; color: #10b981;">฿{{ number_format($item['revenue'], 2) }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">📦</div>
                            <p>No sales data yet</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Least Selling Products -->
            <div class="ranking-card worst">
                <div class="card-header">
                    <span class="card-icon">⚠️</span>
                    <div>
                        <h3>Least Selling Products</h3>
                        <small style="opacity: 0.8;">Products that need attention</small>
                    </div>
                </div>
                <div class="card-body">
                    @if(count($leastSelling) > 0)
                        <ul class="product-list">
                            @foreach($leastSelling as $index => $item)
                                <li>
                                    <div class="product-info">
                                        <span class="rank-badge default">{{ count($leastSelling) - $index }}</span>
                                        <div class="product-icon">📦</div>
                                        <div class="product-details">
                                            <div class="product-name">{{ $item['product']->name }}</div>
                                            <div class="product-price">฿{{ number_format($item['product']->price ?? 0, 2) }}</div>
                                        </div>
                                    </div>
                                    <div class="product-stats">
                                        <div class="sales-count" style="color: #f59e0b;">{{ $item['sales_count'] }}</div>
                                        <div class="sales-label">sold</div>
                                        <div class="revenue" style="font-size: 12px; color: #666;">฿{{ number_format($item['revenue'], 2) }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">✅</div>
                            <p>All products have sales!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions" style="margin-top: 30px;">
            <a href="{{ route('product.add') }}" class="quick-action-btn">
                <span class="action-icon">➕</span>
                <span class="action-label">Add Product</span>
            </a>
            <a href="{{ route('product.index') }}" class="quick-action-btn">
                <span class="action-icon">📋</span>
                <span class="action-label">All Products</span>
            </a>
            <a href="{{ route('dashboard.index') }}" class="quick-action-btn">
                <span class="action-icon">📊</span>
                <span class="action-label">Overview</span>
            </a>
            <a href="{{ route('dashboard.users') }}" class="quick-action-btn">
                <span class="action-icon">👥</span>
                <span class="action-label">User Stats</span>
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
                    Database: <strong>project_shop</strong> | Collection: <strong>products</strong>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
