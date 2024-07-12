$(document).on('click', '#checkout-postpaid', function () {
    const shopping_session_id = $(this).parent().data('shopping-session');
    const address_shipping_id = $(this).parent().data('address-act');
    const note = "";
    const payment = '';
    checkoutCart(shopping_session_id, address_shipping_id, note, payment);
});

$(document).on('click', '#checkout-vnpay', function () {
    localStorage.setItem('checkVnPay', 'checkVnPay');
    const shopping_session_id = $(this).parent().data('shopping-session');
    const address_shipping_id = $(this).parent().data('address-act');
    const note = "";
    const payment = 'vn_pay';
    checkoutCart(shopping_session_id, address_shipping_id, note, payment);
});

const checkoutCart = (shopping_session_id, address_shipping_id, note, payment) => {
    const shopping_item_id = JSON.parse(localStorage.getItem('dataCheckBox')) ?? [];

    let dataSubmit = {shopping_session_id, address_shipping_id, note, payment}
    if (shopping_item_id.length != 0) {
        dataSubmit = {...dataSubmit, shopping_item_id}
    }

    $.ajax({
        url: url_checkout,
        method: 'POST',
        data: dataSubmit,
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
                    localStorage.clear();
                    window.location.href = url_order_list;
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
