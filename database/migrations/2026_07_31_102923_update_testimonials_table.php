<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Rename kolom name -> customer_name
        if (
            Schema::hasColumn('testimonials', 'name') &&
            !Schema::hasColumn('testimonials', 'customer_name')
        ) {
            DB::statement("ALTER TABLE testimonials CHANGE name customer_name VARCHAR(255)");
        }

        Schema::table('testimonials', function (Blueprint $table) {

            if (!Schema::hasColumn('testimonials', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('message');
            }
        });
    }

    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {

            if (Schema::hasColumn('testimonials', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });

        if (
            Schema::hasColumn('testimonials', 'customer_name') &&
            !Schema::hasColumn('testimonials', 'name')
        ) {
            DB::statement("ALTER TABLE testimonials CHANGE customer_name name VARCHAR(255)");
        }
    }
};
