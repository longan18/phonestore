import {COMMON} from "../../common/common.js";

const BRAND = (function () {
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
                    toastr.success(res.message);
                    setTimeout(() => {
                        window.location.href = redirect
                    }, 600);
                } else if (res.failed) {
                    toastr.error(res.message);
                }
            },
            error: function (res) {
                COMMON.showValidateMessage(formId, res, false);
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
                    $('#list-brand table tbody').html(res.data.html);
                    $('#list-brand .render-paginate').html(res.data.pagination);
                } else {
                    toastr.error('Đã xảy ra lỗi hệ thống');
                }
            },
            complete: function () {
                COMMON.loading(false, 300);
            }
        });
    };

    modules.delete = function (id, callback) {
        $.ajax({
            type: 'DELETE',
            url: `/admin/brands/${id}`,
            dataType: 'json',
            beforeSend: function () {
                COMMON.loading(true);
            },
            success: function (res) {
                if (res.success) {
                    COMMON.notifySuccess(res.message);
                    callback();
                } else {
                    toastr.error(res.message);
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
    $(`#handle-brand`).on('submit', BRAND.handle);

    $(document).on('click', '#list-brand .pagination a', function (e) {
        e.preventDefault();
        let keySearch = $("input[name='key_search']").val().trim();
        BRAND.getList($(this).attr('href'), {key_search: keySearch});
    });

    $(document).on('keyup', "input[name='key_search']", COMMON.debounce(function () {
        BRAND.getList('/admin/brands/', {key_search: $(this).val().trim()});
    }, 500));


    $(document).on('click', '.delete-brand', function () {
        COMMON.confirmDelete(() => {
            BRAND.delete($(this).data('id'), () => {
                BRAND.getList(
                    '/admin/brands/',
                    {key_search: $("input[name='key_search']").val().trim()}
                )
            })
        })
    });

    $(document).on('click', '.edit-brand', function () {
        window.location.href = $(this).data('url');
    });

    $(`#image-upload`).change(function (data) {
        $('#image-preview').removeClass('d-none');
        COMMON.previewImage(data, '#image-preview');
    });
});
