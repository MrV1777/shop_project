<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample products
        \App\Models\Product::create([
            'name' => 'Laravel T-Shirt',
            'description' => 'Comfortable cotton t-shirt with Laravel logo',
            'price' => 19.99,
            'image' => 'laravel-tshirt.jpg',
        ]);
        
        \App\Models\Product::create([
            'name' => 'PHP Mug',
            'description' => 'Ceramic mug with PHP logo',
            'price' => 14.99,
            'image' => 'php-mug.jpg',
        ]);
        
        \App\Models\Product::create([
            'name' => 'JavaScript Sticker Pack',
            'description' => 'Set of 10 JavaScript stickers',
            'price' => 9.99,
            'image' => 'js-stickers.jpg',
        ]);
        
        \App\Models\Product::create([
            'name' => 'Vue.js Notebook',
            'description' => 'Spiral-bound notebook with Vue.js cover',
            'price' => 12.99,
            'image' => 'vue-notebook.jpg',
        ]);
        
        \App\Models\Product::create([
            'name' => 'React Cap',
            'description' => 'Adjustable cap with React logo',
            'price' => 24.99,
            'image' => 'react-cap.jpg',
        ]);
    }
}
