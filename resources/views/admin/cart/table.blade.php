@forelse($carts as $item)
    <tr>
        <td class="text-center">{{ indexTable($carts->currentPage(), $carts->perPage(), $loop->index) }}</td>
        <td><img src="{{ asset($item->productPrice->avatar) }}" width="100" height="100" class="object-fit-cover image-table" alt=""></td>
        <td>
            <div style="margin-left: 20px">
                <ol class="text-left" style="list-style-type: disc">
                    <li><span>Tên sản phẩm: </span>{{ $item->product->name }}</li>
                    <li><span>Ram: </span>{{ $item->productPrice->ram->value }}</li>
                    <li><span>Bộ nhớ trong: </span>{{ $item->productPrice->storageCapacity->value }}</li>
                    <li><span>Màu: </span>{{ $item->productPrice->color->color }}</li>
                </ol>
            </div>
        </td>
        <td>{{ formatCurrency($item->price) }}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ formatCurrency($item->total_price_item) }}</td>
    </tr>
@empty
    <tr>
        <td class="text-center" colspan="9">{{ __('Không có dữ liệu.') }}</td>
    </tr>
@endforelse
