<div class="table-responsive list-records" style="padding: 10px;">
    <table class="table table-hover table-bordered" id="user_list">
        <thead>
        <tr>
            <th data-field="member_no">Member No</th>
            <th data-field="name">Name</th>
            <th data-field="surname">Surname</th>
            <th data-field ="is_admin">Admin</th>
            <th data-field ="is_hr">HR User</th>
            <th style="width: 120px;">Actions</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#user_list").DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                "order": [[ 0, "asc" ]],
                'ajax': {
                    url: "{{ route('user_list') }}",
                    type: "POST",
                },
                'columns': [
                    { data: 'member_no', name: 'member_no' },
                    { data: 'name', name: 'name' },
                    { data: 'surname', name: 'surname' },
                    {data: 'is_admin', name: 'is_admin',
                        render:function (data, type, full, meta) {
                            if(full.is_admin == 1)
                                return '<div class="label label-warning">Manager</div>';
                            else if(full.is_admin == 2)
                                return '<div class="label label-danger">Administrator</div>';
                            else
                                return '<div class="label label-primary btn-xs">User</div>';
                        }
                    },
                    {data: 'is_hr', name: 'is_hr',
                        render:function (data, type, full, meta) {
                            //console.log(full);
                            if(full.is_hr == 1)
                                return '<div class="label label-success">HR User</div>';
                            else
                                return '';

                        }
                    },
                    { data: 'action', name:'action', orderable: false }
                ],
                "columnDefs": [ {
                    targets: [0,1,2],
                    render: function ( data, type, row, meta ) {
                        if(data == null)
                            return '';
                        else {
                            return '<a href="users/' + row.id + '/edit">' + data + '</a>';
                        }
                    }
                }]
            })
        })
    </script>
@endpush



