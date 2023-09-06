{{-- Extends Layout --}}
@extends('layouts.backend')
@section('head-extras')

@stop

{{-- Page Title --}}
@section('page-title', 'All Accidents')

{{-- Page Subtitle --}}
@section('page-subtitle', 'First Aid Accidents')

{{-- Header Extras to be Included --}}
@section('head-extras')
    @parent
@endsection

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Select Date Range</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" class="form-horizontal" id="report_form">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="date_type" class="col-sm-2 control-label">Date Type Select</label>
                            <div class="col-sm-1">
                                <select id="date_type" class="form-control" name="date_type">
                                    <option value="year" selected>Year</option>
                                    <option value="month">Month</option>
                                    <option value="week">Week</option>
                                    <option value="custom">Custom</option>
                                </select>
                            </div>
                            <label for="date_type" class="col-sm-2 control-label">Date Range Select</label>
                            <div class="col-md-5">
                                <div class="input-group date" id="year_range">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right " id="year_picker" name="year_picker">
                                </div>

                                <div class="input-group date" id="month_range" style="display: none;">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="month_picker" name="month_picker">
                                </div>

                                <div class="input-group date" id="week_range" style="display: none;">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="week_picker" name="week_picker">
                                </div>

                                <div class="row date" id="custom_range" style="display: none;">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="from_date" name="from_date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="to_date" name="to_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary" id="load_report_data">Load Data</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <input type="hidden" id="report_name" name="report_name" value="all_accidents">
                    <input type="hidden" id="sub_name" name="sub_name" value="aid_accidents">
                </form>
            </div>
        </div>

        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Report Data</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="min-height: 600px; overflow: auto" id="report_data">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Group</th>
                            <th>Dept</th>
                            @foreach($columns as $column)
                                <th>{{$column}}</th>
                            @endforeach
                            <th>TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!--------A-------->
                        <tr>
                            <td>A1???</td>
                            <td style="text-align: left;">External Affairs</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>A2???</td>
                            <td style="text-align: left;">External Affairs</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>A9???</td>
                            <td style="text-align: left;">External Affairs</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            @foreach($columns as $column)
                                <td>&nbsp;</td>
                            @endforeach
                            <td>&nbsp;</td>
                        </tr>
                        <tr style="background-color: yellow;">
                            <td>CP & Dir</td>
                            <td style="text-align: left;">Corporate Planning & Directors Office</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            @foreach($columns as $column)
                                <td>&nbsp;</td>
                            @endforeach
                            <td>&nbsp;</td>
                        </tr>

                        <!--------B-------->
                        <tr>
                            <td>B1???</td>
                            <td style="text-align: left;">Personnel & Employee Relations</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>B2???</td>
                            <td style="text-align: left;">Headcount Planning Resourcing</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>B3???</td>
                            <td style="text-align: left;">Health Safety</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>B4???</td>
                            <td style="text-align: left;">Administration & HR Systems</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>B5???</td>
                            <td style="text-align: left;">Organisation Development</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>B6???</td>
                            <td style="text-align: left;">Ex-Pats / TME Xfr</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>B7???</td>
                            <td style="text-align: left;">HR GM</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            @foreach($columns as $column)
                                <td>&nbsp;</td>
                            @endforeach
                            <td>&nbsp;</td>
                        </tr>
                        <tr style="background-color: yellow;">
                            <td>HR Div</td>
                            <td style="text-align: left;">Human Resources</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            @foreach($columns as $column)
                                <td>&nbsp;</td>
                            @endforeach
                            <td>&nbsp;</td>
                        </tr>

                        <!--------C-------->
                        <tr>
                            <td>C1???</td>
                            <td style="text-align: left;">Accounts & Finance</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>C2???</td>
                            <td style="text-align: left;">&nbsp;</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>C3???</td>
                            <td style="text-align: left;">Corporate Services</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>C9???</td>
                            <td style="text-align: left;">F&CS GM</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            @foreach($columns as $column)
                                <td>&nbsp;</td>
                            @endforeach
                            <td>&nbsp;</td>
                        </tr>
                        <tr style="background-color: yellow;">
                            <td>A&F Div</td>
                            <td style="text-align: left;">Accounts & Finance</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>

                        <!--------E---------->
                        <tr>
                            <td style="background-color: #00FFFF"></td>
                            <td style="background-color: #00FFFF; text-align: left;">corporate office</td>
                            @foreach($columns as $column)
                                <td>&nbsp;</td>
                            @endforeach
                            <td>&nbsp;</td>
                        </tr>

                        <tr>
                            <td>E1???</td>
                            <td style="text-align: left;">Not Used Yet</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>E2???</td>
                            <td style="text-align: left;">Not Used Yet</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>E3???</td>
                            <td style="text-align: left;">Plant Management</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>E4???</td>
                            <td style="text-align: left;">Supply Chain & Project Management</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>E5???</td>
                            <td style="text-align: left;">Parts Flow Management</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>E6???</td>
                            <td style="text-align: left;">Logistics Operations</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>E7???</td>
                            <td style="text-align: left;">Project Management</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>E8???</td>
                            <td style="text-align: left;">Project & Parts Control</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>E9???</td>
                            <td style="text-align: left;">PC GM</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            @foreach($columns as $column)
                                <td>&nbsp;</td>
                            @endforeach
                            <td>&nbsp;</td>
                        </tr>
                        <tr style="background-color: yellow;">
                            <td>PC Div</td>
                            <td style="text-align: left;">Production Control</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            @foreach($columns as $column)
                                <td></td>
                            @endforeach
                            <td></td>
                        </tr>

                        <!-------------F---------------->
                        <tr>
                            <td>F1???</td>
                            <td style="text-align: left;">Mass Production Quality</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>F2???</td>
                            <td style="text-align: left;">Inspection Operations Line</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>F3???</td>
                            <td style="text-align: left;">Special Projects</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>F4???</td>
                            <td style="text-align: left;">Planning & Projects</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>F5???</td>
                            <td style="text-align: left;">Audit Operations</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>F6???</td>
                            <td style="text-align: left;">New Project Quality</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>F7???</td>
                            <td style="text-align: left;">Not Used Yet</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>F8???</td>
                            <td style="text-align: left;">Outside Contracts</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>F9???</td>
                            <td style="text-align: left;">QA GM</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td></td>
                            @foreach($columns as $column)
                                <td>&nbsp;</td>
                            @endforeach
                            <td>&nbsp;</td>
                        </tr>
                        <tr style="background-color: yellow;">
                            <td>QA Div</td>
                            <td style="text-align: left;">Quality Assurance</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            @foreach($columns as $column)
                                <td>&nbsp;</td>
                            @endforeach
                            <td>&nbsp;</td>
                        </tr>

                        <!--------------J--------------->

                        <!--------------G--------------->

                        <!--------------K--------------->

                        <!--------------L--------------->
                        <tr style="background-color: #00FFFF;">
                            <td>Burnaston</td>
                            <td style="text-align: left;">Burnaston</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            @foreach($columns as $column)
                                <td>&nbsp;</td>
                            @endforeach
                            <td>&nbsp;</td>
                        </tr>

                        <!--------------H--------------->
                        <tr>
                            <td>H???</td>
                            <td style="text-align: left;">Engine Other</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>H1???</td>
                            <td style="text-align: left;">General Affairs</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>H25??</td>
                            <td style="text-align: left;">Casting</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>H28??</td>
                            <td style="text-align: left;">ZR</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>H3???</td>
                            <td style="text-align: left;">QA</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>H4???</td>
                            <td style="text-align: left;">PC</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>H5???</td>
                            <td style="text-align: left;">Engineering</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>H6???</td>
                            <td style="text-align: left;">Maintenance</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>H9???</td>
                            <td style="text-align: left;">Engine Directors</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>


                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            @foreach($columns as $column)
                                <td>&nbsp;</td>
                            @endforeach
                            <td>&nbsp;</td>
                        </tr>

                        <tr style="background-color: #00FFFF;">
                            <td>Deeside</td>
                            <td style="text-align: left;">Deeside</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            @foreach($columns as $column)
                                <td>&nbsp;</td>
                            @endforeach
                            <td>&nbsp;</td>
                        </tr>

                        <tr style="background-color: #FF99CC;">
                            <td>TMUK</td>
                            <td style="text-align: left;">Toyota UK Total</td>
                            @foreach($columns as $column)
                                <td>0.00</td>
                            @endforeach
                            <td>0.00</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')
    <link href="{{ cdn_asset('/css/report.css') }}" rel="stylesheet" type="text/css">
