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
                    <div class="col-md-offset-5 col-md-4">
                        <h3 style="display: inline">Missing Data Exceptions</h3>
                    </div>
                    <div class="col-md-3">
                        <form role="form" class="form-horizontal" method="post" id="exception_export" action="{{ route('exception_export') }}">
                            {{csrf_field()}}
                            <input type="hidden" id="exception_export_type" name="exception_export_type" value="excel">
                            <button type="submit" class="btn btn-primary pull-right" id="exception_export_to_excel">Export to Excel</button>
                            <button type="button" class="btn btn-primary pull-right" id="exception_send_email" style="margin-right: 10px;">Send Email</button>
                        </form>
                    </div>


                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @include('exceptions.list')
                </div>
            </div>
        </div>
    </div>
@endsection


