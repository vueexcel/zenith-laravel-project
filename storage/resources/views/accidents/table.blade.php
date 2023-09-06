<div class="table-responsive list-records" style="padding: 10px;">
    <table class="table table-hover table-bordered" id="accidents_list">
        <thead>
            <!--<th style="width: 10px;"><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>-->
            <th data-field="reported_date">Reported Date</th>
            <th data-field="accident_date">Accident Date</th>
            <th data-field="logged_date">OHC Date</th>
            <th data-field="member_no">Member No</th>
            <th data-field="member_name">Name</th>
            <th data-field="member_surname">Surname</th>
            <th data-field="group_code">Group</th>
            <th data-field="member_department">Department</th>
            <th data-field="updated_at">Updated At</th>
            <th style="width: 120px;">Actions</th>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#accidents_list").DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                "order": [[ 8, "desc" ]],
                'ajax': {
                    url: "{{ route('accidents_list') }}",
                    type: "POST",
                },
                'columns': [
                    { data: 'reported_date', name: 'reported_date' },
                    { data: 'accident_date', name: 'accident_date' },
                    { data: 'logged_date', name: 'logged_date' },
                    { data: 'member.member_no', name: 'member.member_no' },
                    { data: 'member.name', name: 'member.name' },
                    { data: 'member.surname', name: 'member.surname' },
                    { data: 'member.group_code', name: 'member.group_code' },
                    { data: 'member.department', name: 'member.department' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data:'action', name:'action', orderable: false }
                ],
                "columnDefs": [ {
                    targets: [0,1,2,3,4,5,6,7,8],
                    render: function ( data, type, row, meta ) {
                        if(data == null)
                            return '';
                        else
                            return '<a href="accidents/'+row.id+'/edit" style="color:#2b2b2b;">' + data + '</a>';
                    }
                }],
                'rowCallback': function(row, data, index){
                    if(data.accident_date != null) {
                        var accident_dates = data.accident_date.split("/");
                        var accident_date = accident_dates[2] + "-" + accident_dates[1] + "-" + accident_dates[0];
                    } else
                        var accident_date = "";

                    if( (   data.member_id == null ||
                            data.reported_date == null ||
                            data.logged_date == null ||
                            data.member_statement == null ||
                            data.injury_type_id == null ||
                            data.body_part_id == null ||
                            data.ohc_comment == null ||
                            data.outcome_id == null ||
                            data.causation_factor_id == null ||
                            data.lt_start_date == null ||
                            data.days_lost == null ||
                            data.gir_definition_id == null ||
                            data.gir_reason == null ||
                            data.wi_required == null ||
                            data.wi_part_1_received == null ||
                            data.wi_part_2_received == null ||
                            data.group_code_id == null ||
                            data.stop_6 == null ||
                            data.riddor == null ||
                            data.riddor_reason == null ||
                            data.monthly_stats == null ||
                            data.escalation == null
                        ) &&
                        accident_date >= '2020-01-01'
                    ) {
                        $(row).css('background-color', '#ff9c9c');
                    }
                }
            })
        });
    </script>
@endpush
