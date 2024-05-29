<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> admin-shop@gmail.com</li>
                            <li>Free Shipping từ {{ number_format(200000) }}đ</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__language">
                            <img src="{{ asset('client_assets/img/language.png') }}" alt="">
                            <div>{{ __('Tiếng việt') }}</div>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="#">{{ __('Tiếng việt') }}</a></li>
                                <li><a href="#">{{ __('English') }}</a></li>
                            </ul>
                        </div>
                        @if(auth()->user())
                            <div class="header__top__right__language">
                                <div>
                                    <a href="#" style="color: #1c1c1c">
                                        <i class="fa fa-user"></i>
{{--                                        {{ auth()->user()->name }}--}}
                                    </a>
                                </div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    @if(auth()->user())
                                        <li><a href="#">{{ __('Hồ sơ') }}</a></li>
                                        <li><a href="{{ route('client.logout') }}">{{ __('Đăng xuất') }}</a></li>
                                    @else

                                    @endif
                                </ul>
                            </div>
                        @else
                            <div class="header__top__right__auth">
                                <a href="#">{{ __('Đăng nhập') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="#"><img src="{{ asset('client_assets/img/logo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="#">{{ __('Trang chủ') }}</a></li>
                        <li><a href="./shop-grid.html">{{ __('Gian hàng') }}</a></li>
{{--                        <li><a href="#">Pages</a>--}}
{{--                            <ul class="header__menu__dropdown">--}}
{{--                                <li><a href="./shop-details.html">Shop Details</a></li>--}}
{{--                                <li><a href="./shoping-cart.html">Shoping Cart</a></li>--}}
{{--                                <li><a href="./checkout.html">Check Out</a></li>--}}
{{--                                <li><a href="./blog-details.html">Blog Details</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
                        <li><a href="./blog.html">{{ __('Blog') }}</a></li>
                        <li><a href="./contact.html">{{ __('Liên hệ') }}</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                        <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                    </ul>
{{--                    <div class="header__cart__price">item: <span>$150.00</span></div>--}}
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
