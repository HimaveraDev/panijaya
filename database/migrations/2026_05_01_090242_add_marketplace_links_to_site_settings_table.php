<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->text('shopee_url')->nullable();
            $table->text('tokopedia_url')->nullable();
            $table->text('tiktok_url')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['shopee_url', 'tokopedia_url', 'tiktok_url']);
        });
    }
};
