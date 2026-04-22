<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectGallery extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'location',
        'installation_date',
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
