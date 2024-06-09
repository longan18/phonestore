@extends('client.layouts.app')

@section('title')
    {{ __('Sản phẩm') }}
@endsection

@section('style_css')
    @vite('resources/scss/client/product-detail.scss')
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
    <section class="product-details spad" data-product="{{ $product->id }}" data-url="{{ route('client.product.option-price') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                 src="https://cdn.tgdd.vn/Products/Images/42/305659/iphone-15-pro-max-black-thumbnew-600x600.jpg" alt="">
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
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 Đánh giá)</span>
                        </div>

                        <div>
                            @include('client.product.option')
                        </div>

                        <div class="primary-btn mt-5 col-9 col-md-6 cursor-pointer noselect" id="btn-add-cart"
                        data-url="{{ route('client.add-cart') }}">
                            <i class="fa fa-shopping-cart fs-20"></i>
                            {{ __('Thêm vào giỏ hàng') }}
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
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                   aria-selected="true">{{ __('Mô tả') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                   aria-selected="false">{{ __('Đánh giá') }} <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>{{ __('Mô tả sản phẩm') }}</h6>

                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Đánh giá sản phẩm</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('client.modal.notify_cart')
@endsection

@section('script')
    <script src="{{ asset('client_assets/js/product_detail.js') }}" type="module"></script>
@endsection
