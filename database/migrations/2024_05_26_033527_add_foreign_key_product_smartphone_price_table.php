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
        if(Schema::hasColumns('product_smartphone_price',
            [
                'ram_id',
                'storage_capacity_id',
                'color_id',
            ]
        )) {
            Schema::table('product_smartphone_price', function (Blueprint $table) {
                $table->foreign('ram_id')->references('id')
                    ->on('rams')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->foreign('storage_capacity_id')->references('id')
                    ->on('storage_capacities')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

                $table->foreign('color_id')->references('id')
                    ->on('colors')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumns('product_smartphone_price',
            [
                'ram_id',
                'storage_capacity_id',
                'color_id',
            ]
        )) {
            Schema::table('product_smartphone_price', function (Blueprint $table) {
                $table->dropForeign('product_smartphone_price_color_id_foreign');
                $table->dropForeign('product_smartphone_price_ram_id_foreign');
                $table->dropForeign('product_smartphone_price_storage_capacity_id_foreign');
            });
        }
    }
};
