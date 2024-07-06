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
                        <li><a href="{{ route('client.cart.index') }}">{{ __('Giỏ hàng') }}</a></li>
                        <li><a href="{{ route('client.order.index') }}">{{ __('Đơn hàng') }}</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li class="notify-show">
                            <a href="#"><i class="fa fa-bell"></i>
                                <div class="d-flex justify-content-center align-items-center item-icon-cart-favorite">0</div>
                            </a>
                            <div class="elm-notify d-none">
                                <div class="top-noti d-flex justify-content-between align-items-center">
                                    <div><b>Thông báo</b></div>
                                    <div id="check-noti">Đánh dấu đã đọc (<i class="fa fa-check"></i>)</div>
                                </div>
                                <div class="content-noti">
                                    <div class="d-flex align-items-center justify-content-between item-noti bg-e3e3e3" data-notify="">
                                        <div class="content-item-noti">
                                            <p><i>Hệ thống - 20-10-2002</i></p>
                                            Đơn hàng <b>4c5a203c-24c0-43b2-9f5d-667db6fdba49</b> đã được tạo thành công, vui lòng chờ xác nhận đơn hàng!
                                        </div>
                                        <div class="icon-noti">
{{--                                            <i class="fa fa-check"></i>--}}
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between item-noti">
                                        <div class="content-item-noti">
                                            <p><i>Hệ thống - 20-10-2002</i></p>
                                            Đơn hàng <b>4c5a203c-24c0-43b2-9f5d-667db6fdba49</b> đã được tạo thành công, vui lòng chờ xác nhận đơn hàng!
                                        </div>
                                        <div class="icon-noti">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between item-noti">
                                        <div class="content-item-noti">
                                            <p><i>Hệ thống - 20-10-2002</i></p>
                                            Đơn hàng <b>4c5a203c-24c0-43b2-9f5d-667db6fdba49</b> đã được tạo thành công, vui lòng chờ xác nhận đơn hàng!
                                        </div>
                                        <div class="icon-noti">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between item-noti">
                                        <div class="content-item-noti">
                                            <p><i>Hệ thống - 20-10-2002</i></p>
                                            Đơn hàng <b>4c5a203c-24c0-43b2-9f5d-667db6fdba49</b> đã được tạo thành công, vui lòng chờ xác nhận đơn hàng!
                                        </div>
                                        <div class="icon-noti">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between item-noti">
                                        <div class="content-item-noti">
                                            <p><i>Hệ thống - 20-10-2002</i></p>
                                            Đơn hàng <b>4c5a203c-24c0-43b2-9f5d-667db6fdba49</b> đã được tạo thành công, vui lòng chờ xác nhận đơn hàng!
                                        </div>
                                        <div class="icon-noti">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    </div>
{{--                                    <div class="text-center" style="padding: 12px 0px; color: #9a9595">Thông báo trống</div>--}}
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="{{ route('client.cart.index') }}">
                                <i class="fa fa-shopping-bag"></i>
                                <div class="d-flex justify-content-center align-items-center item-icon-cart-favorite item-icon-shopping-cart">{{ $quantityCart ?? 0 }}</div>
                            </a>
                        </li>
                    </ul>
                    <div class="header__cart__price">item: <span><span class="item-total-price-cart">{{ shorten_numbers($totalCart ?? null) }}</span><sup>đ</sup></span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
