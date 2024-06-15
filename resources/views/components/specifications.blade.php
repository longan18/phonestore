{{--@dd($specifications)--}}
<div style="padding:0px 15%; padding-bottom: 50px">
    <div class="parameter-item">
        <p class="parameter-ttl" data-group-id="29" data-index="1">Màn hình</p>
        <ul class="ulist">
            <li data-id="6459" data-group-id="29" data-index="1">
                <div class="ctLeft">
                    <p>Công nghệ màn hình:</p>
                </div>
                <div class="ctRight">
                    <span>{{ $specifications->screen_technology ?? '' }}</span>
                </div>
            </li>
            <li data-id="78" data-group-id="29" data-index="2">
                <div class="ctLeft">
                    <p>Độ phân giải:</p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $specifications->screen_resolution ?? '' }}</span>
                </div>
            </li>
            <li data-id="27278" data-group-id="29" data-index="3">
                <div class="ctLeft">
                    <p>Màn hình rộng:</p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $specifications->widescreen }}" - Tần số quét <span target="_blank">{{ $specifications->scanning_frequency }} Hz</span></span>
                </div>
            </li>
            <li data-id="27392" data-group-id="29" data-index="6">
                <div class="ctLeft">
                    <p>Độ sáng tối đa:</p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $specifications->maximum_brightness }} nits</span>
                </div>
            </li>
            <li data-id="7799" data-group-id="29" data-index="7">
                <div class="ctLeft">
                    <p>Mặt kính cảm ứng:</p>
                </div>
                <div class="ctRight">
                    <span target="_blank">{{ $specifications->touch_glass_surface }}</span>
                </div>
            </li>
        </ul>
    </div>
    <div class="parameter-item">
        <p class="parameter-ttl" data-group-id="1841" data-index="2">Camera sau</p>
        <ul class="ulist ">
            <li data-id="27" data-group-id="1841" data-index="1">
                <div class="ctLeft">
                    <p>Độ phân giải:</p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $specifications->rear_camera_resolution }}</span>
                </div>
            </li>
            <li data-id="31" data-group-id="1841" data-index="2">
                <div class="ctLeft">
                    <p>Quay phim:</p>
                </div>
                <div class="ctRight">
                    {!! $specifications->film !!}
                </div>
            </li>
            <li data-id="6460" data-group-id="1841" data-index="3">
                <div class="ctLeft">
                    <p>Đèn Flash:</p>
                </div>
                <div class="ctRight">
                    <span>{{ $specifications->flash_light }}</span>
                </div>
            </li>
            <li data-id="28" data-group-id="1841" data-index="4">
                <div class="ctLeft">
                    <p>Tính năng:</p>
                </div>
                <div class="ctRight">
                    {!! $specifications->rear_camera_feature !!}
                </div>
            </li>
        </ul>
    </div>
    <div class="parameter-item">
        <p class="parameter-ttl" data-group-id="2701" data-index="3">Camera trước</p>
        <ul class="ulist ">
            <li data-id="29" data-group-id="2701" data-index="1">
                <div class="ctLeft">
                    <p>Độ phân giải:</p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $specifications->front_camera_resolution }}</span>
                </div>
            </li>
            <li data-id="7801" data-group-id="2701" data-index="4">
                <div class="ctLeft">
                    <p>Tính năng:</p>
                </div>
                <div class="ctRight">
                    {!! $specifications->front_camera_feature !!}
                </div>
            </li>
        </ul>
    </div>
    <div class="parameter-item">
        <p class="parameter-ttl" data-group-id="2121" data-index="4">Hệ điều hành &amp; CPU</p>
        <ul class="ulist ">
            <li data-id="72" data-group-id="2121" data-index="1">
                <div class="ctLeft">
                    <p>Hệ điều hành:</p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $specifications->operating_system }}</span>
                </div>
            </li>
            <li data-id="6059" data-group-id="2121" data-index="2">
                <div class="ctLeft">
                    <p>Chip xử lý (CPU):</p>
                </div>
                <div class="ctRight">
                    <span>{{ $specifications->cpu }}</span>
                </div>
            </li>
            <li data-id="51" data-group-id="2121" data-index="4">
                <div class="ctLeft">
                    <p>Tốc độ CPU:</p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $specifications->cpu_speed }}</span>
                </div>
            </li>
            <li data-id="6079" data-group-id="2121" data-index="5">
                <div class="ctLeft">
                    <p>Chip đồ họa (GPU):</p>
                </div>
                <div class="ctRight">
                    <span>{{ $specifications->gpu }}</span>
                </div>
            </li>
        </ul>
    </div>
    <div class="parameter-item">
        <p class="parameter-ttl" data-group-id="22" data-index="5">Bộ nhớ &amp; Lưu trữ</p>
        <ul class="ulist ">
            <li data-id="50" data-group-id="22" data-index="1">
                <div class="ctLeft">
                    <p>RAM:</p>
                </div>
                <div class="ctRight">
                    <span class="">8 GB</span>
                </div>
            </li>
            <li data-id="49" data-group-id="22" data-index="2">
                <div class="ctLeft">
                    <p>Dung lượng lưu trữ:</p>
                </div>
                <div class="ctRight">
                    <span class="">512 GB</span>
                </div>
            </li>
            <li data-id="7803" data-group-id="22" data-index="3">
                <div class="ctLeft">
                    <p>Dung lượng còn lại (khả dụng) khoảng:</p>
                </div>
                <div class="ctRight d-flex align-items-center">
                    <span class="">497 GB</span>
                </div>
            </li>
            <li data-id="7803" data-group-id="22" data-index="3">
                <div class="ctLeft">
                    <p>Thẻ nhớ: </p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $specifications->memory_stick }}</span>
                </div>
            </li>
            <li data-id="54" data-group-id="22" data-index="11">
                <div class="ctLeft">
                    <p>Danh bạ:</p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $specifications->phone_book }}</span>
                </div>
            </li>
        </ul>
    </div>
    <div class="parameter-item">
        <p class="parameter-ttl" data-group-id="24" data-index="6">Kết nối</p>
        <ul class="ulist ">
            <li data-id="7761" data-group-id="24" data-index="3">
                <div class="ctLeft">
                    <p>Mạng di động:</p>
                </div>
                <div class="ctRight">
                    <span>{{ $specifications->mobile_network }}</span>
                </div>
            </li>
            <li data-id="6339" data-group-id="24" data-index="6">
                <div class="ctLeft">
                    <p>SIM:</p>
                </div>
                <div class="ctRight">
                    <span>{{ $specifications->sim }}</span>
                </div>
            </li>
            <li data-id="66" data-group-id="24" data-index="7">
                <div class="ctLeft">
                    <p>Wifi:</p>
                </div>
                <div class="ctRight">
                    {!! $specifications->wifi !!}
                </div>
            </li>
            <li data-id="68" data-group-id="24" data-index="8">
                <div class="ctLeft">
                    <p>GPS:</p>
                </div>
                <div class="ctRight">
                    {!! $specifications->gps !!}
                </div>
            </li>
            <li data-id="69" data-group-id="24" data-index="9">
                <div class="ctLeft">
                    <p>Bluetooth:</p>
                </div>
                <div class="ctRight">
                    {!! $specifications->bluetooth !!}
                </div>
            </li>
            <li data-id="71" data-group-id="24" data-index="11">
                <div class="ctLeft">
                    <p>Cổng kết nối/sạc:</p>
                </div>
                <div class="ctRight">
                    <span>{{ $specifications->charger }}</span>
                </div>
            </li>
            <li data-id="48" data-group-id="24" data-index="12">
                <div class="ctLeft">
                    <p>Jack tai nghe:</p>
                </div>
                <div class="ctRight">
                    <span>{{ $specifications->headphone_jack }}</span>
                </div>
            </li>
            <li data-id="5199" data-group-id="24" data-index="13">
                <div class="ctLeft">
                    <p>Kết nối khác:</p>
                </div>
                <div class="ctRight">
                    <span>{{ $specifications->other_connections }}</span>
                </div>
            </li>
        </ul>
    </div>
    <div class="parameter-item">
        <p class="parameter-ttl" data-group-id="2122" data-index="8">Pin &amp; Sạc</p>
        <ul class="ulist ">
            <li data-id="84" data-group-id="2122" data-index="2">
                <div class="ctLeft">
                    <p>Dung lượng pin:</p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $specifications->battery_type }} mAh</span>
                </div>
            </li>
            <li data-id="83" data-group-id="2122" data-index="2">
                <div class="ctLeft">
                    <p>Loại pin:</p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $specifications->battery_capacity }}</span>
                </div>
            </li>
            <li data-id="26846" data-group-id="2122" data-index="3">
                <div class="ctLeft">
                    <p>Hỗ trợ sạc tối đa:</p>
                </div>
                <div class="ctRight">
                    <span>{{ $specifications->maximum_charging_support }} W</span>
                </div>
            </li>
            <li data-id="26846" data-group-id="2122" data-index="3">
                <div class="ctLeft">
                    <p>Sạc đi kèm theo máy:</p>
                </div>
                <div class="ctRight">
                    <span>{{ $specifications->charger_included_with_the_device }}</span>
                </div>
            </li>
            <li data-id="10859" data-group-id="2122" data-index="5">
                <div class="ctLeft">
                    <p>Công nghệ pin:</p>
                </div>
                <div class="ctRight">
                    {!! $specifications->battery_technology !!}
                </div>
            </li>
        </ul>
    </div>
    <div class="parameter-item">
        <p class="parameter-ttl" data-group-id="19" data-index="9">Tiện ích</p>
        <ul class="ulist ">
            <li data-id="10860" data-group-id="19" data-index="1">
                <div class="ctLeft">
                    <p>Bảo mật nâng cao:</p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $specifications->advanced_security }}</span>
                </div>
            </li>
            <li data-id="43" data-group-id="19" data-index="2">
                <div class="ctLeft">
                    <p>Tính năng đặc biệt:</p>
                </div>
                <div class="ctRight">
                    {!! $specifications->special_features !!}
                </div>
            </li>
            <li data-id="27511" data-group-id="19" data-index="3">
                <div class="ctLeft">
                    <p>Kháng nước, bụi:</p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $specifications->water_and_dust_resistant }}</span>
                </div>
            </li>
            <li data-id="36" data-group-id="19" data-index="4">
                <div class="ctLeft">
                    <p>Ghi âm:</p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $specifications->record }}</span>
                </div>
            </li>
            <li data-id="32" data-group-id="19" data-index="7">
                <div class="ctLeft">
                    <p>Xem phim:</p>
                </div>
                <div class="ctRight">
                    {!! $specifications->watch_a_movie !!}
                </div>
            </li>
            <li data-id="33" data-group-id="19" data-index="8">
                <div class="ctLeft">
                    <p>Nghe nhạc:</p>
                </div>
                <div class="ctRight">
                    {!! $specifications->listening_to_music !!}
                </div>
            </li>
        </ul>
    </div>
    <div class="parameter-item">
        <p class="parameter-ttl" data-group-id="28" data-index="10">Thông tin chung</p>
        <ul class="ulist ">
            <li data-id="7804" data-group-id="28" data-index="1">
                <div class="ctLeft">
                    <p>Thiết kế:</p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $specifications->design }}</span>
                </div>
            </li>
            <li data-id="7805" data-group-id="28" data-index="2">
                <div class="ctLeft">
                    <p>Chất liệu:</p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $specifications->material }}</span>
                </div>
            </li>
            <li data-id="88" data-group-id="28" data-index="3">
                <div class="ctLeft">
                    <p>Kích thước, khối lượng:</p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $specifications->size }} - {{ $specifications->mass }}g</span>
                </div>
            </li>
            <li data-id="13045" data-group-id="28" data-index="100">
                <div class="ctLeft">
                    <p>Thời điểm ra mắt:</p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $specifications->launch_time }}</span>
                </div>
            </li>
            <li class="border-0">
                <div class="ctLeft">
                    <p>Hãng:</p>
                </div>
                <div class="ctRight">
                    <span class="">{{ $product->brand->name }}</span>
                </div>
            </li>
        </ul>
    </div>
</div>
