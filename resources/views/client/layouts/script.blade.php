<script src="{{ asset('client_assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
<script src="{{ asset('common/toastr.min.js') }}"></script>
<script src="{{ asset('client_assets/js/bootstrap.min.js') }}"></script>
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

    $('#show-modal').on('click', function () {
        $('#modal').modal('show');
    })

    $('#close-modal').on('click', function () {
        $('#modal').modal('hide');
    })

    $('.select2-custom').select2({
        placeholder: "Lựa chọn",
    });
</script>
@yield('script_js')
