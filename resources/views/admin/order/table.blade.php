@forelse($orderDetails as $item)
    <tr>
        <td class="text-center">{{ indexTable($orderDetails->currentPage(), $orderDetails->perPage(), $loop->index) }}</td>
        <td>
            <ol style="list-style-type: disc; margin: 0px; padding-left: 13px">
                <li><b>Mã: </b> {{ $item->uuid }}</li>
                <li><b>Tổng tiền: </b> <i><span class="text-danger font-weight-bold">{{ formatCurrency($item->price_total).' đ' }}</span></i></li>
                <li><b>Tổng số lượng: </b> {{ $item->quantity_total }}</li>
            </ol>
        </td>
        <td>
            <ol style="list-style-type: disc; margin: 0px; padding-left: 13px">
                <li><b>Ngày tạo: </b> {{ $item->created_at }}</li>
                <li><b>Ghi chú: </b> <i style="color: #7992a3">{{ $item->note }}</i></li>
            </ol>
        </td>
        <td>
            <ol style="list-style-type: disc; margin: 0px; padding-left: 13px">
                <li><b>Họ và tên: </b> {{ $item->user->name }}</li>
                <li><b>Email: </b> {{ $item->user->email }}</li>
                <li><b>Số điện thoại: </b> {{ $item->user->phone }}</li>
            </ol>
        </td>
        <td>
            <select class="w-100 form-control filter-order">
                @foreach(\App\Enums\StatusOrder::cases() as $item)
                    <option value="{{ $item->value }}">{{ $item->getTextAdmin() }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <select class="w-100 form-control filter-order">
                @foreach(\App\Enums\StatusPaymentOrder::cases() as $item)
                    <option value="{{ $item->value }}">{{ $item->getText() }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <select class="w-100 form-control filter-order">
                @foreach(\App\Enums\StatusShippingOrder::cases() as $item)
                    <option value="{{ $item->value }}">{{ $item->getText() }}</option>
                @endforeach
            </select>
        </td>
    </tr>
@empty
    <tr>
        <td class="text-center" colspan="9">{{ __('Không có dữ liệu.') }}</td>
    </tr>
@endforelse
