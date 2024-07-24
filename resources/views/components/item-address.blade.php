<div class="item-address">
    <div class="d-flex content-item-address">
        <ur class="w-100">
            <li><span class="d-inline-block w-25 font-weight-bold">Tỉnh / thành phố: </span>{{ $province }}</li>
            <li><span class="d-inline-block w-25 font-weight-bold">Quận / huyện / thị xã: </span>{{ $district }}</li>
            <li><span class="d-inline-block w-25 font-weight-bold">Phường / xã: </span>{{ $ward }}</li>
            <div class="d-flex">
                <li class="w-39"><span class="w-100 font-weight-bold">Địa chỉ chi tiết: </span></li>
                <p class="text-left text-dark w-100">{{ $addresDetail }}</p>
            </div>
        </ur>
        <div class="d-flex flex-column justify-content-center w-10 mb-3">
            <button class="w-100 mb-1 btn {{ $act ? 'btn-warning' : 'btn-primary' }} act-address" data-id="{{ $id }}"><i class="fa fa-tag"></i></button>
            <button class="w-100 btn btn-danger remove-address" data-id="{{ $id }}"><i class="fa fa-trash"></i></button>
        </div>
    </div>
    <hr class="mt-0">

</div>
