{{-- Extends Layout --}}
@extends('layouts.backend')

{{-- Breadcrumbs --}}
@section('breadcrumbs')
    {!! Breadcrumbs::render('dashboard') !!}
@endsection

{{-- Page Title --}}
@section('page-title', 'Dashboard')

{{-- Page Subtitle --}}
@section('page-subtitle', 'it all starts here')

{{-- Header Extras to be Included --}}
@section('head-extras')
<style>
    .dash-circle {
        margin:0 auto;width:70px;height: 70px;border-radius: 50%; text-align: center; padding-top: 17px; font-size: 26px; cursor: pointer;
    }

    .dash-circle2 {
        margin:0 auto;width:52px;height: 52px;border-radius: 50%; text-align: center; padding-top: 12px; font-size: 22px; cursor: pointer;
    }

    .dash-graph {
        width: 20%;
        float: left;
        position: relative;
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px;
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
                    <table class="">
                        <tr>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">Lost Time Incidents</td>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">Accident</td>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">MSS</td>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">Contractor Accident</td>
                        </tr>
                        <tr>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="year" data-kind="lost_time_incidents" style="background-color: #A9D18E;">{{ $y_lost_time_incidents }}</div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="year" data-kind="accident" style="background-color: #A9D18E;">{{ $y_accidents }}</div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="year" data-kind="mss" style="background-color: #A9D18E;">{{ $y_mss }}</div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="year" data-kind="contractor_accident" style="background-color: #A9D18E;">{{ $y_contractor_accidents }}</div>
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
                    <table class="">
                        <tr>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">Lost Time Incidents</td>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">Accident</td>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">MSS</td>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">Contractor Accident</td>
                        </tr>
                        <tr>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="month" data-kind="lost_time_incidents" style="background-color: #A9D18E;">{{ $m_lost_time_incidents }}</div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="month" data-kind="accident" style="background-color: #A9D18E;">{{ $m_accidents }}</div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="month" data-kind="mss" style="background-color: #A9D18E;">{{ $m_mss }}</div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="month" data-kind="contractor_accident" style="background-color: #A9D18E;">{{ $m_contractor_accidents }}</div>
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
                    <table class="">
                        <tr>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">Lost Time Incidents</td>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">Accident</td>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">MSS</td>
                            <td style="width: 25%; text-align: center; vertical-align: middle;">Contractor Accident</td>
                        </tr>
                        <tr>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="week" data-kind="lost_time_incidents" style="background-color: #A9D18E;">{{ $w_lost_time_incidents }}</div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="week" data-kind="accident" style="background-color: #A9D18E;">{{ $w_accidents }}</div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="week" data-kind="mss" style="background-color: #A9D18E;">{{ $w_mss }}</div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle" data-range="week" data-kind="contractor_accident" style="background-color: #A9D18E;">{{ $w_contractor_accidents }}</div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header" style="text-align: center">
                    <h3 class="box-title">WPI Reports Status</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="">
                        <tr>
                            <td style="text-align: center; vertical-align: middle; height: 28px; font-weight: bold;" colspan="3">Accidents</td>
                            <td style="text-align: center; vertical-align: middle; height: 28px; font-weight: bold;" colspan="4">MSS</td>
                        </tr>
                        <tr>
                            <td style="width: 16%; text-align: center; vertical-align: middle;height: 30px;">Received</td>
                            <td style="width: 16%; text-align: center; vertical-align: middle;height: 30px;">Due</td>
                            <td style="width: 16%; text-align: center; vertical-align: middle;height: 30px;">Overdue</td>
                            <td style="width: 4%;"></td>
                            <td style="width: 16%; text-align: center; vertical-align: middle;height: 30px;">Received</td>
                            <td style="width: 16%; text-align: center; vertical-align: middle;height: 30px;">Due</td>
                            <td style="width: 16%; text-align: center; vertical-align: middle;height: 30px;">Overdue</td>
                        </tr>
                        <tr>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle2" style="background-color: #A9D18E;">0</div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle2" style="background-color: #F4B183;">2</div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle2" style="background-color: #FF0000;">2</div>
                            </td>
                            <td style="width: 4%;"></td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle2" style="background-color: #A9D18E;">0</div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle2" style="background-color: #F4B183;">2</div>
                            </td>
                            <td style="padding: 3px; text-align: center;">
                                <div class="dash-circle2" style="background-color: #FF0000;">2</div>
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
                    <h3 class="box-title graph-modal" data-graph="gir_chart" style="cursor: pointer;">Global Incident Rate(GIR)</h3>
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
                    <h3 class="box-title graph-modal" data-graph="gmir_chart" style="cursor: pointer;">Global Incident Rate(GMIR)</h3>
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
                    <h3 class="box-title graph-modal" data-graph="lost_time_chart" style="cursor: pointer;">Lost Time Incident</h3>
                </div>
                <div class="box-body">
                    <div class="chart" data-graph="lost_time_chart">
                        <canvas id="lost_time_chart" style="height: 230px; width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="dash-graph">
            <div class="box box-success">
                <div class="box-header with-border" style="text-align: center;">
                    <h3 class="box-title graph-modal" data-graph="injuries_chart" style="cursor: pointer;">All Accident</h3>
                </div>
                <div class="box-body">
                    <div class="chart" data-graph="injuries_chart">
                        <canvas id="injuries_chart" style="height: 230px; width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="dash-graph">
            <div class="box box-success">
                <div class="box-header with-border" style="text-align: center;">
                    <h3 class="box-title graph-modal" data-graph="mss_chart" style="cursor: pointer;">Work MSS</h3>
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

    <div class="row">
        <div class="col-md-11">
            <div class="box box-success">
                <div class="box-header with-border" style="text-align: center;">
                    <h3 class="box-title">Work Incidents Year To Date</h3>
                </div>
                <div class="box-body">
                    <div class="chart" data-graph="year_chart">
                        <canvas id="year_chart" style="height: 300px; width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-1">
            <select class="form-control" id="graph_year" name="graph_year">
                @php
                $year = date('Y');
                @endphp
                @for($i = $year; $i > $year - 10; $i--)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor

            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('home.assembly') }}" class="btn btn-default" style="width: 100%; height: 100px; font-size: 30px; padding-top: 30px;">Assembly</a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('home.body_shop') }}" class="btn btn-default" style="width: 100%; height: 100px; font-size: 30px; padding-top: 30px;">Body Shop</a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('home.paint_plastic') }}" class="btn btn-default" style="width: 100%; height: 100px; font-size: 30px; padding-top: 30px;">Paint / Plastic</a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('home.logistic') }}" class="btn btn-default" style="width: 100%; height: 100px; font-size: 30px; padding-top: 30px;">Logistics</a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('home.facilities') }}" class="btn btn-default" style="width: 100%; height: 100px; font-size: 30px; padding-top: 30px;">Facilities</a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('home.qa') }}" class="btn btn-default" style="width: 100%; height: 100px; font-size: 30px; padding-top: 30px;">QA</a>
        </div>
    </div>
    <!-- /.row -->
    <div id="gModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" style="width:90%;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="g_modal_header">Modal Header</h4>
                </div>
                <div class="modal-body">
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


