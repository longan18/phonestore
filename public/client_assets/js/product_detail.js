import {COMMON} from "../../common/common.js";

const NOTIFY_CART = '#notify-cart';

const PRODUCT_DETAIL = (function () {
    let modules = {};

    modules.handleQuantity = function () {
        let quantity = $("input[name='quantity']");
        let quantityCurrent = $(document).find('.quantity-current').data('quantity-current');
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
        const product_id = $('.product-details').data('product');
        const quantity = $("input[name='quantity']").val();
        const url = $(this).data('url');
        const item_id = $(document).find('.item-price.act').data('item');

        console.log(item_id)

        const datas = {
            product_id,
            quantity,
            item_id
        }

        $.ajax({
            type: 'POST',
            url: url,
            data: datas,
            beforeSend: function () {

            },
            success: function (res) {
                if (res.success) {

                }
            },
            error: function (res) {

            },
            complete: function () {

            }
        })
    });

    $(document).on('click', '.item-price', function () {
        actByClass($('.item-price'), $(this));

        let price = $(this).data('price');

        $('.price').text(price.toLocaleString('de-DE'));
        $('.current-price').data('price', price);
        PRODUCT_DETAIL.handleQuantity();
    });

    $('.item-attr-detail').on('click', function () {
        actByClass($('.item-attr-detail'), $(this));

        const ram_id = $(this).data('ram');
        const storage_capacity_id = $(this).data('storage-capacity');
        const product_id = $('.product-details').data('product');
        const url = $('.product-details').data('url');

        const datas = {
            ram_id,
            storage_capacity_id,
            product_id
        }

        $.ajax({
            type: 'POST',
            url: url,
            data: datas,
            beforeSend: function () {

            },
            success: function (res) {
                if (res.success) {
                    let html = '';

                    let act = 0;
                    $.map(res.data.colors, (color, colorId) => {
                        let price = Number(res.data.prices[colorId]);
                        let itemId = res.data.ids[colorId];

                        if (act == 0) {
                            $('.price').text(price.toLocaleString('de-DE'));
                            $('.current-price').data('price', price);
                            $('.total-price').text(price.toLocaleString('de-DE'));
                            $("input[name='quantity']").val(1);
                        }

                        html += elmColor(colorId, price, color, itemId, act);
                        act = 1;
                    })

                    $('#color').empty().append(html);
                }
            },
            error: function (res) {

            },
            complete: function () {

            }
        });
    });

    const elmColor = (idColor, priceColor, bgColor, itemId, act) => {
        return `<div data-color="${idColor}" data-price="${priceColor}" data-item="${itemId}"
             class="item-price text-center h-43px border-non-act ${act == 0 ? 'act' : ''}"
             style="background-color: ${bgColor};"></div>`;
    }
    const actByClass = (elm, elmThis) => {
        elm.removeClass('act');
        elmThis.addClass('act');
    }

    $(document).on('click', '.quantity .qtybtn', function () {
        PRODUCT_DETAIL.handleQuantity();
    });

    $(document).on('change', "input[name='quantity']", function () {
        PRODUCT_DETAIL.handleQuantity();
    });

    // $(NOTIFY_CART).modal('show');
});
