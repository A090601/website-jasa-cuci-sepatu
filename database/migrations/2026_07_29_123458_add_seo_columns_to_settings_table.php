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
        Schema::table('settings', function (Blueprint $table) {

            $table->text('site_description')->nullable()->after('site_name');

            $table->string('favicon')->nullable()->after('logo');

            $table->string('tiktok')->nullable()->after('facebook');

            $table->string('meta_title')->nullable()->after('tiktok');

            $table->text('meta_description')->nullable();

            $table->text('meta_keywords')->nullable();

            $table->string('copyright')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {

            $table->dropColumn([
                'site_description',
                'favicon',
                'tiktok',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'copyright'
            ]);
        });
    }
};
