# E-Commerce Website Project Structure

## Overview
This is a complete e-commerce website built with Laravel that allows users to browse products, add items to cart, and checkout after authentication.

## Directory Structure

```
project_shop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── ProductController.php
│   │   │   └── UserController.php
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php
│   │       └── UserMiddleware.php
│   └── Models/
│       ├── Product.php
│       └── User.php
├── database/
│   └── migrations/
│       └── 2026_01_31_112441_create_products_table.php
├── public/
│   └── images/
├── resources/
│   ├── views/
│   │   ├── home/
│   │   │   ├── public_products.blade.php
│   │   │   ├── user_products.blade.php
│   │   │   ├── product_detail.blade.php
│   │   │   ├── cart.blade.php
│   │   │   └── checkout.blade.php
│   │   ├── layouts/
│   │   │   ├── public.blade.php
│   │   │   ├── user.blade.php
│   │   │   └── admin.blade.php
│   │   ├── login/
│   │   │   ├── login.blade.php
│   │   │   └── register.blade.php
│   │   └── product/
│   │       ├── create.blade.php
│   │       ├── edit.blade.php
│   │       └── Listproduct.blade.php
├── routes/
│   └── web.php
├── AUTHENTICATION_AND_ACCESS.md
└── PROJECT_STRUCTURE.md
```

## Key Features Implemented

1. **Public Product Browsing**
   - Home page with product listings
   - Individual product detail pages
   - Search functionality

2. **User Authentication**
   - Registration with email verification
   - Login/logout functionality
   - Role-based access control (user/admin)

3. **Shopping Cart**
   - Add/remove products
   - Update quantities
   - View cart summary

4. **Checkout Process**
   - Shipping information form
   - Payment method selection
   - Order confirmation

5. **Admin Panel**
   - Product management (CRUD)
   - User management

## Technologies Used

- **Backend**: Laravel PHP Framework
- **Frontend**: Bootstrap 5, Blade Templates
- **Database**: MySQL/MariaDB compatible
- **Authentication**: Laravel Breeze/Auth

## Routes

### Public Routes
- `/` - Home page (product listing)
- `/products` - Product listing
- `/product/{product}` - Product detail
- `/login` - Login form
- `/register` - Registration form

### Authenticated User Routes
- `/home` - User dashboard
- `/cart` - Shopping cart
- `/checkout` - Checkout process

### Admin Routes
- `/admin/dashboard` - Admin dashboard
- `/admin/products` - Product management
- `/admin/users` - User management

## Controllers

### AuthController
Handles user authentication including login, registration, and logout.

### ProductController
Manages all product-related functionality:
- Public product browsing
- Cart management
- Checkout process
- Admin product management

## Models

### User
Extends Laravel's built-in authentication model with role-based access methods.

### Product
Represents products in the store with name, description, price, and image.

## Middleware

### UserMiddleware
Restricts access to authenticated users with "user" role.

### AdminMiddleware
Restricts access to authenticated users with "admin" role.

## Views

### Layouts
- `public.blade.php` - Layout for guest users
- `user.blade.php` - Layout for authenticated users
- `admin.blade.php` - Layout for administrators

### Pages
- `home/public_products.blade.php` - Public product listing
- `home/user_products.blade.php` - Authenticated user product listing
- `home/product_detail.blade.php` - Individual product view
- `home/cart.blade.php` - Shopping cart
- `home/checkout.blade.php` - Checkout process
- `login/login.blade.php` - Login form
- `login/register.blade.php` - Registration form