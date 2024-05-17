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
        Schema::create('product_smartphone', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');

            $table->foreign('product_id')->references('id')->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            // Màn hình
            $table->string("screen_technology")->nullable(); // Công nghệ màn hình
            $table->string("screen_resolution")->nullable(); // Độ phân giải màn hình
            $table->string("widescreen", 20)// Màn hình rộng
            ->comment('The unit is inches and is denoted by Ex: 6.7"');
            $table->integer("scanning_frequency")->unsigned()// Tần số quét
            ->comment('The unit is Hertz(Hz) and is denoted by Ex: 120 Hz');
            $table->integer("maximum_brightness")->unsigned()->nullable() // Độ sáng tối đa
            ->comment('The unit is nits and is denoted by Ex: 2000 nits');
            $table->string("touch_glass_surface")->nullable(); // Màn hình cảm ứng
            // Camera sau
            $table->string("rear_camera_resolution")->nullable(); // Độ phân giải camera sau
            $table->text("film")->nullable(); // Quay phim
            $table->string("flash_light")->nullable(); // Đèn flash
            $table->text("rear_camera_feature")->nullable(); // Tính năng camera sau
            // Camera trước
            $table->string("front_camera_resolution")->nullable(); // Độ phân giải camera trước
            $table->text("front_camera_feature")->nullable(); // Tính năng camera trước
            // Hệ điều hành & CPU
            $table->string("operating_system")->nullable(); // Hệ điều hành
            $table->string("cpu")->nullable(); // CPU
            $table->string("cpu_speed")->nullable(); // Tốc độ CPU
            $table->string("gpu")->nullable(); // Chip đồ họa (GPU)
            // Bộ nhớ & Lưu trữ
            $table->string("memory_stick")->nullable(); // Thẻ nhớ
            $table->string("phone_book")->nullable(); // Danh bạ
            // Kết nối
            $table->string("mobile_network")->nullable(); // Mạng di động
            $table->string("sim")->nullable(); // SIM
            $table->text("wifi")->nullable(); // Wifi
            $table->text("gps")->nullable(); // GPS
            $table->text("bluetooth")->nullable(); // Bluetooth
            $table->string("charger")->nullable(); // Cổng kết nối/sạc
            $table->string("headphone_jack")->nullable(); // Jack tai nghe
            $table->string("other_connections")->nullable(); // Kết nối khác
            // Pin & Sạc
            $table->integer("battery_type")->unsigned() // Loại pin
            ->comment('The unit is mAh and is denoted by Ex: 4422 mAh');
            $table->string("battery_capacity")->nullable(); // Hỗ trợ sạc tối đa
            $table->integer("maximum_charging_support")->unsigned()->nullable() // Dung lượng pin
            ->comment('The unit is W and is denoted by Ex: 20 W');
            $table->string("charger_included_with_the_device")->nullable(); // Sạc kèm theo máy
            $table->text("battery_technology")->nullable(); // Công nghệ pin
            // Tiện ích
            $table->string("advanced_security")->nullable(); // Bảo mật nâng cao
            $table->text("special_features")->nullable(); // Tính năng đặc biệt
            $table->string("water_and_dust_resistant")->nullable(); // Kháng nước bụi
            $table->string("record")->nullable(); // Ghi âm
            $table->text("watch_a_movie")->nullable(); // Xem phim
            $table->text("listening_to_music")->nullable(); // Nghe nhạc
            // Thông tin chung
            $table->string("design")->nullable(); // Thiết kế
            $table->string("material")->nullable(); // Chất liệu
            $table->string("size")->nullable(); // Kích thước
            $table->integer("mass")->unsigned()->nullable() // Khối lượng
            ->comment('The unit is G and is denoted by Ex: 221 g');
            $table->string("launch_time")->nullable(); // Thời điểm ra mắt
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_smartphone');
    }
};
