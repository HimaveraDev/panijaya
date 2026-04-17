<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PricingSetting;

class PricingSettingSeeder extends Seeder
{
    /**
     * Migrasi data dari config/pricing.php ke tabel pricing_settings.
     * Tidak akan melempar error jika data sudah ada (updateOrCreate).
     */
    public function run(): void
    {
        $basePrice = config('pricing.base_price', []);
        $minPrice  = config('pricing.minimum_price', []);
        $matFactor = config('pricing.material_factor', []);

        foreach (array_keys(PricingSetting::PRODUCT_TYPES) as $productType) {
            foreach (array_keys(PricingSetting::MATERIALS) as $material) {
                PricingSetting::updateOrCreate(
                    // Kondisi: kombinasi unik
                    [
                        'product_type' => $productType,
                        'material'     => $material,
                    ],
                    // Nilai yang di-seed dari config
                    [
                        'base_price'      => $basePrice[$productType] ?? 0,
                        'min_price'       => $minPrice[$productType]  ?? 0,
                        'material_factor' => $matFactor[$material]    ?? 1.0,
                    ]
                );
            }
        }

        $this->command->info('[PricingSettingSeeder] ' . PricingSetting::count() . ' baris berhasil diisi/diperbarui.');
    }
}
