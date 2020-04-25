@extends('management.themekit.dashboard')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Bookmarks5</h6>
                                <h2>1,410</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-award"></i>
                            </div>
                        </div>
                        <small class="text-small mt-10 d-block">6% higher than last month</small>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="62"
                            aria-valuemin="0" aria-valuemax="100" style="width: 62%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Likes</h6>
                                <h2>41,410</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-thumbs-up"></i>
                            </div>
                        </div>
                        <small class="text-small mt-10 d-block">61% higher than last month</small>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="78"
                            aria-valuemin="0" aria-valuemax="100" style="width: 78%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Events</h6>
                                <h2>410</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-calendar"></i>
                            </div>
                        </div>
                        <small class="text-small mt-10 d-block">Total Events</small>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="31"
                            aria-valuemin="0" aria-valuemax="100" style="width: 31%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Comments</h6>
                                <h2>41,410</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-message-square"></i>
                            </div>
                        </div>
                        <small class="text-small mt-10 d-block">Total Comments</small>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20"
                            aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="min-height: 422px;">
                    <div class="card-header">
                        <h3>Donut chart</h3>
                    </div>
                    <div class="card-body">
                        <div id="c3-donut-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('csspage')
<link rel="stylesheet" href="{!! asset('plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') !!}">
<link rel="stylesheet" href="{!! asset('plugins/jvectormap/jquery-jvectormap.css') !!}">
<link rel="stylesheet" href="{!! asset('plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css') !!}">
<link rel="stylesheet" href="{!! asset('plugins/weather-icons/css/weather-icons.min.css') !!}">
<link rel="stylesheet" href="{!! asset('plugins/c3/c3.min.css') !!}">
<link rel="stylesheet" href="{!! asset('plugins/owl.carousel/dist/assets/owl.carousel.min.css') !!}">
<link rel="stylesheet" href="{!! asset('plugins/owl.carousel/dist/assets/owl.theme.default.min.css') !!}">
@endsection
@section('scriptpage')
<script src="{!! asset('plugins/datatables.net/js/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') !!}"></script>
<script src="{!! asset('plugins/datatables.net-responsive/js/dataTables.responsive.min.js') !!}"></script>
<script src="{!! asset('plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') !!}"></script>
<script src="{!! asset('plugins/jvectormap/jquery-jvectormap.min.js') !!}"></script>
<script src="{!! asset('plugins/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js') !!}"></script>
<script src="{!! asset('plugins/moment/moment.js') !!}"></script>
<script src="{!! asset('plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') !!}"></script>
<script src="{!! asset('plugins/d3/dist/d3.min.js') !!}"></script>
<script src="{!! asset('plugins/c3/c3.min.js') !!}"></script>
<script src="{!! asset('js/tables.js') !!}"></script>
<script src="{!! asset('js/charts.js') !!}"></script>
@endsection
