@extends('client.layouts.app')

@section('title')
    {{ __('Thông tin người dùng') }}
@endsection

@section('style_css')
    <style>
        .select2-container--default {
            width: 100% !important;
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
                            <span>thông tin</span>
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
                    <div class="col-lg-8 col-12">
                        <div class="list-address">
                            @forelse($addressShipping as $item)
                                <x-item-address :province="$item->province"
                                                :district="$item->district"
                                                :ward="$item->ward"
                                                :addresDetail="$item->address_detail"
                                                :act="$item->active"
                                                :id="$item->id"
                                ></x-item-address>
                            @empty
                                <p class="text-center note">Không có địa chỉ giao hàng nào</p>
                                <p class="text-center note">Vui lòng thêm địa chỉ giao hàng để trải nghiệm dịch vụ</p>
                            @endforelse
                        </div>
                        <div class="d-flex justify-content-end">
                            @if($addressShipping->count() < 10)
                                <button class="btn btn-success" id="show-modal">Thêm mới</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <x-modal-basic-center title="Thêm mới địa chỉ giao hàng">
            <div style="display: grid; gap: 16px">
                <div>
                    <label class="w-50">Chọn tỉnh/thành phố</label>
                    <select class="w-100 form-control" name="province_id" id="provinces">
                        @foreach($provinces as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="w-50">Chọn quận/huyện/thị xã</label>
                    <select class="form-control w-100" name="district_id" id="districts">
                        @foreach($districts as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="w-50">Chọn phường/xã</label>
                    <select class="form-control w-100" name="ward_id" id="wards">
                        @foreach($wards as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="w-50">Địa chỉ chi tiết</label>
                    <input type="text" class="form-control" name="address_detail" autocomplete="off">
                    <p class="text-danger error-msg m-0"></p>
                </div>
            </div>
        </x-modal-basic-center>
    </section>
@endsection

@section('script')
    <script>
        var url_load_district = `{{ route('client.address.get-district') }}`
        var url_load_ward = `{{ route('client.address.get-ward') }}`
        var url_submit_store = `{{ route('client.address.store-address-shipping') }}`
        var url_remove_address = `{{ route('client.address.delete-address-shipping') }}`
        var url_act_address = `{{ route('client.address.active-address-shipping') }}`
        var url_act_redirect = `{{ route('client.infor.index', ['user' => userInfo()->id]) }}`
    </script>
    <script src="{{ asset('client_assets/js/address.js') }}"></script>
@endsection
