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
            $table->text('about_history')->nullable();
            $table->text('about_vision')->nullable();
            $table->text('about_mission')->nullable();
            $table->dropColumn('about_content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->text('about_content')->nullable();
            $table->dropColumn(['about_history', 'about_vision', 'about_mission']);
        });
    }
};
