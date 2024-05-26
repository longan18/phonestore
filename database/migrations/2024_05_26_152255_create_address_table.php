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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ward_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('province_id');
            $table->text('address_detail')->nullable();
            $table->timestamps();

            $table->foreign('ward_id')->references('id')
                ->on('wards')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('district_id')->references('id')
                ->on('districts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('province_id')->references('id')
                ->on('provinces')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
