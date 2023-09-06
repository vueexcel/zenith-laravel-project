<div class="table-responsive list-records" style="padding: 10px;">
    <table class="table table-hover table-bordered" id="reduced_flexibilities_list">
        <thead>
            <!--<th style="width: 10px;"><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>-->
            <th data-field="member_no">Mbr No.</th>
            <th data-field="member_name">Name</th>
            <th data-field="member_surname">Surname</th>
            <th data-field="fully_fit_date">Assessment Date</th>
            <th data-field="category">Category</th>
            <th data-field="restricted_status">Restricted Status</th>
            <th data-field="l4_date">L4 Date</th>
            <th data-field="updated_at">Updated At</th>
            @if(Auth::user()->is_admin > 1)
                <th style="width: 120px;">Actions</th>
            @endif
        </thead>
        <tbody></tbody>
    </table>
</div>


@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#reduced_flexibilities_list").DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                "order": [[ 7, "desc" ]],
                'ajax': {
                    url: "{{ route('reduced_flexibilities_list') }}",
                    type: "POST",
                },
                'columns': [
                    { data: 'member.member_no', name: 'member.member_no' },
                    { data: 'member.name', name: 'member.name' },
                    { data: 'member.surname', name: 'member.surname' },
                    { data: 'fully_fit_date', name: 'fully_fit_date' },
                    { data: 'category.category', name: 'category.category' },
                    { data: 'restricted_status', name: 'restricted_status' },
                    { data: 'l4_date', name: 'l4_date' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data:'action', name:'action', orderable: false }
                ],
                "columnDefs": [ {
                    targets: [0,1,2,3,4,5,6,7],
                    render: function ( data, type, row, meta ) {
                        if(data == null)
                            return '';
                        else
                            return '<a href="reduced_flexibilities/'+row.id+'/edit">' + data + '</a>';
                    }
                }]
            })
        })
    </script>
@endpush
