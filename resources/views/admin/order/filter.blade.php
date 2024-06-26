<div class="mb-3">
    <form action="#" id="fillter-order" method="GET">
        <div class="row">
            <div class="col-3">
                <label class="m-0 mr-2">Tìm kiếm theo mã đơn hàng, email khách hàng</label>
                <input name="key_search" class="w-100 form-control" type="text" placeholder="Tìm kiếm">
            </div>
            <div class="col-3">
                <label class="m-0 mr-2">Tìm kiếm theo trạng thái đơn hàng</label>
                <select class="w-100 form-control filter-order" name="status">
                    @foreach(\App\Enums\StatusOrder::cases() as $item)
                        <option value="{{ $item->value }}">{{ $item->getTextAdmin() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-3">
                <label class="m-0 mr-2">Tìm kiếm theo trạng thái thanh toán</label>
                <select class="w-100 form-control filter-order" name="status_payment">
                    @foreach(\App\Enums\StatusPaymentOrder::cases() as $item)
                        <option value="{{ $item->value }}">{{ $item->getText() }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-3">
                <label class="m-0 mr-2">Tìm kiếm theo trạng thái giao hàng</label>
                <select class="w-100 form-control filter-order" name="status_shipping">
                    @foreach(\App\Enums\StatusShippingOrder::cases() as $item)
                        <option value="{{ $item->value }}">{{ $item->getText() }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <label class="m-0 mr-2">Tìm kiếm theo khoảng giá</label>
                <div class="d-flex">
                    <input class="form-control w-100 mr-1 filter-order" placeholder="Khoảng giá bắt đầu" data-name="price" name="start_price"/> <b>~</b>
                    <input class="form-control w-100 ml-1 filter-order" placeholder="Khoảng giá kết thúc" data-name="price" name="end_price"/>
                </div>
            </div>
            <div class="col-4">
                <label class="m-0 mr-2"><b>{{ __('Ngày:') }}</b></label>
                <div class="d-flex">
                    <input class="form-control w-100 search-status datepicker mr-1 filter-order" placeholder="Khoảng thời gian bắt đầu" name="start_date"/> <b>~</b>
                    <input class="form-control w-100 search-status datepicker ml-1 filter-order" placeholder="Khoảng thời gian kết thúc" name="end_date"/>
                </div>
            </div>
            <div class="col-4">
                <label class="m-0 mr-2"></label>
                <button class="form-control btn btn-blue fillter-order" type="button">Tìm kiếm</button>
            </div>
        </div>
    </form>
</div>
