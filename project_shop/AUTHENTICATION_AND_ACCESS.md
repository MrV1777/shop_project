# Authentication and Product Access Documentation

## Overview

This e-commerce application implements a role-based authentication system with three distinct user types:
1. **Guests** - Can browse products without authentication
2. **Registered Users** - Can browse products, add to cart, and checkout
3. **Administrators** - Can manage products and users

## Authentication Flow

### 1. Guest Access
- Guests can access the home page (`/`) and product listings (`/products`)
- Product detail pages (`/product/{id}`) are also publicly accessible
- All other routes require authentication

### 2. User Registration
- Users can register at `/register`
- New registrations are automatically assigned the "user" role
- After registration, users are redirected to their dashboard

### 3. User Login
- Users can login at `/login`
- Based on their role, they are redirected to:
  - Admins: Admin dashboard (`/admin/dashboard`)
  - Users: User home (`/home`)

### 4. Session Management
- Sessions are managed using Laravel's built-in authentication
- Logout is available for all authenticated users at `/logout`

## Product Access Control

### Public Access (No Authentication Required)
- Home page (`/`) - Product listing
- Product listings (`/products`) - Paginated product list
- Product details (`/product/{id}`) - Individual product view

### Authenticated User Access
- Shopping cart (`/cart`) - View and manage cart items
- Checkout (`/checkout`) - Complete purchase process
- User dashboard (`/home`) - Personalized user home page

### Administrator Access
- Admin dashboard (`/admin/dashboard`) - Administrative overview
- Product management (`/admin/products*`) - Create, edit, delete products
- User management (`/admin/users*`) - Manage registered users

## Middleware Protection

The application uses custom middleware to enforce access control:

1. **UserMiddleware** - Restricts access to regular users only
2. **AdminMiddleware** - Restricts access to administrators only

Routes are grouped by authentication requirements:
- Public routes: No middleware
- User routes: `['auth', 'user']` middleware group
- Admin routes: `['auth', 'admin']` middleware group

## Cart Functionality

### Adding Items to Cart
- Only authenticated users can add products to cart
- If a guest attempts to add to cart, they are redirected to the login page
- Cart data is stored in the session

### Managing Cart
- Users can update quantities or remove items from their cart
- Cart contents persist throughout the user's session

### Checkout Process
- Requires authentication
- Validates cart contents before processing
- Clears cart after successful checkout

## Security Features

1. **Role-Based Access Control** - Users can only access features appropriate to their role
2. **CSRF Protection** - All forms include CSRF tokens
3. **Input Validation** - All user inputs are validated
4. **Password Hashing** - Passwords are securely hashed using Laravel's Hash facade
5. **Session Management** - Proper session invalidation on logout

## Routes Summary

### Public Routes
```
GET  /                    - Home page (product listing)
GET  /products            - Product listing
GET  /product/{product}   - Product detail
GET  /login               - Login form
POST /login               - Process login
GET  /register            - Registration form
POST /register            - Process registration
POST /logout              - Logout
```

### Authenticated User Routes
```
GET  /home                - User dashboard
GET  /cart                - View cart
POST /cart/add/{product}  - Add product to cart
POST /cart/remove/{product} - Remove product from cart
POST /cart/update/{product} - Update cart item quantity
GET  /checkout            - Checkout page
POST /checkout            - Process checkout
```

### Administrator Routes
```
GET  /admin/dashboard     - Admin dashboard
GET  /admin/products      - Product listing
GET  /admin/product/create - Create product form
POST /admin/product/store - Store new product
GET  /admin/product/{product}/edit - Edit product form
PUT  /admin/product/{product} - Update product
DELETE /admin/product/{product} - Delete product
```

## Implementation Details

### Controllers
- `AuthController` - Handles login, registration, and logout
- `ProductController` - Manages all product-related functionality including public browsing, cart, and checkout

### Models
- `User` - User model with role-based access methods
- `Product` - Product model for product data

### Views
- Public layout (`layouts/public.blade.php`) - For guest users
- User layout (`layouts/user.blade.php`) - For authenticated users
- Admin layout (`layouts/admin.blade.php`) - For administrators

### Middleware
- `UserMiddleware` - Ensures user has "user" role
- `AdminMiddleware` - Ensures user has "admin" role