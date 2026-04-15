<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::factory()->create([
            'name' => 'Admin Pani Jaya',
            'email' => 'admin@panijaya.com',
            'password' => bcrypt('password'),
        ]);

        // Categories
        $categories = [
            'Kusen Kayu',
            'Kusen Aluminium',
            'Pintu Modern',
            'Jendela Minimalis'
        ];

        foreach ($categories as $catName) {
            $category = Category::create([
                'name' => $catName,
                'slug' => Str::slug($catName),
                'image' => null, // Placeholder or null
            ]);

            // Products for each category
            for ($i = 1; $i <= 3; $i++) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $catName . ' Type ' . $i,
                    'slug' => Str::slug($catName . ' Type ' . $i),
                    'description' => 'Produk ' . $catName . ' berkualitas tinggi dari Pani Jaya. Dibuat dengan material pilihan untuk ketahanan maksimal.',
                    'specifications' => [
                        'Material' => $catName == 'Kusen Aluminium' ? 'Aluminium 3 Inch' : 'Kayu Jati/Mahoni',
                        'Finishing' => 'Natural / Coating',
                        'Garansi' => '1 Tahun'
                    ],
                    'is_featured' => $i == 1,
                    'image' => null,
                ]);
            }
        }

        // Articles
        Article::create([
            'title' => 'Tips Memilih Kusen Kayu yang Awet',
            'slug' => 'tips-memilih-kusen-kayu-yang-awet',
            'content' => '<p>Kusen kayu memberikan kesan natural dan mewah pada hunian Anda. Namun, perawatan yang tepat diperlukan agar tahan lama...</p>',
            'thumbnail' => null,
            'published_at' => now(),
        ]);

        Article::create([
            'title' => 'Keunggulan Kusen Aluminium untuk Rumah Minimalis',
            'slug' => 'keunggulan-kusen-aluminium',
            'content' => '<p>Aluminium kini menjadi pilihan populer karena tahan rayap, tidak memuai, dan memiliki beragam pilihan warna...</p>',
            'thumbnail' => null,
            'published_at' => now(),
        ]);
    }
}
