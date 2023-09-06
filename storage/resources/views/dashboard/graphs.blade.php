{{-- Extends Layout --}}
@extends('layouts.backend')

{{-- Breadcrumbs --}}
@section('breadcrumbs')
    {!! Breadcrumbs::render('dashboard') !!}
@endsection

{{-- Page Title --}}
@section('page-title', $page_title)

{{-- Page Subtitle --}}
@section('page-subtitle', '')

{{-- Header Extras to be Included --}}
@section('head-extras')
<style>

</style>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border" style="text-align: center;">
                    <h3 class="box-title">{{$page_title}} Lost Time Incident</h3>
                </div>
                <div class="box-body">
                    <div class="chart" data-graph="lost_time_chart">
                        <canvas id="lost_time_chart" style="height: 230px; width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border" style="text-align: center;">
                    <h3 class="box-title">{{$page_title}} Accidents</h3>
                </div>
                <div class="box-body">
                    <div class="chart" data-graph="accident_chart">
                        <canvas id="accident_chart" style="height: 230px; width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border" style="text-align: center;">
                    <h3 class="box-title">{{$page_title}} MSS</h3>
                </div>
                <div class="box-body">
                    <div class="chart" data-graph="mss_chart">
                        <canvas id="mss_chart" style="height: 230px; width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border" style="text-align: center;">
                    <h3 class="box-title">{{$page_title}} Fires</h3>
                </div>
                <div class="box-body">
                    <div class="chart" data-graph="fires_chart">
                        <canvas id="fires_chart" style="height: 230px; width: 100%;"></canvas>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

    <div class="row">
        <form action="{{route('dashboard.go_list')}}" method="post" id="go_list_form">
            {{csrf_field()}}
        <div class="col-md-2">
            <button type="button" class="btn btn-default go-list" style="width: 100%; height: 100px; font-size: 30px;" id="accident">Accident</button>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-default go-list" style="width: 100%; height: 100px; font-size: 30px;" id="mss">MSS</button>
        </div>
        <div class="col-md-2">
            <select class="form-control" id="graph_year" name="graph_year">
                @php
                    $year = date('Y');
                @endphp
                @for($i = $year; $i > $year - 10; $i--)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <input type="hidden" id="section" name="section" value="{{$section}}">
        <input type="hidden" id="graph_type" name="graph_type" value="">
        </form>
    </div>
    <!-- /.row -->

@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')
    <script src="{{ cdn_asset('/adminlte/js/Chart.min.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            var lost_time_chart = null;
            var accident_chart = null;
            var mss_chart = null;
            var fires_chart = null;

            draw_graph();

            $("#graph_year").on('change', function () {
                draw_graph();
            });

            $(".go-list").on('click', function () {
                var graph_type = $(this).attr('id');
                $("#graph_type").val(graph_type);
                $("#go_list_form").submit();
            });

            function draw_graph() {
                $(".chart").each(function () {
                    var e_chart = $(this).data('graph');
                    var graph_year = $("#graph_year").val();
                    var standard = $("#standard").val();
                    $.ajax({
                        url: "{{route('dashboard.standard_graph')}}",
                        method: "POST",
                        data: {e_chart:e_chart, graph_year:graph_year, standard:standard},
                        dataType: "JSON",
                        statusCode: {
                            401: function () {
                                console.log('Login expired. Please sign in again.')
                            }
                        },
                        success: function (result) {
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

                            var graph = $('#'+e_chart).get(0).getContext('2d');
                            switch(e_chart) {
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
                                case 'accident_chart':
                                    if(accident_chart != null)
                                        accident_chart.destroy();
                                    accident_chart = new Chart(graph, {
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
                                case 'fires_chart':
                                    if(fires_chart != null)
                                        fires_chart.destroy();
                                    fires_chart = new Chart(graph, {
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
                            }
                        }
                    });
                });
            }


        });


    </script>
@endsection
