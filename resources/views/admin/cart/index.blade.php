@extends('admin.layouts.admin')

@section('title')
{{ __('Danh sách sản phẩm trong giỏ hàng') }}
@endsection


@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard mr-2"></i>{{ __('Danh sách sản phẩm trong giỏ hàng') }}</h1>
        <p>{{ __('Danh sách sản phẩm trong giỏ hàng') }}</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">{{ __('Danh sách người dùng') }}</a></li>
        <li class="breadcrumb-item"><a href="#">{{ __('Danh sách sản phẩm trong giỏ hàng') }}</a></li>
    </ul>
</div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="tile" id="list-product">
            <div class="d-flex justify-content-between" style="margin-bottom: 20px">
                <h3 class="tile-title mb-0">{{ __('Danh sách sản phẩm trong giỏ hàng') }} <span>- {{ $user->name }}</span></h3>
                <button class="btn btn-blue" id="show-modal-infor-cart">Thông tin giỏ hàng</button>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>{{ __('Hình ảnh') }}</th>
                    <th>{{ __('Tên sản phẩm') }}</th>
                    <th>{{ __('Đơn giá') }}</th>
                    <th>{{ __('Số lượng') }}</th>
                    <th>{{ __('Thành tiền') }}</th>
                </tr>
                </thead>
                <tbody>
                @include('admin.cart.table')
                </tbody>
            </table>
            @if(!empty($carts))
                <div class="render-paginate">
                    {{ $carts->links('pagination.custom') }}
                </div>
            @endif
        </div>
    </div>

    <x-modal-confirm id="modal-info-cart">
        <ol style="list-style-type: disc">
            <li><b>Số lượng sản phẩm trong giỏ hàng:</b> {{ optional($carts)->total() ?? 0 }}</li>
            <li><b>Tổng số lượng sản phẩm trong giỏ hàng:</b> {{ $user->shoppingSession->quantity_total ?? 0 }}</li>
            <li><b>Đơn giá:</b> {{ formatCurrency(optional($carts)->sum('price') ?? 0) }}</li>
            <li><b>Tổng tiền:</b> {{ $user->shoppingSession ? formatCurrency($user->shoppingSession->price_total) : 0 }}</li>
        </ol>

        <x-slot:footer></x-slot:>
    </x-modal-confirm>
</div>
@endsection

@section('script-after')
    <script>
        $('#show-modal-infor-cart').on('click', function () {
            $('#modal-info-cart').modal('show');
        })
    </script>
@endsection

