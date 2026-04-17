<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Harga Dasar Estimasi Produk (per m²)
    |--------------------------------------------------------------------------
    | Satuan: Rupiah. Digunakan oleh kalkulator estimasi di halaman katalog.
    | Ubah nilai di sini untuk menyesuaikan harga dasar tanpa menyentuh kode.
    */
    'base_price' => [
        'kusen_pintu'   => 2500000,
        'kusen_jendela' => 1800000,
        'daun_pintu'    => 2000000,
        'roster'        => 1200000,
    ],

    /*
    |--------------------------------------------------------------------------
    | Faktor Pengali Material Kayu
    |--------------------------------------------------------------------------
    | Nilai ini dikalikan dengan harga dasar untuk menghitung estimasi akhir.
    */
    'material_factor' => [
        'jati'    => 1.8,
        'mahoni'  => 1.3,
        'meranti' => 1.0,
        'pinus'   => 0.8,
    ],

    /*
    |--------------------------------------------------------------------------
    | Harga Minimum per Jenis Produk (Rp)
    |--------------------------------------------------------------------------
    | Floor harga agar estimasi tidak di bawah biaya produksi minimum.
    */
    'minimum_price' => [
        'kusen_pintu'   => 800000,
        'kusen_jendela' => 600000,
        'daun_pintu'    => 700000,
        'roster'        => 400000,
    ],
];
