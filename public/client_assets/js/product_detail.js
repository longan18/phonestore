import {COMMON} from "../../common/common.js";

const NOTIFY_CART = '#notify-cart';

const PRODUCT_DETAIL = (function () {
    let modules = {};

    modules.handleQuantity = function () {
        let quantity = $("input[name='quantity']");
        let quantityCurrent = $(document).find('.quantity-current').attr('data-quantity-current');
        if(parseInt(quantity.val()) > parseInt(quantityCurrent)) {
            quantity.val(quantityCurrent);
        } else if (parseInt(quantity.val()) < 1) {
            quantity.val(1)
        }

        let priceTotal = $('.current-price').data('price') * quantity.val();
        $('.total-price').text(priceTotal.toLocaleString('de-DE'));
    };

    return modules;
})(window.jQuery, window, document);

$(function () {
    $('#btn-add-cart').on('click', function () {
        let product_id = $('.product-details').data('product');
        let item_id = $(".parent-item:not(.d-none)").find('.act').data('id');
        let quantity = $('input[name="quantity"]').val();

        if (check_auth == false) {
            window.location.href = url_login;
        }

        $.ajax({
            type: 'POST',
            url: url_add_cart,
            data: { product_id, item_id, quantity },
            beforeSend: function () {
                $('#preloder').css('display', 'block');
                $('#preloder .loader').css('display', 'block');
            },
            success: function (res) {
                $('#preloder').css('display', 'none');
                $('#preloder .loader').css('display', 'none');

                if (res.success) {
                    if (res.data.quantity_item > 99) {
                        $('.item-icon-shopping-cart').text('+99')
                    } else {
                        $('.item-icon-shopping-cart').text(res.data.quantity_item)
                    }
                    $('.item-total-price-cart').text(res.data.total_price)
                    $(NOTIFY_CART).modal('show');
                } else {
                    toastr.error(res.message);
                }
            },
            error: function (jqXHR) {

            },
            complete: function () {
                $('#preloder').css('display', 'none');
                $('#preloder .loader').css('display', 'none');
            }
        })
    });

    $('input[name="quantity"]').on('input', function () {
        $(this).val(convertNumber($(this).val()));
        PRODUCT_DETAIL.handleQuantity();
    });

    const convertNumber = (value) => {
        let valueInput = Number(value.replace(/[^0-9]/g, ''));

        if (valueInput == 0) {
            valueInput = 1;
        }

        return valueInput;
    }

    $(document).on('click', '.item-price', function () {
        actByClass($($(this)).parent('.parent-item').find('.item-price'), $(this));

        let price = $(this).data('price');
        let quantityCurren = $(this).data('quantity');

        $('.quantity-current').html(`<b>${quantityCurren}</b> sản phẩm có sẵn`);
        $('.quantity-current').attr('data-quantity-current', quantityCurren);

        $('.price').text(price.toLocaleString('de-DE'));
        $('.current-price').data('price', price);
        PRODUCT_DETAIL.handleQuantity();
    });

    $(document).on('click', '.item-attr-detail', function () {
        actByClass($('.item-attr-detail'), $(this));
        let key = $(this).data('key');
        let price = $(`.parent-item[data-key="${key}"]`).find('.act').data('price');
        let ram = $(this).data('ram');
        let storage_capacity = $(this).data('storage-capacity');
        let remaining_capacity_is_approx = $(this).data('remaining-capacity-is-approx');

        $('#ram').text(ram);

        $('#storage-capacity').text(storage_capacity);
        $('#remaining-capacity-is-approx').text(remaining_capacity_is_approx);
        $(`.parent-item[data-key!="${key}"]`).addClass('d-none');
        $(`.parent-item[data-key="${key}"]`).removeClass('d-none');
        $('.price').text(price.toLocaleString('de-DE'));

        $('.current-price').data('price', price);

        $('.item-price:first-child').click();

        PRODUCT_DETAIL.handleQuantity();
    });

    const actByClass = (elm, elmThis) => {
        elm.removeClass('act');
        elmThis.addClass('act');
    }

    $(document).on('click', '.quantity .qtybtn', function () {
        PRODUCT_DETAIL.handleQuantity();
    });

    $('.item-price').on('mouseover', function() {
        $('.product__details__pic__item--large').attr('src', $(this).attr('data-image'));
    });
});
