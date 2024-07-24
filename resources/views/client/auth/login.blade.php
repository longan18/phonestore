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
            <!-- <div class="col-md-6 order-md-2">
              <img src="images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
            </div> -->
            <div class="col-md-6 contents">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="form-block btn-pill">
                            <div class="mb-4">
                                @if(session('errorMessage'))
                                <span class="color-red fs-20">{{ session('errorMessage') }}</span>
                                @endif
                                <h3>{{ __('Đăng nhập') }}</h3>
                            </div>
                            <form action="{{ route('client.login') }}" method="post">
                                @csrf
                                <div class="form-group first mb-0 mt-4">
                                    <label for="user_name">{{ __('Email:') }}</label>
                                    <input type="text" class="form-control" name="email" autocomplete="off">
                                </div>
                                @error('email')
                                <span class="color-red fs-12">{{ $message }}</span>
                                @enderror

                                <div class="form-group last mb-0 mt-4">
                                    <label for="password">{{ __('Mật khẩu:') }}</label>
                                    <div class="position-relative">
                                        <input type="password" class="form-control" name="password" autocomplete="off">

                                        <div class="position-absolute show-password" style="top: 11px; right: 17px">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="show-password">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.2401 7.87114C4.55207 9.2374 3.26205 10.8698 2.5474 11.8804C2.51717 11.9232 2.50684 11.9641 2.50684 12C2.50684 12.0359 2.51717 12.0768 2.54739 12.1196C3.26205 13.1302 4.55207 14.7626 6.2401 16.1289C7.93837 17.5034 9.90321 18.5 12.0003 18.5C14.0974 18.5 16.0622 17.5034 17.7605 16.1289C19.4485 14.7626 20.7385 13.1302 21.4532 12.1196C21.4834 12.0768 21.4937 12.0359 21.4937 12C21.4937 11.9641 21.4834 11.9232 21.4532 11.8804C20.7385 10.8698 19.4485 9.2374 17.7605 7.87114C16.0622 6.4966 14.0974 5.5 12.0003 5.5C9.90321 5.5 7.93837 6.4966 6.2401 7.87114ZM1.32267 11.0144C0.90156 11.6099 0.901559 12.3901 1.32266 12.9856C2.83498 15.1243 6.84778 20 12.0003 20C17.1528 20 21.1656 15.1243 22.6779 12.9856C23.099 12.3901 23.099 11.6099 22.6779 11.0144C21.1656 8.87572 17.1528 4 12.0003 4C6.84778 4 2.83498 8.87572 1.32267 11.0144Z" fill="#26282C"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0003 14.5C13.381 14.5 14.5003 13.3807 14.5003 12C14.5003 10.6193 13.381 9.5 12.0003 9.5C10.6196 9.5 9.50029 10.6193 9.50029 12C9.50029 13.3807 10.6196 14.5 12.0003 14.5ZM16.0003 12C16.0003 14.2091 14.2094 16 12.0003 16C9.79115 16 8.00029 14.2091 8.00029 12C8.00029 9.79086 9.79115 8 12.0003 8C14.2094 8 16.0003 9.79086 16.0003 12Z" fill="#26282C"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                @error('password')
                                <span class="color-red fs-12">{{ $message }}</span>
                                @enderror

                                <div class="d-flex mb-3 align-items-center mt-5">
{{--                                    <label class="control control--checkbox mb-0"><span class="caption">{{ __('Ghi nhớ') }}</span>--}}
{{--                                        <input type="checkbox" checked="checked"/>--}}
{{--                                        <div class="control__indicator"></div>--}}
{{--                                    </label>--}}
{{--                                    <span class="ml-auto"><a href="#" class="forgot-pass">{{ __('Quên mật khẩu?') }}</a></span>--}}
                                </div>
                                @if(session()->has('status'))
                                    @if(session()->get('status'))
                                        <div class="text-center mb-2 text-success"><span>Đăng ký thành công, hãy đăng nhập để sử dụng dịch vụ</span></div>
                                    @else
                                        <div class="text-center mb-2 text-danger"><span>Tài khoản không tồn tại, vui lòng thử lại</span></div>
                                    @endif

                                @endif
                                <button type="submit" class="btn btn-pill text-white btn-block btn-auth-action font-weight-bold"
                                        style="background-color: #0015f6">{{ __('Đăng nhập') }}</button>
                                    <span class="d-block text-center mt-4 text-muted">{{ __('Bạn quên mật khẩu?') }}
                                        <a href="{{ route('client.forgot-password') }}" style="text-decoration: none"><b style="color: red; cursor: pointer">{{ __('Quên mật khẩu') }}</b></a></span>
                                    <span class="d-block text-center mb-4 text-muted">{{ __('Bạn mới biết đến shop?') }}
                                    <a href="{{ route('client.page-register') }}" style="text-decoration: none"><b style="color: red; cursor: pointer">{{ __('Đăng ký') }}</b></a>
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
<script>
    var SHOW_PASSWORD = true;
    $('.show-password').on('click', function () {
        if (SHOW_PASSWORD) {
            $('.show-password').empty().append(` <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" class="show-password">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.2401 7.87114C4.55207 9.2374 3.26205 10.8698 2.5474 11.8804C2.51717 11.9232 2.50684 11.9641 2.50684 12C2.50684 12.0359 2.51717 12.0768 2.54739 12.1196C3.26205 13.1302 4.55207 14.7626 6.2401 16.1289C7.93837 17.5034 9.90321 18.5 12.0003 18.5C14.0974 18.5 16.0622 17.5034 17.7605 16.1289C19.4485 14.7626 20.7385 13.1302 21.4532 12.1196C21.4834 12.0768 21.4937 12.0359 21.4937 12C21.4937 11.9641 21.4834 11.9232 21.4532 11.8804C20.7385 10.8698 19.4485 9.2374 17.7605 7.87114C16.0622 6.4966 14.0974 5.5 12.0003 5.5C9.90321 5.5 7.93837 6.4966 6.2401 7.87114ZM1.32267 11.0144C0.90156 11.6099 0.901559 12.3901 1.32266 12.9856C2.83498 15.1243 6.84778 20 12.0003 20C17.1528 20 21.1656 15.1243 22.6779 12.9856C23.099 12.3901 23.099 11.6099 22.6779 11.0144C21.1656 8.87572 17.1528 4 12.0003 4C6.84778 4 2.83498 8.87572 1.32267 11.0144Z" fill="#26282C"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0003 14.5C13.381 14.5 14.5003 13.3807 14.5003 12C14.5003 10.6193 13.381 9.5 12.0003 9.5C10.6196 9.5 9.50029 10.6193 9.50029 12C9.50029 13.3807 10.6196 14.5 12.0003 14.5ZM16.0003 12C16.0003 14.2091 14.2094 16 12.0003 16C9.79115 16 8.00029 14.2091 8.00029 12C8.00029 9.79086 9.79115 8 12.0003 8C14.2094 8 16.0003 9.79086 16.0003 12Z" fill="#26282C"></path>
                        </svg>`);
            $(this).parent().find('input').attr('type', 'password')
        } else {
            $('.show-password').empty().append(`<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <g clip-path="url(#clip0_13144_35507)">
                    <path d="M21 9C18.6 11.667 15.6 13 12 13C8.4 13 5.4 11.667 3 9" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M3 14.9992L5.5 11.1992" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M20.9998 14.9752L18.5078 11.1992" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M9 17L9.5 13" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M15 17L14.5 13" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
                <defs>
                    <clipPath id="clip0_13144_35507">
                        <rect width="24" height="24" fill="white"></rect>
                    </clipPath>
                </defs>
            </svg>`);
            $(this).parent().find('input').attr('type', 'text')
        }

        SHOW_PASSWORD = !SHOW_PASSWORD;
    });
</script>
</body>
</html>