@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')
    <script src="{{ cdn_asset('/adminlte/js/Chart.min.js') }}" type="text/javascript"></script>
    <script src="{{ cdn_asset('/js/table2csv.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            var gir_chart = null;
            var gmir_chart = null;
            var lost_time_chart = null;
            var injuries_chart = null;
            var mss_chart = null;
            var year_chart = null;
            var modal_graph = null;

            draw_graph();

            $("#dashboard_list_export").on('click', function () {
                var kind = $("#report_list_kind").val();
                if(kind == "lost_time_incidents") {
                    $("#report_list").find('span').remove();
                    $("#report_list").table2csv();
                } else {
                    $("#report_list_form").submit();
                }
            });

            $(".dash-circle").on('click', function () {
                var range = $(this).data('range');
                var kind = $(this).data('kind');

                $.ajax({
                    url: "{{route('dashboard.get_list')}}",
                    method: "POST",
                    data: {range:range, kind:kind},
                    dataType: "HTML",
                    statusCode: {
                        401: function () {
                            console.log('Login expired. Please sign in again.')
                        }
                    },
                    success: function (result) {
                        $("#dash_list").html(result);
                        $("#listModalHeader").text(kind.replaceAll("_", " ").toUpperCase());
                        if(kind != "lost_time_incidents")
                            $("#report_list").DataTable();
                        $("#listModal").modal();
                    }
                });
            });

            $(".dash-circle2").on('click', function () {
                console.log('Let me confirm please. ')
            });

            $("#graph_year").on('change', function () {
                draw_graph();
            });

            $(".graph-modal").on('click', function () {
                var graph_year = $("#graph_year").val();
                var e_chart = $(this).data('graph');

                $.ajax({
                    url: "{{route('dashboard.graph_data')}}",
                    method: "POST",
                    data: {e_chart:e_chart, graph_year:graph_year},
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
                                data: result.graph_data
                            }, {
                                type: 'line',
                                label: 'YTD',
                                borderColor: '#5B9BD5',
                                borderWidth: 2,
                                fill: false,
                                data: result.graph_data
                            }, {
                                type: 'line',
                                label: 'Target',
                                borderColor: '#2d2d2d',
                                borderWidth: 2,
                                fill: false,
                                data: result.target
                            }]
                        };

                        var graph = $('#modal_graph').get(0).getContext('2d');
                        if(modal_graph != null)
                            modal_graph.destroy();
                        modal_graph = new Chart(graph, {
                            type: 'bar',
                            data: chartData,
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                tooltips: {
                                    mode: 'index',
                                    intersect: true
                                }
                            }
                        });
                        $("#gModal").modal();
                    }
                });

            });

            function draw_graph() {
                $(".chart").each(function () {
                    var e_chart = $(this).data('graph');
                    var graph_year = $("#graph_year").val();
                    $.ajax({
                        url: "{{route('dashboard.graph_data')}}",
                        method: "POST",
                        data: {e_chart:e_chart, graph_year:graph_year},
                        dataType: "JSON",
                        statusCode: {
                            401: function () {
                                console.log('Login expired. Please sign in again.')
                            }
                        },
                        success: function (result) {
                            if(e_chart == "year_chart") {
                                var y_str = graph_year.slice(-2);
                                var chartData = {
                                    labels  : ['Jan-'+y_str, 'Feb-'+y_str, 'Mar-'+y_str, 'Apr-'+y_str, 'May-'+y_str, 'Jun-'+y_str, 'Jul-'+y_str, 'Aug-'+y_str, 'Sep-'+y_str, 'Oct-'+y_str, 'Nov-'+y_str, 'Dec-'+y_str],
                                    datasets: [
                                        {
                                            label               : 'Lost Time',
                                            backgroundColor     : 'rgba(60,141,188,0.9)',
                                            borderColor         : 'rgba(60,141,188,0.8)',
                                            pointRadius          : false,
                                            pointColor          : '#3b8bba',
                                            pointStrokeColor    : 'rgba(60,141,188,1)',
                                            pointHighlightFill  : '#fff',
                                            pointHighlightStroke: 'rgba(60,141,188,1)',
                                            data                : result.lost_time_data
                                        },
                                        {
                                            label               : 'Accidents',
                                            backgroundColor     : '#FF66CC',
                                            borderColor         : '#FF66CC',
                                            pointRadius          : false,
                                            pointColor          : '#3b8bba',
                                            pointStrokeColor    : 'rgba(60,141,188,1)',
                                            pointHighlightFill  : '#fff',
                                            pointHighlightStroke: 'rgba(60,141,188,1)',
                                            data                : result.accident_data
                                        },
                                        {
                                            label               : 'MSS',
                                            backgroundColor     : '#FFC000',
                                            borderColor         : '#FFC000',
                                            pointRadius          : false,
                                            pointColor          : '#3b8bba',
                                            pointStrokeColor    : 'rgba(60,141,188,1)',
                                            pointHighlightFill  : '#fff',
                                            pointHighlightStroke: 'rgba(60,141,188,1)',
                                            data                : result.mss_data
                                        }
                                    ]
                                }
                            } else {
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
                                        data: result.graph_data
                                    }, {
                                        type: 'line',
                                        label: 'YTD',
                                        borderColor: '#5B9BD5',
                                        borderWidth: 2,
                                        fill: false,
                                        data: result.graph_data
                                    }, {
                                        type: 'line',
                                        label: 'Target',
                                        borderColor: '#2d2d2d',
                                        borderWidth: 2,
                                        fill: false,
                                        data: result.target
                                    }]
                                };
                            }

                            var graph = $('#'+e_chart).get(0).getContext('2d');
                            switch(e_chart) {
                                case 'gir_chart':
                                    if(gir_chart != null)
                                        gir_chart.destroy();
                                    gir_chart = new Chart(graph, {
                                        type: 'bar',
                                        data: chartData,
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            tooltips: {
                                                mode: 'index',
                                                intersect: true
                                            }
                                        }
                                    });
                                    break;
                                case 'gmir_chart':
                                    if(gmir_chart != null)
                                        gmir_chart.destroy();
                                    gmir_chart = new Chart(graph, {
                                        type: 'bar',
                                        data: chartData,
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            tooltips: {
                                                mode: 'index',
                                                intersect: true
                                            }
                                        }
                                    });
                                    break;
                                case 'lost_time_chart':
                                    if(lost_time_chart != null)
                                        lost_time_chart.destroy();
                                    lost_time_chart = new Chart(graph, {
                                        type: 'bar',
                                        data: chartData,
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            tooltips: {
                                                mode: 'index',
                                                intersect: true
                                            }
                                        }
                                    });
                                    break;
                                case 'injuries_chart':
                                    if(injuries_chart != null)
                                        injuries_chart.destroy();
                                    injuries_chart = new Chart(graph, {
                                        type: 'bar',
                                        data: chartData,
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            tooltips: {
                                                mode: 'index',
                                                intersect: true
                                            }
                                        }
                                    });
                                    break;
                                case 'mss_chart':
                                    if(mss_chart != null)
                                        mss_chart.destroy();
                                    mss_chart = new Chart(graph, {
                                        type: 'bar',
                                        data: chartData,
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            tooltips: {
                                                mode: 'index',
                                                intersect: true
                                            }
                                        }
                                    });
                                    break;
                                case 'year_chart':
                                    if(year_chart != null)
                                        year_chart.destroy();
                                    var barChartData = jQuery.extend(true, {}, chartData);
                                    year_chart = new Chart(graph, {
                                        type: 'bar',
                                        data: barChartData,
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            tooltips: {
                                                mode: 'index',
                                                intersect: true
                                            }
                                        }
                                    });
                                    break;
                            }
                        }
                    });
                });
            }
        });
    </script>
@endsection