@endsection

@push('footer-scripts')
    <script src="{{ cdn_asset('/js/report.js') }}"></script>
    <script>
        $(function () {
            $(document).on('click', '#load_report_data', function () {
                var form = $("#report_form");
                var date_type = $("#date_type").val();
                var form_val = true;

                if(date_type == "year" && $("#year_picker").val() == "") {
                    $("#year_picker").focus();
                    form_val = false;
                }

                if(date_type == "month" && $("#month_picker").val() == "") {
                    $("#month_picker").focus();
                    form_val = false;
                }

                if(date_type == "week" && $("#week_picker").val() == "") {
                    $("#week_picker").focus();
                    form_val = false;
                }

                if(date_type == "custom" && ($("#from_date").val() == "" || $("#to_date").val() == "")) {
                    if($("#from_date").val() == "")
                        $("#from_date").focus();
                    if($("#to_date").val() == "")
                        $("#to_date").focus();
                    form_val = false;
                }

                if(form_val == false)
                    return false;

                var report = form.find('input[name=report_name]').val();
                var sub_name = form.find('input[name=sub_name]').val();

                $.ajax({
                    url: "/report/" + report + "/" + sub_name + "/load",
                    method: "POST",
                    data: form.serialize(),
                    statusCode: {
                        401: function () {
                            console.log('Login expired. Please sign in again.')
                        }
                    },
                    success: function (result) {
                        $("#report_data").html(result);
                        $(".table").tableExport({
                            formats: ["xlsx"],
                            position: "top",
                            bootstrap: true
                        });
                    }
                });
            });
        });
    </script>
@endpush
