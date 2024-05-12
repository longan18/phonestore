import {COMMON} from "../../common/common.js";

const CATEGORY = (function () {
    let modules = {};

    modules.handle = function (e) {
        e.preventDefault();
        const form = $(this);
        const formId = `#${$(this).attr('id')}`;
        const redirect = $(this).data('redirect');
        const formData = form.serialize();
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: formData,
            dataType: 'json',
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
                    $('#list-category table tbody').html(res.data.html);
                    $('#list-category .render-paginate').html(res.data.pagination);
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
            url: `/admin/categories/${id}`,
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
    $(`#handle-category`).on('submit', CATEGORY.handle);

    $(document).on('click', '#list-category .pagination a', function (e) {
        e.preventDefault();
        let keySearch = $("input[name='key_search']").val().trim();
        CATEGORY.getList($(this).attr('href'), {key_search: keySearch});
    });

    $(document).on('keyup', "input[name='key_search']", COMMON.debounce(function () {
        CATEGORY.getList('/admin/categories/', {key_search: $(this).val().trim()});
    }, 500));


    $(document).on('click', '.delete-category', function () {
        COMMON.confirmDelete(() => {
            CATEGORY.delete($(this).data('id'), () => {
                CATEGORY.getList(
                    '/admin/categories/',
                    {key_search: $("input[name='key_search']").val().trim()}
                )
            })
        })
    });

    $(document).on('click', '.edit-category', function () {
        window.location.href = $(this).data('url');
    })
});
