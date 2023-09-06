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
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border" style="text-align: center;">
                    {{--<h3 class="box-title" style="display: inline;">{{$page_title}}</h3>--}}
                    <a id="download_{{$page}}"
                       data-chart = "{{$page}}_chart"
                       download="{{$page}}.jpg"
                       href="#"
                       class="download-chart btn btn-primary float-right bg-flat-color-1"
                       title="Download"
                       style="float: right; margin-bottom: -100px;">
                        <!-- Download Icon -->
                        <i class="fa fa-download"></i>
                    </a>
                    <select class="form-control" id="graph_year" style="display: inline; width: 100px; margin-right: 50px; float: right; margin-bottom: -100px;">
                        @php
                            $year = date('Y');
                        @endphp
                        @for($i = $year; $i > $year - 5; $i--)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>

                </div>
                <div class="box-body">
                    <div class="chart" data-graph="{{ $page }}_chart" tyle="height: 400px;">
                        <canvas id="{{ $page }}_chart" style="height: 400px;"></canvas>
                    </div>
                    <div class="col-md-6" style="text-align: center">
                        @if($page == 'manufacturing')
                            <button type="button" class="btn btn-default go-list" style="width: 200px;" value="{{$page}}_accident">{!! str_replace(" &", "<br/>&", $page_title) !!}<br/>Accidents</button>
                        @else
                            <button type="button" class="btn btn-default go-list" style="width: 200px;" value="{{$page}}_accident">{{$page_title}}<br/>Accidents</button>
                        @endif
                    </div>
                    <div class="col-md-6" style="text-align: center">
                        @if($page == 'manufacturing')
                            <button type="button" class="btn btn-default go-list" style="width: 200px;" value="{{$page}}_mss">{!! str_replace(" &", "<br/>&", $page_title) !!}<br/>MSS</button>
                        @else
                            <button type="button" class="btn btn-default go-list" style="width: 200px;" value="{{$page}}_mss">{{$page_title}}<br/>MSS</button>
                        @endif

                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        @foreach($sub_buttons as $key => $sub_button)
            @if($page_title == "Paint / Plastic" || $page_title == "Body Shop")
                <div class="col-md-6">
            @else
                <div class="col-md-4">
            @endif
                <div class="box box-success">
                    <div class="box-header with-border" style="text-align: center;">
                        @if($page_title == "Paint / Plastic")
                            {{--<h3 class="box-title">{{$sub_button}}</h3>--}}
                            <a id="download_{{$key}}"
                               data-chart = "{{$key}}_chart"
                               download="{{$key}}.jpg"
                               href="#"
                               class="download-chart btn btn-primary float-right bg-flat-color-1"
                               title="Download" style="float: right; margin-bottom: -100px;">
                                <!-- Download Icon -->
                                <i class="fa fa-download"></i>
                            </a>
                        @else
                            {{--<h3 class="box-title">{{$page_title}} {{$sub_button}}</h3>--}}
                            <a id="download_{{ $page }}_{{$key}}"
                               data-chart = "{{ $page }}_{{$key}}_chart"
                               download="{{ $page }}_{{$key}}.jpg"
                               href="#"
                               class="download-chart btn btn-primary bg-flat-color-1"
                               title="Download" style="float: right; margin-bottom: -100px;">
                                <!-- Download Icon -->
                                <i class="fa fa-download"></i>
                            </a>
                        @endif

                    </div>
                    <div class="box-body">
                        @if($page_title == "Paint / Plastic")
                            <div class="chart" data-graph="{{$key}}_chart">
                                <canvas id="{{ $key }}_chart" style="height: 230px; width: 100%;"></canvas>
                            </div>
                        @else
                            <div class="chart" data-graph="{{ $page }}_{{$key}}_chart">
                                <canvas id="{{ $page }}_{{ $key }}_chart" style="height: 230px; width: 100%;"></canvas>
                            </div>
                        @endif

                        <div class="col-md-6" style="text-align: center">
                            @if($page_title == "Paint / Plastic")
                                <button type="button" class="btn btn-default go-list" style="width: 150px;" value="{{ $key }}_accident">{!! str_replace("  ", "<br/>", $sub_button) !!}<br/>Accidents</button>
                            @else
                                <button type="button" class="btn btn-default go-list" style="width: 150px;" value="{{$page}}_{{ $key }}_accident">{{$page_title}}<br/>{{$sub_button}}<br/>Accidents</button>
                            @endif

                        </div>
                        <div class="col-md-6" style="text-align: center">
                            @if($page_title == "Paint / Plastic")
                                <button type="button" class="btn btn-default go-list" style="width: 150px;" value="{{ $key }}_mss">{!! str_replace("  ", "<br/>", $sub_button) !!}<br/>MSS</button>
                            @else
                                <button type="button" class="btn btn-default go-list" style="width: 150px;" value="{{$page}}_{{ $key }}_mss">{{$page_title}}<br/>{{$sub_button}}<br/>MSS</button>
                            @endif

                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        @endforeach
    </div>
    <div class="row" style="display: none;">
        <form action="{{route('dashboard.go_list')}}" method="post" id="go_list_form">
            {{csrf_field()}}
            <input type="hidden" id="graph_type" name="graph_type" value="">
            <input type="hidden" id="year" name="year" value="">
        </form>
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
                    <button type="button" class="btn btn-primary" id="graph_export">Export to Excel</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')
    <script src="{{ cdn_asset('/adminlte/js/Chart.min.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            var user_permission = $("#user_permission").val();
            var assembly_chart = null;
            var body_shop_chart = null;
            var paint_plastic_chart = null;
            var qa_chart = null;
            var manufacturing_chart = null;
            var corporate_chart = null;
            var deeside_chart = null;

            var assembly_production_chart = null;
            var assembly_logistics_chart = null;
            var assembly_maint_eng_chart = null;

            var body_shop_production_chart = null;
            var body_shop_maint_eng_chart = null;

            var paint_shop_production_chart = null;
            var paint_shop_maint_eng_chart = null;
            var plastics_shop_production_chart = null;
            var plastics_shop_maint_eng_chart = null;

            $(".chart").each(function () {
                var chart = $(this).data('graph')
                draw_one_graph(chart)
            })

            $("#graph_year").on('change', function () {
                draw_graph();
            });

            $(".go-list").on('click', function () {
                if(user_permission == 0)
                    return false;
                var graph_type = $(this).val();
                $("#graph_type").val(graph_type);
                $("#year").val($("#graph_year").val());
                var form = $("#go_list_form");
                $.ajax({
                    url: "{{route('dashboard.go_list')}}",
                    method: "POST",
                    data: form.serialize(),
                    dataType: "HTML",
                    statusCode: {
                        401: function () {
                            console.log('Login expired. Please sign in again.')
                        }
                    },
                    success: function (result) {
                        $("#dash_list").html(result);
                        $("#listModalHeader").text(graph_type.replace(/_/g," ").toUpperCase());
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

            $("#graph_export").on('click', function () {
                $("#report_list_form").submit();
            });

            $(document).on('draw.dt', '#report_list', function () {
                if(user_permission == 2) {
                    $(".admin-view").show()
                } else {
                    $(".admin-view").hide()
                }
            })

            function draw_one_graph(chart)
            {
                var graph_year = $("#graph_year").val();
                $.ajax({
                    url: "{{route('dashboard::standard_graph')}}",
                    method: "POST",
                    data: {e_chart:chart, graph_year:graph_year},
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
                                label: 'Accidents',
                                backgroundColor: "#F4B183",
                                data: result.accidents
                            },{
                                label: 'MSS',
                                backgroundColor: "#FFE699",
                                data: result.mss
                            }]
                        };

                        var chartOptions = {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        stepSize: 1,
                                        beginAtZero: true
                                    }
                                }]
                            },
                            maintainAspectRatio: false,
                            title: {
                                display: true,
                                text: 'TEST',
                                fontColor: '#000',
                                fontSize: '20'
                            }
                        }

                        var graph = $('#'+chart).get(0).getContext('2d');
                        switch(chart) {
                            case 'assembly_chart':
                                if(assembly_chart != null)
                                    assembly_chart.destroy();
                                chartOptions.title.text = 'Assembly';
                                assembly_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'body_shop_chart':
                                if(body_shop_chart != null)
                                    body_shop_chart.destroy();
                                chartOptions.title.text = 'Body Shop';
                                body_shop_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'paint_plastic_chart':
                                if(paint_plastic_chart != null)
                                    paint_plastic_chart.destroy();
                                chartOptions.title.text = 'Paint / Plastic';
                                paint_plastic_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'qa_chart':
                                if(qa_chart != null)
                                    qa_chart.destroy();
                                chartOptions.title.text = 'QA';
                                qa_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'manufacturing_chart':
                                if(manufacturing_chart != null)
                                    manufacturing_chart.destroy();
                                chartOptions.title.text = 'Manufacturing Support & Revenue';
                                manufacturing_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'corporate_chart':
                                if(corporate_chart != null)
                                    corporate_chart.destroy();
                                chartOptions.title.text = 'Corporate';
                                corporate_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'deeside_chart':
                                if(deeside_chart != null)
                                    deeside_chart.destroy();
                                chartOptions.title.text = 'Deeside';
                                deeside_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'assembly_production_chart':
                                if(assembly_production_chart != null)
                                    assembly_production_chart.destroy();
                                chartOptions.title.text = 'Assembly Production';
                                assembly_production_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'assembly_logistics_chart':
                                if(assembly_logistics_chart != null)
                                    assembly_logistics_chart.destroy();
                                chartOptions.title.text = 'Assembly Logistics';
                                assembly_logistics_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'assembly_maint_eng_chart':
                                if(assembly_maint_eng_chart != null)
                                    assembly_maint_eng_chart.destroy();
                                chartOptions.title.text = 'Assembly Maint/Eng';
                                assembly_maint_eng_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options:chartOptions
                                });
                                break;
                            case 'body_shop_production_chart':
                                if(body_shop_production_chart != null)
                                    body_shop_production_chart.destroy();
                                chartOptions.title.text = 'Body Shop Production';
                                body_shop_production_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options:chartOptions
                                });
                                break;
                            case 'body_shop_maint_eng_chart':
                                if(body_shop_maint_eng_chart != null)
                                    body_shop_maint_eng_chart.destroy();
                                chartOptions.title.text = 'Body Shop Maint/Eng';
                                body_shop_maint_eng_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options:chartOptions
                                });
                                break;
                            case 'paint_shop_production_chart':
                                if(paint_shop_production_chart != null)
                                    paint_shop_production_chart.destroy();
                                chartOptions.title.text = 'Paint Shop Production';
                                paint_shop_production_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'paint_shop_maint_eng_chart':
                                if(paint_shop_maint_eng_chart != null)
                                    paint_shop_maint_eng_chart.destroy();
                                chartOptions.title.text = 'Paint Shop Maint/Eng';
                                paint_shop_maint_eng_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'plastics_shop_production_chart':
                                if(plastics_shop_production_chart != null)
                                    plastics_shop_production_chart.destroy();
                                chartOptions.title.text = 'Plastics Shop Production';
                                plastics_shop_production_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'plastics_shop_maint_eng_chart':
                                if(plastics_shop_maint_eng_chart != null)
                                    plastics_shop_maint_eng_chart.destroy();
                                chartOptions.title.text = 'Plastics Shop Maint/Eng';
                                plastics_shop_maint_eng_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                        }
                    }
                });
            }

            function draw_graph() {
                $(".chart").each(function () {
                    var chart = $(this).data('graph')
                    draw_one_graph(chart)
                })
            }

            $(".download-chart").on('click', function () {
                var chart_id = $(this).data('chart');
                var canvas = document.getElementById(chart_id);
                if(canvas.msToBlob){
                    var blob = canvas.msToBlob();
                    window.navigator.msSaveBlob(blob, chart_id + '.png');
                }
                else{
                    var a_id = $(this).attr('id');
                    var url_base64jp = document.getElementById(chart_id).toDataURL("image/jpg");
                    /*get download button (tag: <a></a>) */
                    var a =  document.getElementById(a_id);
                    /*insert chart image url to download button (tag: <a></a>) */
                    a.href = url_base64jp;
                }
            });
        });
    </script>
@endsection
