@forelse($products as $product)
    <tr>
        <td class="text-center">{{ indexTable($products->currentPage(), $products->perPage(), $loop->index) }}</td>
        <td><img src="{{ asset($product->avatar) }}" width="100" height="100" class="object-fit-cover image-table" alt=""></td>
        <td>
            <div class="font-14 mb-2"><b>{{ $product->name }}</b></div>
            <div>{{ __('Lượt xem:') }} 20</div>
            <div>{{ __('Yêu thích:') }} 20</div>
            <div>{{ __('Đã bán:') }} 20</div>
        </td>
        <td><img src="{{ $product->brand->avatar }}" width="100" height="100" class="object-fit-cover image-table" alt=""></td>
        <td class="#"><b>#</b></td>
        <td>{{ formatTime($product->created_at) }}</td>
        <td>
            <button class="btn btn-warning edit-product" data-url="{{ route('smartphone.show', ['product' => $product->slug]) }}" type="button">{{ __('Sửa') }}</button>
            <button class="btn btn-danger delete-product" data-id="#" type="button">{{ __('Xóa') }}</button>
            <select class="btn border-0 bg-lg-FFF-EF0D0D" style="height: 37px">
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
