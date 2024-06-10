<script src="{{ asset('client_assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('common/toastr.min.js') }}"></script>
<script src="{{ asset('client_assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('client_assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('client_assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('client_assets/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('client_assets/js/mixitup.min.js') }}"></script>
<script src="{{ asset('client_assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('client_assets/js/main.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('script_js')
