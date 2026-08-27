<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [

        'name',

        'slug',

        'image',

        'price',
        
        'saleprice',

        'category',

        'description',

        'size_chart',

        'stock',
    ];

    // MULTIPLE IMAGES
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    
    public function sizes()
{
    return $this->hasMany(ProductSize::class);
}

public function wishlists()
{
    return $this->hasMany(\App\Models\Wishlist::class);
}

}