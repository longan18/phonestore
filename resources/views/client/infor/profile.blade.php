@extends('client.layouts.app')

@section('title')
    {{ __('Thông tin người dùng') }}
@endsection

@section('style_css')
    <style>
        .element {
            opacity: 0; /* Ban đầu ẩn phần tử */
            transform: translateY(-20px); /* Di chuyển phần tử lên trên */
            animation: slideIn 1s ease forwards; /* Áp dụng animation */
        }

        @keyframes slideIn {
            to {
                opacity: 1; /* Hiển thị phần tử */
                transform: translateY(0); /* Di chuyển phần tử về vị trí ban đầu */
            }
        }

        .element-none {
            opacity: 1; /* Ban đầu ẩn phần tử */
            transform: translateY(-20px); /* Di chuyển phần tử lên trên */
            animation: slideNone 1s ease forwards; /* Áp dụng animation */
        }

        @keyframes slideNone {
            to {
                opacity: 0; /* Hiển thị phần tử */
                transform: translateY(0); /* Di chuyển phần tử về vị trí ban đầu */
            }
        }
    </style>
@endsection

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('client_assets/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Thông tin</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('client.home') }}">{{ __('Trang chủ') }}</a>
                            <span>Thông tin chi tiết</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <x-infor></x-infor>
                @include('client.infor.form')
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
        @if(session()->has('status'))
            @if(session()->get('status'))
                toastr.success('Cập nhật thành công');
            @else
                toastr.error('Cập nhật thất bại');
            @endif
        @endif

        $(function () {
            $("input[name='password']").on('click', function () {
                $('#password_confirmation').removeClass('d-none').addClass('element');
            });

            $("input[name='password']").on('input', function () {
                checkInput($(this).val());
            });

            window.addEventListener('click', function(event) {
                let elmInput = $("input[name='password']");
                let ignoredElement = elmInput[0];
                let valPassword =  $("input[name='password']").val();

                if (event.target !== ignoredElement  && !ignoredElement.contains(event.target)) {
                    checkInput(valPassword);
                }
            });

            const checkInput = valueInput => {
                if (valueInput.length === 0) {
                    $('#password_confirmation').removeClass('element').addClass('element-none');
                    setTimeout(() => {
                        $('#password_confirmation').removeClass('element-none').addClass('d-none');
                    }, 900)
                }
            }
        })
    </script>
@endsection
