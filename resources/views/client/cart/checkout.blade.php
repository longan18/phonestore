<h5 class="title-payment">Thanh toán</h5>
<section class="pb-3 border-ebebeb">
    <div class="title-checkout-quantity"><b>Thông tin khách hàng: </b></div>
    <ur style="list-style-type: disc">
        <li><b>Họ và tên: </b>{{ userInfo()->name }}</li>
        <li><b>Email: </b>{{ userInfo()->email }}</li>
        <li><b>Số điện thoại: </b>{{ userInfo()->phone }}</li>

        <li><b>Địa chỉ giao hàng</b> (<a href="{{ route('client.address.index') }}">Thay đổi địa chỉ giao hàng</a>) <sup class="text-danger">*</sup>: @if(empty($addressAct)) <p class="d-inline-block" style="color: #a3a6a3">Chưa có địa chỉ giao hàng cố định</p> @endif</li>
        @if(!empty($addressAct))
            <ol class="ml-5" style="list-style-type: circle">
                <li><b>Tỉnh/ thành phố: </b>{{ $addressAct->province }}</li>
                <li><b>Quận / huyện / thị xã: </b>{{ $addressAct->province }}</li>
                <li><b>Phường / xã: </b>{{ $addressAct->province }}</li>
                <li><b>Địa chỉ chi tiết: </b>{{ $addressAct->address_detail }}</li>
            </ol>
        @endif
    </ur>
</section>
<div class="d-flex justify-content-between mt-3 pb-3 border-ebebeb">
    <div class="title-checkout-quantity">Số sản phẩm trong giỏ: </div>
    <div class="text-danger"><span class="value-quantity" data-value="{{ optional($shoppingItems)->total() ?? 0 }}">{{ optional($shoppingItems)->total() ?? 0 }}</span> sản phẩm</div>
</div>
<div class="d-flex justify-content-between mt-3 pb-3 border-ebebeb">
    <div>Tổng đơn giá: </div>
    <div class="text-danger">
        <span class="value-price-default" data-value="{{ $shoppingSession ? $shoppingSession->shoppingItems->sum('price') : 0 }}">
            {{ $shoppingSession ? formatCurrency($shoppingSession->shoppingItems->sum('price')) : 0 }}
        </span><sup class="text-danger">đ</sup>
    </div>
</div>
<div class="d-flex justify-content-between mt-3 mb-3">
    <div>Tổng tiền: </div>
    <div class="text-danger">
        <span class="value-price-total" data-value="{{ $shoppingSession ? $shoppingSession->price_total : 0 }}">
            {{ $shoppingSession ? formatCurrency($shoppingSession->price_total) : 0 }}
        </span><sup class="text-danger">đ</sup>
    </div>
</div>
@if($shoppingItems && $shoppingItems->total())
    @if(!empty($addressAct))
        <div class="d-flex" data-address-act="{{ $addressAct->id }}" @if($shoppingSession) data-shopping-session="{{ $shoppingSession->id }}" @endif >
            <button class="btn btn-success w-50 mr-2 font-weight-bold" id="checkout-vnpay" style="font-size: 20px">Thanh toán qua VnPay</button>
            <button class="btn btn-primary w-50 font-weight-bold" id="checkout-postpaid" style="font-size: 20px">Thanh toán trả sau</button>
        </div>
    @else
        <div class="d-flex justify-content-end">
            <a href="{{ route('client.address.index') }}" class="btn btn-warning">Thêm địa chỉ giao hàng</a>
        </div>
    @endif
@endif
