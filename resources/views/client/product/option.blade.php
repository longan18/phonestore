<div class="product__details__price current-price" data-price="{{ reset($dataResult['data'])[0]['price'] }}"><span class="price">{{ formatCurrency(reset($dataResult['data'])[0]['price']) }}</span><sup>đ</sup></div>
<div class="color-757575"><b>{{ __('Ram - Storage capacity:') }}</b></div>
<div class="mt-3 mb-3 item-attr">
    @foreach($dataResult['key'] as $key => $item)
        <div data-key="{{ $key }}" data-ram="{{ $item['ram'] }}" data-storage-capacity="{{ $item['storage_capacity'] }}"
             data-remaining-capacity-is-approx="{{ $item['remaining_capacity_is_approx'] }}"
             class="item-attr-detail h-43px border-non-act {{ $key == array_key_first($dataResult['key']) ? 'act' : '' }} d-flex align-items-center justify-content-center">{{ $item['title'] }}</div>
    @endforeach
</div>
<div class="color-757575"><b>{{ __('Color:') }}</b></div>
<div class="mt-3 mb-3" data-column="color_id" id="color" style="display: grid; gap: 20px">
    @foreach($dataResult['data'] as $key => $productPrice)
        <div class="parent-item item-attr {{ $key != array_key_first($dataResult['key']) ? 'd-none' : ''}}" data-key="{{ $key }}">
            @foreach($productPrice as $keyItem => $item)
                <div data-id="{{ $item['item_id'] }}" data-price="{{ $item['price'] }}"
                     data-image="{{ $item['avatar'] }}"
                     data-quantity="{{ $item['quantity'] }}"
                     class="item-price text-center h-43px border-non-act {{ $keyItem == 0 ? 'act' : '' }}
                      d-flex align-items-center justify-content-center">{{ $item['color'] }}</div>
            @endforeach
        </div>
    @endforeach
</div>
<div class="d-flex flex-column mb-3">
    <div class="product__details__quantity">
        <div class="quantity">
            <label class="color-757575"><b>{{ __('Số lượng') }}</b></label>
            <div class="mx-3 pro-qty">
                <span class="dec qtybtn noselect">-</span>
                <input type="text" value="1" name="quantity" min="1" autocomplete="off">
                <span class="inc qtybtn noselect">+</span>
            </div>
            <label class="color-757575 quantity-current" data-quantity-current="{{ reset($dataResult['data'])[0]['quantity'] }}"><b>{{ reset($dataResult['data'])[0]['quantity'] }}</b> {{ __('sản phẩm có sẵn') }}</label>
        </div>
    </div>
</div>
<div>
    <b class="color-757575">Tổng số tiền: <span class="color-DD2222"><span class="price total-price">{{ formatCurrency(reset($dataResult['data'])[0]['price']) }}</span><sup>đ</sup></span></b>
</div>
