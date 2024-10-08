<meta charset="UTF-8">
<meta name="description" content="Ogani Template">
<meta name="keywords" content="Ogani, unica, creative, html">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>@yield('title')</title>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

<!-- Css Styles -->
<link rel="stylesheet" href="{{ asset('client_assets/css/bootstrap.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('client_assets/css/font-awesome.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('client_assets/css/elegant-icons.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('client_assets/css/nice-select.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('client_assets/css/jquery-ui.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('client_assets/css/owl.carousel.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('client_assets/css/slicknav.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('client_assets/css/style.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('client_assets/css/my_style.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('common/common.css') }}" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('common/toastr.min.css') }}">
@vite(['resources/scss/client/notify.scss', 'resources/scss/common.scss','resources/scss/client/top-bar.scss'])
@yield('style_css')
<style>
    @media (max-width: 995px) {
        .listproduct {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }
    }

    @media (max-width: 850px) {
        .listproduct {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        .featured,
        .spad {
            padding-top: 0px !important;
        }

        .product__details__pic__item--large {
            margin-top: 50px;
            width: 100vw!important;
            height: auto;
        }

        .listproduct {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

