<form id="report_list_form" method="post" action="{{route('dashboard.graph_export')}}">
    {{csrf_field()}}
    <input type="hidden" id="report_list_range" name="report_list_range" value="{{$year}}">
    <input type="hidden" id="report_list_kind" name="report_list_kind" value="{{$graph_type}}">
</form>
@if($kind == "health_concerns")
    <table class="table table-bordered" id="report_list">
        <thead>
        <tr>
            <th>Episode Reference</th>
            <th class="admin-view">Member No</th>
            <th class="admin-view">Name</th>
            <th class="admin-view">Surname</th>
            <th>Group Stats</th>
            <th>OHC Date</th>
            <th>Body Part</th>
            <th>Outcome</th>
            <th>GMIR</th>
            <th>Discharge Date</th>
            <th>Current Level</th>
            <th>Updated At</th>
            <th>WI Part1 Received</th>
            <th>WI Part2 Received</th>
        </tr>
        </thead>
        <tbody>
        @foreach($hs as $item)
            <tr class="report-tr" data-type="health_concerns" data-item="{{$item->id}}" style="cursor: pointer;">
                <td>{{$item->episode_reference}}</td>
                <td class="admin-view">{{$item->member->member_no}}</td>
                <td class="admin-view">{{$item->member->name}}</td>
                <td class="admin-view">{{$item->member->surname}}</td>
                <td>{{$item->group_code->group_code}}</td>
                <td><span>{{$item->ohc_appointment}}</span>{{($item->ohc_appointment != null && $item->ohc_appointment != "")?date('d/m/Y', strtotime($item->ohc_appointment)):''}}</td>
                <td>{{$item->body_part->body_part}}</td>
                <td>{{$item->outcome}}</td>
                <td>{{($item->gmir)?$item->gmir:'No'}}</td>
                <td><span>{{$item->discharge_date}}</span>{{($item->discharge_date != null && $item->discharge_date != "")?date('d/m/Y', strtotime($item->discharge_date)):''}}</td>
                <td>{{$item->current_level}}</td>
                <td><span>{{$item->updated_at}}</span>{{($item->updated_at != null && $item->updated_at != "")?date('d/m/Y H:i', strtotime($item->updated_at)):''}}</td>
                <td><span>{{$item->wi_part_1_received}}</span>{{($item->wi_part_1_received != null && $item->wi_part_1_received != "")?date('d/m/Y H:i', strtotime($item->wi_part_1_received)):''}}</td>
                <td><span>{{$item->wi_part_2_received}}</span>{{($item->wi_part_2_received != null && $item->wi_part_2_received != "")?date('d/m/Y H:i', strtotime($item->wi_part_2_received)):''}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <table class="table table-bordered" id="report_list">
        <thead>
        <tr>
            <th class="admin-view">Member No</th>
            <th class="admin-view">Name</th>
            <th class="admin-view">Surname</th>
            <th>Group Stats</th>
            <th>Body Part</th>
            <th>Accident Date</th>
            <th>Department</th>
            <th>GIR</th>
            <th>Causation</th>
            <th>Updated At</th>
            <th>WI Part1 Received</th>
            <th>WI Part2 Received</th>
        </tr>
        </thead>
        <tbody>
        @foreach($hs as $item)
            <tr class="report-tr" data-type="accidents" data-item="{{$item->id}}" style="cursor: pointer;">
                <td class="admin-view">{{$item->member->member_no}}</td>
                <td class="admin-view">{{$item->member->name}}</td>
                <td class="admin-view">{{$item->member->surname}}</td>
                <td>{{$item->group_code->group_code}}</td>
                <td>{{$item->body_part->body_part}}</td>
                <td><span>{{$item->accident_date}}</span>{{($item->accident_date != null && $item->accident_date != "")?date('d/m/Y', strtotime($item->accident_date)):''}}</td>
                <td>{{$item->member->department}}</td>
                <td>{{$item->gir_definition->definition}}</td>
                <td>{{$item->causation_factor->causation_factor}}</td>
                <td><span>{{$item->updated_at}}</span>{{($item->updated_at != null && $item->updated_at != "")?date('d/m/Y H:i', strtotime($item->updated_at)):''}}</td>
                <td><span>{{$item->wi_part_1_received}}</span>{{($item->wi_part_1_received != null && $item->wi_part_1_received != "")?date('d/m/Y H:i', strtotime($item->wi_part_1_received)):''}}</td>
                <td><span>{{$item->wi_part_2_received}}</span>{{($item->wi_part_2_received != null && $item->wi_part_2_received != "")?date('d/m/Y H:i', strtotime($item->wi_part_2_received)):''}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
