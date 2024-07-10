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
            <div class="col-md-6 contents">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="form-block btn-pill">
                            <div class="mb-4">
                                <h3>{{ __('Lấy lại mật khẩu') }}</h3>
                            </div>
                            <form action="{{ route('client.forgot-password-send-email') }}" method="post">
                                @csrf
                                <div class="form-group first mb-0 mt-4">
                                    <label for="user_name">{{ __('Email:') }}</label>
                                    <input type="text" class="form-control" name="email" autocomplete="off">
                                </div>
                                @error('email')
                                <span class="color-red fs-12">{{ $message }}</span>
                                @enderror
                                @if(session()->has('status'))
                                    @if(session()->get('status'))
                                        <div class="text-center mb-2 text-success"><span>{{session()->get('status')}}</span></div>
                                    @endif
                                @endif
                                <div class="d-flex mb-3 align-items-center mt-5">
                                </div>
                                <button type="submit" class="btn btn-pill text-white btn-block btn-auth-action font-weight-bold"
                                        style="background-color: #0015f6">{{ __('Lấy lại mật khẩu') }}</button>
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
