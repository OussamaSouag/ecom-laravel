<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable = [
    'name',
    'description',
    'short_description',
    'slug',
    'SKU',
    'price',
    'sale_price',
    'stock',
    'category_id',
    'brand_id',
    'image',
    'images',
    
];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
