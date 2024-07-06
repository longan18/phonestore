@extends('client.layouts.app')

@section('title')
    {{ __('Thông tin người dùng') }}
@endsection

@section('style_css')
    <style>
        h4 {
            border: 0px !important;
        }

        th {
            border-bottom: 0px !important;
            border-right: 1px solid #dee2e6 !important;
        }

        td {
            border: 0px !important;
            border-top: 1px solid #dee2e6 !important;
            border-right: 1px solid #dee2e6 !important;
        }

        .timeline-section {
            position: relative;
        }

        .timeline-container {
            position: relative;
            margin: 0 auto;
            width: 50%; /* Điều chỉnh chiều rộng theo ý muốn */
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }

        .timeline-marker {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #ccc;
        }

        .timeline-content {
            position: relative;
            margin-left: 30px;
            padding: 10px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .timeline-content h3 {
            margin-top: 0;
            margin-bottom: 5px;
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
                            <span>Chi tiết đơn hàng {{ request()->order->uuid }}</span>
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
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="w-50 text-center">Sản phẩm</th>
                                <th class="text-center">Giá tiền</th>
                                <th class="text-center">Số lượng</th>
                                <th class="w-15 text-center">Tổng tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orderItems as $item)
                                <tr class="item-cart">
                                    <td class="d-flex align-items-center">
                                        <div class="">
                                            <img src="{{ $item->productPrice->avatar }}" alt="" style="width: 100px;">
                                        </div>
                                        <div style="margin-left: 20px">
                                            <ol class="text-left" style="list-style-type: disc">
                                                <li><span>Tên sản phẩm: </span>{{ $item->product->name }}</li>
                                                <li><span>Ram: </span>{{ $item->productPrice->ram->value }}</li>
                                                <li><span>Bộ nhớ trong: </span>{{ $item->productPrice->storageCapacity->value }}</li>
                                                <li><span>Màu: </span>{{ $item->productPrice->color->color }}</li>
                                            </ol>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="price">{{ formatCurrency($item->price) }}</span><sup>đ</sup>
                                    </td>
                                    <td class="text-center">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="text-center"><span class="price-total">{{ formatCurrency($item->total_price_item) }}</span><sup>đ</sup></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="render-paginate">
                            {{ $orderItems->links('pagination.custom') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="timeline-section">
        <div class="timeline-container">
            <div class="timeline-item">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                    <h4>Sự kiện 1</h4>
                    <p class="m-0">Mô tả sự kiện 1</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                    <h4>Sự kiện 1</h4>
                    <p class="m-0">Mô tả sự kiện 1</p>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')

@endsection
