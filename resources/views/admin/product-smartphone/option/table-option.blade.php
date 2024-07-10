@php($index = 1)
@forelse($options as $option)
    <tr>
{{--        <td class="text-center">{{ $index++ }}</td>--}}
        <td class="text-center">{{ $option->id }}</td>
        <td><img src="{{ asset($option->avatar) }}" width="100" height="100" class="object-fit-cover image-table" alt=""></td>
        <td><img src="{{ asset($option->thumb_option) }}" width="100" height="100" class="object-fit-cover image-table" alt=""></td>
        <td>{{ $option->ram->value }}</td>
        <td>{{ $option->storageCapacity->value }}</td>
        <td>{{ $option->remaining_capacity_is_approx }}</td>
        <td>{{ $option->color->color }}</td>
        <td>
{{--            <p class="mb-0">Giảm giá: 20%</p>--}}
{{--            <strike class="text-danger">{{ formatCurrency($option->price) }}</strike>--}}
            <p class="mb-0">{{ formatCurrency($option->price) }}</p>
        </td>
        <td>{{ $option->quantity }}</td>
        <td class="{{ $option->status_action->color }} msg-status fw-700"><b>{{ $option->status_action->text }}</b></td>
        <td>
           @if($option->status != UNKNOWN)
                <a href="{{ route('smartphone.option.show', ['product' => $product->slug, 'option' => $option->id]) }}" class="btn btn-warning mr-1">
                    {{ __('Sửa') }}
                </a>
                <button class="btn btn-danger delete-product-option"
                        data-url="{{ route('smartphone.option.update-status', ['option' => $option->id]) }}"
                        data-status="{{ UNKNOWN }}"
                        type="button">{{ __('Xóa') }}</button>
                <select class="btn border-0 update-status {{ $option->status_action->bg_btn }}"
                        data-url="{{ route('smartphone.option.update-status', ['option' => $option->id]) }}"
                        data-status="{{ $option->status }}"
                        style="height: 37px"
                >
                    <option value="{{ STOP_SELLING }}" @if($option->status == STOP_SELLING) selected @endif>Dừng bán</option>
                    <option value="{{ PUBLISH }}" @if($option->status == PUBLISH) selected @endif>Đăng bán</option>
                </select>
           @endif
        </td>
    </tr>
@empty
    <tr>
        <td class="text-center" colspan="9">{{ __('Không có dữ liệu.') }}</td>
    </tr>
@endforelse
