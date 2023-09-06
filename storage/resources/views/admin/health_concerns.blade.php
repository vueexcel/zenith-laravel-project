{{-- Extends Layout --}}
@extends('layouts.backend')
@section('head-extras')
    <link href="//cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
@stop

{{-- Page Title --}}
@section('page-title', 'Health Concerns')

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

        <div class="col-lg-6 col-xs-12">
            <h3 style="color: #00a7d0;">Supervisors &nbsp;&nbsp;<a class="btn btn-success btn-sm item-create" data-item="supervisors">Add New</a></h3>
            <div class="col-md-12" id="div_supervisors" style="background-color: #fff; padding: 10px; min-height: 560px; height: auto"></div>
        </div>

        <div class="col-lg-6 col-xs-12">
            <h3 style="color: #00a7d0;">Body Parts&nbsp;&nbsp;<a class="btn btn-success btn-sm item-create" data-item="body_parts">Add New</a></h3></h3>
            <div class="col-md-12" id="div_body_parts" style="background-color: #fff; padding: 10px; min-height: 560px; height: auto"></div>
        </div>

        <div class="col-lg-6 col-xs-12">
            <h3 style="color: #00a7d0;">MSS Causation &nbsp;&nbsp;<a class="btn btn-success btn-sm item-create" data-item="mss_causation">Add New</a></h3>
            <div class="col-md-12" id="div_mss_causation" style="background-color: #fff; padding: 10px; min-height: 560px; height: auto"></div>
        </div>

        <div class="col-lg-6 col-xs-12">
            <h3 style="color: #00a7d0;">Group Codes &nbsp;&nbsp;<a class="btn btn-success btn-sm item-create" data-item="group_codes">Add New</a></h3>
            <div class="col-md-12" id="div_group_codes" style="background-color: #fff; padding: 10px; min-height: 560px; height: auto"></div>
        </div>

        <div class="col-lg-6 col-xs-12">
            <h3 style="color: #00a7d0;">Origin Types &nbsp;&nbsp;<a class="btn btn-success btn-sm item-create" data-item="origin_types">Add New</a></h3>
            <div class="col-md-12" id="div_origin_types" style="background-color: #fff; padding: 10px; min-height: 560px; height: auto"></div>
        </div>

        <div class="col-lg-6 col-xs-12">
            <h3 style="color: #00a7d0;">Outcomes &nbsp;&nbsp;<a class="btn btn-success btn-sm item-create" data-item="outcomes">Add New</a></h3>
            <div class="col-md-12" id="div_outcomes" style="background-color: #fff; padding: 10px; min-height: 560px; height: auto"></div>
        </div>

        <div class="col-lg-6 col-xs-12">
            <h3 style="color: #00a7d0;">Next Steps &nbsp;&nbsp;<a class="btn btn-success btn-sm item-create" data-item="next_steps">Add New</a></h3>
            <div class="col-md-12" id="div_next_steps" style="background-color: #fff; padding: 10px; min-height: 560px; height: auto"></div>
        </div>

        <!-- ./col -->

        <!--------modal-------->
        <div class="modal fade" id="form-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Default Modal</h4>
                    </div>
                    <div class="modal-body" style="height: auto">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save-item">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-------./modal------->

        <div id="confirm-delete-modal" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-red color-palette">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="modalConfirmModelDeleteLabel">Are you sure <i class="fa fa-question"></i>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <p> Are you sure you want to delete this item<i class="fa fa-question"></i></p>
                        <form id="delete-form">
                            {{ csrf_field() }}
                            <input type="hidden" name="delete_item">
                            <input type="hidden" name="delete_item_id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger delete-item">Confirm</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')

@endsection

@push('footer-scripts')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="{{asset('js/admin.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        read_group_codes();
        read_body_parts();
        read_mss_causation();
        read_supervisors();
        read_origin_types();
        read_outcomes();
        read_next_steps();
    });


</script>
@endpush