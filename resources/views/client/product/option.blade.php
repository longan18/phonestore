<div class="product__details__price current-price" data-price="{{ $actDefault['price_default'] }}"><span class="price">{{ formatCurrency($actDefault['price_default']) }}</span><sup>đ</sup></div>
<div class="color-757575"><b>{{ __('Ram - Storage capacity:') }}</b></div>
<div class="mt-3 mb-3 item-attr">
    @php($act = 0)
    @foreach($uniqueRamStorageCapacity as $key => $item)
        <div data-ram="{{ $idRamStorageCapacityArray[$key]['ram_id'] }}" data-storage-capacity="{{ $idRamStorageCapacityArray[$key]['storage_capacity_id'] }}"
             class="item-attr-detail h-43px border-non-act {{ !$act ? 'act' : '' }} d-flex align-items-center justify-content-center">{{ $item }}</div>
        @php($act++)
    @endforeach
</div>
<div class="color-757575"><b>{{ __('Color:') }}</b></div>
<div class="mt-3 mb-3 item-attr" data-column="color_id" id="color">
    @php($act = 0)
    @foreach($uniqueColor as $idColor => $color)
        <div data-color="{{ $idColor }}" data-price="{{ $priceArray[$idColor] }}" data-item="{{ $ids[$idColor] }}"
             class="item-price text-center h-43px border-non-act {{ !$act ? 'act' : '' }}"
             style="background-color: {{ $color }};"></div>
        @php($act++)
    @endforeach
</div>
<div class="d-flex flex-column mb-3">
    <div class="product__details__quantity">
        <div class="quantity">
            <label class="color-757575"><b>{{ __('Số lượng') }}</b></label>
            <div class="mx-3 pro-qty">
                <input type="text" value="1" name="quantity" min="1" autocomplete="off">
            </div>
            <label class="color-757575 quantity-current" data-quantity-current="{{ $actDefault['quantity_default'] }}"><b>{{ $actDefault['quantity_default'] }}</b> {{ __('sản phẩm có sẵn') }}</label>
        </div>
    </div>
</div>
<div>
    <b class="color-757575">Tổng số tiền: <span class="color-DD2222"><span class="price total-price">{{ formatCurrency($actDefault['price_default']) }}</span><sup>đ</sup></span></b>
</div>
