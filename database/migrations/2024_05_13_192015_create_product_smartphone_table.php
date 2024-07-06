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
            $table->string("widescreen", 200)->nullable(false);// Màn hình rộng
            $table->string("scanning_frequency", 200)->nullable(false);// Tần số quét
            $table->string("maximum_brightness", 50)->nullable(false); // Độ sáng tối đa
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
            $table->string("battery_type", 50)->nullable(); // Loại pin
            $table->string("battery_capacity")->nullable(); // Dung lượng pin
            $table->string("maximum_charging_support", 50)->nullable(); // Hỗ trợ sạc tối đa
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
            $table->string("mass", 50)->nullable(); // Khối lượng
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
