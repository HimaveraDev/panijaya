<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'image',
        'description',
        'specifications',
        'is_featured',
        'base_price',
    ];

    protected $casts = [
        'specifications' => 'array',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function priceOptions()
    {
        return $this->hasMany(ProductPriceOption::class);
    }
}
