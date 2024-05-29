import {COMMON} from "../../common/common.js";

const NOTIFY_CART = '#notify-cart';

const PRODUCT_DETAIL = (function () {
    let modules = {};

    modules.handleQuantity = function () {
        let quantity = $("input[name='quantity']");
        let quantityCurrent = $(document).find('.quantity-current b');
        if(parseInt(quantity.val()) > parseInt(quantityCurrent.text())) {
            quantity.val(quantityCurrent.text());
        } else if (parseInt(quantity.val()) < 1) {
            quantity.val(1)
        }
    };

    return modules;
})(window.jQuery, window, document);

$(document).ready(function () {
    $(document).on('click', '.size-area .size', function () {
        let element = $(this);
        let elementQuantity = $("input[name='quantity']");
        let eleParent = element.parent('.size-area');
        let quantity = element.data('quantity');
        eleParent.find('.active').removeClass('active');
        element.addClass('active');
        $(document).find('.quantity-current b').text(quantity);
        eleParent.removeClass('bg-fff5f5')
            .find('.notify-select')
            .remove();
        elementQuantity.val(1);
    });

    $(document).on('click', '.quantity .qtybtn', function () {
        PRODUCT_DETAIL.handleQuantity();
    });

    $(document).on('click', '#btn-add-cart', function () {
        let elementSize = $('.size-area');
        let selectProduct = elementSize.find('.active');
        if (!selectProduct.length && !elementSize.hasClass('bg-fff5f5')) {
            elementSize.addClass('bg-fff5f5').append(`
               <div class="color-red m-3 notify-select">Vui lòng chọn Phân loại hàng</div>
            `);
        } else {

        }
        $(NOTIFY_CART).modal('show');
    });

    $(document).on('change', "input[name='quantity']", function () {
        PRODUCT_DETAIL.handleQuantity();
    });
});
