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
        Schema::create('product_smartphone_price', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->integer("ram")->unsigned()->nullable() // Ram
            ->comment('The unit is GB and is denoted by Ex: 8 GB');
            $table->string("storage_capacity")->nullable(); // Dung lượng lưu trữ
            $table->string("remaining_capacity_is_approx")->nullable(); // Dung lượng còn lại (khả dụng) khoảng
            $table->string('color'); // Màu sắc
            $table->string('hex_color');
            $table->string('price'); // Giá
            $table->bigInteger('quantity'); // Số lượng
            $table->tinyInteger('status')->default(\App\Enums\Status::StopSelling->value);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('item_id')->references('id')->on('product_smartphone')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_smartphone_price');
    }
};
