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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('features_title')->default('Mengapa Memilih Pani Jaya?');
            $table->string('features_image')->nullable();
            
            $table->string('feature_1_title')->default('Material Berkualitas');
            $table->text('feature_1_description')->nullable();
            
            $table->string('feature_2_title')->default('Custom Desain');
            $table->text('feature_2_description')->nullable();
            
            $table->string('feature_3_title')->default('Harga Kompetitif');
            $table->text('feature_3_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'features_title',
                'features_image',
                'feature_1_title',
                'feature_1_description',
                'feature_2_title',
                'feature_2_description',
                'feature_3_title',
                'feature_3_description',
            ]);
        });
    }
};
