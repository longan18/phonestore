<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar object-fit-cover" width="40" height="40" src="{{ asset('admin_assets/images/avatar.jpeg') }}" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ 'Vũ Long An' }}</p>
            <p class="app-sidebar__user-designation">Admin</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item @if(currentRoute('admin.dashboard.index')) active @endif" href="{{ route('admin.dashboard.index') }}" ><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">{{ __('Trang chủ') }}</span></a></li>
        <li class="treeview @if(currentRoute('smartphone') || currentRoute('brands')) is-expanded @endif">
            <a class="app-menu__item @if(currentRoute('smartphone') || currentRoute('brands')) active @endif" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">{{ __('Quản lý sản phẩm') }}</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="treeview-item @if(currentRoute('smartphone')) active @endif" href="{{ route('smartphone.index') }}"><i class="icon fa fa-circle-o"></i>{{ __('Danh sách điện thoại') }}</a></li>
                <li><a class="treeview-item @if(currentRoute('brands')) active @endif" href="{{ route('brands.index') }}"  rel="noopener"><i class="icon fa fa-circle-o"></i>{{ __('Danh sách thương hiệu') }}</a></li>
                <li><a class="treeview-item" href="#" rel="noopener"><i class="icon fa fa-circle-o"></i>{{ __('Danh mục sản phẩm') }}</a></li>
            </ul>
        </li>
        <li><a class="app-menu__item @if(currentRoute('customer') || currentRoute('address') || currentRoute('cart')) active @endif" href="{{ route('customer.index') }}"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Quản lý người dùng</span></a></li>
        <li><a class="app-menu__item @if(currentRoute('order')) active @endif" href="{{ route('order.index') }}"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Quản lý đơn hàng</span></a></li>
        <li><a class="app-menu__item" href="charts.html"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Biểu đồ</span></a></li>
    </ul>
</aside>
