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

    modules.updateStatus = function (url, status = {}, elm) {
        $.ajax({
            type: 'POST',
            url: url,
            data: status,
            dataType: 'json',
            beforeSend: function () {
                COMMON.loading(true);
            },
            success: function (res) {
                if (res.success) {
                    toastr.success(res.message);
                    let elmMsg = elm.parents('tr').find('td.msg-status');
                    if (res.data == COMMON.STOP_SELLING) {
                        elm.removeClass('bg-lg-FFF-20Ef0D').addClass('bg-lg-FFF-EF0D0D');
                        elm.attr('data-status', COMMON.STOP_SELLING);
                        elmMsg.removeClass('text-success').addClass('text-danger');
                        elmMsg.text('Dừng bán');
                    } else {
                        elm.removeClass('bg-lg-FFF-EF0D0D').addClass('bg-lg-FFF-20Ef0D');
                        elm.attr('data-status', COMMON.PUBLISH);
                        elmMsg.removeClass('text-danger').addClass('text-success');
                        elmMsg.text('Đăng bán');
                    }

                    // modules.getList('/admin/products/');
                } else {
                    toastr.error('Đã xảy ra lỗi hệ thống');
                }
            },
            error: function (res) {
                if (res.responseJSON.failed) {
                    toastr.error(res.responseJSON.message);
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
            url: `/admin/product-smartphone/${id}`,
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

    modules.deleteOption = function (id, callback) {
        $.ajax({
            type: 'DELETE',
            url: `/admin/product-smartphone/${id}/options`,
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
        const form = $(`#fillter-product`);
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
    $(`#handle-product`).on('submit', PRODUCT.handle);

    $(document).on('click', '#list-product .pagination a', function (e) {
        e.preventDefault();
        PRODUCT.getList($(this).attr('href'), PRODUCT.filter());
    });

    $(document).on('click', '.fillter-product', function (e) {
        e.preventDefault();
        PRODUCT.getList($(`#fillter-product`).attr('action'), PRODUCT.filter());
    });

    // $(document).on('keyup', 'input[name="price"]', COMMON.debounce(function () {
    //     let data = $(this).val().replaceAll(',', '');
    //     $(this).val(data.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
    // }, 200));


    $(document).on('click', '.delete-product', function () {
        COMMON.confirmDelete(() => {
            PRODUCT.delete($(this).data('id'), () => {
                PRODUCT.getList(
                    '/admin/product-smartphone/',
                    {key_search: $("input[name='key_search']").val().trim()}
                )
            })
        })
    });

    $(document).on('click', '.delete-product-option', function () {
        COMMON.confirmDelete(() => {
            PRODUCT.deleteOption($(this).data('id'), () => {
                PRODUCT.getList(
                    `/admin/product-smartphone/${$(this).data('slug')}/options`
                )
            })
        })
    });

    $(document).on('click', '.update-status', function () {
        let status = $(this).val();
        let statusCheck  = $(this).attr('data-status');
        let url = $(this).data('url');

        if (status != statusCheck) {
            PRODUCT.updateStatus(url, {status}, $(this));
        }
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
