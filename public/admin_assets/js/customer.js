import {COMMON} from "../../common/common.js";

const CUSTOMER = (function () {
    let modules = {};

    modules.handle = function (e) {
        e.preventDefault();
        const form = $(this);
        const formId = `#${$(this).attr('id')}`;
        const redirect = $(this).data('redirect');
        const formData = new FormData(form.get(0));

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: function () {
                COMMON.loading(true);
                COMMON.clearValidate(formId);
            },
            success: function (res) {
                if (res.success) {
                    $('#modal').modal('hide');
                    toastr.success(res.message);
                    setTimeout(() => {
                        window.location.href = redirect
                    }, 550);
                } else if (res.failed) {
                    toastr.error(res.message);
                    $('#modal').modal('hide');
                }
            },
            error: function (res) {
                COMMON.showValidateMessage(formId, res, false);
                $('#modal').modal('hide');
            },
            complete: function () {
                COMMON.loading(false, 700);
            }
        });
    };

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
                    $('#list-customer table tbody').html(res.data.html);
                    $('#list-customer .render-paginate').html(res.data.pagination);
                } else {
                    toastr.error('Đã xảy ra lỗi hệ thống');
                }
            },
            complete: function () {
                COMMON.loading(false, 300);
            }
        });
    };

    return modules;
})(window.jQuery, window, document);

$(document).ready(function () {
    $('#handle-user').on('submit', CUSTOMER.handle);

    $(`#image-upload`).change(function (data) {
        $('#image-preview').removeClass('d-none');
        COMMON.previewImage(data, '#image-preview');
    });

    $(document).on('keyup', "input[name='key_search']", COMMON.debounce(function () {
        CUSTOMER.getList('/admin/customer/', {key_search: $(this).val().trim()});
    }, 500));
});
