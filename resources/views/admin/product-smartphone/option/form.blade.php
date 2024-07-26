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
            <li class="breadcrumb-item">
                <a href="{{ route('smartphone.option.index', ['product' => $product->slug]) }}">
                    {{ __('Option sản phẩm').' '. $product->name }}
                </a>
            </li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="tile">
                <div class="d-flex justify-content-between">
                    <h3 class="tile-title">{{ !empty($productSmartphonePrice->id) ? __('Chỉnh sửa option sản phẩm').' '. $product->name : __('Thêm option sản phẩm').' '. $product->slug }}
                        <span class="{{ $product->status_action->color }}">- {{ $product->status_action->text }}</span>
                    </h3>
                </div>
                @if(!empty($product->slug))
                    <ul>
                        <li><b>Tên sản phẩm:</b> {{ $product->name }} </li>
                    </ul>
                @endif
                <form id="handle-product" method="POST"
                      action="{{ empty($productSmartphonePrice->id) ? route('smartphone.option.store') : route('smartphone.option.update', ['option' => $productSmartphonePrice->id]) }}"
                      data-redirect="{{ route('smartphone.option.index', ['product' => $product->slug]) }}" enctype="multipart/form-data">
                    <input name="id" value="{{ $productSmartphonePrice->id ?? '' }}" type="hidden">
                    <input name="status" value="{{ $productSmartphonePrice->status ?? '' }}" type="hidden">
                    <input name="product_id" value="{{ $product->id ?? '' }}" type="hidden">
                    <div class="row w-100 d-flex justify-content-center">
                        <div class="col-md-12 col-lg-4">
                            <div class="mb-3">
                                <label>{{ __('Ảnh option') }}<span class="text-danger">*</span></label>
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input name="thumb_avatar_option" class="d-none" type="file" id="image-upload"
                                               accept=".png,.jpg,.jpeg"/>
                                        <label for="image-upload">
                                            <div class="btn btn-primary icon-btn">
                                                <i class="fa fa-plus"></i>{{ __('Chọn file') }}
                                            </div>
                                        </label>
                                    </div>
                                    <div class="avatar-preview mt-2 mb-1">
                                        <img class="profile-user-img img-responsive img-circle object-fit-cover {{ !empty($productSmartphonePrice->avatar) ?: 'd-none' }}"
                                             height="150" width="150" id="image-preview" alt="User profile picture" src="{{ $productSmartphonePrice->avatar ?? '' }}">
                                    </div>
                                </div>
                                <div class="error-message error_thumb_avatar_option"></div>
                            </div>
{{--                            <div class="mb-3">--}}
{{--                                <label>{{ __('Ảnh thumb option (200x200)') }}<span class="text-danger">*</span></label>--}}
{{--                                <div class="avatar-upload">--}}
{{--                                    <div class="avatar-edit">--}}
{{--                                        <input name="thumb_option" class="d-none" type="file" id="image-upload-option"--}}
{{--                                               accept=".png,.jpg,.jpeg"/>--}}
{{--                                        <label for="image-upload-option">--}}
{{--                                            <div class="btn btn-primary icon-btn">--}}
{{--                                                <i class="fa fa-plus"></i>{{ __('Chọn file') }}--}}
{{--                                            </div>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="avatar-preview mt-2 mb-1">--}}
{{--                                        <img class="profile-user-img img-responsive img-circle object-fit-cover {{ !empty($productSmartphonePrice->thumb_option) ?: 'd-none' }}"--}}
{{--                                             height="150" width="150" id="image-preview-option" alt="User profile picture" src="{{ $productSmartphonePrice->thumb_option ?? '' }}">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="error-message error_thumb_option"></div>--}}
{{--                            </div>--}}
                            <div class="mb-3">
                                <label>{{ __('Ram') }}<span class="text-danger">*</span></label>
                                <select class="select2-multiple form-control w-100 filter-product" name="ram_id">
                                    <option value="">{{ __('Ram') }}</option>
                                    @foreach($rams as $item)
                                        <option value="{{ $item->id }}" {{ handleSelected($item->id, $productSmartphonePrice->ram->id ?? null) }}>
                                            {{ $item->value }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="error-message error_ram_id"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Storage capacity') }}<span class="text-danger">*</span></label>
                                <select class="select2-multiple form-control w-100 filter-product" name="storage_capacity_id">
                                    <option value="">{{ __('Storage capacity') }}</option>
                                    @foreach($storageCapacities as $item)
                                        <option value="{{ $item->id }}" {{ handleSelected($item->id, $productSmartphonePrice->storageCapacity->id ?? null) }}>
                                            {{ $item->value }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="error-message error_storage_capacity_id"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Remaining capacity is approx') }}</label>
                                <input name="remaining_capacity_is_approx" value="{{ $productSmartphonePrice->remaining_capacity_is_approx ?? '' }}" class="form-control" type="text" placeholder="Nhập bộ nhớ còn lại sản phẩm">
                                <div class="error-message error_remaining_capacity_is_approx"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Color') }}<span class="text-danger">*</span></label>
                                <select class="color-select2 select2-multiple form-control w-100 filter-product" name="color_id">
                                    <option value="">{{ __('Color') }}</option>
                                    @foreach($colors as $item)
                                        <option value="{{ $item->id }}" {{ handleSelected($item->id, $productSmartphonePrice->color->id ?? null) }}>
                                            {{ $item->color }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="error-message error_color_id"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Price') }}<span class="text-danger">*</span></label>
                                <input name="price" data-name="price" value="{{ !empty($productSmartphonePrice->price) ? formatCurrency($productSmartphonePrice->price) : '' }}" class="form-control" type="text" placeholder="Nhập tiền sản phẩm">
                                <div class="error-message error_price"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Quantity') }}<span class="text-danger">*</span></label>
                                <input name="quantity" value="{{ $productSmartphonePrice->quantity ?? '' }}" class="form-control" type="text" placeholder="Nhập số lượng sản phẩm">
                                <div class="error-message error_quantity"></div>
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
