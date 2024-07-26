@extends('client.layouts.app')

@section('title')
    {{ __('Sản phẩm') }}
@endsection

@section('style_css')
    @vite([
        'resources/scss/client/product-detail.scss',
        'resources/scss/client/parameter-item.scss',
    ])
@endsection

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('client_assets/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $product->name }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('client.home') }}">{{ __('Trang chủ') }}</a>
                            <span>{{ $product->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-details spad" data-product="{{ $product->id }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                 src="{{ asset($product->avatar) }}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
{{--                            @forelse($product->sub_image as $subImage)--}}
{{--                                <img data-imgbigurl="{{ $subImage['url'] }}"--}}
{{--                                     src="{{ $subImage['url'] }}" alt="">--}}
{{--                            @empty--}}
{{--                            @endforelse--}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $product->name }}</h3>
{{--                        <div class="product__details__rating">--}}
{{--                            <i class="fa fa-star"></i>--}}
{{--                            <i class="fa fa-star"></i>--}}
{{--                            <i class="fa fa-star"></i>--}}
{{--                            <i class="fa fa-star"></i>--}}
{{--                            <i class="fa fa-star-half-o"></i>--}}
{{--                            <span>(18 Đánh giá)</span>--}}
{{--                        </div>--}}

                        <div>
                            @include('client.product.option')
                        </div>

                        <div class="d-flex">
                            <div class="primary-btn mt-5 col-9 col-md-6 cursor-pointer noselect mr-2" id="btn-add-cart"
                                 data-url="{{ route('client.add-cart') }}">
                                <i class="fa fa-shopping-cart fs-20"></i>
                                {{ __('Thêm vào giỏ hàng') }}
                            </div>
                            <div id="show-modal" class="border text-primary border-primary mt-5 w-100 cursor-pointer d-flex justify-content-center align-items-center p-0">
                                <div>
                                    {{ __('Xem cấu hình chi tiết') }}
                                    <i class="fa fa-caret-right"></i>
                                </div>
                            </div>
                        </div>

                        <ul>
                            <li><b>{{ __('Số lượng hiện có:') }}</b> <span></span></li>
                            <li><b>{{ __('Vận chuyển:') }}</b><span>vận chuyển từ 3 - 5 ngày.</span></li>
                            <li><b>{{ __('Chia sẻ:') }}</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-modal-scroll title="Thông số kỹ thuật {{ $product->name }}">
        <x-specifications
            :product="$product"
            :specifications="$product->productSmartphone"
            :optionDefault="$dataResult['default']"
            :urlSubImage="$product->sub_image->pluck('url')"
        ></x-specifications>
    </x-modal-scroll>

    <x-modal-notify-cart></x-modal-notify-cart>
@endsection

@section('script')
    <script>
        var url_add_cart = `{{ route('client.add-cart') }}`
        var check_auth = {{ auth()->guard(GUARD_WEB)->check() ? 'true' : 'false' }};
        var url_login = `{{ route('client.page-login') }}`
        var image_default = `{{ asset($product->avatar) }}`

        $(function () {
            $('.carousel').carousel({
                interval: 2000
            })
        })
    </script>
    <script src="{{ asset('client_assets/js/product_detail.js') }}" type="module"></script>
@endsection
