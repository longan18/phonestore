$(function () {
    $("li").on('click', function (event) {
        event.preventDefault();
        let price = $(this).data('price');
        $(this).parents('.prods-group').find('.merge__item').removeClass('act');
        $(this).addClass('act');
        $(this).parents('.item').find('.price').text(formatNumberWithDots(price));
    });

    function formatNumberWithDots(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
})
