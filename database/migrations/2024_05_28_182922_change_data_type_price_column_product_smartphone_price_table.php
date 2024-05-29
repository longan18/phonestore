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
        if (Schema::hasColumn('product_smartphone_price', 'price')) {
            Schema::table('product_smartphone_price', function (Blueprint $table) {
                $table->decimal('price', 10, 0)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('product_smartphone_price', 'price')) {
            Schema::table('product_smartphone_price', function (Blueprint $table) {
                $table->string('price')->change();
            });
        }
    }
};
