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
                <i class="fa fa-dashboard mr-3"></i>{{ !empty($productSmartphonePrice->id) ? __('Chỉnh sửa option điện thoại thông minh') : __('Thêm option điện thoại thông minh') }}
            </h1>
            <p>{{ __('Thông tin sản phẩm') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{ route('smartphone.index') }}">{{ __('Danh sách sản phẩm điện thoại thông minh') }}</a></li>
            <li class="breadcrumb-item"><a
                    href="#">{{ __('Option sản phẩm').' '. $product->slug }}</a></li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="tile">
                <div class="d-flex justify-content-between">
                    <h3 class="tile-title">{{ __('Thêm option sản phẩm').' '. $product->slug }}</h3>
                </div>
                @if(!empty($product->slug))
                    <ul>
                        <li><b>Tên sản phẩm:</b> {{ $product->name }} </li>
                    </ul>
                @endif
                <form id="handle-option" action="{{ route('smartphone.handle') }}" method="POST" data-redirect="{{ route('smartphone.index') }}" enctype="multipart/form-data">
                    @if(!empty($product))
                        <input name="id" value="{{ $product->id ?? '' }}" type="hidden">
                    @endif
                    <div class="row w-100 d-flex justify-content-center">
                        <div class="col-md-12 col-lg-4">
                            <div class="mb-3">
                                <label>{{ __('Ram') }}<span class="text-danger">*</span></label>
                                <input name="ram" value="{{ $productSmartphonePrice->ram ?? '' }}" class="form-control" type="text" placeholder="Nhập tên sản phẩm">
                                <div class="error-message error_name"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Storage capacity') }}<span class="text-danger">*</span></label>
                                <input name="storage_capacity" value="{{ $productSmartphonePrice->storage_capacity ?? '' }}" class="form-control" type="text" placeholder="Nhập tên sản phẩm">
                                <div class="error-message error_name"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Remaining capacity is approx') }}</label>
                                <input name="remaining_capacity_is_approx" value="{{ $productSmartphonePrice->remaining_capacity_is_approx ?? '' }}" class="form-control" type="text" placeholder="Nhập tên sản phẩm">
                                <div class="error-message error_name"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Color') }}<span class="text-danger">*</span></label>
                                <input name="color" value="{{ $productSmartphonePrice->color ?? '' }}" class="form-control" type="text" placeholder="Nhập tên sản phẩm">
                                <div class="error-message error_name"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Hex color') }}<span class="text-danger">*</span></label>
                                <input name="hex_color" value="{{ $productSmartphonePrice->hex_color ?? '' }}" class="form-control" type="text" placeholder="Nhập tên sản phẩm">
                                <div class="error-message error_name"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Price') }}<span class="text-danger">*</span></label>
                                <input name="price" value="{{ $productSmartphonePrice->price ?? '' }}" class="form-control" type="text" placeholder="Nhập tên sản phẩm">
                                <div class="error-message error_name"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Quantity') }}<span class="text-danger">*</span></label>
                                <input name="quantity" value="{{ $productSmartphonePrice->quantity ?? '' }}" class="form-control" type="text" placeholder="Nhập tên sản phẩm">
                                <div class="error-message error_name"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Status') }}<span class="text-danger">*</span></label>
                                <input name="status" value="{{ $productSmartphonePrice->status ?? '' }}" class="form-control" type="text" placeholder="Nhập tên sản phẩm">
                                <div class="error-message error_name"></div>
                            </div>

                            <div class="row mb-10">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i> {{ __('Lưu') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script-after')
    <script src="{{ asset('admin_assets/js/product.js') }}" type="module"></script>
@endsection
