<div class="row d-flex justify-content-center">
    <div class="col-6 d-flex justify-content-between">
        <a href="{{ route('client.infor.index', ['user' => auth()->guard(GUARD_WEB)->user()->id]) }}"><h4 class="@if(request()->routeIs('client.infor.index')) text-danger @endif">Thông tin chi tiết</h4></a>
        <a href="{{ route('client.address.index') }}"><h4 class="@if(request()->routeIs('client.address.index')) text-danger @endif">Địa chỉ giao hàng</h4></a>
        <a href="#"><h4>Đơn hàng</h4></a>
    </div>
</div>
