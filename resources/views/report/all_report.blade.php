{{-- Extends Layout --}}
@extends('layouts.backend')
@section('head-extras')

@stop

{{-- Page Title --}}
@section('page-title', $title)

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
                    <form role="form" class="form-horizontal" method="post" id="report_form" action="{{ route('report::all_record_export') }}">
                        {{csrf_field()}}
                        <input type="hidden" id="report_target" name="report_target" value="{{ $title }}">
                        <div class="form-group">
                            <label for="date_type" class="col-sm-3 control-label">Date Range</label>
                            <div class="col-sm-4">
                                <div class="row date" id="custom_range">
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
                            <div class="col-md-5">
                                <button type="submit" class="btn btn-primary pull-right">Export to Excel</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    <div class="row">

                    </div>
                    <div class="row">
                        <div class="col-md-12" style="min-height: 500px; overflow-x: scroll; font-size: 12px;" id="report_result"></div>
                    </div>

                </div>

            </div>
        </div>


    </div>
@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')

@endsection

@push('footer-scripts')

    <script>
        $(document).ready(function () {
            $("#from_date").datetimepicker({
                format: 'DD/MM/YYYY'
            });
            $("#to_date").datetimepicker({
                format: 'DD/MM/YYYY',
                useCurrent: false
            });

            $("#from_date").on("dp.change", function (e) {
                $('#to_date').data("DateTimePicker").minDate(e.date);
            });
            $("#to_date").on("dp.change", function (e) {
                $('#from_date').data("DateTimePicker").maxDate(e.date);
            });
        });


    </script>
@endpush
