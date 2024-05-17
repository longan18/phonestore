<div class="col-12 storehouse-sub mb-3">
    <div class="row w-100">
        <div class="col-5">
            <label>{{ __('Size:') }}</label>
            <input name="storehouse[{{$index}}][name]" class="form-control" value="{{ $name ?? '' }}">
        </div>
        <div class="col-5">
            <label>{{ __('Số lượng:') }}</label>
            <input name="storehouse[{{$index}}][quantity]" class="form-control" type="number" value="{{ $quantity ?? '' }}">
        </div>
        <div class="col-2 mt-1">
            <div class="btn btn-primary icon-btn mt-4 btn-storehouse">
                <i class="fa fa-plus"></i>
            </div>
        </div>
    </div>
    <div class="row error-message error_storehouse_{{$index}}_name"></div>
    <div class="row error-message error_storehouse_{{$index}}_quantity"></div>
</div>
