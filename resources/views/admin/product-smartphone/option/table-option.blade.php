@php($index = 1)
@forelse($options as $option)
    <tr>
        <td class="text-center">{{ $index++ }}</td>
        <td>{{ $option->ram->value }}</td>
        <td>{{ $option->storageCapacity->value }}</td>
        <td>{{ $option->remaining_capacity_is_approx }}</td>
        <td><div style="width: 100%; height: 38px; background-color: {{ $option->color->hex_color }}"></div></td>
        <td>{{ formatCurrency($option->price) }}</td>
        <td>{{ $option->quantity }}</td>
        <td class="text-danger"><b>Dừng bán</b></td>
        <td class="d-flex">
            <button class="btn btn-warning edit-product mr-3"
                    data-url="{{ route('smartphone.option.show', ['product' => $product->slug, 'option' => $option->id]) }}"
                    type="button">{{ __('Sửa') }}</button>
            <select class="btn border-0 bg-lg-FFF-EF0D0D">
                <option value="">Dừng bán</option>
                <option value="">Đăng bán</option>
            </select>
        </td>
    </tr>
@empty
    <tr>
        <td class="text-center" colspan="9">{{ __('Không có dữ liệu.') }}</td>
    </tr>
@endforelse
