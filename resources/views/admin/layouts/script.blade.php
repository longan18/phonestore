<script src="{{ asset('admin_assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
<script src="{{ asset('common/toastr.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/popper.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugins/sweetalert.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/main.js') }}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{ asset('admin_assets/js/plugins/pace.min.js') }}"></script>
<!-- Page specific javascripts-->
<script type="text/javascript" src="{{ asset('admin_assets/js/plugins/chart.js') }}"></script>
<script src="{{ asset('common/ckeditor.js') }}"></script>
<script src="{{ asset('common/bootstrap-datepicker.min.js') }}"></script>
<script>
    if(document.location.hostname == 'pratikborsadiya.in') {
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if ($(document).find('.ckeditor').length) {
        ClassicEditor
            .create(document.querySelector('.ckeditor' ))
            .catch(error => {
                console.log(error);
            });
    }


    const formattedPrice = (value, replace = true) => {
        let valuePrice = value.toLocaleString('vi-VN',
            {
                style: 'currency',
                currency: 'VND'
            }
        ).slice(0, -2);

        let result = '';

        if(replace) {
            result = valuePrice.replace(/\./g, ',');
        } else {
            result = valuePrice;
        }

        return result;
    }

    $(document).ready(function() {
        $(document).on('input', 'input[data-name="price"]', function () {
            let value = $(this).val();
            let valueReplace = value.replace(/[^0-9]/g, '');
            let valuePrice = Number(valueReplace);

            if (valuePrice == 0) {
                valuePrice = '';
            }

            $(this).val(formattedPrice(valuePrice));
        });

        $('.select2-multiple').select2({
            placeholder: "Lựa chọn",
            allowClear: true
        });

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });

        $('#show-modal').on('click', function () {
            $('#modal').modal('show');
        })

        $('.class-show-modal').on('click', function () {
            $('#modal').modal('show');
        })

        $('#close-modal').on('click', function () {
            $('#modal').modal('hide');
        })
    });
</script>
@yield('script-after')
