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
                    <form role="form" class="form-horizontal" method="post" id="report_form" action="{{ route('report::health_concerns_by_member.export_report') }}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="date_type" class="col-sm-3 control-label">Member No</label>
                            <div class="col-sm-3">
                                <select name="member_id" id="member_id" class="form-control select2" style="width: 100%" tabindex="1" required   autofocus></select>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary pull-right" id="export_to_excel">Export to Excel</button>
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
            $('#member_id').select2({
                placeholder: "Select Member No...",
                minimumInputLength: 2,
                ajax: {
                    url: '/member/find',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });

            if($("#member_id").val() != null && typeof $("#member_id").val() !== 'undefined') {
                var id = $("#member_id").val();
                get_report(id);
            }

            $("#member_id").on('change', function () {
                if($(this).val() == null || typeof $(this).val() === 'undefined') {
                    return false;
                }
                var id = $(this).val();
                get_report(id);
            });
        });

        function get_report(id) {
            $.ajax({
                url: "{{ route('report::health_concerns_by_member.get_report') }}",
                method: "GET",
                data: {id:id},
                statusCode: {
                    401: function () {
                        console.log('Login expired. Please sign in again.')
                    }
                },
                success: function (data) {
                    $("#report_result").html(data)
                }
            });
        }

    </script>
@endpush
