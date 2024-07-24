@extends('admin.layouts.admin')

@section('title')
    {{ __('Danh sách người dùng') }}
@endsection
@section('css-after')
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard mr-2"></i>{{ __('Danh sách người dùng') }}</h1>
            <p>{{ __('Thông tin người dùng') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">{{ __('Danh sách người dùng') }}</a></li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="tile" id="list-customer">
                <div class="d-flex justify-content-between">
                    <h3 class="tile-title">{{ __('Danh sách người dùng') }}</h3>
{{--                    <p>--}}
{{--                        <a class="btn btn-primary icon-btn" href="{{ route('customer.create') }}"><i class="fa fa-plus"></i>{{ __('Thêm mới') }}</a>--}}
{{--                    </p>--}}
                </div>
                <div class="w-30 ml-0 mb-3 position-relative">
                    <i class="fa fa-search position-absolute position-search cursor-pointer" aria-hidden="true"></i>
                    <input name="key_search" class="form-control" type="text" placeholder="Tìm kiếm">
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>{{ __('Họ và tên') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Số điện thoại') }}</th>
                        <th>{{ __('Trạng thái') }}</th>
                        <th>{{ __('Ngày tạo') }}</th>
                        <th class="w-26">{{ __('Tùy chọn') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @include('admin.customer.table')
                    </tbody>
                </table>
                <div class="render-paginate">
                    {{ $users->links('pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-after')
    <script src="{{ asset('admin_assets/js/customer.js') }}" type="module"></script>
@endsection

