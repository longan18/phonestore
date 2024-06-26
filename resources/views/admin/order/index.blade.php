@extends('admin.layouts.admin')

@section('title')
    {{ __('Danh sách đơn hàng') }}
@endsection
@section('css-after')
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard mr-2"></i>{{ __('Danh sách đơn hàng') }}</h1>
            <p>{{ __('Danh sách đơn hàng') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            @if(!empty($user))
                <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">{{ __('Danh Sách Người Dùng') }}</a></li>
                <li class="breadcrumb-item"><a href="#">{{ __('Danh sách đơn hàng') }}</a></li>
            @else
                <li class="breadcrumb-item"><a href="#">{{ __('Danh sách đơn hàng') }}</a></li>
            @endif
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="tile" id="list-order">
                <div class="d-flex justify-content-between">
                    <h3 class="tile-title">{{ __('Danh sách đơn hàng') }} @if(!empty($user)) <span>- {{ $user->name }}</span> @endif</h3>
                </div>
                @include('admin.order.filter')
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>{{ __('Thông tin') }}</th>
                        <th>{{ __('Ngày tạo / Ghi chú') }}</th>
                        <th>{{ __('Khách hàng') }}</th>
                        <th>{{ __('Trạng thái đơn hàng') }}</th>
                        <th>{{ __('Trạng thái thanh toán') }}</th>
                        <th>{{ __('Trạng thái giao hàng') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @include('admin.order.table')
                    </tbody>
                </table>
                <div class="render-paginate">
                    {{ $orderDetails->links('pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-after')
    <script>
        var url_update_status = `{{ route('order.update-status') }}`;
    </script>
    <script src="{{ asset('admin_assets/js/order.js') }}" type="module"></script>
@endsection

