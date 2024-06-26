$(document).on('click', '#checkout-postpaid', function () {
    const shopping_session_id = $(this).parent().data('shopping-session');
    const address_shipping_id = $(this).parent().data('address-act');
    const note = "Thanh toán trả sau";
    const payment = '';
    checkoutCart(shopping_session_id, address_shipping_id, note, payment);
});

$(document).on('click', '#checkout-vnpay', function () {
    const shopping_session_id = $(this).parent().data('shopping-session');
    const address_shipping_id = $(this).parent().data('address-act');
    const note = "Thanh toán qua VnPay";
    const payment = 'vn_pay';
    checkoutCart(shopping_session_id, address_shipping_id, note, payment);
});

const checkoutCart = (shopping_session_id, address_shipping_id, note, payment) => {
    $.ajax({
        url: url_checkout,
        method: 'POST',
        data: { shopping_session_id, address_shipping_id, note, payment},
        beforeSend: function () {
            $('#preloder').css('display', 'block');
            $('#preloder .loader').css('display', 'block');
        },
        success: async function(res) {
            if (res.success) {
                if (payment == 'vn_pay') {
                    $('#preloder').css('display', 'block');
                    $('#preloder .loader').css('display', 'block');

                    window.location.href = res.data;
                } else {
                    toastr.success(res.message);
                    setTimeout(() => {
                        window.location.href = url_order_list;
                    }, 500)
                }
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
}
