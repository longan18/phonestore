import {COMMON} from "../../common/common.js";

const ORDER = (function () {
    let modules = {};

    modules.getList = function (url, data = {}) {
        $.ajax({
            type: 'GET',
            url,
            data,
            dataType: 'json',
            beforeSend: function () {
                COMMON.loading(true);
            },
            success: function (res) {
                if (res.success) {
                    $('#list-order table tbody').html(res.data.html);
                    $('#list-order .render-paginate').html(res.data.pagination);
                } else {
                    toastr.error('Đã xảy ra lỗi hệ thống');
                }
            },
            complete: function () {
                COMMON.loading(false, 300);
            }
        });
    };

    modules.filter = function () {
        const form = $(`#fillter-order`);
        const formData = new FormData(form.get(0));
        let data = {};
        for (const [key, value] of formData.entries()) {
            data[key] = value;
        }

        return data
    };

    return modules;
})(window.jQuery, window, document);

$(document).ready(function () {
    $(`#handle-order`).on('submit', ORDER.handle);

    $(document).on('click', '#list-order .pagination a', function (e) {
        e.preventDefault();
        ORDER.getList($(this).attr('href'), ORDER.filter());
    });

    $(document).on('click', '.fillter-order', function (e) {
        e.preventDefault();
        ORDER.getList($(`#fillter-order`).attr('action'), ORDER.filter());
    });

    $(".status-order").on('change', function () {
        const id = $(this).parents('tr').data('order');
        const status = $(this).val();
        updateStatus({id, status});
    })

    $(".status-payment").on('change', function () {
        const id = $(this).parents('tr').data('order');
        const status_payment = $(this).val();
        updateStatus({id, status_payment});
    })

    $(".status-shipping").on('change', function () {
        const id = $(this).parents('tr').data('order');
        const status_shipping = $(this).val();
        updateStatus({id, status_shipping});
    })

    const updateStatus = (data) => {
        $.ajax({
            type: 'POST',
            url: url_update_status,
            data: data,
            beforeSend: function () {
                $('.loading').removeClass('d-none')
            },
            success: function (res) {
                if (res.success) {
                    toastr.success(res.message);

                    setTimeout(() => window.location.reload(), 700);
                } else {
                    toastr.error(res.message);
                }
            },
            error: function (Xhtp) {

            },
            complete: function () {
                setTimeout(() => $('.loading').addClass('d-none'), 700);
            }
        });
    }
});

