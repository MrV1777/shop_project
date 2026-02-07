# Quick Reference Guide - Laravel Refactored Project

## File Structure Overview

```
project_shop/
├── app/Http/Controllers/
│   ├── HomeController.php          # Handles all home pages
│   ├── AuthController.php          # Handles authentication
│   └── ProductController.php       # Handles product management
│
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php          # Main layout template
│   ├── partials/
│   │   ├── header.blade.php       # Navigation header
│   │   └── footer.blade.php       # Footer section
│   ├── home/
│   │   ├── index.blade.php        # Homepage
│   │   ├── shop.blade.php         # Shop page
│   │   ├── contact.blade.php      # Contact page
│   │   ├── testimonial.blade.php  # Testimonials
│   │   ├── why.blade.php          # Why Us page
│   │   └── dashboard.blade.php    # User dashboard
│   ├── login/
│   │   ├── login.blade.php        # Login form
│   │   └── register.blade.php     # Registration form
│   └── product/
│       ├── create.blade.php       # Create product
│       ├── edit.blade.php         # Edit product
│       └── listproduct.blade.php  # List products
│
├── routes/
│   └── web.php                    # All route definitions
│
└── public/
    ├── css/                       # Stylesheets
    ├── js/                        # JavaScript files
    └── images/                    # Images
```

---

## Routes Quick Reference

### Public Routes (No Authentication)
| URL | Controller Method | View | Description |
|-----|------------------|------|-------------|
| `/` | `HomeController@index` | `home.index` | Homepage |
| `/shop` | `HomeController@shop` | `home.shop` | Shop page |
| `/contact` | `HomeController@contact` | `home.contact` | Contact page |
| `/testimonial` | `HomeController@testimonial` | `home.testimonial` | Testimonials |
| `/why` | `HomeController@why` | `home.why` | Why Us page |

### Authentication Routes
| URL | Method | Controller Method | Description |
|-----|--------|------------------|-------------|
| `/login` | GET | `AuthController@index` | Show login form |
| `/login` | POST | `AuthController@postLogin` | Process login |
| `/register` | GET | `AuthController@showRegistrationForm` | Show registration |
| `/register` | POST | `AuthController@register` | Process registration |
| `/logout` | POST | `AuthController@logout` | Logout user |

### Protected Routes (Requires Login)
| URL | Controller Method | View | Description |
|-----|------------------|------|-------------|
| `/dashboard` | `HomeController@dashboard` | `home.dashboard` | User dashboard |

### Admin Routes (Requires Admin Role)
| URL | Method | Controller Method | Description |
|-----|--------|------------------|-------------|
| `/products` | GET | `ProductController@index` | List products |
| `/product/create` | GET | `ProductController@create` | Create form |
| `/product/store` | POST | `ProductController@store` | Store product |
| `/product/{id}/edit` | GET | `ProductController@edit` | Edit form |
| `/product/{id}` | PUT | `ProductController@update` | Update product |
| `/product/{id}` | DELETE | `ProductController@destroy` | Delete product |

---

## Blade Template Syntax

### Layout Structure
```blade
{{-- Extend main layout --}}
@extends('layouts.app')

{{-- Set page title --}}
@section('title', 'Page Title')

{{-- Hero section (optional, for homepage) --}}
@section('hero')
  <!-- Hero content here -->
@endsection

{{-- Main content --}}
@section('content')
  <!-- Page content here -->
@endsection

{{-- Additional CSS (optional) --}}
@push('styles')
  <style>
    /* Custom CSS */
  </style>
@endpush

{{-- Additional JS (optional) --}}
@push('scripts')
  <script>
    // Custom JavaScript
  </script>
@endpush
```

### Common Blade Directives
```blade
{{-- Display variable --}}
{{ $variable }}

{{-- Display unescaped HTML --}}
{!! $html !!}

{{-- Asset helper --}}
{{ asset('css/style.css') }}
{{ asset('images/logo.png') }}

{{-- Route helper --}}
{{ route('home') }}
{{ route('products.edit', $id) }}

{{-- Authentication --}}
@auth
  <!-- Show if logged in -->
@endauth

@guest
  <!-- Show if not logged in -->
@endguest

{{-- Conditionals --}}
@if($condition)
  <!-- Content -->
@elseif($other)
  <!-- Other content -->
@else
  <!-- Default content -->
@endif

{{-- Loops --}}
@foreach($items as $item)
  {{ $item->name }}
@endforeach

{{-- Include partial --}}
@include('partials.header')

{{-- CSRF token (required for forms) --}}
@csrf

{{-- Method spoofing (for PUT/DELETE) --}}
@method('PUT')
@method('DELETE')
```

---

## Controller Examples

### Basic Controller Method
```php
public function index()
{
    return view('home.index');
}
```

### Passing Data to View
```php
public function shop()
{
    $products = Product::all();
    return view('home.shop', compact('products'));
}
```

