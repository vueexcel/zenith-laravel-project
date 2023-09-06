<div class="table-responsive list-records" style="padding: 10px;">
    <table class="table table-hover table-bordered" id="contractor_accidents_list">
        <thead>
            <!--<th style="width: 10px;"><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>-->
            <th data-field="t_number">T Number</th>
            <th data-field="member_no">TCR Member No.</th>
            <th data-field="accident_date">Accident Date</th>
            <th data-field="contracting_company">Company</th>
            <th data-field="tcr_member_number">TCR No.</th>
            <th data-field="updated_at">Updated At</th>
            <th style="width: 120px;">Actions</th>
        </thead>
        <tbody></tbody>
    </table>
</div>

@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#contractor_accidents_list").DataTable({
                'processing': true,
                'serverSide': true,
                'stateSave': true,
                "order": [[ 5, "desc" ]],
                'ajax': {
                    url: "{{ route('contractor_accidents_list') }}",
                    type: "POST",
                },
                'columns': [
                    { data: 't_number', name: 't_number' },
                    { data: 'member.member_no', name: 'member.member_no' },
                    { data: 'accident_date', name: 'accident_date' },
                    { data: 'contracting_company', name: 'contracting_company' },
                    { data: 'tcr_member_number', name: 'tcr_member_number' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data:'action', name:'action', orderable: false }
                ],
                "columnDefs": [ {
                    targets: [0,1,2,3,4,5],
                    render: function ( data, type, row, meta ) {
                        if(data == null)
                            return '';
                        else
                            return '<a href="contractor_accidents/'+row.id+'/edit">' + data + '</a>';
                    }
                }]
            })
        })
    </script>
@endpush
