@extends('client.layouts.app')

@section('title')
    {{ __('Giỏ hàng') }}
@endsection

@section('style_css')
    <style>
        .pro-qty {
            user-select: none;
        }

        a:hover {
            color: #0d95e8;
        }

        input[type="checkbox"] {
            appearance: none;
            width: 24px;
            height: 24px;
            border: 2px solid #A7A7A7;
            border-radius: 8px;

            &:checked {
                border: 2px solid #FF0000;
                background-color: #FF0000; /* Màu đỏ */
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23fff' d='M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: center;                    }
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
                    <div class="shoping__cart__table" id="list-item">
                        @if($shoppingItems && $shoppingItems->count() > 0)
                            <table>
                                <thead>
                                <tr>
                                    <th class="d-flex align-items-center">
                                    </th>
                                    <th class="w-50">Sản phẩm</th>
                                    <th>Giá tiền</th>
                                    <th>Số lượng</th>
                                    <th class="w-15">Tổng tiền</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @include('client.cart.table')
                                </tbody>
                            </table>
                        @else
                            <p class="text-center note">Không có sản phẩm nào trong giỏ hàng của bạn</p>
                            <p class="text-center note">Vui lòng thêm thêm sản phẩm để trải nghiệm dịch vụ</p>
                        @endif

                        @if(!empty($shoppingItems) && $shoppingItems->count() > 0)
                            <div class="render-paginate mt-4">
                                {{ $shoppingItems->links('pagination.custom') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__checkout" id="checkout-cart">
                        @include('client.cart.checkout')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        if (localStorage.getItem('checkVnPay') != undefined) {
            localStorage.removeItem('checkVnPay');
            location.reload();
        }

        // location.reload();
        var url_update_item_cart = `{{ route('client.update-item-cart') }}`;
        var url_delete_item_cart = `{{ route('client.delete-item-cart') }}`;
        var url_get_list = `{{ route('client.cart.index') }}`;
        var url_checkout = `{{ route('client.order.store') }}`;
        var url_order_list = `{{ route('client.order.index') }}`;
    </script>
    <script src="{{ asset('client_assets/js/cart.js') }}"></script>
    <script src="{{ asset('client_assets/js/checkout.js') }}"></script>
@endsection
