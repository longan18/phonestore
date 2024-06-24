@forelse($carts as $item)
    <tr>
        <td class="text-center">{{ indexTable($carts->currentPage(), $carts->perPage(), $loop->index) }}</td>
        <td></td>
        <td>{{ $item->product->name }}</td>
        <td>{{ formatCurrency($item->price) }}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ formatCurrency($item->total_price_item) }}</td>
        <td class="d-flex justify-content-center">
            <button class="btn btn-warning d-flex justify-content-center align-items-center class-show-modal show-attr-shopping-item"
            data-name="{{ $item->product->name }}" data-price="{{ $item->price }}" data-qty="{{ $item->quantity }}"
            data-price-total="{{ $item->total_price_item }}" data-ram="{{ $item->ram->value }}" data-storage="{{ $item->storage_capacity->value }}"
            data-color="{{ $item->color->color }}" data-storage-after="{{ $item->productPrice->remaining_capacity_is_approx ?? '' }}"
            ><i class="fa fa-eye m-0"></i></button>
        </td>
    </tr>
@empty
    <tr>
        <td class="text-center" colspan="9">{{ __('Không có dữ liệu.') }}</td>
    </tr>
@endforelse
