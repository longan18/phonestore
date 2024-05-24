<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('common/common.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login admin</title>
</head>
<body>
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <h1>Admin</h1>
    </div>
    <div class="login-box justify-content-center">
        @if(session('error'))
            <div class="error-message d-flex mt-10 ml-25"> {{ session('error') }}</div>
        @endif
        <form class="login-form" action="{{ route('admin.login') }}" method="POST" autocomplete="off">
            @csrf
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Đăng nhập</h3>
            <div class="form-group">
                <label class="control-label">Tài khoản</label>
                <input class="form-control" type="text" value="{{ old('email') }}" placeholder="Email" name="email" autocomplete="off">
                @error('email')
                 <div class="error-message d-flex"> {{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="control-label">Mật khẩu</label>
                <input class="form-control" type="password" placeholder="Password" name="password" autocomplete="off">
                @error('password')
                <div class="error-message d-flex"> {{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <div class="utility">
                    <div class="animated-checkbox">
                        <label>
                            <input type="checkbox"><span class="label-text">Lưu mật khẩu</span>
                        </label>
                    </div>
                    <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Quên mật khẩu ?</a></p>
                </div>
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Đăng nhập</button>
            </div>
        </form>
        <form class="forget-form" action="#">
            <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Quên mật khẩu ?</h3>
            <div class="form-group">
                <label class="control-label">Nhập email lấy lại mật khẩu</label>
                <input class="form-control" type="text" placeholder="Email">
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>Đặt lại mật khẩu</button>
            </div>
            <div class="form-group mt-3">
                <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Đăng nhập</a></p>
            </div>
        </form>
    </div>
</section>
<!-- Essential javascripts for application to work-->
<script src="{{ asset('admin_assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/popper.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/main.js') }}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{ asset('admin_assets/js/plugins/pace.min.js') }}"></script>
<script type="text/javascript">
    // Login Page Flipbox control
    $('.login-content [data-toggle="flip"]').click( function() {
        $('.login-box').toggleClass('flipped');
        return false;
    });
</script>
</body>
</html>
