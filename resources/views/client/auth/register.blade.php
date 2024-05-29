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
                        <div class="form-block">
                            <div class="mb-4">
                                <h3>{{ __('Đăng ký') }}</h3>
                            </div>
                            <form action="{{ route('client.register') }}" method="post">
                                @csrf

                                <div class="form-group first mb-0 mt-3 {{ old('phone') ? 'field--not-empty' : '' }}">
                                    <label for="name">{{ __('Họ tên:') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                </div>
                                @error('name')
                                <span class="color-red font-12">{{ $message }}</span>
                                @enderror

                                <div class="form-group first mb-0 mt-3 {{ old('phone') ? 'field--not-empty' : '' }}">
                                    <label for="phone">{{ __('Số điện thoại:') }}</label>
                                    <input type="number" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                                </div>
                                @error('phone')
                                <span class="color-red font-12">{{ $message }}</span>
                                @enderror

                                <div class="form-group first mb-0 mt-3 {{ old('email') ? 'field--not-empty' : '' }}">
                                    <label for="email">{{ __('Email:') }}</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                </div>
                                @error('email')
                                <span class="color-red font-12">{{ $message }}</span>
                                @enderror

                                <div class="form-group last mb-0 mt-3">
                                    <label for="password">{{ __('Mật khẩu:') }}</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                @error('password')
                                <span class="color-red font-12">{{ $message }}</span>
                                @enderror

                                <div class="form-group last mb-5 mt-3">
                                    <label for="password_confirmation">{{ __('Mật khẩu:') }}</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>

                                <button type="submit" value="Log In" class="btn btn-pill text-white btn-block btn-auth-action" style="background-color: #38d39f">{{ __('Đăng ký') }}</button>
                                <span class="d-block text-center my-4 text-muted">{{ __('Lựa chọn đăng ký khác') }}</span>
                                <div class="social-login text-center">
                                    <a href="#" class="facebook">
                                        <span class="icon-facebook mr-3"></span>
                                    </a>
                                    <a href="#" class="twitter">
                                        <span class="icon-twitter mr-3"></span>
                                    </a>
                                    <a href="#" class="google">
                                        <span class="icon-google mr-3"></span>
                                    </a>
                                </div>
                                <span class="d-block text-center my-4 text-muted">{{ __('Bạn đã có tài khoản?') }}
                                    <a href="{{ route('client.loginView') }}" style="text-decoration: none"><b style="color: red; cursor: pointer">{{ __('Đăng nhập') }}</b></a>
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
