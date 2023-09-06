{{-- Extends Layout --}}
@extends('layouts.backend')

{{-- Page Title --}}
@section('page-title', 'Completed & outstanding Form')

{{-- Page Subtitle --}}
@section('page-subtitle', '')

{{-- Header Extras to be Included --}}
@section('head-extras')
    <style>
        .dataTables_length {
            text-align: left;
        }
        .dataTables_info{
            text-align: left;
        }
    </style>
@endsection

@section('content')
    <form id="edit_form" method="post" action="{{ route('forms::edit') }}">
        @csrf
        <input type="hidden" id="form_name" name="form_name">
        <input type="hidden" id="form_id" name="form_id">
    </form>
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" id="year_month_form" method="post">
                <div class="form-group row">
                    <div class=" col-md-4">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="year_month" name="year_month" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary" type="submit" style="width: 100px;" id="year_month_submit">Load Data</button>
                        <button class="btn btn-default" type="button" style="width: 100px;" id="reset_button">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row" id="outstanding_content">
        @include('forms.outstanding_list')
    </div>
@endsection

{{-- Footer Extras to be Included --}}
@section('footer-extras')
    <script>
        $(function () {
            $(".table").dataTable({
                "columnDefs": [{
                    "targets": 5,
                    "orderable": false
                }]
            });

            $('#year_month').datetimepicker({
                format: 'MM/YYYY',
                showTodayButton: true,
                showClear: true,
                useCurrent: false,
                icons: {
                    today: "fa fa-thumb-tack",
                    clear: "fa fa-trash"
                },
                widgetPositioning: {
                    horizontal: "auto",
                    vertical: "bottom"
                }
            });

            $("#year_month_form").on('submit', function (e) {
                e.preventDefault();
                var year_month = $("#year_month").val();
                $.ajax({
                    url: route('forms::filter_outstanding'),
                    type: "POST",
                    data: {
                        'year_month': year_month,
                    },
                    dataType:'HTML',
                    success: function(result) {
                        $("#outstanding_content").html(result);
                        $(".table").dataTable({
                            "columnDefs": [{
                                "targets": 5,
                                "orderable": false
                            }]
                        });
                    },
                });
            });

            $("#reset_button").on('click', function () {
                $("#year_month").val('');
                $("#year_month_form").submit();
            });

            $(document).on('click', '.edit-form', function () {
                var form_id = $(this).val();
                var form_name = $(this).attr('data-form');
                $("#form_name").val(form_name);
                $("#form_id").val(form_id);
                $("#edit_form").submit();
            });

        });
    </script>
@endsection
