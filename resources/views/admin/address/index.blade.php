@extends('admin.layouts.admin')

@section('title')
    {{ __('Danh sách địa chỉ giao hàng') }}
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard mr-2"></i>{{ __('Danh sách địa chỉ giao hàng') }}</h1>
            <p>{{ __('Danh sách địa chỉ giao hàng') }}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">{{ __('Danh sách người dùng') }}</a></li>
            <li class="breadcrumb-item"><a href="#">{{ __('Danh sách địa chỉ giao hàng') }}</a></li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="tile" id="list-product">
                <div class="d-flex justify-content-between">
                    <h3 class="tile-title">{{ __('Danh sách địa chỉ giao hàng') }} <span>- {{ $user->name }}</span></h3>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>{{ __('Tỉnh/thành phố') }}</th>
                        <th>{{ __('Quận/huyện/thị xã') }}</th>
                        <th>{{ __('Phường/xã') }}</th>
                        <th style="width: 720px">{{ __('Địa chỉ chi tiết') }}</th>
                        <th class="text-center">{{ __('Trạng thái') }}</th>
                        <th>{{ __('Ngày tạo') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($index = 0)
                    @forelse($address as $item)
                        <tr>
                            <td class="text-center">{{ ++$index }}</td>
                            <td>{{ $item->province }}</td>
                            <td>{{ $item->district }}</td>
                            <td>{{ $item->ward }}</td>
                            <td>{{ $item->address_detail }}</td>
                            @if($item->active == \App\Enums\AddressShippingEnum::ACTIVE->value)
                                <td class="text-center"><i class="fa fa-tag text-warning" style="font-size: 20px"></i></td>
                            @else
                                <td></td>
                            @endif
                            <td>{{ $item->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="9">{{ __('Không có dữ liệu.') }}</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script-after')

@endsection

