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
        if (Schema::hasColumn('product_smartphone_price', 'item_id')) {
            Schema::table('product_smartphone_price', function (Blueprint $table) {
                $table->dropForeign('product_smartphone_price_item_id_foreign');
                $table->renameColumn('item_id', 'product_id');

                $table->foreign('product_id', 'product_smartphone_price_product_id_foreign')
                    ->references('id')
                    ->on('products')
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
        if (Schema::hasColumn('product_smartphone_price', 'product_id')) {
            Schema::table('product_smartphone_price', function (Blueprint $table) {
                $table->dropForeign('product_smartphone_price_product_id_foreign');
                $table->renameColumn('product_id', 'item_id');

                $table->foreign('item_id', 'product_smartphone_price_item_id_foreign')
                    ->references('id')
                    ->on('product_smartphone')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }
    }
};
