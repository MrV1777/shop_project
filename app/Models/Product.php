<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'products';
    
    protected $fillable = [
        'name',
        'category',
        'price',
        'stock',
        'image',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public $timestamps = false;

    /**
     * Get the primary key for the model.
     *
     * @return string
     */
    public function getKeyName()
    {
        return '_id';
    }
}
