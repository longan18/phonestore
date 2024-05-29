<div class="w-60 mb-3">
    <form action="{{ route('smartphone.index') }}" id="fillter-product" method="GET">
        <div class="row">
            <div class="col-12 col-md-4">
                <label class="m-0 mr-2"><b>{{ __('Thương hiệu:') }}</b></label>
                <select class="w-100 form-control filter-product" name="brand_id">
                    <option value="">{{ __('Chọn nhãn hiệu') }}</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ handleSelected($brand->id, $product->brand_id ?? null) }}>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-4">
                <label class="m-0 mr-2"><b>{{ __('Trạng thái:') }}</b></label>
                <select class="form-control w-100 filter-product" name="status">
                    <option value=>{{ __('Tất cả') }}</option>
                    <option value="{{ \App\Enums\Status::StopSelling->value }}">{{ __('Dừng bán') }}</option>
                    <option value="{{ \App\Enums\Status::Publish->value }}">{{ __('Đang bán') }}</option>
                </select>
            </div>
            <div class="col-12 col-md-4">
                <label class="m-0 mr-2"><b>{{ __('Ngày:') }}</b></label>
                <div class="d-flex">
                    <input class="form-control w-100 search-status datepicker mr-1 filter-product" name="start_date"/> <b>~</b>
                    <input class="form-control w-100 search-status datepicker ml-1 filter-product" name="end_date"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <label class="m-0 mr-2"><b>{{ __('Tên sản phẩm:') }}</b></label>
                <input name="key_search" class="w-100 form-control" type="text" placeholder="Tìm kiếm">
            </div>
            <div class="col-12 col-md-4">
                <label class="m-0 mr-2"><b>{{ __('Khoảng giá:') }}</b></label>
                <div class="d-flex">
                    <input class="form-control w-100 mr-1 filter-product" data-name="price" name="start_price"/> <b>~</b>
                    <input class="form-control w-100 ml-1 filter-product" data-name="price" name="end_price"/>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <label class="m-0 mr-2"></label>
                <button class="form-control btn btn-blue fillter-product" type="button">Tìm kiếm</button>
            </div>
        </div>
    </form>
</div>
