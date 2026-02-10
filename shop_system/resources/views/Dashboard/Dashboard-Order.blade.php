<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Analytics - Shop System</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Dashboard.css') }}">
</head>
<body>
    @include('components.header')

    <div class="container">
        <!-- Order Analytics Header -->
        <div class="page-header orders">
            <div class="page-header-content">
                <h1>📈 Order Analytics</h1>
                <p>Monitor your order performance and revenue.</p>
                
                <div class="header-stats">
                    <div class="header-stat">
                        <div class="stat-value">{{ $totalOrders }}</div>
                        <div class="stat-label">Total Orders</div>
                    </div>
                    <div class="header-stat">
                        <div class="stat-value">฿{{ number_format($totalRevenue, 0) }}</div>
                        <div class="stat-label">Total Revenue</div>
                    </div>
                    <div class="header-stat">
                        <div class="stat-value">{{ $completedOrders }}</div>
                        <div class="stat-label">Completed</div>
                    </div>
                    <div class="header-stat">
                        <div class="stat-value">{{ $pendingOrders }}</div>
                        <div class="stat-label">Pending</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Title & Navigation -->
        <div class="page-title-section">
            <h2>📊 Order Statistics</h2>
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>›</span>
                <a href="{{ route('dashboard.index') }}">Dashboard</a>
                <span>›</span>
                <span>Orders</span>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="nav-tabs">
            <a href="{{ route('dashboard.index') }}" class="tab-link">📊 Overview</a>
            <a href="{{ route('dashboard.products') }}" class="tab-link">📦 Products</a>
            <a href="{{ route('dashboard.orders') }}" class="tab-link active">📈 Orders</a>
            <a href="{{ route('dashboard.users') }}" class="tab-link">👥 Users</a>
        </div>

        <!-- Order Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon orders">📦</div>
                <div class="stat-value">{{ $totalOrders }}</div>
                <div class="stat-label">Total Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon revenue">💰</div>
                <div class="stat-value">฿{{ number_format($totalRevenue, 2) }}</div>
                <div class="stat-label">Total Revenue</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon pending">✅</div>
                <div class="stat-value">{{ $completedOrders }}</div>
                <div class="stat-label">Completed</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon pending">⏳</div>
                <div class="stat-value">{{ $pendingOrders }}</div>
                <div class="stat-label">Pending</div>
            </div>
        </div>

        <!-- Order Content -->
        <div class="dashboard-content">
            <!-- Order Status Distribution -->
            <div class="beautiful-card">
                <div class="card-header">
                    <h3>
                        <span class="card-icon" style="background: #e3f2fd;">📊</span>
                        Order Status Distribution
                    </h3>
                </div>
                <div class="card-body">
                    <div class="status-distribution">
                        @php
                            $total = $totalOrders > 0 ? $totalOrders : 1;
                        @endphp
                        <div class="status-row">
                            <span class="status-label">✅ Completed</span>
                            <div class="progress-bar">
                                <div class="progress-fill completed" style="width: {{ ($completedOrders / $total) * 100 }}%"></div>
                            </div>
                            <span class="status-value">{{ $completedOrders }}</span>
                        </div>
                        <div class="status-row">
                            <span class="status-label">⏳ Pending</span>
                            <div class="progress-bar">
                                <div class="progress-fill pending" style="width: {{ ($pendingOrders / $total) * 100 }}%"></div>
                            </div>
                            <span class="status-value">{{ $pendingOrders }}</span>
                        </div>
                        <div class="status-row">
                            <span class="status-label">❌ Cancelled</span>
                            <div class="progress-bar">
                                <div class="progress-fill cancelled" style="width: {{ ($cancelledOrders / $total) * 100 }}%"></div>
                            </div>
                            <span class="status-value">{{ $cancelledOrders }}</span>
                        </div>
                    </div>

                    <!-- Success Rate -->
                    @if($totalOrders > 0)
                    <div style="margin-top: 25px; padding: 20px; background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-radius: 12px; text-align: center; border: 1px solid #86efac;">
                        <div style="font-size: 14px; color: #166534; margin-bottom: 5px;">Order Success Rate</div>
                        <div style="font-size: 32px; font-weight: bold; color: #10b981;">
                            {{ round(($completedOrders / $totalOrders) * 100, 1) }}%
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Payment Methods -->
            <div class="beautiful-card">
                <div class="card-header">
                    <h3>
                        <span class="card-icon" style="background: #fff3e0;">💳</span>
                        Payment Methods
                    </h3>
                </div>
                <div class="card-body">
                    @if(count($paymentMethods) > 0)
                        <div class="status-distribution">
                            @php $totalPayments = array_sum($paymentMethods); @endphp
                            @foreach($paymentMethods as $method => $count)
                                <div class="status-row">
                                    <span class="status-label">
                                        @switch($method)
                                            @case('cash') 💵 Cash @break
                                            @case('credit_card') 💳 Card @break
                                            @case('bank_transfer') 🏦 Bank @break
                                            @case('promt_pay') 📱 PromptPay @break
                                            @default ❓ {{ ucfirst($method) }}
                                        @endswitch
                                    </span>
                                    <div class="progress-bar">
                                        <div class="progress-fill completed" style="width: {{ ($count / $totalPayments) * 100 }}%"></div>
                                    </div>
                                    <span class="status-value">{{ $count }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon">💳</div>
                            <p>No payment data yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="beautiful-card" style="margin-top: 25px;">
            <div class="card-header">
                <h3>
                    <span class="card-icon" style="background: #fce4ec;">🕐</span>
                    Recent Orders
                </h3>
                <a href="{{ route('order.index') }}" class="btn-view-all">View All →</a>
            </div>
            <div class="card-body">
                @if($recentOrders->count() > 0)
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('order.show', $order->_id) }}" style="color: #3b82f6; text-decoration: none; font-weight: 500;">
                                                {{ $order->order_id }}
                                            </a>
                                        </td>
                                        <td>
                                            @php
                                                $shipping = is_array($order->shipping_info) ? $order->shipping_info : (array)$order->shipping_info;
                                            @endphp
                                            {{ $shipping['name'] ?? 'N/A' }}
                                        </td>
                                        <td class="price">฿{{ number_format($order->total_price, 2) }}</td>
                                        <td>{{ strtoupper($order->payment_method) }}</td>
                                        <td>
                                            @php
                                                $statusClass = 'badge-' . ($order->status ?? 'pending');
                                            @endphp
                                            <span class="badge {{ $statusClass }}">
                                                {{ $order->status ?? 'pending' }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
        <div class="quick-actions" style="margin-top: 30px;">
            <a href="{{ route('order.add') }}" class="quick-action-btn">
                <span class="action-icon">➕</span>
                <span class="action-label">Create Order</span>
            </a>
            <a href="{{ route('order.index') }}" class="quick-action-btn">
                <span class="action-icon">📋</span>
                <span class="action-label">All Orders</span>
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
                    Database: <strong>project_shop</strong> | Collection: <strong>orders</strong>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
