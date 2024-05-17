<div>
    <div class="row d-flex px-3 mb-3 align-items-center">
        <label class="m-0 mr-2"><b>{{ __('Thương hiệu:') }}</b></label>
        <select class="select2-multiple form-control w-10 filter-product" data-name="brand_id">
            <option value="">{{ __('Chọn nhãn hiệu') }}</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}" {{ handleSelected($brand->id, $product->brand_id ?? null) }}>{{ $brand->name }}</option>
            @endforeach
        </select>
        <label class="m-0 ml-4 mr-2"><b>{{ __('Trạng thái:') }}</b></label>
        <select class="form-control w-10 filter-product" data-name="status">
            <option value="">{{ __('Tất cả') }}</option>
            <option value="">{{ __('Dừng bán') }}</option>
            <option value="">{{ __('Đang bán') }}</option>
        </select>
        <label class="m-0 ml-4 mr-2"><b>{{ __('Ngày:') }}</b></label>
        <input class="form-control w-10 search-status datepicker mr-1 filter-product" data-name="start_date"/> <b>~</b>
        <input class="form-control w-10 search-status datepicker ml-1 filter-product" data-name="end_date"/>
    </div>
    <div class="w-30 ml-0 mb-3 position-relative">
        <i class="fa fa-search position-absolute position-search cursor-pointer" aria-hidden="true"></i>
        <input name="key_search" class="form-control" type="text" placeholder="Tìm kiếm">
    </div>
</div>
