<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Shop System</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
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
            <h2>Add New Product</h2>
            
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="image">Product Image</label>
                        <input type="file" id="image" name="image" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category" required>
                            @if(isset($categories) && count($categories) > 0)
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->name }}">
                                        @if($cat->icon && file_exists(public_path($cat->icon)))
                                            🖼️ {{ $cat->name }}
                                        @else
                                            📁 {{ $cat->name }}
                                        @endif
                                    </option>
                                @endforeach
                            @else
                                <option value="">No categories available</option>
                                <option value="CPU">💻 CPU</option>
                                <option value="GPU">🎮 GPU</option>
                                <option value="RAM">🧮 RAM</option>
                                <option value="Storage">💾 Storage</option>
                                <option value="Motherboard">🔌 Motherboard</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Price (฿)</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" id="stock" name="stock" min="0" required>
                    </div>
                    <div class="form-group full-width">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description">
                    </div>
                </div>
                
                <button type="submit" class="btn-add">Add Product</button>
                <a href="{{ route('product.index') }}" class="btn-cancel">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>
