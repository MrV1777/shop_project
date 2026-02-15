<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Shop System</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    
    <style>
        /* CSS เพิ่มเติมเพื่อให้รูปแสดงผลถูกต้องและสวยงาม */
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: contain;
            border-radius: 8px;
            background: #fff;
            border: 1px solid #ddd;
            display: block;
            margin: 0 auto;
        }
        .no-image {
            font-size: 24px;
            color: #ccc;
        }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; border-bottom: 1px solid #eee; text-align: left; }
        .price { color: #28a745; font-weight: bold; }
        
        .product-filters {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
            flex-wrap: wrap;
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
        .filter-cpu { background: #dbeafe; color: #1d4ed8; }
        .filter-cpu.active { background: #1d4ed8; color: white; }
        .filter-gpu { background: #fce7f3; color: #db2777; }
        .filter-gpu.active { background: #db2777; color: white; }
        .filter-ram { background: #d1fae5; color: #059669; }
        .filter-ram.active { background: #059669; color: white; }
        .filter-storage { background: #fef3c7; color: #d97706; }
        .filter-storage.active { background: #d97706; color: white; }
        .filter-motherboard { background: #e0e7ff; color: #7c3aed; }
        .filter-motherboard.active { background: #7c3aed; color: white; }
    </style>
</head>
<body>
    @include('components.header')

    <div class="container">
        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="product-card">
            <h2>➕ Add New Product</h2>
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="image">📷 Product Image</label>
                        <input type="file" id="image" name="image" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="name">📦 Product Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter product name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="category">🏷️ Category</label>
                        <select id="category" name="category" required>
                            <option value="">Select category</option>
                            @if(isset($categories))
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->name }}">{{ $cat->icon }} {{ $cat->name }}</option>
                                @endforeach
                            @else
                                <option value="CPU">💻 CPU</option>
                                <option value="GPU">🎮 GPU</option>
                                <option value="RAM">🧮 RAM</option>
                                <option value="Storage">💾 Storage</option>
                                <option value="Motherboard">🔌 Motherboard</option>
                                <option value="Power Supply">⚡ Power Supply</option>
                                <option value="Case">🖥️ Case</option>
                                <option value="Cooler">❄️ Cooler</option>
                                <option value="Monitor">🖥️ Monitor</option>
                                <option value="Keyboard">⌨️ Keyboard</option>
                                <option value="Mouse">🖱️ Mouse</option>
                                <option value="Headset">🎧 Headset</option>
                                <option value="Webcam">📷 Webcam</option>
                                <option value="Speaker">🔊 Speaker</option>
                                <option value="UPS">🔋 UPS</option>
                                <option value="Cable">🔌 Cable</option>
                                <option value="Accessory">🎁 Accessory</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">💰 Price (฿)</label>
                        <input type="number" id="price" name="price" placeholder="Enter price" step="0.01" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">📊 Stock</label>
                        <input type="number" id="stock" name="stock" placeholder="Enter stock" min="0" required>
                    </div>
                </div>
                
                <button type="submit" class="btn-add">➕ Add Product</button>
            </form>
        </div>

        <div class="table-card">
            <h3>📋 Product List</h3>
            
            @php
                $filter = $filter ?? 'all';
                $totalProducts = isset($totalCount) ? $totalCount : 0;
            @endphp
            
            <div class="product-filters">
                <a href="{{ route('product.index') }}?filter=all" class="filter-btn filter-all {{ $filter == 'all' ? 'active' : '' }}">
                    📋 All ({{ $totalCount }})
                </a>
                @if(isset($categories))
                    @foreach($categories as $cat)
                        <a href="{{ route('product.index') }}?filter={{ $cat->name }}" class="filter-btn {{ $filter == $cat->name ? 'active' : '' }}" style="background: #e0e7ff; color: #4338ca;">
                            @if($cat->icon && file_exists(public_path($cat->icon)))
                                <img src="{{ asset($cat->icon) }}" alt="{{ $cat->name }}" style="width: 20px; height: 20px; object-fit: contain; border-radius: 4px; vertical-align: middle; margin-right: 5px; background: white;">
                            @else
                                📁
                            @endif
                            {{ $cat->name }} ({{ $categoryCounts[$cat->name] ?? 0 }})
                        </a>
                    @endforeach
                @endif
            </div>
            
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 100px; text-align: center;">Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th style="width: 150px; text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $prod)
                            <tr>
                                <td style="text-align: center;">
                                    @if(!empty($prod->image))
                                        <img src="data:image/png;base64,{{ $prod->image }}" alt="{{ $prod->name }}" class="product-image">
                                    @else
                                        <span class="no-image">📷</span>
                                    @endif
                                </td>
                                <td>{{ $prod->name }}</td>
                                <td>{{ $prod->category }}</td>
                                <td class="price">฿{{ number_format($prod->price, 2) }}</td>
                                <td>{{ $prod->stock }}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('product.edit', $prod->_id) }}" class="btn-action btn-edit">✏️</a>
                                    <a href="{{ route('product.delete', $prod->_id) }}" class="btn-action btn-delete" onclick="return confirm('Are you sure?')">🗑️</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 40px;">No products found...</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
