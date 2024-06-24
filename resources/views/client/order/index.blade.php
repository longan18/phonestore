@extends('client.layouts.app')

@section('title')
    {{ __('Thông tin người dùng') }}
@endsection

@section('style_css')
    <style>
        .text-warting {
            color: #d1b816;
        }
        .text-cancel {
            color: #929287;
        }
        .text-delivering {
            color: #4fb5dc;
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
                        <h2>Thông tin</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('client.home') }}">{{ __('Trang chủ') }}</a>
                            <span>Đơn hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <x-infor></x-infor>
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        @forelse($orderDetails as $item)
                            <div class="pt-3 pb-3 border-bottom">
                                <div><b>Thông tin đơn hàng - {{ $item->uuid }}</b></div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <div>
                                            <p class="mb-1"><i>Thông tin đơn hàng</i></p>
                                            <ol style="list-style-type: disc">
                                                <li><b>Khách hàng:</b> {{ $item->user->name }}</li>
                                                <li><b>Email:</b> {{ $item->user->email }}</li>
                                                <li><b>Số điện thoại:</b> {{ $item->user->phone }}</li>
                                                <li><b>Tổng số lượng sản phẩm:</b> {{ $item->quantity_total }}</li>
                                                <li><b>Tổng tiền thanh toán:</b> <span class="text-danger font-weight-bold">{{ formatCurrency($item->price_total) }} <sup>đ</sup></span></li>
                                                <li><b>Trạng thái đơn hàng: </b> <span class="{{ $item->status_order->color }}"><i>{{ $item->status_order->text }}</i></span></li>
                                                <li><b>Trạng thái thanh toán: </b> <span class="{{ $item->status_order_payment->color  }}"><i>{{ $item->status_order_payment->text }}</i></span></li>
                                                <li><b>Thông tin thanh toán: </b> <i>{{ $item->note }}</i></li>
                                                <li><b>Thời gian tạo đơn hàng:</b> {{ $item->created_at }}</li>
                                            </ol>
                                        </div>
                                        <div class="ml-5" style="max-width: 500px">
                                            <p class="mb-1"><i>Thông tin địa chỉ giao hàng</i></p>
                                            <ol style="list-style-type: disc">
                                                <li><b>Tỉnh / thành phố:</b> {{ $item->province }}</li>
                                                <li><b>Quận / huyện / thị xã:</b> {{ $item->district }}</li>
                                                <li><b>Phường / xã:</b> {{ $item->ward }}</li>
                                                <li><b>Địa chỉ chi tiết:</b> {{ $item->address_detail }}</li>
                                                <li><b>Trạng thái giao hàng:</b> <span class="{{ $item->status_order_shipping->color }}"><i>{{ $item->status_order_shipping->text }}</i></span></li>
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="w-16">
                                        <a href="{{ route('client.order.show', ['order' => $item->uuid]) }}" class="btn btn-warning w-100">Xem chi tiết đơn hàng</a>
                                        <button class="btn btn-danger w-100 mt-2">Hủy đơn hàng</button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center note">Bạn chưa có đơn hàng nào</p>
                            <p class="text-center note">Hãy lựa chọn cho mình những sản phẩm tuyệt vời từ cửa hàng</p>
                        @endforelse
                            @if(!empty($orderDetails))
                                <div class="render-paginate mt-3">
                                    {{ $orderDetails->links('pagination.custom') }}
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')

@endsection
