@extends('admin.layouts.admin')

@section('title')
    {{ __('Chi tiết đơn hàng') }}
@endsection
@section('css-after')
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
    </style>
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard mr-2"></i>{{ __('Chi tiết đơn hàng') }}</h1>
            <p>{{ __('Chi tiết đơn hàng') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{ route('order.index') }}">{{ __('Danh sách đơn hàng') }}</a></li>
            <li class="breadcrumb-item"><a href="#">{{ __('Chi tiết đơn hàng') }}</a></li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="tile" id="list-product">
                <div class="d-flex justify-content-between">
                    <h3 class="tile-title">{{ __('Chi tiết đơn hàng') }} {{ request()->order->uuid }}</h3>
                </div>
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
                                    <img src="{{ $item->product->avatar }}" alt="" style="width: 100px;">
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
@endsection

@section('script-after')
@endsection

