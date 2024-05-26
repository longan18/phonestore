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
        Schema::create('shopping_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shopping_session_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('item_id');
            $table->double('quantity');
            $table->double('price');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('shopping_session_id')->references('id')
                ->on('shopping_sessions')
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
        Schema::dropIfExists('shopping_items');
    }
};
