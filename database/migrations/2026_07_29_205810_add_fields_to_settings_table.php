<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('settings', 'site_description')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->text('site_description')->nullable()->after('site_name');
            });
        }

        if (!Schema::hasColumn('settings', 'google_maps')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->text('google_maps')->nullable()->after('address');
            });
        }

        if (!Schema::hasColumn('settings', 'tiktok')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->string('tiktok')->nullable()->after('facebook');
            });
        }

        if (!Schema::hasColumn('settings', 'meta_title')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->string('meta_title')->nullable();
            });
        }

        if (!Schema::hasColumn('settings', 'meta_description')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->text('meta_description')->nullable();
            });
        }

        if (!Schema::hasColumn('settings', 'meta_keywords')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->text('meta_keywords')->nullable();
            });
        }

        if (!Schema::hasColumn('settings', 'copyright')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->string('copyright')->nullable();
            });
        }

        if (!Schema::hasColumn('settings', 'favicon')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->string('favicon')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {

            $table->dropColumn([
                'site_description',
                'google_maps',
                'tiktok',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'copyright',
                'favicon',
            ]);
        });
    }
};
