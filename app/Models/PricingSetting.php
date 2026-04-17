<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingSetting extends Model
{
    protected $fillable = [
        'product_type',
        'material',
        'base_price',
        'min_price',
        'material_factor',
    ];

    protected $casts = [
        'base_price'      => 'integer',
        'min_price'       => 'integer',
        'material_factor' => 'decimal:2',
    ];

    // -------------------------------------------------------
    // Konstanta pilihan enum — dipakai di Form & Seeder
    // -------------------------------------------------------
    public const PRODUCT_TYPES = [
        'kusen_pintu'   => 'Kusen Pintu',
        'kusen_jendela' => 'Kusen Jendela',
        'daun_pintu'    => 'Daun Pintu',
        'roster'        => 'Roster',
    ];

    public const MATERIALS = [
        'jati'    => 'Kayu Jati (Premium)',
        'mahoni'  => 'Kayu Mahoni (Menengah)',
        'meranti' => 'Kayu Meranti (Standar)',
        'pinus'   => 'Kayu Pinus (Ekonomis)',
    ];

    // -------------------------------------------------------
    // Ambil seluruh data dan transformasi ke format __pricingConfig
    // yang siap dikonsumsi Alpine.js di frontend.
    // Jika tabel kosong → fallback ke config/pricing.php
    // -------------------------------------------------------
    public static function toPricingConfig(): array
    {
        $rows = static::all();

        if ($rows->isEmpty()) {
            // Fallback ke config lama — zero-risk guarantee
            return [
                'basePrice' => config('pricing.base_price', []),
                'matFactor' => config('pricing.material_factor', []),
                'minPrice'  => config('pricing.minimum_price', []),
            ];
        }

        $basePrice = [];
        $matFactor = [];
        $minPrice  = [];

        foreach ($rows as $row) {
            $pt = $row->product_type;
            $m  = $row->material;

            // base_price & min_price: indexed by product_type (Alpine memakai key ini)
            $basePrice[$pt]       = (int) $row->base_price;
            $minPrice[$pt]        = (int) $row->min_price;

            // material_factor: indexed by material
            $matFactor[$m]        = (float) $row->material_factor;
        }

        return compact('basePrice', 'matFactor', 'minPrice');
    }
}
