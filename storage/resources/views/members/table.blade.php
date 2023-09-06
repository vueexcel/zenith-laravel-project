<div class="table-responsive list-records" style="padding: 10px;">
    <table class="table table-hover table-bordered" id="members_list">
        <thead>
            <th data-field="member_no">Mbr No.</th>
            <th data-field="group_code">Group</th>
            <th data-field="name">Name</th>
            <th data-field="surname">Surname</th>
            <th data-field="department">Department</th>
            <th data-field="division">Division</th>
            <th data-field="occupation">Occupation</th>
            <th data-field="status">Status</th>
            <th style="width: 120px;">Actions</th>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#members_list").DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                "order": [[ 0, "desc" ]],
                'ajax': {
                    url: "{{ route('members_list') }}",
                    type: "POST",
                },
                'columns': [
                    { data: 'member_no', name: 'member_no' },
                    { data: 'group_code', name: 'group_code' },
                    { data: 'name', name: 'name' },
                    { data: 'surname', name: 'surname' },
                    { data: 'department', name: 'department' },
                    { data: 'division', name: 'division' },
                    { data: 'occupation', name: 'occupation' },
                    { data: 'status', name: 'status' },
                    {
                        data:'action',
                        name:'action',
                        orderable: false
                    }
                ],
                "columnDefs": [ {
                    targets: [0,1,2,3,4,5,6,7],
                    render: function ( data, type, row, meta ) {
                        if(data == null)
                            return '';
                        else
                            return '<a href="members/'+row.id+'/edit">' + data + '</a>';
                    }
                }]
            })
        })
    </script>
@endpush
