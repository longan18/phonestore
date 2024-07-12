@php

use App\Enums\StatusOrder;
use App\Enums\StatusShippingOrder;
use App\Enums\StatusPaymentOrder;
@endphp
@forelse($orderDetails as $item)
    <tr data-order="{{ $item->id }}">
        <td class="text-center">{{ indexTable($orderDetails->currentPage(), $orderDetails->perPage(), $loop->index) }}</td>
        <td>
            <ol style="list-style-type: disc; margin: 0px; padding-left: 13px">
                <li><b>Mã: </b> <a href="{{ route('order.show', ['order' => $item->uuid]) }}">{{ $item->uuid }}</a></li>
                <li><b>Tổng tiền: </b> <i><span class="text-danger font-weight-bold">{{ formatCurrency($item->price_total).' đ' }}</span></i></li>
                <li><b>Tổng số lượng: </b> {{ $item->quantity_total }}</li>
            </ol>
        </td>
        <td>
            <ol style="list-style-type: disc; margin: 0px; padding-left: 13px">
                <li><b>Ngày tạo: </b> {{ $item->created_at }}</li>
            </ol>
        </td>
        <td>
            <ol style="list-style-type: disc; margin: 0px; padding-left: 13px">
                <li><b>Họ và tên: </b> <a href="{{ route('customer.show-infor', ['user' => $item->user->id]) }}">{{ $item->user->name }}</a></li>
                <li><b>Email: </b> {{ $item->user->email }}</li>
                <li><b>Số điện thoại: </b> {{ $item->user->phone }}</li>
            </ol>
        </td>
        <td>
            <select class="w-100 form-control filter-order status-order"
                @if($item->status_shipping == StatusShippingOrder::ORDER_SHIP_SUCCESSFUL->value)
                        disabled
                @endif
            >
                <option value="{{ $item->status }}">{{ $item->status_order->text_admin }}</option>
                @foreach(StatusOrder::cases() as $itemStatus)
                    @if($item->status != $itemStatus->value && $item->status != StatusOrder::ORDER_CANCEL->value)
                        <option value="{{ $itemStatus->value }}">{{ $itemStatus->getTextAdmin() }}</option>
                    @endif
                @endforeach
            </select>
        </td>
        <td>
            <select class="w-100 form-control filter-order status-payment"
                @if($item->status == StatusOrder::ORDER_WRATING->value || $item->status == StatusOrder::ORDER_CANCEL->value
                    || $item->status_payment == StatusPaymentOrder::ORDER_PAYMENT_PAID->value)
                    disabled
                @endif
            >
                <option value="{{ $item->status_payment }}">{{ $item->status_order_payment->text }}</option>
                @foreach(StatusPaymentOrder::cases() as $itemStatusPaymentOrder)
                    @if($item->status_payment != $itemStatusPaymentOrder->value)
                        <option value="{{ $itemStatusPaymentOrder->value }}">{{ $itemStatusPaymentOrder->getText() }}</option>
                    @endif
                @endforeach
            </select>
        </td>
        <td>
            <select class="w-100 form-control filter-order status-shipping"
                @if($item->status == StatusOrder::ORDER_WRATING->value || $item->status == StatusOrder::ORDER_CANCEL->value
                || $item->status_shipping == StatusShippingOrder::ORDER_SHIP_SUCCESSFUL->value)
                        disabled
                @endif
            >
                <option value="{{ $item->status_shipping }}">{{ $item->status_order_shipping->text }}</option>
                @foreach(StatusShippingOrder::cases() as $itemStatusShippingOrder)
                    @if($item->status_shipping != $itemStatusShippingOrder->value)
                        <option value="{{ $itemStatusShippingOrder->value }}">{{ $itemStatusShippingOrder->getText() }}</option>
                    @endif
                @endforeach
            </select>
        </td>
    </tr>
@empty
    <tr>
        <td class="text-center" colspan="9">{{ __('Không có dữ liệu.') }}</td>
    </tr>
@endforelse
