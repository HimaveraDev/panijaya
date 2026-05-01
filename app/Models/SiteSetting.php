<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $guarded = [];

    /**
     * Get the singleton record of site settings.
     */
    public static function get()
    {
        return static::firstOrCreate([], [
            'site_name' => 'Pani Jaya',
            'hero_title' => 'Solusi Kebutuhan Kusen & Pintu Premium',
            'hero_description' => 'Kami menghadirkan produk berkualitas tinggi untuk mempercantik dan memperkuat hunian Anda dengan material kayu dan aluminium pilihan.',
            'whatsapp_number' => '+628123456789',
            'address' => 'Jl. Jend. Sudirman No. 123, Kota Bekasi',
            'email' => 'info@panijaya.com',
            'footer_text' => 'Copyright © 2024 Pani Jaya. All Rights Reserved.',
            'features_title' => 'Mengapa Memilih Pani Jaya?',
            'feature_1_title' => 'Material Berkualitas',
            'feature_1_description' => 'Kami hanya menggunakan kayu pilihan (Jati, Mahoni, Meranti Kamper, Samarinda, Merbau) and aluminium premium yang tahan lama serta estetik.',
            'feature_2_title' => 'Custom Desain',
            'feature_2_description' => 'Sesuaikan ukuran dan model kusen, pintu, jendela, atau roster Anda sesuai dengan selera dan kebutuhan arsitektur rumah.',
            'feature_3_title' => 'Harga Kompetitif',
            'feature_3_description' => 'Kualitas mewah tidak harus mahal. Kami menawarkan harga terbaik langsung dari workshop penyedia.',
            'about_hero_title' => 'Tentang Kami',
            'about_hero_description' => 'Dedikasi kami untuk kualitas dan keindahan hunian Anda.',
            'about_history_title' => 'Sejarah & Visi Pani Jaya',
            'about_history' => '<p>Berawal dari sebuah workshop kecil di Kota Bekasi, Pani Jaya telah tumbuh menjadi salah satu penyedia kusen, pintu, dan jendela terpercaya untuk ribuan hunian dan proyek komersial.</p><p>Kami percaya bahwa setiap detail dalam konstruksi rumah memiliki nilai seni dan fungsionalitas yang tinggi. Itulah mengapa kami berkomitmen untuk hanya menggunakan material premium dan tenaga ahli yang berpengalaman.</p>',
            'about_vision' => '<p>Menjadi mitra utama dalam menghadirkan hunian yang estetis, kokoh, dan modern melalui produk-produk berkualitas tinggi.</p>',
            'about_mission' => '<ul class="list-disc pl-5"><li>Memberikan kualitas material terbaik yang tahan lama.</li><li>Menyediakan desain custom yang mengikuti tren arsitektur terkini.</li><li>Memberikan pelayanan konsultasi dan purnajual yang memuaskan.</li></ul>',
            'logo_height' => 40,
        ]);
    }

    public function getLogoUrlAttribute()
    {
        return $this->logo_path ? asset('storage/' . $this->logo_path) : asset('images/logo_nobg.png');
    }

    public function getHeroImageUrlAttribute()
    {
        return $this->hero_image ? asset('storage/' . $this->hero_image) : asset('images/hero-placeholder.jpg');
    }

    public function getFeaturesImageUrlAttribute()
    {
        return $this->features_image ? asset('storage/' . $this->features_image) : asset('images/features-placeholder.jpg');
    }

    public function getAboutImageUrlAttribute()
    {
        return $this->about_image ? asset('storage/' . $this->about_image) : asset('images/about-placeholder.jpg');
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
