<div class="table-responsive list-records" style="padding: 10px;">
    <table class="table table-hover table-bordered" id="exception_table">
        <thead>
            <tr>
                <th style="width: 10%;">Episode Reference</th>
                <th style="width: 10%;">Member No</th>
                <th style="width: 10%;">Name</th>
                <th style="width: 10%;">Surname</th>
                <th style="width: 10%;">Group Code</th>
                <th style="width: 10%;">OHC Date</th>
                <th style="width: 30%;">Missing Data</th>
                <th style="width: 10%;">HealthConcern/Accident</th>
            </tr>
        </thead>
        <tbody>
        @foreach($exceptions as $exception)
            <tr>
                <td>{{$exception['episode_reference']}}</td>
                <td>{{$exception['member_no']}}</td>
                <td>{{$exception['name']}}</td>
                <td>{{$exception['member_surname']}}</td>
                <td>{{$exception['group_code']}}</td>
                <td><span style="display: none">{{$exception['ohc_appointment']}}</span>{{(!empty($exception['ohc_appointment']))?date('d/m/Y', strtotime($exception['ohc_appointment'])):''}}</td>
                <td style="width: 30%;">{{$exception['missing_data']}}</td>
                <td>{{$exception['hs_accident']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#exception_table").DataTable({
                'processing': true,
                'stateSave': true,
                'searching': false,
                "pageLength": 25,
                "order": [[ 5, "desc" ]],
            });

            $("#exception_send_email").on('click', function () {
                $("#exception_export_type").val('email');
                $("#exception_export").submit();
            });
        })
    </script>
@endpush
