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
        <td class="{{ $option->status_action->color }} msg-status fw-700"><b>{{ $option->status_action->text }}</b></td>
        <td class="d-flex">
            <button class="btn btn-warning edit-product mr-1"
                    data-url="{{ route('smartphone.option.show', ['product' => $product->slug, 'option' => $option->id]) }}"
                    type="button">{{ __('Sửa') }}</button>
            <button class="btn btn-danger delete-product mr-1" data-id="#" type="button">{{ __('Xóa') }}</button>
            <select class="btn border-0 update-status {{ $option->status_action->bg_btn }}"
                    data-url="{{ route('smartphone.option.update-status', ['option' => $option->id]) }}"
                    data-status="{{ $option->status }}"
                    style="height: 37px"
            >
                <option value="{{ STOP_SELLING }}" @if($option->status == STOP_SELLING) selected @endif>Dừng bán</option>
                <option value="{{ PUBLISH }}" @if($option->status == PUBLISH) selected @endif>Đăng bán</option>
            </select>
        </td>
    </tr>
@empty
    <tr>
        <td class="text-center" colspan="9">{{ __('Không có dữ liệu.') }}</td>
    </tr>
@endforelse
