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
        if (Schema::hasColumn('order_details', 'address_id')) {
            Schema::table('order_details', function (Blueprint $table) {
                $table->renameColumn('address_id', 'address_shipping_id');
            });
        }

        Schema::table('order_details', function (Blueprint $table) {
            $table->string('uuid')->nullable()->after('id');
            $table->tinyInteger('status')->nullable()->unsigned()->default(1)->after('note')
                ->comment("1: Chờ xác nhận, 2: Đã xác nhận, 3: Hủy đơn hàng");
            $table->tinyInteger('status_payment')->nullable()->unsigned()->default(1)->after('status')
                ->comment("1: Chưa thanh toán, 2: Đã thanh toán");
            $table->tinyInteger('status_shipping')->nullable()->default(1)->after('status_payment')
                ->comment("1: Chờ giao hàng, 2: Đang giao hàng, 3: Giao hàng thành công");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('order_details', 'address_shipping_id')) {
            Schema::table('order_details', function (Blueprint $table) {
                $table->renameColumn('address_shipping_id', 'address_id');
            });
        }

        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn('uuid');
            $table->dropColumn('status');
            $table->dropColumn('status_payment');
            $table->dropColumn('status_shipping');
        });
    }
};
