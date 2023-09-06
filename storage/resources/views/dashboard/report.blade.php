<form id="report_list_form" method="post" action="{{route('dashboard.export')}}">
    {{csrf_field()}}
<input type="hidden" id="report_list_range" name="report_list_range" value="{{$range}}">
<input type="hidden" id="report_list_kind" name="report_list_kind" value="{{$kind}}">
</form>
@if($kind == "mss")
    <table class="table table-bordered table-striped" id="report_list">
        <thead>
        <tr>
            <th>Episode Reference</th>
            <th>Member No</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Group Code</th>
            <th>OHC Date</th>
            <th>Body Part</th>
            <th>Outcome</th>
            <th>Discharge Date</th>
            <th>Current Level</th>
            <th>Updated At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($hs as $item)
            <tr>
                <td>{{$item->episode_reference}}</td>
                <td>{{$item->member->member_no}}</td>
                <td>{{$item->member->name}}</td>
                <td>{{$item->member->surname}}</td>
                <td>{{$item->member->group_code}}</td>
                <td><span>{{$item->ohc_appointment}}</span>{{($item->ohc_appointment != null && $item->ohc_appointment != "")?date('d/m/Y', strtotime($item->ohc_appointment)):''}}</td>
                <td>{{$item->body_part->body_part}}</td>
                <td>{{$item->outcome}}</td>
                <td><span>{{$item->discharge_date}}</span>{{($item->discharge_date != null && $item->discharge_date != "")?date('d/m/Y', strtotime($item->discharge_date)):''}}</td>
                <td>{{$item->current_level}}</td>
                <td><span>{{$item->updated_at}}</span>{{($item->updated_at != null && $item->updated_at != "")?date('d/m/Y H:i', strtotime($item->updated_at)):''}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@elseif($kind == "lost_time_incidents" || $kind == "accident")
    <table class="table table-bordered table-striped" id="report_list">
        <thead>
        <tr>
            <th>Member No</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Group Code</th>
            <th>Reported Date</th>
            <th>Accident Date</th>
            <th>OHC Date</th>
            <th>Department</th>
            <th>Causation</th>
            <th>Updated At</th>
            <th>HC/Accident</th>
        </tr>
        </thead>
        <tbody>
        @foreach($hs as $item)
            <tr>
                <td>{{$item->member->member_no}}</td>
                <td>{{$item->member->name}}</td>
                <td>{{$item->member->surname}}</td>
                <td>{{$item->member->group_code}}</td>
                <td><span>{{$item->reported_date}}</span>{{($item->reported_date != null && $item->reported_date != "")?date('d/m/Y', strtotime($item->reported_date)):''}}</td>
                <td><span>{{$item->accident_date}}</span>{{($item->accident_date != null && $item->accident_date != "")?date('d/m/Y', strtotime($item->accident_date)):''}}</td>
                <td><span>{{$item->logged_date}}</span>{{($item->logged_date != null && $item->logged_date != "")?date('d/m/Y', strtotime($item->logged_date)):''}}</td>
                <td>{{$item->member->department}}</td>
                <td>{{$item->causation_factor->causation_factor}}</td>
                <td><span>{{$item->updated_at}}</span>{{($item->updated_at != null && $item->updated_at != "")?date('d/m/Y H:i', strtotime($item->updated_at)):''}}</td>
                <td>Accident</td>
            </tr>
        @endforeach
        @if(isset($health))
            @foreach($health as $item)
                <tr>
                    <td>{{$item->member->member_no}}</td>
                    <td>{{$item->member->name}}</td>
                    <td>{{$item->member->surname}}</td>
                    <td>{{$item->member->group_code}}</td>
                    <td><span>{{$item->concern_date}}</span>{{($item->concern_date != null && $item->concern_date != "")?date('d/m/Y', strtotime($item->concern_date)):''}}</td>
                    <td></td>
                    <td><span>{{$item->ohc_appointment}}</span>{{($item->ohc_appointment != null && $item->ohc_appointment != "")?date('d/m/Y', strtotime($item->ohc_appointment)):''}}</td>
                    <td>{{$item->member->department}}</td>
                    <td>{{$item->mss_causation->mss_causation}}</td>
                    <td><span>{{$item->updated_at}}</span>{{($item->updated_at != null && $item->updated_at != "")?date('d/m/Y H:i', strtotime($item->updated_at)):''}}</td>
                    <td>HC</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@elseif($kind == "contractor_accident")
    <table class="table table-bordered table-striped" id="report_list">
        <thead>
        <tr>
            <th>T Number</th>
            <th>T Member No</th>
            <th>Contractor Name</th>
            <th>TCR Name</th>
            <th>TCR Surname</th>
            <th>Group Code</th>
            <th>Accident Date</th>
            <th>Company</th>
            <th>TCR No.</th>
            <th>Updated At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($hs as $item)
            <tr>
                <td>{{$item->t_number}}</td>
                <td>{{$item->member->member_no}}</td>
                <td>{{$item->member->contractor_name}}</td>
                <td>{{$item->member->name}}</td>
                <td>{{$item->member->surname}}</td>
                <td>{{$item->member->group_code}}</td>
                <td><span>{{$item->accident_date}}</span>{{($item->accident_date != null && $item->accident_date != "")?date('d/m/Y', strtotime($item->accident_date)):''}}</td>
                <td>{{$item->contracting_company}}</td>
                <td>{{$item->tcr_member_number}}</td>
                <td><span>{{$item->updated_at}}</span>{{($item->updated_at != null && $item->updated_at != "")?date('d/m/Y H:i', strtotime($item->updated_at)):''}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <table class="table table-bordered table-striped" id="report_list">
        <thead>
        <tr>
            <th>Episode Reference</th>
            <th>Member No</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Group Code</th>
            <th>OHC Date</th>
            <th>Body Part</th>
            <th>Outcome</th>
            <th>Discharge Date</th>
            <th>Current Level</th>
            <th>Updated At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($hs as $item)
            <tr>
                <td>{{$item->episode_reference}}</td>
                <td>{{$item->member->member_no}}</td>
                <td>{{$item->member->name}}</td>
                <td>{{$item->member->surname}}</td>
                <td>{{$item->member->group_code}}</td>
                <td><span>{{$item->ohc_appointment}}</span>{{($item->ohc_appointment != null && $item->ohc_appointment != "")?date('d/m/Y', strtotime($item->ohc_appointment)):''}}</td>
                <td>{{$item->body_part->body_part}}</td>
                <td>{{$item->outcome}}</td>
                <td><span>{{$item->discharge_date}}</span>{{($item->discharge_date != null && $item->discharge_date != "")?date('d/m/Y', strtotime($item->discharge_date)):''}}</td>
                <td>{{$item->current_level}}</td>
                <td><span>{{$item->updated_at}}</span>{{($item->updated_at != null && $item->updated_at != "")?date('d/m/Y H:i', strtotime($item->updated_at)):''}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

