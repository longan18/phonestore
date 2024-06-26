@extends('admin.layouts.admin')

@section('title')
    Trang chủ
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
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>Users</h4>
                    <p><b>5</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
                <div class="info">
                    <h4>Likes</h4>
                    <p><b>25</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
                <div class="info">
                    <h4>Uploades</h4>
                    <p><b>10</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
                <div class="info">
                    <h4>Stars</h4>
                    <p><b>500</b></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title m-0">{{ $title }}</h3>
                <p class="text-danger"><i>{{ $description }}</i></p>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('admin.dashboard.index', ['query_total' => 'week']) }}" class="btn btn-warning mr-3">8 Tuần gần nhất</a>
                    <a href="{{ route('admin.dashboard.index', ['query_total' => 'month']) }}" class="btn btn-blue mr-3">4 Tháng gần nhất</a>
                    <a href="{{ route('admin.dashboard.index', ['query_total' => 'year']) }}" class="btn btn-danger">4 Năm gần nhất</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Support Requests</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-after')
    <script type="text/javascript">
        var dataController = @json($data);

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
