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
        Schema::create('pricing_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('product_type', ['kusen_pintu', 'kusen_jendela', 'daun_pintu', 'roster']);
            $table->enum('material', ['jati', 'mahoni', 'meranti', 'pinus']);
            $table->bigInteger('base_price');
            $table->bigInteger('min_price');
            $table->decimal('material_factor', 3, 2);
            $table->timestamps();

            // Setiap kombinasi product × material harus unik
            $table->unique(['product_type', 'material'], 'pricing_product_material_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_settings');
    }
};
