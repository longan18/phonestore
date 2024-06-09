@forelse($products as $product)
    <tr>
        <td class="text-center">{{ indexTable($products->currentPage(), $products->perPage(), $loop->index) }}</td>
        <td><img src="{{ asset($product->avatar) }}" width="100" height="100" class="object-fit-cover image-table" alt=""></td>
        <td>
            <div class="fs-14 mb-2"><b>{{ $product->name }}</b></div>
            <div>{{ __('Lượt xem:') }} 20</div>
            <div>{{ __('Yêu thích:') }} 20</div>
            <div>{{ __('Đã bán:') }} 20</div>
        </td>
        <td><img src="{{ $product->brand->avatar }}" width="100" height="100" class="object-fit-cover image-table" alt=""></td>
        <td>{{ $product->productSmartphonePrice->sum('quantity') }}</td>
        <td class="{{ $product->status_action->color }} msg-status fw-700"><b>{{ $product->status_action->text }}</b></td>
        <td>{{ formatTime($product->created_at) }}</td>
        <td>
            <a href="{{ route('smartphone.show', ['product' => $product->slug]) }}" class="btn btn-warning">{{ __('Sửa') }}</a>
            <button class="btn btn-danger delete-product" data-id="#" type="button">{{ __('Xóa') }}</button>
            <select class="btn border-0 update-status {{ $product->status_action->bg_btn }}"
                    data-url="{{ route('product.update-status', ['product' => $product->slug]) }}"
                    data-status="{{ $product->status }}"
                    style="height: 37px"
            >
                <option value="{{ STOP_SELLING }}" @if($product->status == STOP_SELLING) selected @endif>Dừng bán</option>
                <option value="{{ PUBLISH }}" @if($product->status == PUBLISH) selected @endif>Đăng bán</option>
            </select>
        </td>
    </tr>
@empty
    <tr>
        <td class="text-center" colspan="9">{{ __('Không có dữ liệu.') }}</td>
    </tr>
@endforelse
