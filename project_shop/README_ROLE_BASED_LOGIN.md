# Role-Based Login System in Laravel

This Laravel application implements a role-based login system with two user roles:
- **Admin**: Can manage products (create, read, update, delete)
- **Normal User**: Can view products only

## Features Implemented

1. **Role-Based Authentication**
   - Users are redirected based on their role after login
   - Admin users are redirected to the product management page
   - Normal users are redirected to the home page with product listing

2. **Admin Functionality**
   - Product management (CRUD operations)
   - Access to admin dashboard and user management

3. **User Functionality**
   - View products in a modern card layout
   - Responsive design for mobile and desktop
   - Search functionality for products

4. **Security**
   - Middleware to restrict access based on roles
   - Passwords are securely hashed
   - Admin-only pages cannot be accessed by normal users

## Database Structure

### Users Table
- id (primary key)
- name (string)
- email (string, unique)
- password (string)
- role (enum: 'admin', 'user', default: 'user')
- timestamps

### Products Table
- id (primary key)
- name (string)
- quantity (integer)
- description (text, nullable)
- image (string, nullable)
- timestamps

## Seeded Data

The application comes with pre-seeded data for testing:

### Admin Users
1. Email: `admin@gmail.com`, Password: `admin12345678`
2. Email: `admin@example.com`, Password: `password123`

### Normal Users
1. Email: `user@example.com`, Password: `password123`

### Products
8 sample products have been created for testing purposes.

## How to Test the Application

1. **Start the Laravel development server:**
   ```
   php artisan serve
   ```

2. **Visit the application in your browser:**
   ```
   http://127.0.0.1:8000
   ```

3. **Test Admin Login:**
   - Email: `admin@gmail.com`
   - Password: `admin12345678`
   - After login, you should be redirected to the product management page

4. **Test User Login:**
   - Email: `user@example.com`
   - Password: `password123`
   - After login, you should be redirected to the home page with product listing

5. **Test Role Restrictions:**
   - As an admin, try to access `/home` - you should be redirected to product management
   - As a user, try to access `/products` - you should get a 403 Forbidden error

## Key Implementation Details

### Routes
- `/` - Login page
- `/login` - POST login endpoint
- `/register` - Registration page
- `/home` - User home page (product listing)
- `/products` - Admin product management
- `/product/create` - Create new product (admin only)
- `/product/{product}/edit` - Edit product (admin only)

### Middleware
- `admin` - Restricts access to admin users only
- `user` - Restricts access to normal users only

### Controllers
- `AuthController` - Handles authentication logic
- `ProductController` - Handles product management and user product listing

### Views
- `resources/views/layouts/user.blade.php` - Layout for user pages
- `resources/views/layouts/admin.blade.php` - Layout for admin pages
- `resources/views/home/user_products.blade.php` - User home page with product listing
- `resources/views/product/Listproduct.blade.php` - Admin product listing

## Customization

To add more roles or modify existing functionality:
1. Update the User model with additional role checking methods
2. Create new middleware for additional roles
3. Register new middleware in `app/Http/Kernel.php`
4. Update routes to use new middleware
5. Create new views and controllers as needed

## Troubleshooting

If you encounter any issues:
1. Ensure all migrations have been run: `php artisan migrate`
2. Seed the database: `php artisan db:seed`
3. Clear cache: `php artisan cache:clear` and `php artisan config:clear`
4. Check that the `.env` file is properly configured