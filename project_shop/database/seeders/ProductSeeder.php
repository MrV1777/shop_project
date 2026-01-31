<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Smartphone X1',
                'quantity' => 299.99,
                'description' => 'Latest smartphone with advanced features and high-resolution camera.',
                'image' => null,
            ],
            [
                'name' => 'Laptop Pro',
                'quantity' => 899.99,
                'description' => 'Powerful laptop for professionals and gamers with SSD storage.',
                'image' => null,
            ],
            [
                'name' => 'Wireless Headphones',
                'quantity' => 79.99,
                'description' => 'High-quality wireless headphones with noise cancellation.',
                'image' => null,
            ],
            [
                'name' => 'Smart Watch',
                'quantity' => 199.99,
                'description' => 'Feature-rich smartwatch with health monitoring capabilities.',
                'image' => null,
            ],
            [
                'name' => 'Bluetooth Speaker',
                'quantity' => 49.99,
                'description' => 'Portable Bluetooth speaker with excellent sound quality.',
                'image' => null,
            ],
            [
                'name' => 'Tablet Z',
                'quantity' => 349.99,
                'description' => 'Lightweight tablet perfect for entertainment and productivity.',
                'image' => null,
            ],
            [
                'name' => 'Gaming Console',
                'quantity' => 499.99,
                'description' => 'Next-generation gaming console with 4K gaming support.',
                'image' => null,
            ],
            [
                'name' => 'Digital Camera',
                'quantity' => 599.99,
                'description' => 'Professional digital camera with interchangeable lenses.',
                'image' => null,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}