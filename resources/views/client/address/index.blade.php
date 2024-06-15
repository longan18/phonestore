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
                    <select class="select2-custom w-100 form-control" name="province_id" id="provinces">
                        @foreach($provinces as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="w-50">Chọn quận/huyện/thị xã</label>
                    <select class="select2-custom w-50" name="district_id" id="districts">
                        @foreach($districts as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="w-50">Chọn phường/xã</label>
                    <select class="select2-custom w-50" name="ward_id" id="wards">
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
        $(document).find('#provinces').change(function () {
            loadAddress(`{{ route('client.address.get-district')  }}`, $(this).val());
        })

        $(document).find('#districts').change(function () {
            loadAddress(`{{ route('client.address.get-ward')  }}`, $(this).val());
        })

        $(document).on('click', 'input[name="address_detail"]', function () {
            $('.error-msg').text('');
        })

        $('#submit-address-shipping').on('click', function () {
            const province_id = $('#provinces').val();
            const district_id = $('#districts').val();
            const ward_id = $('#wards').val();
            const address_detail = $('input[name="address_detail"]').val();

            $.ajax({
                type: 'POST',
                url: `{{ route('client.address.store-address-shipping') }}`,
                data: {
                    province_id,
                    district_id,
                    ward_id,
                    address_detail
                },
                success: function (res) {
                    if(res.success) {
                        console.log($(".list-address .note").length)
                        if($(".list-address .note").length > 0) {
                            $(".list-address").empty();
                        }
                        $(".list-address").append(res.data.html);
                        setTimeout(() => {
                            $('#modal').modal('hide');
                        }, 500);
                        toastr.success(res.message);
                    } else {
                        toastr.error(res.message);
                    }
                },
                error: function (jqXHR) {
                    if (jqXHR.responseJSON.failed) {
                        toastr.error('Địa chỉ của bạn đã tối đa');
                    } else {
                        $('.error-msg').text(jqXHR.responseJSON.message);
                    }
                },
            });
        })

        $(document).on('click', '.remove-address', function () {
            const elmRoot = $(this);
            const id = elmRoot.data('id');

            $.ajax({
                type: 'POST',
                url: `{{ route('client.address.delete-address-shipping') }}`,
                data: { id },
                success: function (res) {
                    if(res.success) {
                        elmRoot.parents('.item-address').remove();
                        if($(document).find('.item-address').length == 0) {
                            $('.list-address').append(`
                             <p class="text-center note">Không có địa chỉ giao hàng nào</p>
                                <p class="text-center note">Vui lòng thêm địa chỉ giao hàng để trải nghiệm dịch vụ</p>
                            `)
                        }
                        toastr.success(res.message);
                    } else {
                        toastr.error(res.message);
                        window.location.reload();
                    }
                },
                error: function (jqXHR) {
                    toastr.error(jqXHR.responseJSON.message);
                },
            });
        })

        $(document).on('click', '.act-address', function () {
            const elmRoot = $(this);
            const id = elmRoot.data('id');

            if(elmRoot.hasClass('btn-warning')) {
                toastr.success('Cập nhật địa chỉ giao hàng mặc định thành công');
            } else {
                $.ajax({
                    type: 'POST',
                    url: `{{ route('client.address.active-address-shipping') }}`,
                    data: { id },
                    success: function (res) {
                        if(res.success) {
                            $('.item-address').find('.act-address').removeClass('btn-warning').addClass('btn-primary');
                            elmRoot.removeClass('btn-primary').addClass('btn-warning');
                            toastr.success(res.message);
                            setTimeout(() => {
                                window.location.href = `{{ route('client.infor.index', ['user' => userInfo()->id]) }}`;
                            }, 550);
                        } else {
                            toastr.error(res.message);
                        }
                    },
                    error: function (jqXHR) {
                        toastr.error(jqXHR.responseJSON.message);
                    },
                });
            }
        })

        const loadAddress = (url, id) => {
            $.ajax({
                type: 'POST',
                url: url,
                data: { id },
                success: function (res) {
                    if (res.data.districts) {
                        loadMapAddress($('#districts'), res.data.districts);
                        loadMapAddress($('#wards'), res.data.wards);
                    } else {
                        loadMapAddress($('#wards'), res.data.wards);
                    }
                },
                error: function (res) {
                    toastr.error('Đã xảy ra lỗi hệ thống, vui lòng thử lại sau giây lát');
                    window.location.reload();
                },
            });
        }

        const loadMapAddress = (elm, data) => {
            elm.empty();
            let html = '';

            data.map((item, index) => {
                html += `<option value="${item.id}">${item.name}</option>`
            })
            elm.append(html);
        }
    </script>
@endsection
