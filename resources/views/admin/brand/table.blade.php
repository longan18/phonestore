@forelse($brands as $brand)
    <tr>
        <td class="text-center">{{ indexTable($brands->currentPage(), $brands->perPage(), $loop->index) }}</td>
        <td class="note-unknown">
            <div class="fs-14 mb-2"><b>{{ $brand->name }}</b></div>
            @if($brand->status == UNKNOWN)
                <p class="color-999595"><i>Thương hiệu này đã được xóa vào thời gian <br> {{ $brand->updated_at }}</i></p>
            @endif
        </td>
        <td><img src="{{ asset($brand->avatar) }}" width="100" height="100" class="object-fit-cover image-table" alt=""></td>
        <td>{{ formatTime($brand->created_at) }}</td>
        <td class="{{ $brand->status_action->color }} msg-status fw-700"><b>{{ $brand->status_action->text }}</b></td>
        <td>
            @if($brand->status != UNKNOWN)
                <button class="btn btn-warning edit-brand" data-url="{{ route('brands.show', $brand->id) }}" type="button">{{ __('Sửa') }}</button>
                <button class="btn btn-danger delete-brand"
                        data-url="{{ route('brands.update', ['brand' => $brand->id]) }}"
                        data-status="{{ UNKNOWN }}"
                        type="button">{{ __('Xóa') }}</button>
                <select class="btn border-0 update-status {{ $brand->status_action->bg_btn }}"
                        data-url="{{ route('brands.update', ['brand' => $brand->id]) }}"
                        data-status="{{ $brand->status }}"
                        style="height: 37px"
                >
                    <option value="{{ STOP_SELLING }}" @if($brand->status == STOP_SELLING) selected @endif>Dừng bán</option>
                    <option value="{{ PUBLISH }}" @if($brand->status == PUBLISH) selected @endif>Đăng bán</option>
                </select>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td class="text-center" colspan="5">{{ __('Không có dữ liệu.') }}</td>
    </tr>
@endforelse
