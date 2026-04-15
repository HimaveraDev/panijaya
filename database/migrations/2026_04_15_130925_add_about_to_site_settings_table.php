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
            $table->string('about_hero_title')->default('Tentang Kami');
            $table->string('about_hero_description')->default('Dedikasi kami untuk kualitas dan keindahan hunian Anda.');
            $table->string('about_history_title')->default('Sejarah & Visi Pani Jaya');
            $table->text('about_content')->nullable();
            $table->string('about_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'about_hero_title',
                'about_hero_description',
                'about_history_title',
                'about_content',
                'about_image',
            ]);
        });
    }
};
