<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Shop System</title>
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
            <h2>Edit Product</h2>
            
            <form action="{{ route('product.update', $product->_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="image">Product Image</label>
                        @if($product->image)
                            <div class="current-image">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-image-small">
                                <p>Current image</p>
                            </div>
                        @endif
                        <input type="file" id="image" name="image" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" id="name" name="name" value="{{ $product->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category" required>
                            <option value="CPU" {{ $product->category == 'CPU' ? 'selected' : '' }}>CPU</option>
                            <option value="GPU" {{ $product->category == 'GPU' ? 'selected' : '' }}>GPU</option>
                            <option value="RAM" {{ $product->category == 'RAM' ? 'selected' : '' }}>RAM</option>
                            <option value="Storage" {{ $product->category == 'Storage' ? 'selected' : '' }}>Storage</option>
                            <option value="Motherboard" {{ $product->category == 'Motherboard' ? 'selected' : '' }}>Motherboard</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Price (฿)</label>
                        <input type="number" id="price" name="price" value="{{ $product->price }}" step="0.01" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" id="stock" name="stock" value="{{ $product->stock }}" min="0" required>
                    </div>
                    <div class="form-group full-width">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" value="{{ $product->description }}">
                    </div>
                </div>
                
                <button type="submit" class="btn-add">Update Product</button>
                <a href="{{ route('product.index') }}" class="btn-cancel">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>
