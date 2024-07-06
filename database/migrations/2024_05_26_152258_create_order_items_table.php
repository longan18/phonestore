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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_detail_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('item_id');
            $table->double('quantity');
            $table->decimal('price', 10, 0);
            $table->timestamps();

            $table->foreign('order_detail_id')->references('id')
                ->on('order_details')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('product_id')->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
