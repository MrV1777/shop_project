<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Creates an admin user with the specified credentials.
     *
     * @return void
     */
    public function run(): void
    {
        // Create admin user with specified credentials
        User::updateOrInsert(
            ['email' => 'admin@gmail.com'], // Search for existing user with this email
            [
                'name' => 'Admin',
                'password' => Hash::make('admin12345678'), // Securely hash the password
                'role' => 'admin', // Assign admin role
                'email_verified_at' => now(), // Mark email as verified
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}