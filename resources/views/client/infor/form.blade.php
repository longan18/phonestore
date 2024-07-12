<form action="{{ route('client.infor.update') }}" method="POST">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-8 col-12">
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="checkout__input">
                <p>{{ __('Địa chỉ giao hàng hiện tại') }}<span>*</span></p>
                <div class="d-flex align-items-center justify-content-between border-bottom pb-2">
                    @empty($addressAct->address->address_detail)
                        <div style="width: 81%; color: #988e8e">Chưa có địa chỉ giao hàng cố định, vui lòng chọn địa chỉ giao hàng cố định</div>
                    @else
                        <div style="width: 81%">{{ $addressAct->address->address_detail }}</div>
                    @endempty
                    <a href="{{ route('client.address.index') }}" class="btn btn-warning ml-2" style="width: 110px">Chỉnh sửa</a>
                </div>
            </div>
            <div class="checkout__input">
                <p>{{ __('Họ và tên') }}<span>*</span></p>
                <input type="text" value="{{ $user->name }}" name="name" autocomplete="off">
                @error('name')
                <span class="color-red fs-12">{{ $message }}</span>
                @enderror
            </div>
            <div class="checkout__input">
                <p>{{ __('Email') }}<span>*</span></p>
                <input type="text" value="{{ $user->email }}" name="email" autocomplete="off">
                @error('email')
                <span class="color-red fs-12">{{ $message }}</span>
                @enderror
            </div>
            <div class="checkout__input">
                <p>{{ __('Số điện thoại') }}<span>*</span></p>
                <input type="text" value="{{ $user->phone }}" name="phone" autocomplete="off">
                @error('phone')
                <span class="color-red fs-12">{{ $message }}</span>
                @enderror
            </div>
            <div class="checkout__input">
                <p>{{ __('Thay đổi mật khẩu') }}</p>
                <input type="password" value="" name="password" autocomplete="off">
                @error('password')
                <span class="color-red fs-12">{{ $message }}</span>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">{{ __('Cập nhật') }}</button>
            </div>
        </div>
    </div>
</form>

