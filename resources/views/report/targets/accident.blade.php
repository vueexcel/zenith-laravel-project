{{-- Extends Layout --}}
@extends('layouts.backend')
@section('head-extras')

@stop

{{-- Page Title --}}
@section('page-title', 'Targets')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Accident')

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
                <form role="form" class="form-horizontal">
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
                                    <input type="text" class="form-control pull-right " id="year_picker">
                                </div>

                                <div class="input-group date" id="month_range" style="display: none;">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="month_picker">
                                </div>

                                <div class="input-group date" id="week_range" style="display: none;">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="week_picker">
                                </div>

                                <div class="row date" id="custom_range" style="display: none;">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="from_date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="to_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-primary">Load Data</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                </form>
            </div>
        </div>

        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Report Data</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="min-height: 600px;">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Group</th>
                            <th>Dept</th>
                            <th>Jan</th>
                            <th>Feb</th>
                            <th>Mar</th>
                            <th>Apr</th>
                            <th>May</th>
                            <th>Jun</th>
                            <th>Jul</th>
                            <th>Aug</th>
                            <th>Sep</th>
                            <th>Oct</th>
                            <th>Nov</th>
                            <th>Dec</th>
                            <th>Target</th>
                            <th>Actual</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!--------A-------->
                        <tr>
                            <td>A1???</td>
                            <td style="text-align: left;">External Affairs</td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr>
                            <td>A2???</td>
                            <td style="text-align: left;">External Affairs</td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr>
                            <td>A9???</td>
                            <td style="text-align: left;">External Affairs</td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr style="background-color: yellow;">
                            <td>CP & Dir</td>
                            <td style="text-align: left;">Corporate Planning & Directors Office</td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>

                        <!--------B-------->
                        <tr>
                            <td>B1???</td>
                            <td style="text-align: left;">Personnel & Employee Relations</td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr>
                            <td>B2???</td>
                            <td style="text-align: left;">Headcount Planning Resourcing</td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr>
                            <td>B3???</td>
                            <td style="text-align: left;">Health Safety</td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr>
                            <td>B4???</td>
                            <td style="text-align: left;">Administration & HR Systems</td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr>
                            <td>B5???</td>
                            <td style="text-align: left;">Organisation Development</td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr>
                            <td>B6???</td>
                            <td style="text-align: left;">Ex-Pats / TME Xfr</td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr>
                            <td>B7???</td>
                            <td style="text-align: left;">HR GM</td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr style="background-color: yellow;">
                            <td>HR Div</td>
                            <td style="text-align: left;">Human Resources</td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>

                        <!--------C-------->
                        <tr>
                            <td>C1???</td>
                            <td style="text-align: left;">Accounts & Finance</td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr>
                            <td>C2???</td>
                            <td style="text-align: left;">Accounting</td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr>
                            <td>C3???</td>
                            <td style="text-align: left;">Corporate Services</td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr>
                            <td>C9???</td>
                            <td style="text-align: left;">F&CS GM</td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr style="background-color: yellow;">
                            <td>A&F Div</td>
                            <td style="text-align: left;">Accounts & Finance</td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
                        </tr>

                        <tr style="background-color: #FF99CC;">
                            <td>TMUK</td>
                            <td style="text-align: left;">Toyota UK Total</td>
                            @for($i=0;$i<15;$i++)
                                <td>0.00</td>
                            @endfor
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
@endpush
