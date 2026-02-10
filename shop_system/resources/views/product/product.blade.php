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
                            <option value="CPU">💻 CPU</option>
                            <option value="GPU">🎮 GPU</option>
                            <option value="RAM">🧮 RAM</option>
                            <option value="Storage">💾 Storage</option>
                            <option value="Motherboard">🔌 Motherboard</option>
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
