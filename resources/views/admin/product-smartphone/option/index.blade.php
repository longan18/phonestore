@extends('admin.layouts.admin')

@section('title')
    {{ __('Sản phẩm') }}
@endsection
@section('css-after')
    <style>
        .ck-editor__editable {
            min-height: 100px;
            max-height: 100px;
        }
    </style>
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1>
                <i class="fa fa-dashboard mr-3"></i>{{ __('Option sản phẩm điện thoại thông minh') }}
            </h1>
            <p>{{ __('Thông tin sản phẩm') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{ route('smartphone.index') }}">Danh sách sản phẩm điện thoại thông minh</a></li>
            <li class="breadcrumb-item">
                <a href="{{ route('smartphone.show-list-option', ['product' => $product->slug]) }}">
                    {{ __('Option sản phẩm').' '. $product->slug }}
                </a>
            </li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="tile">
                <div class="d-flex justify-content-between">
                    <h3 class="tile-title">{{ __('Option sản phẩm').' '. $product->slug }}</h3>
                    <p>
                        <a class="btn btn-primary icon-btn"
                           href="{{ route('smartphone.create-option', ['product' => $product->slug]) }}"><i
                                class="fa fa-plus"></i>{{ __('Thêm option sản phẩm') }}</a>
                    </p>
                </div>
                <ul>
                    <li><b>Tên sản phẩm:</b> {{ $product->name }}</li>
                </ul>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>{{ __('Ram') }}</th>
                        <th>{{ __('Khả năng lưu trữ') }}</th>
                        <th>{{ __('Dung lượng còn lại') }}</th>
                        <th>{{ __('Màu sắc') }}</th>
                        <th>{{ __('Giá tiền') }}</th>
                        <th>{{ __('Số lượng') }}</th>
                        <th>{{ __('Trạng thái') }}</th>
                        <th>{{ __('Tùy chọn') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @include('admin.product-smartphone.option.table-option')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script-after')
    <script src="{{ asset('admin_assets/js/product.js') }}" type="module"></script>
@endsection
