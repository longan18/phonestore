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
                <div class="position-relative">
                    <input type="password" value="" name="password" autocomplete="off">

                    <div class="position-absolute show-password" style="top: 11px; right: 17px">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="show-password">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.2401 7.87114C4.55207 9.2374 3.26205 10.8698 2.5474 11.8804C2.51717 11.9232 2.50684 11.9641 2.50684 12C2.50684 12.0359 2.51717 12.0768 2.54739 12.1196C3.26205 13.1302 4.55207 14.7626 6.2401 16.1289C7.93837 17.5034 9.90321 18.5 12.0003 18.5C14.0974 18.5 16.0622 17.5034 17.7605 16.1289C19.4485 14.7626 20.7385 13.1302 21.4532 12.1196C21.4834 12.0768 21.4937 12.0359 21.4937 12C21.4937 11.9641 21.4834 11.9232 21.4532 11.8804C20.7385 10.8698 19.4485 9.2374 17.7605 7.87114C16.0622 6.4966 14.0974 5.5 12.0003 5.5C9.90321 5.5 7.93837 6.4966 6.2401 7.87114ZM1.32267 11.0144C0.90156 11.6099 0.901559 12.3901 1.32266 12.9856C2.83498 15.1243 6.84778 20 12.0003 20C17.1528 20 21.1656 15.1243 22.6779 12.9856C23.099 12.3901 23.099 11.6099 22.6779 11.0144C21.1656 8.87572 17.1528 4 12.0003 4C6.84778 4 2.83498 8.87572 1.32267 11.0144Z" fill="#26282C"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0003 14.5C13.381 14.5 14.5003 13.3807 14.5003 12C14.5003 10.6193 13.381 9.5 12.0003 9.5C10.6196 9.5 9.50029 10.6193 9.50029 12C9.50029 13.3807 10.6196 14.5 12.0003 14.5ZM16.0003 12C16.0003 14.2091 14.2094 16 12.0003 16C9.79115 16 8.00029 14.2091 8.00029 12C8.00029 9.79086 9.79115 8 12.0003 8C14.2094 8 16.0003 9.79086 16.0003 12Z" fill="#26282C"></path>
                        </svg>
                    </div>
                </div>
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

