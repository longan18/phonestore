import {COMMON} from "../../common/common.js";

const PRODUCT = (function () {
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
                    $('#list-product table tbody').html(res.data.html);
                    $('#list-product .render-paginate').html(res.data.pagination);
                } else {
                    toastr.error('Đã xảy ra lỗi hệ thống');
                }
            },
            complete: function () {
                COMMON.loading(false, 300);
            }
        });
    };

    modules.updateStatus = function (id, data = {}) {
        $.ajax({
            type: 'POST',
            url: `/admin/products/${id}`,
            data,
            dataType: 'json',
            beforeSend: function () {
                COMMON.loading(true);
            },
            success: function (res) {
                if (res.success) {
                    toastr.success(res.message);
                    modules.getList('/admin/products/');
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
            url: `/admin/products/${id}`,
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

    modules.filter = function () {
        let data = {
            key_search: $("input[name='key_search']").val().trim()
        };
        $(document).find('.filter-product').map((i, e) => {
            data = {...data, [$(e).data('name')]: $(e).val()};
        });

        return data;
    };

    return modules;
})(window.jQuery, window, document);

$(document).ready(function () {
    $(`#handle-product`).on('submit', PRODUCT.handle);

    $(document).on('click', '#list-product .pagination a', function (e) {
        e.preventDefault();
        PRODUCT.getList($(this).attr('href'), PRODUCT.filter());
    });

    $(document).on('keyup', "input[name='key_search']", COMMON.debounce(function () {
        PRODUCT.getList('/admin/products/', PRODUCT.filter());
    }, 500));

    $(document).on('keyup, change', '.filter-product', COMMON.debounce(function () {
        PRODUCT.getList('/admin/products/', PRODUCT.filter());
    }, 500));

    $(document).on('keyup', 'input[name="price"]', COMMON.debounce(function () {
        let data = $(this).val().replaceAll(',', '');
        $(this).val(data.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
    }, 200));


    $(document).on('click', '.delete-product', function () {
        COMMON.confirmDelete(() => {
            PRODUCT.delete($(this).data('id'), () => {
                PRODUCT.getList(
                    '/admin/products/',
                    {key_search: $("input[name='key_search']").val().trim()}
                )
            })
        })
    });

    $(document).on('click', '.edit-product', function () {
        window.location.href = $(this).data('url');
    });

    $(document).on('click', '.update-status', function () {
        let value = $(this).val();
        let slug  = $(this).data('slug');
        console.log({value, slug});
        PRODUCT.updateStatus(id, {status})
    });

    $(`#image-upload`).change(function (data) {
        $('#image-preview').removeClass('d-none');
        COMMON.previewImage(data, '#image-preview');
    });

    COMMON.previewMultipleImage();

    $(document).on('click', '.remove-sub-image', function () {
        $('#handle-product').append(`
            <input name="sub_image_remove[]" value="${$(this).data('sub_image_remove')}" type="hidden"/>
        `);
    });
});
