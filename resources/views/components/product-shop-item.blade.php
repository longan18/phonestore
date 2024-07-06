<div class="item d-flex flex-column justify-content-between">
    <a href="{{ route('client.product.detail', ['product' => $product->slug]) }}">
        <div class="item-label">
            <span class="lb-tragop">Trả góp 0%</span>
        </div>
        <div class="item-img item-img_42">
            <img class="thumb" src="{{ asset($product->avatar) }}" alt="iPhone 15 Pro Max">
        </div>
        <h3>{{ $product->name }}</h3>
        <div class="item-compare gray-bg">
            <ul>
                <li>{{ $product->productSmartphone->widescreen }}</li>
                <li>{{ $product->productSmartphone->screen_technology }}</li>
            </ul>
        </div>
        <div class="prods-group">
            <ul>
                @php
                    $uniqueArray = [];
                    $arrayPrice = [];
                    foreach($product->productSmartphonePrice as $item) {
                        $ram_storageCapacity = $item->ram->value.' - '.$item->storageCapacity->value;
                         if (!in_array($ram_storageCapacity, $uniqueArray)) {
                                $uniqueArray[] = $ram_storageCapacity;
                                $arrayPrice[] = ['id' => $item->id, 'price' => $item->price];
                         }
                    }
                @endphp

                @foreach($uniqueArray as $key => $value)
                    <li class="merge__item {{ $key == 0 ? 'act' : '' }}" data-url="" data-id="{{ $arrayPrice[$key]['id'] }}"
                        data-price="{{ $arrayPrice[$key]['price'] }}">{{ $value }}</li>
                @endforeach
            </ul>
        </div>
    </a>
    <div>
        <div class="box-p d-none">
            <p class="price-old black">40.990.000₫</p>
            <span class="percent">-12%</span>
        </div>
        <strong><span class="price">{{ !empty($arrayPrice[0]['price']) ? formatCurrency($arrayPrice[0]['price']) : '' }}</span><sup>đ</sup></strong>
    </div>
</div>
