<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'role',
        'content',
        'image',
        'rating',
        'is_active',
    ];

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
