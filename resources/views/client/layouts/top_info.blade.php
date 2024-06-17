<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> admin-shop@gmail.com</li>
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
                        @if(auth()->guard(GUARD_WEB)->check())
                            <div class="header__top__right__language">
                                <div>
                                    <a href="{{ route('client.infor.index', ['user' => userInfo()->id]) }}" style="color: #1c1c1c">
                                        <i class="fa fa-user"></i>
                                        {{ userInfo()->name }}
                                    </a>
                                </div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="{{ route('client.infor.index', ['user' => userInfo()->id]) }}">{{ __('Hồ sơ') }}</a></li>
                                    <li><a href="{{ route('client.logout') }}">{{ __('Đăng xuất') }}</a></li>
                                </ul>
                            </div>
                        @else
                            <div class="header__top__right__auth">
                                <a href="{{ route('client.page-login')}}">{{ __('Đăng nhập') }}</a>
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
                        <li class="active"><a href="{{ route('client.home') }}">{{ __('Trang chủ') }}</a></li>
                        <li><a href="./shop-grid.html">{{ __('Gian hàng') }}</a></li>
                        <li><a href="./blog.html">{{ __('Blog') }}</a></li>
                        <li><a href="./contact.html">{{ __('Liên hệ') }}</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li><a href="#"><i class="fa fa-heart"></i>
                                <div class="d-flex justify-content-center align-items-center item-icon-cart-favorite">0</div>
                            </a></li>
                        <li>
                            <a href="#">
                                <i class="fa fa-shopping-bag"></i>
                                <div class="d-flex justify-content-center align-items-center item-icon-cart-favorite item-icon-shopping-cart">{{ optional(userInfo())->count_shopping_item ?? 0 }}</div>
                            </a>
                        </li>
                    </ul>
                    <div class="header__cart__price">item: <span><span class="item-total-price-cart">{{ shorten_numbers(optional(userInfo())->shoppingSession->price_total ?? null) }}</span><sup>đ</sup></span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
