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
        @foreach($result['exceptions'] as $exception)
            @if(Auth::user()->is_admin > 1)
            <tr>
                <td><a href="{{str_replace(" ", "_", strtolower($exception['hs_accident']))}}/{{$exception['id']}}/edit" style="color:#2b2b2b;">{{$exception['episode_reference']}}</a></td>
                <td><a href="{{str_replace(" ", "_", strtolower($exception['hs_accident']))}}/{{$exception['id']}}/edit" style="color:#2b2b2b;">{{$exception['member_no']}}</a></td>
                <td><a href="{{str_replace(" ", "_", strtolower($exception['hs_accident']))}}/{{$exception['id']}}/edit" style="color:#2b2b2b;">{{$exception['name']}}</a></td>
                <td><a href="{{str_replace(" ", "_", strtolower($exception['hs_accident']))}}/{{$exception['id']}}/edit" style="color:#2b2b2b;">{{$exception['member_surname']}}</a></td>
                <td><a href="{{str_replace(" ", "_", strtolower($exception['hs_accident']))}}/{{$exception['id']}}/edit" style="color:#2b2b2b;">{{$exception['group_code']}}</a></td>
                <td><span style="display: none">{{$exception['ohc_appointment']}}</span><a href="{{str_replace(" ", "_", strtolower($exception['hs_accident']))}}/{{$exception['id']}}/edit" style="color:#2b2b2b;">{{(!empty($exception['ohc_appointment']))?date('d/m/Y', strtotime($exception['ohc_appointment'])):''}}</a></td>
                <td style="width: 30%;">{{$exception['missing_data']}}</td>
                <td>{{$exception['hs_accident']}}</td>
            </tr>
            @else
                <tr>
                    <td>{{$exception['episode_reference']}}</a></td>
                    <td>{{$exception['member_no']}}</a></td>
                    <td>{{$exception['name']}}</a></td>
                    <td>{{$exception['member_surname']}}</a></td>
                    <td>{{$exception['group_code']}}</a></td>
                    <td><span style="display: none">{{$exception['ohc_appointment']}}</span>{{(!empty($exception['ohc_appointment']))?date('d/m/Y', strtotime($exception['ohc_appointment'])):''}}</td>
                    <td style="width: 30%;">{{$exception['missing_data']}}</td>
                    <td>{{$exception['hs_accident']}}</td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
    <h3 style="text-align: center; margin-top: 20px;"> Changed Data Exceptions</h3>
    <table class="table table-hover table-bordered" id="data_exception_table">
        <thead>
        <tr>
            <th>Episode Reference</th>
            <th>Member No</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Group Code</th>
            <th>OHC Date</th>
            <th>Changed Data</th>
            <th>HealthConcern/Accident</th>
            @if(Auth::user()->is_admin > 1)
            <th>Confirm</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($result['changed_exceptions'] as $exception)
            @if(empty($exception->health_concern_id))
            <tr class="data-exception" data-kind="health_concerns" data-exception="{{$exception->health_concern_id}}" style="cursor: pointer;">
                <td>{{$exception->health_concern->episode_reference}}</td>
            @else
            <tr class="data-exception" data-kind="accidents" data-exception="{{$exception->accident_id}}" style="cursor: pointer;">
                <td></td>
            @endif
                <td>{{$exception->member->member_no}}</td>
                <td>{{$exception->member->name}}</td>
                <td>{{$exception->member->surname}}</td>
                <td>{{$exception->member->group_code}}</td>
                <td><span style="display: none">{{$exception->ohc_date}}</span>{{(!empty($exception->ohc_date))?date('d/m/Y', strtotime($exception->ohc_date)):''}}</td>
                <td>{{$exception->changed_data}}</td>
                <td>
                    @if(empty($exception->health_concern_id))
                        Accident
                    @else
                        Health Concern
                    @endif
                </td>
                @if(Auth::user()->is_admin > 1)
                <td><button class="btn btn-primary btn-xs confirm-exception" value="{{$exception->id}}">Confirm</button></td>
                @endif
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

            $("#data_exception_table").DataTable({
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

            $(".confirm-exception").on('click', function () {
                var exception_id = $(this).val();
                var tr = $(this).closest('tr');
                $.ajax({
                    url: "{{route('confirm_exception')}}",
                    method: "POST",
                    data: {exception_id:exception_id},
                    statusCode: {
                        401: function () {
                            console.log('Login expired. Please sign in again.')
                        }
                    },
                    success: function (result) {
                        tr.remove();
                    }
                });
            });

            $(".data-exception").on('click', function (e) {
                var user_permission = $("#user_permission").val();
                if(user_permission < 2)
                    return false;
                var id = $(this).data('exception');
                var page = $(this).data('kind');
                if(e.target.nodeName != 'BUTTON')
                    location.href = page+'/'+id+'/edit';
            })
        })
    </script>
@endpush
