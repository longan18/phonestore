$(function () {
    console.log(1)
    $(document).find('#provinces').change(function () {
        loadAddress(url_load_district, $(this).val());
    })

    $(document).find('#districts').change(function () {
        loadAddress(url_load_ward, $(this).val());
    })

    $(document).on('click', 'input[name="address_detail"]', function () {
        $('.error-msg').text('');
    })

    $('#submit-address-shipping').on('click', function () {
        const province_id = $('#provinces').val();
        const district_id = $('#districts').val();
        const ward_id = $('#wards').val();
        const address_detail = $('input[name="address_detail"]').val();

        $.ajax({
            type: 'POST',
            url: url_submit_store,
            data: {
                province_id,
                district_id,
                ward_id,
                address_detail
            },
            success: function (res) {
                if(res.success) {
                    console.log($(".list-address .note").length)
                    if($(".list-address .note").length > 0) {
                        $(".list-address").empty();
                    }
                    $(".list-address").append(res.data.html);
                    setTimeout(() => {
                        $('#modal').modal('hide');
                    }, 500);
                    toastr.success(res.message);
                } else {
                    toastr.error(res.message);
                }
            },
            error: function (jqXHR) {
                if (jqXHR.responseJSON.failed) {
                    toastr.error('Địa chỉ của bạn đã tối đa');
                } else {
                    $('.error-msg').text(jqXHR.responseJSON.message);
                }
            },
        });
    })

    $(document).on('click', '.remove-address', function () {
        const elmRoot = $(this);
        const id = elmRoot.data('id');

        $.ajax({
            type: 'POST',
            url: url_remove_address,
            data: { id },
            success: function (res) {
                if(res.success) {
                    elmRoot.parents('.item-address').remove();
                    if($(document).find('.item-address').length == 0) {
                        $('.list-address').append(`
                             <p class="text-center note">Không có địa chỉ giao hàng nào</p>
                                <p class="text-center note">Vui lòng thêm địa chỉ giao hàng để trải nghiệm dịch vụ</p>
                            `)
                    }
                    toastr.success(res.message);
                } else {
                    toastr.error(res.message);
                    window.location.reload();
                }
            },
            error: function (jqXHR) {
                toastr.error(jqXHR.responseJSON.message);
            },
        });
    })

    $(document).on('click', '.act-address', function () {
        const elmRoot = $(this);
        const id = elmRoot.data('id');

        if(elmRoot.hasClass('btn-warning')) {
            toastr.success('Cập nhật địa chỉ giao hàng mặc định thành công');
        } else {
            $.ajax({
                type: 'POST',
                url: url_act_address,
                data: { id },
                success: function (res) {
                    if(res.success) {
                        $('.item-address').find('.act-address').removeClass('btn-warning').addClass('btn-primary');
                        elmRoot.removeClass('btn-primary').addClass('btn-warning');
                        toastr.success(res.message);
                        setTimeout(() => {
                            window.location.href = url_act_redirect;
                        }, 550);
                    } else {
                        toastr.error(res.message);
                    }
                },
                error: function (jqXHR) {
                    toastr.error(jqXHR.responseJSON.message);
                },
            });
        }
    })

    const loadAddress = (url, id) => {
        $.ajax({
            type: 'POST',
            url: url,
            data: { id },
            success: function (res) {
                if (res.data.districts) {
                    loadMapAddress($('#districts'), res.data.districts);
                    loadMapAddress($('#wards'), res.data.wards);
                } else {
                    loadMapAddress($('#wards'), res.data.wards);
                }
            },
            error: function (res) {
                toastr.error('Đã xảy ra lỗi hệ thống, vui lòng thử lại sau giây lát');
                window.location.reload();
            },
        });
    }

    const loadMapAddress = (elm, data) => {
        elm.empty();
        let html = '';

        data.map((item, index) => {
            html += `<option value="${item.id}">${item.name}</option>`
        })
        elm.append(html);
    }
});
