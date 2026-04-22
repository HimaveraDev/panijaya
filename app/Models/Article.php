<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'thumbnail',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function getImageUrlAttribute()
    {
        if (!$this->thumbnail) {
            return asset('images/placeholder.png');
        }

        if (str_starts_with($this->thumbnail, 'http')) {
            return $this->thumbnail;
        }

        return asset('storage/' . $this->thumbnail);
    }
}
