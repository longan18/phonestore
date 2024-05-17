@extends('admin.layouts.admin')

@section('title')
    {{ __('Danh sách sản phẩm') }}
@endsection
@section('css-after')
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard mr-2"></i>{{ __('Danh sách sản phẩm điện thoại thông minh') }}</h1>
            <p>{{ __('Thông tin sản phẩm') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">{{ __('Danh sách sản phẩm điện thoại thông minh') }}</a></li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="tile" id="list-product">
                <div class="d-flex justify-content-between">
                    <h3 class="tile-title">{{ __('Danh sách sản phẩm') }}</h3>
                    <p>
                        <a class="btn btn-primary icon-btn" href="{{ route('smartphone.create') }}"><i class="fa fa-plus"></i>{{ __('Thêm mới') }}</a>
                    </p>
                </div>
                @include('admin.product-smartphone.filter')
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>{{ __('Hình ảnh') }}</th>
                        <th class="w-25">{{ __('Tên sản phẩm') }}</th>
                        <th>{{ __('Thương hiệu') }}</th>
                        <th>{{ __('Số lượng') }}</th>
                        <th>{{ __('Trạng thái') }}</th>
                        <th>{{ __('Ngày tạo') }}</th>
                        <th>{{ __('Tùy chọn') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @include('admin.product-smartphone.table')
                    </tbody>
                </table>
                <div class="render-paginate">
                    {{ $products->links('pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-after')
    <script src="{{ asset('admin_assets/js/product.js') }}" type="module"></script>
@endsection

