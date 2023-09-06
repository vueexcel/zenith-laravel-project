{{-- Extends Layout --}}
@extends('layouts.backend')
@section('head-extras')
    <link href="//cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
@stop

{{-- Page Title --}}
@section('page-title', 'Dashboard Settings')

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
        <div class="col-md-12">
            <div class="box box-info" id="">
                <div class="box-header with-border">
                    <h3 class="box-title">Graph Target Settings</h3>
                </div>
                <form class="form form-horizontal" method="POST" >
                    {{ csrf_field() }}
                    <div class="box-body" >
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="gir_target">Global Incident Rate(GIR) Target: </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control required-field setting-value" id="gir_target" name="gir_target" value="{{isset($gir_target)?$gir_target:''}}">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-info save-setting" type="button" data-setting="gir_target" style="width: 180px;">Save</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="gmir_target">Global Incident Rate(GMIR) Target: </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control required-field setting-value" id="gmir_target" name="gmir_target" value="{{isset($gmir_target)?$gmir_target:''}}">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-info save-setting" type="button" data-setting="gmir_target" style="width: 180px;">Save</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="lost_time_incident">Lost Time Incident Target: </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control required-field setting-value" id="lost_time_incident_target" name="lost_time_incident_target" value="{{isset($lost_time_incident_target)?$lost_time_incident_target:''}}">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-info save-setting" type="button" data-setting="lost_time_incident_target" style="width: 180px;">Save</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="gmir_target">Accident Injuries Target: </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control required-field setting-value" id="accident_injuries_target" name="accident_injuries_target" value="{{isset($accident_injuries_target)?$accident_injuries_target:''}}">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-info save-setting" type="button" data-setting="accident_injuries_target" style="width: 180px;">Save</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="gmir_target">Work MSS Target: </label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control required-field setting-value" id="work_mss_target" name="work_mss_target" value="{{isset($work_mss_target)?$work_mss_target:''}}">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-info save-setting" type="button" data-setting="work_mss_target" style="width: 180px;">Save</button>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>


    </div>
@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')

@endsection

@push('footer-scripts')

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.save-setting', function () {
            var set_type = $(this).data('setting');

            if($("#"+set_type).val() == '') {
                $("#"+set_type).focus();
                return;
            }

            var set_value = $("#"+set_type).val();

            $.ajax({
                url: "{{route('save_setting')}}",
                method: "POST",
                data: {set_type:set_type, set_value:set_value},
                statusCode: {
                    401: function () {
                        console.log('Login expired. Please sign in again.')
                    }
                },
                success: function (result) {
                    console.log(result);
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
