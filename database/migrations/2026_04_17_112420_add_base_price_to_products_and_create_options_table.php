<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tambahkan base_price ke tabel products
        Schema::table('products', function (Blueprint $table) {
            $table->bigInteger('base_price')->nullable()->after('slug');
        });

        // 2. Buat tabel opsi harga produk
        Schema::create('product_price_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('label');
            $table->bigInteger('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_price_options');

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('base_price');
        });
    }
};
