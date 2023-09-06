{{-- Extends Layout --}}
@extends('layouts.backend')
@section('head-extras')

@stop

{{-- Page Title --}}
@section('page-title', 'All Accidents')

{{-- Page Subtitle --}}
@section('page-subtitle', $sub_title)

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
                <form role="form" class="form-horizontal" method="post" id="report_form" action="{{route('report::all_accidents.export_report')}}">
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
                                    <input type="text" class="form-control pull-right " id="year_picker" name="year_picker" value="{{$current_year}}">
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
                    <input type="hidden" id="report_type" name="report_type" value="{{$report_type}}">
                </form>
            </div>
        </div>

        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Report Data</h3>
                    <button class="btn btn-primary pull-right" id="export_to_excel">Export to Excel</button>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="min-height: 600px; overflow: auto" id="report_data">
                    @include('report.all_accidents.list', ['rows' => $rows, 'columns' => $columns])
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

        });
    </script>
@endpush
