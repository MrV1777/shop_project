# Admin User Setup Instructions

This document provides instructions for setting up an admin user in your Laravel application.

## Credentials

The admin user will be created with the following credentials:
- Email: admin@gmail.com
- Password: admin12345678

## Seeding the Admin User

The admin user is created using a seeder. To run the seeder and create the admin user, follow these steps:

### 1. Run the Database Seeder

Open your terminal in the project root directory and run:

```bash
php artisan db:seed --class=AdminUserSeeder
```

This will create the admin user with the specified credentials if it doesn't already exist, or update it if it does.

### 2. Alternative: Run All Seeders

If you want to run all seeders (including the test users and admin user), use:

```bash
php artisan db:seed
```

## How It Works

1. The `AdminUserSeeder` creates an admin user with:
   - Name: Admin
   - Email: admin@gmail.com
   - Password: admin12345678 (hashed using Laravel's `Hash::make()`)
   - Role: admin

2. The password is securely hashed using Laravel's built-in hashing functionality.

3. The seeder uses `updateOrInsert()` to avoid creating duplicate users.

## Accessing Admin-Only Pages

1. Log in with the admin credentials at the login page.
2. The `AdminMiddleware` will allow access to admin-only routes.
3. Users with the 'admin' role can access protected routes.

## Admin Middleware

The application includes `AdminMiddleware` which checks if the authenticated user has the 'admin' role. If not, it returns a 403 error.

## User Model

The `User` model includes a `role` attribute which can be 'admin' or 'user'. The database migration ensures this field exists with appropriate defaults.

## Security Notes

- Passwords are securely hashed using Laravel's `Hash::make()` function
- The seeder uses `updateOrInsert()` to prevent duplicate entries
- The AdminMiddleware protects admin-only routes