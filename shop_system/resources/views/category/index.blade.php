<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management - Shop System</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
</head>
<body>
    @include('components.header')

    <div class="category-container">
        @if(session('success'))
            <div class="alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="category-card" style="margin-bottom: 30px;">
            <h2>➕ Add New Category</h2>
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 15px;">
                    <div class="form-group">
                        <label for="icon">Category Icon (Image)</label>
                        <input type="file" id="icon" name="icon" accept="image/*">
                        <small style="color: #666;">If no image uploaded, default icon (📁) will be used</small>
                    </div>
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input type="text" id="name" name="name" placeholder="Category name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" placeholder="Category description (optional)">
                </div>
                <button type="submit" class="btn-add-category">➕ Add Category</button>
            </form>
        </div>

        <div class="category-card">
            <h3>📁 Category List</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">
                @forelse($categories as $cat)
                    <div style="background: #f8f9fa; border-radius: 12px; padding: 20px; transition: transform 0.3s;">
                        @if($cat->icon && file_exists(public_path($cat->icon)))
                            <img src="{{ asset($cat->icon) }}" alt="{{ $cat->name }}" style="width: 80px; height: 80px; object-fit: contain; border-radius: 8px; margin-bottom: 10px; background: white;">
                        @else
                            <div style="font-size: 40px; margin-bottom: 10px;">📁</div>
                        @endif
                        <div style="font-size: 18px; font-weight: bold; margin-bottom: 5px;">{{ $cat->name }}</div>
                        <div style="color: #666; font-size: 14px; margin-bottom: 15px;">{{ $cat->description ?? 'No description' }}</div>
                        <div class="category-actions">
                            <a href="{{ route('category.edit', $cat->_id) }}" class="btn-edit">✏️ Edit</a>
                            <form action="{{ route('category.delete', $cat->_id) }}" method="DELETE" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this category?')">🗑️ Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="empty-state" style="grid-column: 1 / -1;">
                        <p>No categories yet. Add your first category above!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</body>
</html>
