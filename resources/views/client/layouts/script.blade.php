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
    // window.addEventListener('popstate', function(event) {
    //     window.location.reload();
    // });

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

    var SHOW_NOTI = true
    $('.notify-show').on('click', function () {
        if (SHOW_NOTI) {
            $('.elm-notify').removeClass('d-none');
        } else {
            $('.elm-notify').addClass('d-none');
        }

        SHOW_NOTI = !SHOW_NOTI;
    });

    $(document).on('click', '#check-noti', function () {
        let dataCheckNoti = $(this).attr('data-check-noti');
        const user_id = $(this).data('user');
        const url = $(this).data('url');

        if (dataCheckNoti == 'true') {
            $.ajax({
                type: 'POST',
                url: url,
                data: { user_id },
                beforeSend: function () {

                },
                success: function (res) {
                    if (res.success) {
                        $('.item-icon-cart-favorite').text('0');
                        $('.no-read').find('.icon-noti').append(`<i class="fa fa-check"></i>`);
                        $('.item-noti').removeClass('no-read bg-e3e3e3');
                        $('#check-noti').attr('data-check-noti', 'false');
                        toastr.success(res.message);
                    } else {
                        toastr.error(res.message);
                    }
                },
                error: function (jqXHR) {

                },
                complete: function () {

                }
            })
        }
    });
</script>
