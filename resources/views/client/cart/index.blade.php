@extends('client.layouts.app')

@section('title')
    {{ __('Giỏ hàng') }}
@endsection

@section('style_css')
    <style>
        .pro-qty {
            user-select: none;
        }
    </style>
@endsection

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('client_assets/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ __('Giỏ hàng') }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('client.home') }}">{{ __('Trang chủ') }}</a>
                            <span>Giỏ hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="w-50">Sản phẩm</th>
                                    <th>Giá tiền</th>
                                    <th>Số lượng</th>
                                    <th class="w-15">Tổng tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            @if($shoppingItems)
                                @foreach($shoppingItems as $shoppingItem)
                                    <tr class="item-cart"
                                        data-shopping-item="{{ $shoppingItem->id }}"
                                        data-quantity="{{ $shoppingItem->quantity }}"
                                        data-item-id="{{ $shoppingItem->item_id }}"
                                        data-shopping-session-id="{{ $shoppingItem->shopping_session_id }}"
                                        data-product-id="{{ $shoppingItem->product_id }}"
                                        data-price="{{ $shoppingItem->price }}">
                                        <td class="d-flex align-items-center">
                                            <div class="">
                                                <img src="https://cdn.tgdd.vn/Products/Images/42/305659/iphone-15-pro-max-black-thumbnew-600x600.jpg" alt="" style="width: 100px;">
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
                                                    <input type="text" name="quantity" min="1" autocomplete="off" value="{{ $shoppingItem->quantity }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="price-total">{{ formatCurrency($shoppingItem->total_price_item) }}</span><sup>đ</sup></td>
                                        <td class="action">
                                            <button class="btn btn-danger delete-item-cart"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
{{--                <div class="col-lg-12">--}}
{{--                    <div class="shoping__cart__btns">--}}
{{--                        <button class="primary-btn cart-btn cart-btn-right border-0 partial_payment" data-check="false">Thanh toán một phần</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-lg-12">
                    <div class="shoping__checkout">
{{--                        <h5 class="title-payment">Thanh toán tất cả</h5>--}}
                        <h5 class="title-payment">Thanh toán</h5>
                        <div class="d-flex justify-content-between pb-3 border-ebebeb">
                            <div class="title-checkout-quantity">Số sản phẩm trong giỏ: </div>
                            <div class="text-danger"><span class="value-quantity" data-value="{{ $quantityCart ?? 0 }}">{{ $quantityCart ?? 0 }}</span> sản phẩm</div>
                        </div>
                        <div class="d-flex justify-content-between mt-3 pb-3 border-ebebeb">
                            <div>Tổng giá tiền: </div>
                            <div class="text-danger">
                                <span class="value-price-default"
                                      data-value="{{ $shoppingSession ? $shoppingSession->shoppingItems->sum('price') : 0 }}">
                                    {{ $shoppingSession ? formatCurrency($shoppingSession->shoppingItems->sum('price')) : 0 }}
                                </span><sup class="text-danger">đ</sup>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-3 mb-3">
                            <div>Tổng tiền: </div>
                            <div class="text-danger"><span class="value-price-total" data-value="{{ $shoppingSession ? $shoppingSession->price_total : 0 }}">
                                    {{ $shoppingSession ? formatCurrency($shoppingSession->price_total) : 0 }}
                                </span><sup class="text-danger">đ</sup></div>
                        </div>
                        <div class="d-flex">
                            <button class="btn btn-success w-50 mr-2 font-weight-bold" style="font-size: 20px">Chuyển khoản qua VnPay</button>
                            <button class="btn btn-primary w-50 font-weight-bold" style="font-size: 20px">Thanh toán trả sau</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        let typingTimer;
        let doneTypingInterval = 900;
        let cartItems = [];

        $('input[name="quantity"]').on('input', function () {
            let parentQty = $(this).parent('.pro-qty');
            let maxQty = Number(parentQty.attr('data-qty-max'));

            if ($(this).val() > maxQty) {
                $(this).val(maxQty);
            } else {
                $(this).val(convertNumber($(this).val()));
            }

            addCartItemInArray($(this).parents('.item-cart'), $(this).val());
            updateHtml($(this), $(this).parents('.item-cart'), $(this).val());

            clearTimeout(typingTimer);
            typingTimer = setTimeout(updateCart, doneTypingInterval);
        });

        $(document).on('click', '.quantity .qtybtn', function () {
            let parentQty = $(this).parent('.pro-qty');
            let elmInputQty = parentQty.find('input[name="quantity"]');
            let maxQty = Number(parentQty.attr('data-qty-max'));

            let valueInputNumber = convertNumber(elmInputQty.val());

            if(valueInputNumber > maxQty) {
                elmInputQty.val(maxQty);
            }

            if (valueInputNumber <= 1) {
                elmInputQty.val(1);
            }

            addCartItemInArray($(this).parents('.item-cart'), elmInputQty.val());
            updateHtml($(this), $(this).parents('.item-cart'), elmInputQty.val());

            clearTimeout(typingTimer);
            typingTimer = setTimeout(updateCart, doneTypingInterval);
        });

        $(document).on('click', '.delete-item-cart', function () {
            let id = $(this).parents('.item-cart').attr('data-shopping-item');

            $.ajax({
                url: `{{ route('client.delete-item-cart') }}`,
                method: 'POST',
                data: { id: id },
                beforeSend: function () {
                    $('#preloder').css('display', 'block');
                    $('#preloder .loader').css('display', 'block');
                },
                success: function(res) {
                    $('#preloder').css('display', 'none');
                    $('#preloder .loader').css('display', 'none');

                    let itemRemove = $(`.item-cart[data-shopping-item="${id}"]`);
                    let priceDec = itemRemove.attr('data-quantity') * itemRemove.attr('data-price');
                    let valuePriceTotalCurrent = $('.value-price-total').attr('data-value');
                    let valuePriceDefaultCurrent = $('.value-price-default').attr('data-value');

                    $('.value-price-default').attr('data-value', valuePriceDefaultCurrent - itemRemove.attr('data-price'));
                    $('.value-price-default').text(formattedPrice(valuePriceDefaultCurrent - itemRemove.attr('data-price')));
                    $('.value-price-total').attr('data-value', valuePriceTotalCurrent - priceDec);
                    $('.value-price-total').text(formattedPrice(valuePriceTotalCurrent - priceDec));

                    itemRemove.remove();

                    if (res.success) {
                        toastr.success(res.message);
                    } else {
                        toastr.error(res.message);
                    }
                },
                error: function (jqXHR) {
                    toastr.error('Lỗi hệ thống, vui lòng thử lại sau giây lát!');
                },
            });

        });

        const updateCart = () => {
            $.ajax({
                url: `{{ route('client.update-item-cart') }}`,
                method: 'POST',
                data: { cartItems: cartItems },
                success: function(res) {
                    if (res.success) {
                        toastr.success(res.message);
                    } else {
                        toastr.error(res.message);
                    }
                }
            });

            cartItems = [];
        }

        const addCartItemInArray = (elmCartItem, valQty) => {
            let itemArray = {
                id: elmCartItem.attr('data-shopping-item'),
                quantity: valQty,
                shopping_session_id: elmCartItem.attr('data-shopping-session-id'),
                product_id: elmCartItem.attr('data-product-id'),
                item_id: elmCartItem.attr('data-item-id'),
                price: elmCartItem.attr('data-price'),
            };

            if(cartItems.length) {
                let index = cartItems.findIndex(item => itemArray.id == item.id);
                if (index >= 0) {
                    cartItems.splice(index, 1);
                }
            }
            cartItems.push(itemArray);
        }

        const updateHtml = (elmInput, elmCartItem, valQty) => {
            let qty = valQty - elmCartItem.attr('data-quantity');

            let totalPriceElm = elmCartItem.attr('data-price') * qty;
            let totalPriceCart = $('.value-price-total').attr('data-value');

            elmCartItem.find('.price-total').text(formattedPrice(elmCartItem.attr('data-price') * valQty));

            newValue = Number(totalPriceCart) + Number(totalPriceElm);
            $('.value-price-total').attr('data-value', newValue);
            elmCartItem.attr('data-quantity', valQty);
            $('.value-price-total').text(formattedPrice(newValue));
        }

        const convertNumber = (value) => {
            let valueInput = Number(value.replace(/[^0-9]/g, ''));
            if (valueInput == 0) {
                valueInput = 1;
            }

            return valueInput;
        }

        const formattedPrice = (value) => {
            let valuePrice = value.toLocaleString('vi-VN',
                {
                    style: 'currency',
                    currency: 'VND'
                }
            ).slice(0, -2);

            return valuePrice;
        }
    </script>

{{--    <script>--}}
{{--        let defaultQuantity = {{ $quantityCart }};--}}
{{--        let defaultPrice = {{ $shoppingSession->shoppingItems->sum('price') }};--}}
{{--        let defaultPriceTotal = {{ $shoppingSession->price_total }};--}}

{{--        $(document).on('click', '.partial_payment', function () {--}}
{{--            if ($(this).attr('data-check') == 'false') {--}}
{{--                mapItemPartialPayment();--}}
{{--                $(this).attr('data-check', true);--}}
{{--                $(this).text('Thanh toán tất cả');--}}
{{--                $('.title-payment').text('Thanh toán một phần');--}}
{{--                $('.title-checkout-quantity').text('Số sản phẩm được chọn:');--}}
{{--                $('.value-quantity').text('0');--}}
{{--                $('.value-quantity').attr('data-value', 0);--}}
{{--                $('.value-price-default').text('0');--}}
{{--                $('.value-price-default').attr('data-value', 0);--}}
{{--                $('.value-price-total').text('0');--}}
{{--                $('.value-price-total').attr('data-value', 0);--}}
{{--            } else {--}}
{{--                $('.item-cart').find('button.item-partial-payment').remove();--}}
{{--                $(this).attr('data-check', false);--}}
{{--                $(this).text('Thanh toán một phần');--}}
{{--                $('.title-payment').text('Thanh toán tất cả');--}}
{{--                $('.title-checkout-quantity').text('Số sản phẩm trong giỏ:');--}}
{{--                $('.value-quantity').text(defaultQuantity);--}}
{{--                $('.value-quantity').attr('data-value', defaultQuantity);--}}
{{--                $('.value-price-default').text(formattedPrice(defaultPrice));--}}
{{--                $('.value-price-default').attr('data-value', defaultPrice);--}}
{{--                $('.value-price-total').text(formattedPrice(defaultPriceTotal));--}}
{{--                $('.value-price-total').attr('data-value', defaultPriceTotal);--}}
{{--            }--}}
{{--        });--}}

{{--        $(document).on('click', '.item-partial-payment', function () {--}}
{{--            if($(this).hasClass('btn-primary')) {--}}
{{--                $(this).removeClass('btn-primary').addClass('btn-warning');--}}
{{--            } else {--}}
{{--                $(this).removeClass('btn-warning').addClass('btn-primary');--}}
{{--            }--}}
{{--        });--}}

{{--        const formattedPrice = (value) => {--}}
{{--            let valuePrice = value.toLocaleString('vi-VN',--}}
{{--                {--}}
{{--                    style: 'currency',--}}
{{--                    currency: 'VND'--}}
{{--                }--}}
{{--            ).slice(0, -2);--}}

{{--            return valuePrice;--}}
{{--        }--}}

{{--        const mapItemPartialPayment = () => {--}}
{{--            $('.item-cart').map((index, item) => {--}}
{{--                $(item).find('td.action').find('button').before(`<button class="btn btn-primary mr-2 item-partial-payment"><i class="fa fa-money"></i></button>`);--}}
{{--            })--}}
{{--        }--}}
{{--    </script>--}}
@endsection