### With Multiple Variables
```php
public function dashboard()
{
    $user = Auth::user();
    $orders = Order::where('user_id', $user->id)->get();
    
    return view('home.dashboard', [
        'user' => $user,
        'orders' => $orders
    ]);
}
```

---

## Common Tasks

### 1. Add New Public Page

**Step 1:** Add route in `routes/web.php`
```php
Route::get('/about', [HomeController::class, 'about'])->name('about');
```

**Step 2:** Add method in `app/Http/Controllers/HomeController.php`
```php
public function about()
{
    return view('home.about');
}
```

**Step 3:** Create view `resources/views/home/about.blade.php`
```blade
@extends('layouts.app')

@section('title', 'About Us')

@section('content')
  <h1>About Us</h1>
  <p>Content here...</p>
@endsection
```

**Step 4:** Add to navigation in `resources/views/partials/header.blade.php`
```blade
<li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('about') }}">About</a>
</li>
```

---

### 2. Protect a Page with Authentication

```php
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
});
```

---

### 3. Check User Role in View

```blade
@if(Auth::check() && Auth::user()->role === 'admin')
  <a href="{{ route('products.index') }}">Admin Panel</a>
@endif
```

---

### 4. Display Flash Messages

**In Controller:**
```php
return redirect()->route('dashboard')->with('success', 'Action completed!');
```

**In View:**
```blade
@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
@endif
```

---

### 5. Create a Form

```blade
<form action="{{ route('contact.store') }}" method="POST">
  @csrf
  
  <div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control" required>
  </div>
  
  <div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control" required>
  </div>
  
  <div class="form-group">
    <label>Message</label>
    <textarea name="message" class="form-control" required></textarea>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
```

---

### 6. Display Validation Errors

```blade
@if($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
```

---

## Asset Management

### CSS Files
```blade
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
```

### JavaScript Files
```blade
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
```

### Images
```blade
<img src="{{ asset('images/logo.png') }}" alt="Logo">
```

### External CDN
```blade
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
```

---

## Authentication Helpers

### Check if User is Logged In
```php
// In Controller
if (Auth::check()) {
    // User is logged in
}

// In View
@auth
  <!-- User is logged in -->
@endauth
```

### Get Current User
```php
// In Controller
$user = Auth::user();
$name = Auth::user()->name;
$email = Auth::user()->email;

// In View
{{ Auth::user()->name }}
```

### Logout
```blade
<form action="{{ route('logout') }}" method="POST">
  @csrf
  <button type="submit">Logout</button>
</form>
```

---

## Useful Artisan Commands

```bash
# Start development server
php artisan serve

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# List all routes
php artisan route:list

# Create new controller
php artisan make:controller PageController

# Create new model
php artisan make:model Page -m

# Run migrations
php artisan migrate

# Create migration
php artisan make:migration create_pages_table
```

---

## Debugging Tips

### Display Variable Contents
```blade
{{ dd($variable) }}  {{-- Die and dump --}}
{{ dump($variable) }} {{-- Dump without dying --}}
```

### Check Current Route
```blade
{{ Request::path() }}      {{-- Returns: shop --}}
{{ Request::url() }}       {{-- Returns: http://localhost/shop --}}
{{ Request::is('shop') }}  {{-- Returns: true/false --}}
```

### Enable Debug Mode
In `.env` file:
```
APP_DEBUG=true
```

---

## Common Errors & Solutions

### 1. "Route not found"
- Check `routes/web.php` for typos
- Run `php artisan route:clear`
- Verify route name matches

### 2. "View not found"
- Check file path: `resources/views/home/page.blade.php`
- Verify view name: `view('home.page')`
- File must have `.blade.php` extension

### 3. "Class not found"
- Check namespace in controller
- Run `composer dump-autoload`
- Verify use statements

### 4. "CSRF token mismatch"
- Add `@csrf` to all POST forms
- Check session configuration
- Clear cache: `php artisan cache:clear`

### 5. "Assets not loading"
- Use `{{ asset('path') }}` helper
- Check file exists in `public/` directory
- Clear browser cache

---

## Best Practices

1. ✅ Always use named routes: `route('home')`
2. ✅ Use `{{ asset() }}` for all assets
3. ✅ Add `@csrf` to all forms
4. ✅ Escape output with `{{ }}` (not `{!! !!}`)
5. ✅ Keep controllers thin, views clean
6. ✅ Use middleware for protection
7. ✅ Follow Laravel naming conventions
8. ✅ Comment complex logic
9. ✅ Keep views DRY (Don't Repeat Yourself)
10. ✅ Use Blade components for reusable parts

---

## Support Resources

- **Laravel Docs:** https://laravel.com/docs
- **Blade Templates:** https://laravel.com/docs/blade
- **Routing:** https://laravel.com/docs/routing
- **Controllers:** https://laravel.com/docs/controllers
- **Authentication:** https://laravel.com/docs/authentication

---

**Quick Start:**
1. Run `php artisan serve`
2. Visit `http://localhost:8000`
3. Test all routes
4. Check authentication flow
5. Verify assets load correctly

**Happy Coding! 🚀**
