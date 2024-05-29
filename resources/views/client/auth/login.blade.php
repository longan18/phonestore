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

    <title>{{ __('Đăng nhập') }}</title>
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
                                @if(session('errorMessage'))
                                <span class="color-red font-20">{{ session('errorMessage') }}</span>
                                @endif
                                <h3>{{ __('Đăng nhập') }}</h3>
                            </div>
                            <form action="{{ route('client.login') }}" method="post">
                                @csrf
                                <div class="form-group first mb-0 mt-3">
                                    <label for="user_name">{{ __('Số điện thoại/Email:') }}</label>
                                    <input type="text" class="form-control" id="user_name" name="phone">
                                </div>
                                @error('phone')
                                <span class="color-red font-12">{{ $message }}</span>
                                @enderror

                                <div class="form-group last mb-0 mt-3">
                                    <label for="password">{{ __('Mật khẩu:') }}</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                @error('password')
                                <span class="color-red font-12">{{ $message }}</span>
                                @enderror

                                <div class="d-flex mb-5 align-items-center mt-5">
                                    <label class="control control--checkbox mb-0"><span class="caption">{{ __('Ghi nhớ') }}</span>
                                        <input type="checkbox" checked="checked"/>
                                        <div class="control__indicator"></div>
                                    </label>
                                    <span class="ml-auto"><a href="#" class="forgot-pass">{{ __('Quên mật khẩu?') }}</a></span>
                                </div>

                                <button type="submit" class="btn btn-pill text-white btn-block btn-auth-action" style="background-color: #38d39f">{{ __('Đăng nhập') }}</button>

                                <span class="d-block text-center my-4 text-muted">{{ __('Lựa chọn đăng nhập khác') }}</span>

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

                                <span class="d-block text-center my-4 text-muted">{{ __('Bạn mới biết đến shop?') }}
                                    <a href="{{ route('client.registerView') }}" style="text-decoration: none"><b style="color: red; cursor: pointer">{{ __('Đăng ký') }}</b></a>
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
