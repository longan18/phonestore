<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="{{ route('client.home') }}"><img src="{{ asset('images/logo.png') }}" alt="" style="width: 60%"></a>
    </div>
    <div class="humberger__menu__widget">
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
                <a href="{{ route('client.page-login')}}"><i class="fa fa-user"></i>{{ __('Đăng nhập') }}</a>
            </div>
        @endif
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="@if(currentRoute('client.home')) active @endif"><a href="{{ route('client.home') }}">{{ __('Trang chủ') }}</a></li>
            <li class="@if(currentRoute('client.cart.index')) active @endif"><a href="{{ route('client.cart.index') }}">{{ __('Giỏ hàng') }}</a></li>
            <li class="@if(currentRoute('client.order.index')) active @endif"><a href="{{ route('client.order.index') }}">{{ __('Đơn hàng') }}</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
            <li>Free Shipping for all Order of $99</li>
        </ul>
    </div>
</div>
