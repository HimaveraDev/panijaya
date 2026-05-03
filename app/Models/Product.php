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
        'shopee_url',
        'tokopedia_url',
        'tiktok_url',
        'gallery',
    ];

    protected $casts = [
        'specifications' => 'array',
        'is_featured' => 'boolean',
        'gallery' => 'array',
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

    public function getGalleryUrlsAttribute()
    {
        $urls = [];
        if ($this->gallery && is_array($this->gallery)) {
            foreach ($this->gallery as $img) {
                if (str_starts_with($img, 'http')) {
                    $urls[] = $img;
                } else {
                    $urls[] = asset('storage/' . $img);
                }
            }
        }
        return $urls;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function priceOptions()
    {
        return $this->hasMany(ProductPriceOption::class);
    }

    public function getMarketplaceLinksAttribute()
    {
        return array_filter([
            'shopee' => $this->shopee_url,
            'tokopedia' => $this->tokopedia_url,
            'tiktok' => $this->tiktok_url,
        ]);
    }

    public function hasMarketplace()
    {
        return !empty($this->marketplace_links);
    }
}
