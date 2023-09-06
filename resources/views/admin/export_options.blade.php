{{-- Extends Layout --}}
@extends('layouts.backend')
@section('head-extras')
    <link href="//cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
@stop

{{-- Page Title --}}
@section('page-title', 'Export Options')

{{-- Page Subtitle --}}
@section('page-subtitle', 'Control panel')

{{-- Breadcrumbs --}}
@section('breadcrumbs')
    {!! Breadcrumbs::render('admin') !!}
@endsection

{{-- Header Extras to be Included --}}
@section('head-extras')
    @parent
@endsection

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="my-alert alert alert-success" id="success-alert" style="display: none">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong id="alert_title">Success! </strong>
                <span id="alert_message">Successfully saved.</span>
            </div>

            <div class="my-alert alert alert-danger" id="fault-alert" style="display: none">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong id="fault_title">Fail! </strong>
                <span id="fault_message">Save failed.</span>
            </div>
        </div>
        <div class="col-xs-12">
            <!-- Edit Form -->
            <div class="box box-info" id="">
                <form class="form form-horizontal" id="import-form" method="POST" >
                    {{ csrf_field() }}
                    <div class="box-body" >

                        <div class="checkbox">
                            <label style="font-size: 16px;">
                                <input type="checkbox" id="select_all" value="all"> Select All
                            </label>
                        </div>
                        <hr>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" {{(in_array('company_statistics', $options))?'checked':''}} value="company_statistics"> Company Statistics
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" {{(in_array('lost_incidents', $options))?'checked':''}} value="lost_incidents"> Lost Time Incidents
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" {{(in_array('all_accidents', $options))?'checked':''}} value="all_accidents"> All Accidents
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" {{(in_array('mss_incidents', $options))?'checked':''}} value="mss_incidents"> MSS Incidents
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" {{(in_array('illness_incidents', $options))?'checked':''}} value="illness_incidents"> Illness Incidents
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" {{(in_array('near_misses', $options))?'checked':''}} value="near_misses"> Near Misses
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" {{(in_array('riddor_incidents', $options))?'checked':''}} value="riddor_incidents"> RIDDOR Incidents
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" {{(in_array('restriction_cost', $options))?'checked':''}} value="restriction_cost"> Restriction Cost
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" {{(in_array('work_other_incidents', $options))?'checked':''}} value="work_other_incidents"> Work Other Incidents
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" {{(in_array('contractor_accidents', $options))?'checked':''}} value="contractor_accidents"> Contractor Accidents
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" {{(in_array('daily_restriction_status', $options))?'checked':''}} value="daily_restriction_status"> Daily Restriction Status
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" {{(in_array('master_kpi', $options))?'checked':''}} value="master_kpi"> Master KPI
                            </label>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <div class="col-xs-12">
                            <div class="margin-b-5 margin-t-5">
                                <button class="btn btn-primary" id="export_options_save" type="button">
                                    <i class="fa fa-save"></i> <span>Save Settings</span>
                                </button>
                            </div>
                        </div>
                        <!-- /.col-xs-6 -->
                    </div>
                </form>
            </div>
            <!-- /.box -->
            <!-- /End Edit Form -->
        </div>
    </div>
    <!-- /.row -->
@endsection

@push('footer-scripts')
    <script src="{{asset('js/admin.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#select_all").on('change', function () {
                if(this.checked) {
                    $(".options").prop("checked", true);
                }
            });

            $(document).on('click', '#export_options_save', function () {
                var form = $("#import-form");
                $.ajax({
                    url: "{{route('export_options.save')}}",
                    method: "POST",
                    data: form.serialize(),
                    statusCode: {
                        401: function () {
                            console.log('Login expired. Please sign in again.')
                        }
                    },
                    success: function (result) {
                        if(result.message == "ok") {
                            $("#success-alert").show();
                        } else {
                            $("#fault-alert").show();
                        }
                    }
                });
            });
        });
    </script>
@endpush
