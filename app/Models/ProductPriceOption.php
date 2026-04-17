<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPriceOption extends Model
{
    protected $fillable = ['product_id', 'label', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
