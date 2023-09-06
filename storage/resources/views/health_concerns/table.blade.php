<div class="table-responsive list-records" style="padding: 10px;">
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
            <th style="width: 120px;">Actions</th>
        </thead>
        <tbody></tbody>
    </table>
</div>
@push('footer-scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $("#health_concerns").DataTable({
            'processing': true,
            'serverSide': true,
            'stateSave': true,
            "order": [[ 10, "desc" ]],
            'ajax': {
                url: "{{ route('health_concerns_list') }}",
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
                        data.ohc_appointment == null ||
                        data.body_part_id == null ||
                        data.symptoms == null ||
                        data.group_code_id == null ||
                        data.current_level == null
                    ) &&
                    data.origin == 'Work' &&
                    (data.origin_type_id == 1 || data.origin_type_id == 2) &&
                    ohc_date >= '2020-01-01'
                ) {
                    $(row).css('background-color', '#ff9c9c');
                }
            }
        })
    })
</script>
@endpush
