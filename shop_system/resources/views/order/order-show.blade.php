<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Shop System</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <style>
        .order-detail-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 30px;
            max-width: 800px;
            margin: 0 auto;
        }
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
        }
        .order-header h3 {
            margin: 0;
            font-size: 24px;
        }
        .order-id-badge {
            background: #3b82f6;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-family: 'Courier New', monospace;
            font-weight: bold;
        }
        .detail-section {
            margin-bottom: 25px;
        }
        .detail-section h4 {
            color: #333;
            margin-bottom: 15px;
            font-size: 16px;
            border-left: 4px solid #3b82f6;
            padding-left: 10px;
        }
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        .detail-item {
            background: #f8f9fa;
            padding: 12px 15px;
            border-radius: 8px;
        }
        .detail-item label {
            display: block;
            font-size: 12px;
            color: #666;
            margin-bottom: 4px;
        }
        .detail-item span {
            font-weight: 600;
            color: #333;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 13px;
            text-transform: uppercase;
        }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-completed { background: #d4edda; color: #155724; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .items-table th, .items-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        .items-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #555;
        }
        .items-table td {
            color: #333;
        }
        .total-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            text-align: right;
            margin-top: 20px;
        }
        .total-amount {
            font-size: 28px;
            font-weight: bold;
            color: #10b981;
        }
        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background: #6b7280;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 20px;
        }
        .back-btn:hover {
            background: #4b5563;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .btn-action {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
        }
        .btn-edit { background: #3b82f6; color: white; }
        .btn-edit:hover { background: #2563eb; }
        .btn-delete { background: #ef4444; color: white; }
        .btn-delete:hover { background: #dc2626; }
    </style>
</head>
<body>
    @include('components.header')

    <div class="container">
        <a href="{{ route('order.index') }}" class="back-btn">← Back to Orders</a>
        
        <div class="order-detail-card">
            <div class="order-header">
                <div>
                    <h3>Order Details</h3>
                    <small style="color: #666;">Created: {{ $order->created_at->format('d M Y H:i') }}</small>
                </div>
                <span class="order-id-badge">{{ $order->order_id }}</span>
            </div>

            <div class="detail-section">
                <h4>📋 Order Status</h4>
                @php
                    $statusClass = 'status-' . ($order->status ?? 'pending');
                @endphp
                <span class="status-badge {{ $statusClass }}">
                    {{ $order->status ?? 'pending' }}
                </span>
            </div>

            <div class="detail-section">
                <h4>👤 Customer Information</h4>
                <div class="detail-grid">
                    <div class="detail-item">
                        <label>Name</label>
                        <span>{{ $order->customer_name }}</span>
                    </div>
                    <div class="detail-item">
                        <label>Email</label>
                        <span>{{ $order->customer_email }}</span>
                    </div>
                </div>
            </div>

            <div class="detail-section">
                <h4>🚚 Shipping Information</h4>
                @php
                    $shipping = is_array($order->shipping_info) ? $order->shipping_info : (array)$order->shipping_info;
                @endphp
                <div class="detail-grid">
                    <div class="detail-item">
                        <label>Recipient Name</label>
                        <span>{{ $shipping['name'] ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <label>Phone</label>
                        <span>{{ $shipping['phone'] ?? '-' }}</span>
                    </div>
                    <div class="detail-item" style="grid-column: span 2;">
                        <label>Address</label>
                        <span>{{ $shipping['address'] ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <div class="detail-section">
                <h4>💳 Payment Information</h4>
                <div class="detail-grid">
                    <div class="detail-item">
                        <label>Payment Method</label>
                        <span>{{ strtoupper($order->payment_method) }}</span>
                    </div>
                </div>
            </div>

            @if(!empty($order->items) && is_array($order->items) && count($order->items) > 0)
            <div class="detail-section">
                <h4>📦 Order Items</h4>
                <table class="items-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item['name'] ?? 'Product' }}</td>
                            <td>{{ $item['quantity'] ?? 1 }}</td>
                            <td>฿{{ number_format($item['price'] ?? 0, 2) }}</td>
                            <td>฿{{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            <div class="total-section">
                <div style="font-size: 14px; color: #666; margin-bottom: 5px;">Total Amount</div>
                <div class="total-amount">฿{{ number_format($order->total_price, 2) }}</div>
            </div>

            <div class="action-buttons">
                <form action="{{ route('order.updateStatus', $order->_id) }}" method="POST" style="display: flex; gap: 10px;">
                    @csrf
                    @method('PUT')
                    <select name="status" style="padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="btn-action btn-edit">Update Status</button>
                </form>
                <a href="{{ route('order.delete', $order->_id) }}" 
                   class="btn-action btn-delete"
                   onclick="return confirm('Are you sure you want to delete this order?')">
                    Delete Order
                </a>
            </div>
        </div>
    </div>
</body>
</html>
