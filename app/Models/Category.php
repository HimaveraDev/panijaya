<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'image'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/placeholder.png');
        }

        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }
}
