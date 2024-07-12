@foreach($shoppingItems as $shoppingItem)
    <tr class="item-cart"
        data-shopping-item="{{ $shoppingItem->id }}"
        data-quantity="{{ $shoppingItem->quantity }}"
        data-item-id="{{ $shoppingItem->item_id }}"
        data-shopping-session-id="{{ $shoppingItem->shopping_session_id }}"
        data-product-id="{{ $shoppingItem->product_id }}"
        data-price="{{ $shoppingItem->price }}">
        <td>
            <input type="checkbox" class="checkbox-item-cart" value="{{ $shoppingItem->id }}">
        </td>
        <td class="d-flex align-items-center">
            <div class="">
                <img src="{{ asset($shoppingItem->productPrice->avatar) }}" alt="" style="width: 100px;">
            </div>
            <div style="margin-left: 20px">
                <ol class="text-left" style="list-style-type: disc">
                    <li><span>Tên sản phẩm: </span>{{ $shoppingItem->product->name }}</li>
                    <li><span>Ram: </span>{{ $shoppingItem->productPrice->ram->value }}</li>
                    <li><span>Bộ nhớ trong: </span>{{ $shoppingItem->productPrice->storageCapacity->value }}</li>
                    <li><span>Màu: </span>{{ $shoppingItem->productPrice->color->color }}</li>
                </ol>
            </div>
        </td>
        <td><span class="price">{{ formatCurrency($shoppingItem->price) }}</span><sup>đ</sup></td>
        <td class="shoping__cart__quantity">
            <div class="quantity">
                <div class="pro-qty" data-qty-max="{{ $shoppingItem->productPrice->quantity }}">
                    <span class="dec qtybtn noselect">-</span>
                    <input type="text" name="quantity" min="1" autocomplete="off" value="{{ $shoppingItem->quantity }}">
                    <span class="inc qtybtn noselect">+</span>
                </div>
            </div>
        </td>
        <td><span class="price-total">{{ formatCurrency($shoppingItem->total_price_item) }}</span><sup>đ</sup></td>
        <td class="action">
            <button class="btn btn-danger delete-item-cart"><i class="fa fa-trash"></i></button>
        </td>
    </tr>
@endforeach
