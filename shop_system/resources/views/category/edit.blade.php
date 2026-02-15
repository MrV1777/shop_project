<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category - Shop System</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
</head>
<body>
    @include('components.header')

    <div class="category-container">
        <div class="category-form-card">
            <h2>✏️ Edit Category</h2>
            <form action="{{ route('category.update', $category->_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label>Current Icon</label>
                    <div style="margin-bottom: 15px;">
                        @if($category->icon && file_exists(public_path($category->icon)))
                            <img src="{{ asset($category->icon) }}" alt="{{ $category->name }}" style="width: 80px; height: 80px; object-fit: contain; border-radius: 8px; background: white;">
                        @else
                            <div style="font-size: 60px;">📁</div>
                        @endif
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="icon">Change Icon (Image)</label>
                    <input type="file" id="icon" name="icon" accept="image/*">
                    <small style="color: #666;">If no image uploaded, current icon will be kept. Default: 📁</small>
                </div>
                
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" id="name" name="name" value="{{ $category->name }}" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" value="{{ $category->description ?? '' }}">
                </div>
                
                <button type="submit" class="btn-save">💾 Save Changes</button>
                <a href="{{ route('category.index') }}" class="btn-cancel">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>
