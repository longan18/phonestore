let typingTimer;
let doneTypingInterval = 900;
let cartItems = [];

$('input[name="quantity"]').on('input', function () {
    let parentQty = $(this).parent('.pro-qty');
    let maxQty = Number(parentQty.attr('data-qty-max'));

    if ($(this).val() > maxQty) {
        $(this).val(maxQty);
    } else {
        $(this).val(convertNumber($(this).val()));
    }

    addCartItemInArray($(this).parents('.item-cart'), $(this).val());
    updateHtml($(this), $(this).parents('.item-cart'), $(this).val());

    clearTimeout(typingTimer);
    typingTimer = setTimeout(updateCart, doneTypingInterval);
});

$(document).on('click', '.quantity .qtybtn', function () {
    let parentQty = $(this).parent('.pro-qty');
    let elmInputQty = parentQty.find('input[name="quantity"]');

    let maxQty = Number(parentQty.attr('data-qty-max'));

    let valueInputNumber = convertNumber(elmInputQty.val());

    if(valueInputNumber > maxQty) {
        elmInputQty.val(maxQty);
    }

    if (valueInputNumber <= 1) {
        elmInputQty.val(1);
    }

    addCartItemInArray($(this).parents('.item-cart'), elmInputQty.val());
    updateHtml($(this), $(this).parents('.item-cart'), elmInputQty.val());

    clearTimeout(typingTimer);
    typingTimer = setTimeout(updateCart, doneTypingInterval);
});

$(document).on('click', '.delete-item-cart', function () {
    let id = $(this).parents('.item-cart').attr('data-shopping-item');

    $.ajax({
        url: url_delete_item_cart,
        method: 'POST',
        data: { id: id },
        beforeSend: function () {
            $('#preloder').css('display', 'block');
            $('#preloder .loader').css('display', 'block');
        },
        success: async function(res) {
            let itemRemove = $(`.item-cart[data-shopping-item="${id}"]`);
            let priceDec = itemRemove.attr('data-quantity') * itemRemove.attr('data-price');
            let valuePriceTotalCurrent = $('.value-price-total').attr('data-value');
            let valuePriceDefaultCurrent = $('.value-price-default').attr('data-value');

            $('.value-price-default').attr('data-value', valuePriceDefaultCurrent - itemRemove.attr('data-price'));
            $('.value-price-default').text(formattedPrice(valuePriceDefaultCurrent - itemRemove.attr('data-price')));
            $('.value-price-total').attr('data-value', valuePriceTotalCurrent - priceDec);
            $('.value-price-total').text(formattedPrice(valuePriceTotalCurrent - priceDec));

            itemRemove.remove();

            await getList(url_get_list);

            $('#preloder').css('display', 'none');
            $('#preloder .loader').css('display', 'none');

            if (res.success) {
                $('.item-total-price-cart').text(shortenNumbers(res.data.price_total != 0 ? res.data.price_total : null));
                $('.item-icon-shopping-cart').text(res.data.quantity_total);
                toastr.success(res.message);
            } else {
                toastr.error(res.message);
            }
        },
        error: function (jqXHR) {
            toastr.error('Lỗi hệ thống, vui lòng thử lại sau giây lát!');
        },
    });

});

const updateCart = () => {
    $.ajax({
        url: url_update_item_cart,
        method: 'POST',
        data: { cartItems: cartItems },
        success: function(res) {
            if (res.success) {
                toastr.success(res.message);
            } else {
                toastr.error(res.message);
            }
        }
    });

    cartItems = [];
}

const addCartItemInArray = (elmCartItem, valQty) => {
    let itemArray = {
        id: elmCartItem.attr('data-shopping-item'),
        quantity: valQty,
        shopping_session_id: elmCartItem.attr('data-shopping-session-id'),
        product_id: elmCartItem.attr('data-product-id'),
        item_id: elmCartItem.attr('data-item-id'),
        price: elmCartItem.attr('data-price'),
    };

    if(cartItems.length) {
        let index = cartItems.findIndex(item => itemArray.id == item.id);
        if (index >= 0) {
            cartItems.splice(index, 1);
        }
    }
    cartItems.push(itemArray);
}

const updateHtml = (elmInput, elmCartItem, valQty) => {
    let qty = valQty - elmCartItem.attr('data-quantity');

    let totalPriceElm = elmCartItem.attr('data-price') * qty;
    let totalPriceCart = $('.value-price-total').attr('data-value');

    elmCartItem.find('.price-total').text(formattedPrice(elmCartItem.attr('data-price') * valQty));

    let newValue = Number(totalPriceCart) + Number(totalPriceElm);
    $('.value-price-total').attr('data-value', newValue);
    elmCartItem.attr('data-quantity', valQty);
    $('.value-price-total').text(formattedPrice(newValue));
    $('.item-total-price-cart').text(shortenNumbers(newValue));
}

const convertNumber = (value) => {
    let valueInput = Number(value.replace(/[^0-9]/g, ''));
    if (valueInput == 0) {
        valueInput = 1;
    }

    return valueInput;
}

const formattedPrice = (value) => {
    let valuePrice = value.toLocaleString('vi-VN',
        {
            style: 'currency',
            currency: 'VND'
        }
    ).slice(0, -2);

    return valuePrice;
}

const shortenNumbers = number => {
    if (number === null) {
        return '0K';
    }

    const units = ['', 'K', 'M', 'B', 'T'];
    const power = Math.floor(Math.log10(number) / 3);
    const shortened = number / Math.pow(1000, power);
    const formatted = shortened.toFixed(1); //
    return formatted.endsWith('.0') ? formatted.slice(0, -2) + units[power] : formatted + units[power];
}

const getList = url => {
    return Promise.resolve($.ajax({
        type: 'GET',
        url,
        success: function (res) {
            if (res.success) {
                $('#list-item table tbody').html(res.data.htmlTable);
                $('#checkout-cart').html(res.data.htmlCheckout);
                $('#list-item .render-paginate').html(res.data.pagination);
            }
        },
    }));
};
