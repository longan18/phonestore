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
                'ram',
                'storage_capacity',
                'color',
                'hex_color'
            ]
        )) {
            Schema::table('product_smartphone_price', function (Blueprint $table) {
                $table->dropColumn(['ram', 'storage_capacity', 'color', 'hex_color']);
            });
        }

        if(!Schema::hasColumns('product_smartphone_price',
            [
                'ram_id',
                'storage_capacity_id',
                'color_id',
            ]
        )) {
            Schema::table('product_smartphone_price', function (Blueprint $table) {
                $table->unsignedInteger('ram_id')->nullable()->after('item_id');
                $table->unsignedInteger('storage_capacity_id')->nullable()->after('ram_id');
                $table->unsignedBigInteger('color_id')->nullable()->after('remaining_capacity_is_approx');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(!Schema::hasColumns('product_smartphone_price',
            [
                'ram',
                'storage_capacity',
                'color',
                'hex_color'
            ]
        )) {
            Schema::table('product_smartphone_price', function (Blueprint $table) {
                $table->integer("ram")->unsigned()->nullable() // Ram
                ->comment('The unit is GB and is denoted by Ex: 8 GB');
                $table->string("storage_capacity")->nullable(); // Dung lượng lưu trữ
                $table->string('color'); // Màu sắc
                $table->string('hex_color');
            });
        }

        if(Schema::hasColumns('product_smartphone_price',
            [
                'ram_id',
                'storage_capacity_id',
                'color_id',
            ]
        )) {
            Schema::table('product_smartphone_price', function (Blueprint $table) {
                $table->dropColumn(['ram_id', 'storage_capacity_id', 'color_id']);
            });
        }
    }
};
