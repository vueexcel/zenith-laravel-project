{{-- Extends Layout --}}
@extends('layouts.backend')

@section('last_import_time')
    @if(Auth::user() && Auth::user()->is_admin > 1)
        <select class="form-control" style="width: 200px;display: block; margin-left: auto; margin-right: auto; margin-top: -30px;" id="select_group_name" name="select_group_name">
            <option value="all">All</option>
            <option value="burnaston">Burnaston</option>
            <option value="deeside">Deeside</option>
        </select>
    @endif
    <h3 style="
        float: right;
        background: transparent;
        margin-top: 0;
        margin-bottom: 0;
        font-size: 20px;
        padding: 7px 5px;
        position: absolute;
        top: 13px;
        right: 100px;
        border-radius: 2px;">Last Updated: {{(isset($settings->last_import) && $settings->last_import != "")?date('d/m/Y H:i', strtotime($settings->last_import)):''}}
    </h3>
@endsection

{{-- Breadcrumbs --}}
@section('breadcrumbs')
    {!! Breadcrumbs::render('dashboard') !!}
@endsection

{{-- Page Title --}}
@section('page-title', 'Dashboard')

{{-- Page Subtitle --}}
@section('page-subtitle', '')

{{-- Header Extras to be Included --}}
@section('head-extras')
    <style>
        .dash-circle {
            margin:0 auto;width:70px;height: 70px;border-radius: 50%; text-align: center; padding-top: 17px; font-size: 26px; cursor: pointer;
        }

        .dash-circle2 {
            margin:0 auto;width:60px;height: 60px;border-radius: 50%; text-align: center; padding-top: 13px; font-size: 25px; cursor: pointer;
        }

        .dash-graph {
            width: 25%;
            float: left;
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .report-tr:hover {
            background-color: #E5F3FF;
        }

        .sub-button {
            width: 100%; font-size: 18px; margin-top: 10px;
        }

        .verticalTableHeader {
            text-align:center;
            white-space:nowrap;
            transform-origin:50% 50%;
            -webkit-transform: rotate(270deg);
            -moz-transform: rotate(270deg);
            -ms-transform: rotate(270deg);
            -o-transform: rotate(270deg);
            transform: rotate(270deg);

        }
        .verticalTableHeader:before {
            content:'';
            padding-top:110%;/* takes width as reference, + 10% for faking some extra padding */
            display:inline-block;
            vertical-align:middle;
        }

        .vertical-p {
            writing-mode: vertical-rl;
            text-orientation: upright;
        }

        div.vertical
        {
            transform: rotate(270deg);
            -webkit-transform: rotate(270deg); /* Safari/Chrome */
            -moz-transform: rotate(270deg); /* Firefox */
            -o-transform: rotate(270deg); /* Opera */
            -ms-transform: rotate(270deg); /* IE 9 */
            width: 10px;
            font-size: 15px;
        }
    </style>
@endsection

@section('content')

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header" style="text-align: center">
                    <h3 class="box-title">CY {{date('Y')}} Year To Date</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table" style="width: 100%;">
                        <tr>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">GIR</td>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">Accident</td>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">GMIR</td>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">MSS</td>
                        </tr>
                        <tr>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="year" data-kind="gir" style="background-color: #A9D18E;">
                                    <span class="all-value" style="display: block;">{{ $y_gir }}</span>
                                    <span class="deeside-value" style="display: none;">{{ $deeside_y_gir }}</span>
                                    <span class="burnaston-value" style="display: none;">{{ $burnaston_y_gir }}</span>
                                </div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="year" data-kind="accident" style="background-color: #A9D18E;">
                                    <span class="all-value" style="display: block;">{{ $y_accidents }}</span>
                                    <span class="deeside-value" style="display: none;">{{ $deeside_y_accidents }}</span>
                                    <span class="burnaston-value" style="display: none;">{{ $burnaston_y_accidents }}</span>
                                </div>
                            </td>

                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="year" data-kind="gmir" style="background-color: #A9D18E;">
                                    <span class="all-value" style="display: block;">{{ $y_gmir }}</span>
                                    <span class="deeside-value" style="display: none;">{{ $deeside_y_gmir }}</span>
                                    <span class="burnaston-value" style="display: none;">{{ $burnaston_y_gmir }}</span>
                                </div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="year" data-kind="mss" style="background-color: #A9D18E;">
                                    <span class="all-value" style="display: block;">{{ $y_mss }}</span>
                                    <span class="deeside-value" style="display: none;">{{ $deeside_y_mss }}</span>
                                    <span class="burnaston-value" style="display: none;">{{ $burnaston_y_mss }}</span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header" style="text-align: center">
                    <h3 class="box-title">CY Month - {{date('F')}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table" style="width: 100%;">
                        <tr>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">GIR</td>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">Accident</td>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">GMIR</td>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">MSS</td>
                        </tr>
                        <tr>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="month" data-kind="gir" style="background-color: #A9D18E;">
                                    <span class="all-value" style="display: block;">{{ $m_gir }}</span>
                                    <span class="deeside-value" style="display: none;">{{ $deeside_m_gir }}</span>
                                    <span class="burnaston-value" style="display: none;">{{ $burnaston_m_gir }}</span>
                                </div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="month" data-kind="accident" style="background-color: #A9D18E;">
                                    <span class="all-value" style="display: block;">{{ $m_accidents }}</span>
                                    <span class="deeside-value" style="display: none;">{{ $deeside_m_accidents }}</span>
                                    <span class="burnaston-value" style="display: none;">{{ $burnaston_m_accidents }}</span>
                                </div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="month" data-kind="gmir" style="background-color: #A9D18E;">
                                    <span class="all-value" style="display: block;">{{ $m_gmir }}</span>
                                    <span class="deeside-value" style="display: none;">{{ $deeside_m_gmir }}</span>
                                    <span class="burnaston-value" style="display: none;">{{ $burnaston_m_gmir }}</span>
                                </div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="month" data-kind="mss" style="background-color: #A9D18E;">
                                    <span class="all-value" style="display: block;">{{ $m_mss }}</span>
                                    <span class="deeside-value" style="display: none;">{{ $deeside_m_mss }}</span>
                                    <span class="burnaston-value" style="display: none;">{{ $burnaston_m_mss }}</span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header" style="text-align: center">
                    <h3 class="box-title">Current Week</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table" style="width: 100%;">
                        <tr>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">GIR</td>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">Accident</td>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">GMIR</td>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">MSS</td>
                        </tr>
                        <tr>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="week" data-kind="gir" style="background-color: #A9D18E;">
                                    <span class="all-value" style="display: block;">{{ $w_gir }}</span>
                                    <span class="deeside-value" style="display: none;">{{ $deeside_w_gir }}</span>
                                    <span class="burnaston-value" style="display: none;">{{ $burnaston_w_gir }}</span>
                                </div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="week" data-kind="accident" style="background-color: #A9D18E;">
                                    <span class="all-value" style="display: block;">{{ $w_accidents }}</span>
                                    <span class="deeside-value" style="display: none;">{{ $deeside_w_accidents }}</span>
                                    <span class="burnaston-value" style="display: none;">{{ $burnaston_w_accidents }}</span>
                                </div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="week" data-kind="gmir" style="background-color: #A9D18E;">
                                    <span class="all-value" style="display: block;">{{ $w_gmir }}</span>
                                    <span class="deeside-value" style="display: none;">{{ $deeside_w_gmir }}</span>
                                    <span class="burnaston-value" style="display: none;">{{ $burnaston_w_gmir }}</span>
                                </div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="week" data-kind="mss" style="background-color: #A9D18E;">
                                    <span class="all-value" style="display: block;">{{ $w_mss }}</span>
                                    <span class="deeside-value" style="display: none;">{{ $deeside_w_mss }}</span>
                                    <span class="burnaston-value" style="display: none;">{{ $burnaston_w_mss }}</span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body" style="text-align: center; ">
                    <table class="table" style="width: 100%;">
                        <tr>
                            <td rowspan="2"><div class="vertical" style="margin-top: 70px;">WPI</div></td>
                            <td style="width: 26%; text-align: center; vertical-align: middle;">Accident</td>
                            <td rowspan="2"><div class="vertical" style="margin-top: 85px;">Received</div></td>
                            <td>
                                <div class="dash-circle2" data-range="year" data-kind="accident_received" style="background-color: #A9D18E;">
                                    <span class="all-value" style="display: block;">{{ $y_accidents - $accident_outstanding }}</span>
                                    <span class="deeside-value" style="display: none;">{{ $deeside_y_accidents - $deeside_accident_outstanding }}</span>
                                    <span class="burnaston-value" style="display: none;">{{ $burnaston_y_accidents - $burnaston_accident_outstanding }}</span>
                                </div>
                            </td>
                            <td rowspan="2"><div class="vertical" style="margin-top: 100px;">Outstanding</div></td>
                            <td>
                                <div class="dash-circle2" data-range="year" data-kind="accident_outstanding" style="background-color: #FC0007;">
                                    <span class="all-value" style="display: block;">{{ $accident_outstanding }}</span>
                                    <span class="deeside-value" style="display: none;">{{ $deeside_accident_outstanding }}</span>
                                    <span class="burnaston-value" style="display: none;">{{ $burnaston_accident_outstanding }}</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 26%; text-align: center; vertical-align: middle;">MSS</td>
                            <td>
                                <div class="dash-circle2" data-range="year" data-kind="mss_received" style="background-color: #A9D18E;">
                                    <span class="all-value" style="display: block;">{{ $y_mss - $mss_outstanding }}</span>
                                    <span class="deeside-value" style="display: none;">{{ $deeside_y_mss - $deeside_mss_outstanding }}</span>
                                    <span class="burnaston-value" style="display: none;">{{ $burnaston_y_mss - $burnaston_mss_outstanding }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="dash-circle2" data-range="year" data-kind="mss_outstanding" style="background-color: #FC0007;">
                                    <span class="all-value" style="display: block;">{{ $mss_outstanding }}</span>
                                    <span class="deeside-value" style="display: none;">{{ $deeside_mss_outstanding }}</span>
                                    <span class="burnaston-value" style="display: none;">{{ $burnaston_mss_outstanding }}</span>
                                </div>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="dash-graph">
            <div class="box box-success">
                <div class="box-header with-border" style="text-align: center;">
                    <h3 class="box-title graph-modal" data-graph="gir_chart" style="display: inline; cursor: pointer;">Global Incident Rate(GIR)</h3>
                    <select class="form-control select-year" id="year_gir_chart" style="display: inline; width: 100px;">
                        @php
                            $year = date('Y');
                        @endphp
                        @for($i = $year; $i > $year - 5; $i--)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor

                    </select>
                </div>
                <div class="box-body">
                    <div class="chart" data-graph="gir_chart">
                        <canvas id="gir_chart" style="height: 230px; width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>

        <div class="dash-graph">
            <div class="box box-success">
                <div class="box-header with-border" style="text-align: center;">
                    <h3 class="box-title graph-modal" data-graph="gmir_chart" style="display: inline; cursor: pointer;">Global Incident Rate(GMIR)</h3>
                    <select class="form-control select-year" id="year_gmir_chart" style="display: inline; width: 100px;">
                        @php
                            $year = date('Y');
                        @endphp
                        @for($i = $year; $i > $year - 5; $i--)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="box-body">
                    <div class="chart" data-graph="gmir_chart">
                        <canvas id="gmir_chart" style="height: 230px; width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>

        <div class="dash-graph">
            <div class="box box-success">
                <div class="box-header with-border" style="text-align: center;">
                    <h3 class="box-title graph-modal" data-graph="accident_chart" style="display: inline; cursor: pointer;">All Accident</h3>
                    <select class="form-control select-year" id="year_accident_chart" style="display: inline; width: 100px;">
                        @php
                            $year = date('Y');
                        @endphp
                        @for($i = $year; $i > $year - 5; $i--)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="box-body">
                    <div class="chart" data-graph="accident_chart">
                        <canvas id="accident_chart" style="height: 230px; width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>

        <div class="dash-graph">
            <div class="box box-success">
                <div class="box-header with-border" style="text-align: center;">
                    <h3 class="box-title graph-modal" data-graph="mss_chart" style="display: inline; cursor: pointer;">Work MSS</h3>
                    <select class="form-control select-year" id="year_mss_chart" style="display: inline; width: 100px;">
                        @php
                            $year = date('Y');
                        @endphp
                        @for($i = $year; $i > $year - 5; $i--)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="box-body">
                    <div class="chart" data-graph="mss_chart">
                        <canvas id="mss_chart" style="height: 230px; width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

    <div class="row burnaston">
        <div class="col-md-2" style="width: 14%;">
            <a href="{{ route('dashboard.go_page', 'assembly') }}" class="btn btn-default" style="width: 100%; height: 100px;  font-size: 26px; padding-top: 34px;">Assembly</a>
        </div>
        <div class="col-md-2" style="width: 14%;">
            <a href="{{ route('dashboard.go_page', 'body_shop') }}" class="btn btn-default" style="width: 100%; height: 100px;  font-size: 26px; padding-top: 34px;">Body Shop</a>
        </div>
        <div class="col-md-2" style="width: 16%;">
            <a href="{{ route('dashboard.go_page', 'paint_plastic') }}" class="btn btn-default" style="width: 100%; height: 100px;  font-size: 26px; padding-top: 34px;">Paint / Plastic</a>
        </div>

        <div class="col-md-2" style="width: 14%;">
            <a href="{{ route('dashboard.go_page', 'qa') }}" class="btn btn-default" style="width: 100%; height: 100px; font-size: 26px; padding-top: 34px;">QA</a>
        </div>
        <div class="col-md-2" style="width: 14%;">
            <a href="{{ route('dashboard.go_page', 'manufacturing') }}" class="btn btn-default" style="width: 100%; height: 100px; font-size: 20px; padding-top: 10px;">Manufacturing <br/>Support & <br/>Revenue</a>
        </div>
        <div class="col-md-2" style="width: 14%;">
            <a href="{{ route('dashboard.go_page', 'corporate') }}" class="btn btn-default" style="width: 100%; height: 100px;  font-size: 26px; padding-top: 34px;">Corporate</a>
        </div>
        <div class="col-md-2" style="width: 14%;">
            <a href="{{ route('dashboard.go_page', 'deeside') }}" class="btn btn-default" style="width: 100%; height: 100px;  font-size: 26px; padding-top: 34px;">Deeside</a>
        </div>
        {{--<div class="col-md-2" style="width: 14%;">
            <a href="{{ route('dashboard.go_page', 'deeside') }}" class="btn btn-default" style="width: 100%; height: 100px; font-size: 26px; padding-top: 34px;">Deeside</a>
        </div>--}}
    </div>

    <!-- /.row -->
    <div id="gModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" style="width:90%;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <a id="download_modal_graph"
                       data-chart = "modal_graph"
                       download="chart.jpg"
                       href="#"
                       class="download-chart btn btn-primary float-right bg-flat-color-1"
                       title="Download"
                       style="float: right; margin-right: 20px;">
                        <!-- Download Icon -->
                        <i class="fa fa-download"></i>
                    </a>
                    <h4 class="modal-title" id="g_modal_header">Modal Header</h4>

                </div>
                <div class="modal-body" style="min-height: 640px;">
                    <div class="col-md-12" id="" style="min-height: 600px;">
                        <canvas id="modal_graph" style="height: 600px; width: 100%;"></canvas>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div id="listModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" style="width:90%;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="listModalHeader">Modal Header</h4>
                </div>
                <div class="modal-body" style="min-height: 400px; height: auto;">
                    <div class="col-md-12" id="dash_list"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="dashboard_list_export">Export to Excel</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="user_group_name" value="{{ (Auth::user())?Auth::user()->groupName():'' }}">
@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')
    <script src="{{ cdn_asset('/adminlte/js/Chart.min.js') }}" type="text/javascript"></script>
    <script src="{{ cdn_asset('/js/table2csv.js') }}" type="text/javascript"></script>
    <script>
        $(function () {

            var user_group_name = $("#user_group_name").val();
            var select_group_name = $("#select_group_name").val();
            if(user_group_name == 'deeside' || select_group_name == 'deeside') {
                $(".deeside").show();
                $(".burnaston").hide();
                $(".all-value").hide();
                $(".deeside-value").show();
                $(".burnaston-value").hide();
            } else if(user_group_name == 'burnaston' || select_group_name == 'burnaston') {
                $(".deeside").hide();
                $(".burnaston").show();
                $(".all-value").hide();
                $(".deeside-value").hide();
                $(".burnaston-value").show();
            } else {
                $(".deeside").show();
                $(".burnaston").show();
                $(".all-value").show();
                $(".deeside-value").hide();
                $(".burnaston-value").hide();
            }

            $("#select_group_name").on('change', function () {
                var select_group = $("#select_group_name").val();
                if(select_group == 'deeside') {
                    $(".deeside").show();
                    $(".burnaston").hide();
                    $(".all-value").hide();
                    $(".deeside-value").show();
                    $(".burnaston-value").hide();
                } else if(select_group == 'burnaston') {
                    $(".deeside").hide();
                    $(".burnaston").show();
                    $(".all-value").hide();
                    $(".deeside-value").hide();
                    $(".burnaston-value").show();
                } else {
                    $(".deeside").show();
                    $(".burnaston").show();
                    $(".all-value").show();
                    $(".deeside-value").hide();
                    $(".burnaston-value").hide();
                }
                $(".chart").each(function () {
                    var e_chart = $(this).data('graph');
                    var graph_year = $("#year_"+e_chart).val();
                    draw_one_graph(graph_year, e_chart);
                });
            })
            var gir_chart = null;
            var gmir_chart = null;
            var accident_chart = null;
            var mss_chart = null;
            var modal_graph = null;
            var user_permission = $("#user_permission").val();

            $(".chart").each(function () {
                var e_chart = $(this).data('graph');
                var graph_year = $("#year_"+e_chart).val();
                draw_one_graph(graph_year, e_chart);
            });

            $("#dashboard_list_export").on('click', function () {
                $("#report_list_form").submit();
            });

            $(".dash-circle, .dash-circle2").on('click', function () {
                if(user_permission == 0)
                    return false;
                var range = $(this).data('range');
                var kind = $(this).data('kind');
                var selected_group = get_selected_group();
                $.ajax({
                    url: "{{route('dashboard.get_list')}}",
                    method: "POST",
                    data: {range:range, kind:kind, selected_group:selected_group},
                    dataType: "HTML",
                    statusCode: {
                        401: function () {
                            console.log('Login expired. Please sign in again.')
                        }
                    },
                    success: function (result) {
                        $("#dash_list").html(result);
                        $("#listModalHeader").text(kind.replace(/_/g," ").toUpperCase());
                        if(kind != "lost_time_incidents")
                            $("#report_list").DataTable({
                                "order": [[ 5, "desc" ]]
                            });
                        if(user_permission == 2) {
                            $(".admin-view").show()
                        } else {
                            $(".admin-view").hide()
                        }
                        $("#listModal").modal();
                    }
                });
            });

            $(document).on('click', '.report-tr', function () {
                if(user_permission < 2)
                    return false;
                var target = $(this).data('type');
                var item = $(this).data('item');
                location.href = target+'/'+item+'/edit';
            })

            $(".dash-circle2").on('click', function () {
                console.log('Let me confirm please. ')
            });

            $(".select-year").on('change', function () {
                var year = $(this).val();
                var chart = $(this).attr('id').replace('year_', '');
                draw_one_graph(year, chart);
            });

            var chartOptions = {
                scales: {
                    yAxes: [{
                        id: 'B',
                        position: 'right',
                        scaleLabel: {
                            display: true,
                            labelString: 'YTD'
                        },
                        ticks: {
                            stepSize: 3,
                            beginAtZero: true
                        }
                    },{
                        id: 'A',
                        position: 'left',
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        },
                        ticks: {
                            stepSize: 1,
                            beginAtZero: true
                        }
                    }]
                },
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    mode: 'index',
                    intersect: true
                },
                legend: {
                    display: true,
                    position: 'top',
                },
                title: {
                    display: false,
                    text: 'TEST',
                    fontColor: '#000',
                    fontSize: '20'
                },
            }

            function draw_one_graph(year, chart)
            {
                var selected_group = get_selected_group();
                $.ajax({
                    url: "{{route('dashboard::graph_data')}}",
                    method: "POST",
                    data: {e_chart:chart, graph_year:year, selected_group:selected_group},
                    dataType: "JSON",
                    statusCode: {
                        401: function () {
                            console.log('Login expired. Please sign in again.')
                        }
                    },
                    success: function (result) {
                        var g_data = result.graph_data
                        var ytd_data = result.ytd
                        var target = result.target
                        var max_val =  Math.max.apply(this, g_data) * 2;

                        var step_val =  Math.floor(max_val / 3);
                        if(step_val < 1)
                            step_val = 1;
                        var max_ytd_val =  Math.max.apply(this, ytd_data) * 2;
                        var step_ytd_val =  Math.floor(max_ytd_val / 3);
                        if(step_ytd_val < 1)
                            step_ytd_val = 1;
                        chartOptions.scales.yAxes[1].ticks.max = max_val
                        chartOptions.scales.yAxes[1].ticks.stepSize = step_val
                        /*chartOptions.scales.yAxes[0].ticks.max = max_ytd_val
                        chartOptions.scales.yAxes[0].ticks.stepSize = step_ytd_val*/
                        var chartData = {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            datasets: [{
                                type: 'line',
                                label: 'YTD',
                                borderColor: '#5B9BD5',
                                borderWidth: 2,
                                fill: false,
                                data: result.ytd,
                                yAxisID: 'B',
                            },{
                                type: 'bar',
                                label: 'Month',
                                borderColor: '#8064A2',
                                backgroundColor     : '#8064A2',
                                pointRadius          : false,
                                pointColor          : '#8064A2',
                                pointStrokeColor    : '#8064A2',
                                pointHighlightFill  : '#8064A2',
                                pointHighlightStroke: '#8064A2',
                                data: result.graph_data,
                                yAxisID: 'A',
                            },{
                                type: 'line',
                                label: 'Target',
                                borderColor: '#a5a5a5',
                                borderWidth: 2,
                                fill: false,
                                data: result.target,
                                yAxisID: 'B',
                            }]
                        };

                        var graph = $('#'+chart).get(0).getContext('2d');
                        switch(chart) {
                            case 'gir_chart':
                                if(gir_chart != null)
                                    gir_chart.destroy();
                                chartOptions.title.text = 'GIR';
                                gir_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'gmir_chart':
                                if(gmir_chart != null)
                                    gmir_chart.destroy();
                                chartOptions.title.text = 'GMIR';
                                gmir_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'accident_chart':
                                if(accident_chart != null)
                                    accident_chart.destroy();
                                chartOptions.title.text = 'Accident';
                                accident_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'mss_chart':
                                if(mss_chart != null)
                                    mss_chart.destroy();
                                chartOptions.title.text = 'MSS';
                                mss_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                        }
                    }
                });
            }

            $(".graph-modal").on('click', function () {
                var e_chart = $(this).data('graph');
                var graph_year = $("#year_"+e_chart).val();
                var selected_group = get_selected_group();
                $.ajax({
                    url: "{{route('dashboard::graph_data')}}",
                    method: "POST",
                    data: {e_chart:e_chart, graph_year:graph_year, selected_group:selected_group},
                    dataType: "JSON",
                    statusCode: {
                        401: function () {
                            console.log('Login expired. Please sign in again.')
                        }
                    },
                    success: function (result) {
                        $("#g_modal_header").text(e_chart.replace("_", " "));
                        var chartData = {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            datasets: [{
                                type: 'bar',
                                label: 'Month',
                                borderColor: '#8064A2',
                                backgroundColor     : '#8064A2',
                                pointRadius          : false,
                                pointColor          : '#8064A2',
                                pointStrokeColor    : '#8064A2',
                                pointHighlightFill  : '#8064A2',
                                pointHighlightStroke: '#8064A2',
                                data: result.graph_data,
                                yAxisID: 'A',
                            }, {
                                type: 'line',
                                label: 'YTD',
                                borderColor: '#5B9BD5',
                                borderWidth: 2,
                                fill: false,
                                data: result.ytd,
                                yAxisID: 'B',
                            },{
                                type: 'line',
                                label: 'Target',
                                borderColor: '#a5a5a5',
                                borderWidth: 2,
                                fill: false,
                                data: result.target,
                                yAxisID: 'B',
                            }]
                        };

                        var graph = $('#modal_graph').get(0).getContext('2d');
                        if(modal_graph != null)
                            modal_graph.destroy();
                        chartOptions.title.display = true;
                        modal_graph = new Chart(graph, {
                            type: 'bar',
                            data: chartData,
                            options: chartOptions
                        });
                        $("#gModal").modal();
                    }
                });
            });

            $(document).on('draw.dt', '#report_list', function () {
                if(user_permission == 2) {
                    $(".admin-view").show()
                } else {
                    $(".admin-view").hide()
                }
            })

            $(".download-chart").on('click', function () {
                var chart_id = $(this).data('chart');
                var a_id = $(this).attr('id');
                var url_base64jp = document.getElementById(chart_id).toDataURL("image/jpg");
                /*get download button (tag: <a></a>) */
                var a =  document.getElementById(a_id);
                /*insert chart image url to download button (tag: <a></a>) */
                a.href = url_base64jp;
            });

            function get_selected_group()
            {
                var user_group_name = $("#user_group_name").val();
                var select_group_name = $("#select_group_name").val();
                if(user_group_name == 'deeside' || select_group_name == 'deeside') {
                    var selected_group = 'deeside';
                } else if(user_group_name == 'burnaston' || select_group_name == 'burnaston') {
                    var selected_group = 'burnaston';
                } else {
                    var selected_group = 'all';
                }
                return selected_group;
            }

        });
    </script>
@endsection
