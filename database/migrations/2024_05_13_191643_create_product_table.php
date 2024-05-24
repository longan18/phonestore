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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->uuid('slug')->unique();

            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');

            $table->tinyInteger('status')->default(\App\Enums\Status::StopSelling->value);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('brand_id')->references('id')->on('brands')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('category_id')->references('id')->on('categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
