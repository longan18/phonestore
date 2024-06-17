@extends('admin.layouts.admin')

@section('title')
    {{ __('Sản phẩm') }}
@endsection
@section('css-after')
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1>
                <i class="fa fa-dashboard mr-3"></i>{{ __('Thông tin người dùng') }}
            </h1>
            <p>{{ __('Thông tin người dùng') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">{{ __('Danh sách người dùng') }}</a></li>
            <li class="breadcrumb-item">
                <a href="#">
                    {{ empty($user) ? __('Thêm mới người dùng') : __('Thông tin người dùng') }}
                </a>
            </li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="tile">
                <div class="d-flex justify-content-between mb-3">
                    <h3 class="tile-title m-0">
                        @empty($user)
                            <span>Thêm mới người dùng</span>
                        @else
                            <span>{{ 'Thông tin người dùng '.$user->name }} <span class="{{ $user->status_act->color }}">{{ ' - '.$user->status_act->text }}</span> </span>
                        @endempty
                    </h3>
                    <div class="d-flex">
                        <a href="{{ route('address.index', ['user' => $user->id]) }}" class="btn btn-warning d-flex align-items-center mr-2">
                            <i class="fa fa-truck"></i>Địa chỉ giao hàng
                        </a>
                        <a href="#" class="btn btn-success d-flex align-items-center mr-2">
                            <i class="fa fa-shopping-cart"></i>Giỏ hàng
                        </a>
                        <a href="#" class="btn btn-danger d-flex align-items-center">
                            <i class="fa fa-money"></i>Đơn hàng
                        </a>
                    </div>
                </div>

                <form id="handle-user"
                      action="{{ empty($user) ? route('customer.store') : route('customer.update', ['user' => $user->id]) }}"
                      data-redirect="{{ route('customer.index') }}" enctype="multipart/form-data"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    <input name="id" value="{{ $user->id ?? '' }}" type="hidden">
                    <div class="row w-100 d-flex justify-content-center">
                        <div class="col-md-12 col-lg-4">
                            <div class="mb-3">
                                <label>{{ __('Ảnh đại diện') }}</label>
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input name="avatar" class="d-none" type='file' id="image-upload"
                                               accept=".png,.jpg,.jpeg"/>
                                        <label for="image-upload">
                                            <div class="btn btn-primary icon-btn">
                                                <i class="fa fa-plus"></i>{{ __('Chọn file') }}
                                            </div>
                                        </label>
                                    </div>
                                    <div class="avatar-preview mt-2 mb-1">
                                        <img class="profile-user-img img-responsive img-circle object-fit-cover {{ !empty($user->avatar) ?: 'd-none' }}"
                                             height="150" width="150" id="image-preview" alt="User profile picture" src="{{ $user->avatar ?? '' }}">
                                    </div>
                                </div>
                                <div class="error-message error_avatar"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Họ và tên') }}<span class="text-danger">*</span></label>
                                <input name="name" value="{{ $user->name ?? '' }}" class="form-control" type="text" placeholder="Nhập tên người dùng" autocomplete="off">
                                <div class="error-message error_name"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Email') }}<span class="text-danger">*</span></label>
                                <input name="email" value="{{ $user->email ?? '' }}" class="form-control" type="text" placeholder="Nhập email" autocomplete="off">
                                <div class="error-message error_email"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Số điện thoại') }}<span class="text-danger">*</span></label>
                                <input name="phone" value="{{ $user->phone ?? '' }}" class="form-control" type="text" placeholder="Nhập số điện thoại" autocomplete="off">
                                <div class="error-message error_phone"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Mật khẩu') }}<span class="text-danger">*</span></label>
                                <input name="password" value="" class="form-control" type="text" placeholder="Nhập mật khẩu" autocomplete="off">
                                <div class="error-message error_password"></div>
                            </div>
                            <div class="mb-3">
                                <label>{{ __('Nhập lại mật khẩu') }}<span class="text-danger">*</span></label>
                                <input name="password_confirmation" value="" class="form-control" type="text" placeholder="Nhập lại mật khẩu" autocomplete="off">
                                <div class="error-message error_password_confirmation"></div>
                            </div>
                            <div class="row mb-10">
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button class="btn btn-primary" type="button" id="show-modal">
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i> {{ __('Lưu') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-modal-confirm>
                        <div class="d-flex justify-content-center">
                            <div class="div-icon-success d-flex justify-content-center align-items-center">
                                <i class="fa fa-user" style="font-size: 30px; color: white;"></i>
                            </div>
                        </div>
                        <h4 class="text-center mt-2">Bạn có muốn thực hiện hành động này lên người dùng</h4>
                    </x-modal-confirm>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script-after')
    <script src="{{ asset('admin_assets/js/customer.js') }}" type="module"></script>
@endsection
