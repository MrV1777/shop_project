<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'categories';

    protected $fillable = [
        'name',
        'icon',
        'description',
        'image',
    ];
    
    // Default icon if none uploaded
    public static function getDefaultIcon()
    {
        return '📁';
    }
}
