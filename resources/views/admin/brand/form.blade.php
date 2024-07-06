@extends('admin.layouts.admin')

@section('title')
    {{ __('Thương hiệu') }}
@endsection
@section('css-after')
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>{{ !empty($brand->name) ?  __('Sửa thương hiệu') : __('Tạo mới thương hiệu') }}</h1>
            <p>{{ __('Thông tin thương hiệu sản phẩm') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{ route('brands.index') }}">{{ __('Danh sách thương hiệu') }}</a></li>
            <li class="breadcrumb-item"><a href="#">{{ !empty($brand->name) ? __('Sửa thương hiệu') : __('Tạo mới thương hiệu') }}</a></li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-5">
            <div class="tile">
                <div class="d-flex justify-content-between">
                    <h3 class="tile-title">{{ !empty($brand->name) ?  __('Sửa thương hiệu') : __('Tạo thương hiệu') }}</h3>
                </div>
                <form id="handle-brand" action="{{ route('brands.handle') }}" method="POST"
                      data-redirect="{{ route('brands.index') }}" enctype="multipart/form-data">
                    @if(!empty($brand))
                        <input name="id" value="{{ $brand->id ?? '' }}" type="hidden">
                    @endif
                    <div class="row mb-4">
                        <div class="col-12">
                            <label>Tên thương hiệu:</label>
                            <input name="name" value="{{ $brand->name ?? '' }}" class="form-control" type="text">
                            <div class="error-message error_name"></div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <label>Ảnh thương hiệu:</label>
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input name="thumb_avatar_brand" class="d-none" type='file' id="image-upload"
                                           accept=".png,.jpg,.jpeg"/>
                                    <label for="image-upload">
                                        <div class="btn btn-primary icon-btn">
                                            <i class="fa fa-plus"></i>{{ __('Chọn file') }}
                                        </div>
                                    </label>
                                </div>
                                <div class="avatar-preview mt-2">
                                    <img class="profile-user-img img-responsive img-circle object-fit-cover {{ !empty($brand->avatar) ?: 'd-none' }}"
                                         src="{{ $brand->avatar ?? '' }}"
                                         height="150" width="150"
                                         id="image-preview"
                                         alt="User profile picture">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 row error-message error_avatar"></div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-fw fa-lg fa-check-circle"></i> Lưu
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script-after')
    <script src="{{ asset('admin_assets/js/brand.js') }}" type="module"></script>
@endsection
