@forelse($users as $user)
    <tr>
        <td class="text-center">{{ indexTable($users->currentPage(), $users->perPage(), $loop->index) }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone }}</td>
        <td class="fw-700 {{ $user->status_act->color }}">{{ $user->status_act->text }}</td>
        <td>{{ $user->created_at }}</td>
        <td class="d-flex flex-wrap" style="gap: 4px">
            <a href="{{ route('customer.show-infor', ['user' => $user->id]) }}" class="d-inline-block btn py-0 btn-blue d-flex align-items-center">
                <i class="fa fa-eye"></i>Thông tin chi tiết
            </a>
            <a href="{{ route('address.index', ['user' => $user->id]) }}" class="d-inline-block btn py-0 btn-warning d-flex align-items-center">
                <i class="fa fa-truck"></i>Địa chỉ giao hàng
            </a>
            <a href="{{ route('cart.index', ['user' => $user->id]) }}" class="d-inline-block btn py-0 btn-success d-flex align-items-center">
                <i class="fa fa-shopping-cart"></i>Giỏ hàng
            </a>
            <a href="{{ route('order.show-order-user', ['user' => $user->id]) }}" class="d-inline-block btn py-0 btn-danger d-flex align-items-center">
                <i class="fa fa-money"></i>Đơn hàng
            </a>
        </td>
    </tr>
@empty
    <tr>
        <td class="text-center" colspan="9">{{ __('Không có dữ liệu.') }}</td>
    </tr>
@endforelse
