<div class="table-responsive list-records" style="padding: 10px;">
    <table class="table table-hover table-bordered" id="exception_table">
        <thead>
        <tr>
            <th data-field="episode_reference">Episode Reference</th>
            <th data-field="member_no">Member No</th>
            <th data-field="member_name">Name</th>
            <th data-field="member_surname">Surname</th>
            <th data-field="group_code">Group Code</th>
            <th data-field="ohc_appointment">OHC Date</th>
            <th>Missing Data</th>
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
