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
            $table->string('alu_image')->nullable();
            $table->string('alu_subtitle')->nullable();
            $table->string('alu_title')->nullable();
            $table->text('alu_description')->nullable();
            $table->json('alu_features')->nullable();
            
            $table->string('services_subtitle')->nullable();
            $table->string('services_title')->nullable();
            $table->json('services_list')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'alu_image',
                'alu_subtitle',
                'alu_title',
                'alu_description',
                'alu_features',
                'services_subtitle',
                'services_title',
                'services_list',
            ]);
        });
    }
};
