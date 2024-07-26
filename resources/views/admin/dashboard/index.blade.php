@extends('admin.layouts.admin')

@section('title')
    Trang chủ
@endsection

@section('css-after')
    <style>
        a, a:hover {
            text-decoration: none;
        }

        .fs-0875 {
            font-size: 0.875rem !important;
        }
    </style>
@endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Trang chủ</h1>
            <p>Thông tin quản lý website</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('customer.index') }}">
                <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                    <div class="info">
                        <h4 style="margin-bottom: 0px">Người dùng</h4>
                        <p><b>{{ $countUser }}</b></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-usd fa-3x"></i></i>
                <div class="info">
                    <h4 style="margin-bottom: 0px">Doanh thu trong tháng</h4>
                    <p><b>{{ number_format($sumPriceTotalInMonth, 0, '.', '.') }} đ</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('order.index', [
                        'status' => \App\Enums\StatusOrder::ORDER_WRATING->value,
                        'status_payment' => [\App\Enums\StatusPaymentOrder::ORDER_PAYMENT_UNPAID->value]
                    ]) }}">
                <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
                    <div class="info">
                        <h4 style="margin-bottom: 0px">Số đơn hàng cần xử lý</h4>
                        <p><b>{{ $totalOrderDetailStatusOrderWarting }}</b></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-3">
            <a href="{{ route('order.index', [
                        'status' => \App\Enums\StatusOrder::ORDER_CANCEL->value,
                        'status_payment' => [\App\Enums\StatusPaymentOrder::ORDER_PAYMENT_UNPAID->value]
                    ]) }}">
                <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
                    <div class="info">
                        <h4 style="margin-bottom: 0px">Số đơn hàng hủy</h4>
                        <p><b>{{ $totalOrderDetailStatusOrderCancel }}</b></p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title m-0">{{ $title }}</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('admin.dashboard.index', ['query_total' => 'month']) }}" class="btn btn-warning mr-3">Doanh thu các ngày trong tháng</a>
                    <a href="{{ route('admin.dashboard.index', ['query_total' => 'year']) }}" class="btn btn-blue mr-3">Doanh thu các tháng trong năm</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-after')
    <script type="text/javascript">
        var dataController = @json($data);

        console.log(dataController);
        var data = {
            labels: dataController.map(row => row.time),
            datasets: [
                {
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: dataController.map(row => row.total)
                },
            ]
        };

        var ctxl = $("#lineChartDemo").get(0).getContext("2d");
        var lineChart = new Chart(ctxl).Line(data);
    </script>
@endsection
