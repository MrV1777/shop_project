<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Shop System</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <style>
        .status-select {
            padding: 6px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 13px;
            background: #fff;
        }
        .badge {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-pending { background: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
        .badge-completed { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .badge-cancelled { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        
        .order-id { font-family: 'Courier New', Courier, monospace; font-weight: bold; color: #3b82f6; }
        .btn-update {
            background: #4f46e5;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        }
        .btn-update:hover { background: #4338ca; }
        
        .order-filters {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }
        .filter-btn {
            padding: 8px 16px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s;
            border: 2px solid transparent;
        }
        .filter-btn:hover {
            transform: translateY(-2px);
        }
        .filter-btn.active {
            border: 2px solid currentColor;
        }
        .filter-all { background: #e0e7ff; color: #4338ca; }
        .filter-all.active { background: #4338ca; color: white; }
        .filter-pending { background: #fff3cd; color: #856404; }
        .filter-pending.active { background: #856404; color: white; }
        .filter-completed { background: #d4edda; color: #155724; }
        .filter-completed.active { background: #155724; color: white; }
        .filter-cancelled { background: #f8d7da; color: #721c24; }
        .filter-cancelled.active { background: #721c24; color: white; }
    </style>
</head>
<body>
    @include('components.header')

    <div class="container">
        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        <div class="table-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h3>📦 Order Management List</h3>
                <a href="{{ route('order.add') }}" class="btn-add" style="padding: 8px 16px; background: #10b981; color: white; border-radius: 5px; text-decoration: none;">+ Create Order</a>
            </div>
            
            @php
                $filter = $filter ?? 'all';
                $pendingCount = isset($pendingCount) ? $pendingCount : 0;
                $completedCount = isset($completedCount) ? $completedCount : 0;
                $cancelledCount = isset($cancelledCount) ? $cancelledCount : 0;
            @endphp
            
            <div class="order-filters">
                <a href="{{ route('order.index') }}?filter=all" class="filter-btn filter-all {{ $filter == 'all' ? 'active' : '' }}">
                    📋 All ({{ $pendingCount + $completedCount + $cancelledCount }})
                </a>
                <a href="{{ route('order.index') }}?filter=pending" class="filter-btn filter-pending {{ $filter == 'pending' ? 'active' : '' }}">
                    ⏳ Pending ({{ $pendingCount }})
                </a>
                <a href="{{ route('order.index') }}?filter=completed" class="filter-btn filter-completed {{ $filter == 'completed' ? 'active' : '' }}">
                    ✅ Completed ({{ $completedCount }})
                </a>
                <a href="{{ route('order.index') }}?filter=cancelled" class="filter-btn filter-cancelled {{ $filter == 'cancelled' ? 'active' : '' }}">
                    ❌ Cancelled ({{ $cancelledCount }})
                </a>
            </div>
            
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer (Shipping)</th>
                            <th>Total Price</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th style="text-align: center;">Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td class="order-id">
                                    <a href="{{ route('order.show', $order->_id) }}" style="color: #3b82f6; text-decoration: none;">{{ $order->order_id }}</a>
                                </td>
                                <td>
                                    @php
                                        $shippingName = is_array($order->shipping_info) ? ($order->shipping_info['name'] ?? 'N/A') : ($order->shipping_info->name ?? 'N/A');
                                        $shippingPhone = is_array($order->shipping_info) ? ($order->shipping_info['phone'] ?? '-') : ($order->shipping_info->phone ?? '-');
                                    @endphp
                                    <strong>{{ $shippingName }}</strong><br>
                                    <small style="color: #667;">📞 {{ $shippingPhone }}</small>
                                </td>
                                <td class="price">฿{{ number_format($order->total_price, 2) }}</td>
                                <td>
                                    <small>{{ strtoupper($order->payment_method) }}</small>
                                </td>
                                <td>
                                    @php
                                        $statusClass = 'badge-' . ($order->status ?? 'pending');
                                    @endphp
                                    <span class="badge {{ $statusClass }}">
                                        {{ $order->status ?? 'pending' }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <form action="{{ route('order.updateStatus', $order->_id) }}" method="POST" style="display: flex; gap: 5px; justify-content: center;">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="status-select">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <button type="submit" class="btn-update">Save</button>
                                    </form>
                                    <a href="{{ route('order.delete', $order->_id) }}" 
                                       style="display: inline-block; margin-top: 5px; padding: 4px 8px; background: #ef4444; color: white; border-radius: 4px; font-size: 11px; text-decoration: none;"
                                       onclick="return confirm('Are you sure you want to delete this order?')">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 40px;">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
