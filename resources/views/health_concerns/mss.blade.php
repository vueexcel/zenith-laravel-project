{{-- Extends Layout --}}
@extends('layouts.backend')
@section('head-extras')

@stop

{{-- Page Title --}}
@section('page-title', 'MSS')

{{-- Page Subtitle --}}
@section('page-subtitle', '')

{{-- Header Extras to be Included --}}
@section('head-extras')
    @parent
@endsection

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body" style="min-height: 600px; overflow: auto" id="mss_table">
                    <table class="table table-hover table-bordered" id="health_concerns">
                        <thead>
                        <th data-field="episode_reference">Episode Reference</th>
                        <th data-field="member_no">Member No</th>
                        <th data-field="member_name">Name</th>
                        <th data-field="member_surname">Surname</th>
                        <th data-field="group_code">Group Code</th>
                        <th data-field="ohc_appointment">OHC Date</th>
                        <th data-field="body_part">Body Part</th>
                        <th data-field="outcome">Outcome</th>
                        <th data-field="discharge_date">Discharge Date</th>
                        <th data-field="current_level">Current Level</th>
                        <th data-field="updated_at">Updated At</th>
                        @if(Auth::user()->is_admin > 1)
                            <th style="width: 120px;">Actions</th>
                        @endif
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var user_permission = $("#user_permission").val();
            if(user_permission == 2) {
                $("#health_concerns").DataTable({
                    'processing': true,
                    'serverSide': true,
                    'stateSave': true,
                    "order": [[ 10, "desc" ]],
                    'ajax': {
                        url: "{{ route('mss_list') }}",
                        type: "POST",
                    },
                    'columns': [
                        { data: 'episode_reference', name: 'episode_reference' },
                        { data: 'member.member_no', name: 'member.member_no' },
                        { data: 'member.name', name: 'member.name' },
                        { data: 'member.surname', name: 'member.surname' },
                        { data: 'member.group_code', name: 'member.group_code' },
                        { data: 'ohc_appointment', name: 'ohc_appointment' },
                        { data: 'body_part.body_part', name: 'body_part.body_part' },
                        { data: 'outcome', name: 'outcome' },
                        { data: 'discharge_date', name: 'discharge_date' },
                        { data: 'current_level', name: 'current_level' },
                        { data: 'updated_at', name: 'updated_at'},
                        {
                            data:'action',
                            name:'action',
                            orderable: false
                        }
                    ],
                    "columnDefs": [ {
                        targets: [0,1,2,3,4,5,6,7,8,9,10],
                        render: function ( data, type, row, meta ) {
                            if(data == null)
                                return '';
                            else
                                return '<a href="health_concerns/'+row.id+'/edit" style="color:#2b2b2b;">' + data + '</a>';
                        }
                    }],
                    'rowCallback': function(row, data, index){
                        if(data.ohc_appointment != null) {
                            var ohc_dates = data.ohc_appointment.split("/");
                            var ohc_date = ohc_dates[2] + "-" + ohc_dates[1] + "-" + ohc_dates[0];
                        } else
                            var ohc_date = "";
                        if( (   data.member_id == null ||
                                data.body_part_id == null ||
                                data.symptoms == null ||
                                data.origin == null ||
                                data.origin_type_id == null ||
                                data.group_code_id == null ||
                                data.current_level == null ||
                                ohc_date == ""
                            ) &&
                            (ohc_date >= '2020-01-01' || ohc_date == "") && (data.concern_date >= '2020-01-01' || data.concern_date == null)
                        ) {
                            $(row).css('background-color', '#ff9c9c');
                        }
                    }
                })
            } else {
                $("#health_concerns").DataTable({
                    'processing': true,
                    'serverSide': true,
                    'stateSave': true,
                    "order": [[ 10, "desc" ]],
                    'ajax': {
                        url: "{{ route('mss_list') }}",
                        type: "POST",
                    },
                    'columns': [
                        { data: 'episode_reference', name: 'episode_reference' },
                        { data: 'member.member_no', name: 'member.member_no' },
                        { data: 'member.name', name: 'member.name' },
                        { data: 'member.surname', name: 'member.surname' },
                        { data: 'member.group_code', name: 'member.group_code' },
                        { data: 'ohc_appointment', name: 'ohc_appointment' },
                        { data: 'body_part.body_part', name: 'body_part.body_part' },
                        { data: 'outcome', name: 'outcome' },
                        { data: 'discharge_date', name: 'discharge_date' },
                        { data: 'current_level', name: 'current_level' },
                        { data: 'updated_at', name: 'updated_at'}
                    ],
                    'rowCallback': function(row, data, index){
                        if(data.ohc_appointment != null) {
                            var ohc_dates = data.ohc_appointment.split("/");
                            var ohc_date = ohc_dates[2] + "-" + ohc_dates[1] + "-" + ohc_dates[0];
                        } else
                            var ohc_date = "";
                        if( (   data.member_id == null ||
                                data.body_part_id == null ||
                                data.symptoms == null ||
                                data.origin == null ||
                                data.origin_type_id == null ||
                                data.group_code_id == null ||
                                data.current_level == null ||
                                ohc_date == ""
                            ) &&
                            (ohc_date >= '2020-01-01' || ohc_date == "") && (data.concern_date >= '2020-01-01' || data.concern_date == null)
                        ) {
                            $(row).css('background-color', '#ff9c9c');
                        }
                    }
                })
            }
        })
    </script>
@endpush
