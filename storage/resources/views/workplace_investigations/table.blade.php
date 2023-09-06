<div class="table-responsive list-records" style="padding: 10px;">
    <table class="table table-hover table-bordered"  id="incident_investigations_list">
        <thead>
            <th data-field="logged_date">Logged Date</th>
            <th data-field="incident_date">Accident Date</th>
            <th data-field="member_no">Member No.</th>
            <th data-field="member_name">Name</th>
            <th data-field="member_surname">Sure Name</th>
            <th data-field="incident_type">Incident Type</th>
            <th data-field="updated_at">Updated At</th>
            <th style="width: 120px;">Actions</th>
        </thead>
        <tbody></tbody>
    </table>
</div>

@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#incident_investigations_list").DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                "order": [[ 6, "desc" ]],
                'ajax': {
                    url: "{{ route('incident_investigations_list') }}",
                    type: "POST",
                },
                'columns': [
                    { data: 'logged_date', name: 'logged_date' },
                    { data: 'incident_date', name: 'incident_date' },
                    { data: 'member.member_no', name: 'member.member_no' },
                    { data: 'member.name', name: 'member.name' },
                    { data: 'member.surname', name: 'member.surname' },
                    { data: 'incident_type.incident', name: 'incident_type.incident' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data:'action', name:'action', orderable: false }
                ],
                "columnDefs": [ {
                    targets: [0,1,2,3,4,5,6],
                    render: function ( data, type, row, meta ) {
                        if(data == null)
                            return '';
                        else
                            return '<a href="workplace_investigations/'+row.id+'/edit">' + data + '</a>';
                    }
                }]
            })
        })
    </script>
@endpush
