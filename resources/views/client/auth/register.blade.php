<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('client_assets/fonts/style.css') }}">

    <link rel="stylesheet" href="{{ asset('client_assets/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('client_assets/css/bootstrap.min.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('client_assets/css/style_login.css') }}">

    <title>{{ __('Đăng ký') }}</title>
    <style>
        input {
            font-size: 17px !important;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="container">
        <div class="row justify-content-center">
            <!-- <div class="col-md-6 order-md-2">
              <img src="images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
            </div> -->
            <div class="col-md-6 contents">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="form-block btn-pill">
                            <div class="mb-4">
                                <h3>{{ __('Đăng ký') }}</h3>
                            </div>
                            <form action="{{ route('client.register') }}" method="post">
                                @csrf

                                <div class="form-group first mb-0 mt-4 {{ old('phone') ? 'field--not-empty' : '' }}">
                                    <label for="name">{{ __('Họ tên:') }}</label>
                                    <input type="text" class="form-control" name="name" value="" autocomplete="off">
                                </div>
                                @error('name')
                                <span class="color-red fs-12">{{ $message }}</span>
                                @enderror

                                <div class="form-group first mb-0 mt-4 {{ old('phone') ? 'field--not-empty' : '' }}">
                                    <label for="phone">{{ __('Số điện thoại:') }}</label>
                                    <input type="text" class="form-control" name="phone" value="" autocomplete="off">
                                </div>
                                @error('phone')
                                <span class="color-red fs-12">{{ $message }}</span>
                                @enderror

                                <div class="form-group first mb-0 mt-4 {{ old('email') ? 'field--not-empty' : '' }}">
                                    <label for="email">{{ __('Email:') }}</label>
                                    <input type="text" class="form-control" name="email" value="" autocomplete="off">
                                </div>
                                @error('email')
                                <span class="color-red fs-12">{{ $message }}</span>
                                @enderror

                                <div class="form-group last mb-0 mt-4">
                                    <label for="password">{{ __('Mật khẩu:') }}</label>
                                    <input type="password" class="form-control" name="password" autocomplete="off">
                                </div>
                                @error('password')
                                <span class="color-red fs-12">{{ $message }}</span>
                                @enderror
                                <div class="form-group last mb-5 mt-4">
                                    <label for="password_confirmation">{{ __('Nhập lại mật khẩu:') }}</label>
                                    <input type="password" class="form-control" name="password_confirmation" autocomplete="off">
                                    @error('password_confirmation')
                                    <span class="color-red fs-12">{{ $message }}</span>
                                    @enderror
                                </div>

                                @if(session()->has('status') && !session()->get('status'))
                                    <div class="text-center mb-2 text-danger"><span>Đăng ký thất bại, vui lòng thử lại</span></div>
                                @endif
                                <button type="submit" value="Log In" class="btn btn-pill text-white btn-block btn-auth-action font-weight-bold"
                                        style="background-color: #38d39f">{{ __('Đăng ký') }}</button>
                                <span class="d-block text-center my-4 text-muted">{{ __('Bạn đã có tài khoản?') }}
                                    <a href="{{ route('client.page-login') }}" style="text-decoration: none"><b style="color: red; cursor: pointer">{{ __('Đăng nhập') }}</b></a>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<script src="{{ asset('client_assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('client_assets/js/popper.min.js') }}"></script>
<script src="{{ asset('client_assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('client_assets/js/main_login.js') }}"></script>
</body>
</html>
