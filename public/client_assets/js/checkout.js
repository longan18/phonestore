$(document).on('click', '#checkout-postpaid', function () {
    const shopping_session_id = $(this).parent().data('shopping-session');
    const address_shipping_id = $(this).parent().data('address-act');
    const note = "Thanh toán trả sau";

    $.ajax({
        url: url_checkout,
        method: 'POST',
        data: { shopping_session_id, address_shipping_id, note },
        beforeSend: function () {
            $('#preloder').css('display', 'block');
            $('#preloder .loader').css('display', 'block');
        },
        success: async function(res) {
            if (res.success) {
                toastr.success(res.message);
                setTimeout(() => {
                    console.log(url_order_list);
                    window.location.href = url_order_list;
                }, 500)
            } else {
                toastr.error(res.message);
            }
        },
        error: function (jqXHR) {
            toastr.error('Lỗi hệ thống, vui lòng thử lại sau giây lát!');
        },
        complete: function () {
            $('#preloder').css('display', 'none');
            $('#preloder .loader').css('display', 'none');
        }
    });
});
