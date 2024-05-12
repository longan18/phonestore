import {COMMON} from "../../common/common.js";

const PROFILE = (function () {
    let modules = {};

    modules.update = function (e) {
        e.preventDefault();
        const form = $(this);
        const formId = `#${$(this).attr('id')}`;
        const formReset = $(this).data('reset');
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
                    if(formReset) {
                        form.get(0).reset();
                    }
                    toastr.success(res.message);
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

    return modules;
})(window.jQuery, window, document);

$(document).ready(function () {
    $(`#update-profile`).on('submit', PROFILE.update);
    $(`#update-password`).on('submit', PROFILE.update);

    $(`#image-upload`).change(function (data) {
        COMMON.previewImage(data, '#image-preview');
    });
});
