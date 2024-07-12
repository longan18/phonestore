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
                                                <li><b>Tổng số lượng sản phẩm:</b> {{ $item->quantity_total }}</li>
                                                <li><b>Tổng tiền thanh toán:</b> <span class="text-danger font-weight-bold">{{ formatCurrency($item->price_total) }} <sup>đ</sup></span></li>
                                                @if($item->status_shipping == \App\Enums\StatusShippingOrder::ORDER_SHIP_WRATING->value)
                                                    <li><b>Trạng thái đơn hàng: </b> <span class="{{ $item->status_order->color }}"><i>{{ $item->status_order->text }}</i></span></li>
                                                @else
                                                    <li><b>Trạng thái đơn hàng: </b> <span class="{{ $item->status_order_shipping->color }}"><i>{{ $item->status_order_shipping->text }}</i></span></li>
                                                @endif
                                                @if($item->status != \App\Enums\StatusOrder::ORDER_CANCEL->value)
                                                    <li><b>Trạng thái thanh toán: </b> <span class="{{ $item->status_order_payment->color  }}"><i>{{ $item->status_order_payment->text }}</i></span></li>
                                                @endif
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
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="w-16">
                                        <a href="{{ route('client.order.show', ['order' => $item->uuid]) }}" class="btn btn-warning w-100">Xem chi tiết đơn hàng</a>
                                        @if($item->status_shipping == \App\Enums\StatusShippingOrder::ORDER_SHIP_WRATING->value
                                               && $item->status != \App\Enums\StatusOrder::ORDER_CANCEL->value
                                               && $item->status_payment != \App\Enums\StatusPaymentOrder::ORDER_PAYMENT_PAID->value)
                                            <button class="btn btn-danger w-100 mt-2 cancel-order" data-value="{{ \App\Enums\StatusOrder::ORDER_CANCEL->value }}" data-order="{{ $item->id }}">Hủy đơn hàng</button>
                                        @endif
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
    <script>
        $(function () {
            @if(session()->has('data_vnpay'))
                @php($data_vnpay = session()->get('data_vnpay'))
                @if($data_vnpay['check_payment'])
                    toastr.success('Đơn hàng {{ $data_vnpay['uuid'] }} đã được thanh toán thành công');
                @else
                    toastr.error('Đơn hàng {{ $data_vnpay['uuid'] }} thanh toán thất bại');
                @endif
            @endif

            $('.cancel-order').on('click', function () {
                const id = $(this).data('order');
                const status = $(this).data('value');
                const client = true;

                $.ajax({
                    type: 'POST',
                    url: `{{ route('client.order.cancel-order') }}`,
                    data: {id, status, client},
                    beforeSend: function () {
                        $('.loading').removeClass('d-none')
                    },
                    success: function (res) {
                        if (res.success) {
                            toastr.success(res.message);
                        } else if(res.failed) {
                            toastr.error(res.message);
                        }
                        setTimeout(() => window.location.reload(), 700);
                    },
                    error: function (Xhtp) {
                        toastr.error(Xhtp.responseJson.message);
                        setTimeout(() => window.location.reload(), 700);
                    },
                    complete: function () {
                        setTimeout(() => $('.loading').addClass('d-none'), 700);
                    }
                });
            });
        })
    </script>
@endsection
