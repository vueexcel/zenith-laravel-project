<form id="report_list_form" method="post" action="{{route('dashboard.export')}}">
    {{csrf_field()}}
<input type="hidden" id="report_list_range" name="report_list_range" value="{{$range}}">
<input type="hidden" id="report_list_kind" name="report_list_kind" value="{{$kind}}">
</form>
@if($kind == "mss" || $kind == "gmir" || $kind == "mss_outstanding" || $kind == "mss_received")
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
        </tr>
        </thead>
        <tbody>
        @foreach($hs as $item)
            <tr class="report-tr" data-type="health_concerns" data-item="{{$item->id}}" style="cursor: pointer;">
                <td>{{$item->episode_reference}}</td>
                <td class="admin-view">{{ $item->member ? $item->member->member_no: "" }}</td>
                <td class="admin-view">{{ $item->member ? $item->member->name : "" }}</td>
                <td class="admin-view">{{ $item->member ? $item->member->surname : "" }}</td>
                <td>{{ $item->group_code ? $item->group_code->group_code : "" }}</td>
                <td><span>{{$item->ohc_appointment}}</span>{{($item->ohc_appointment != null && $item->ohc_appointment != "")?date('d/m/Y', strtotime($item->ohc_appointment)):''}}</td>
                <td>{{ isset($item->body_part) ? $item->body_part->body_part : ""}}</td>
                <td>{{$item->outcome}}</td>
                <td>{{($item->gmir)?$item->gmir:'No'}}</td>
                <td><span>{{$item->discharge_date}}</span>{{($item->discharge_date != null && $item->discharge_date != "")?date('d/m/Y', strtotime($item->discharge_date)):''}}</td>
                <td>{{$item->current_level}}</td>
                <td><span>{{$item->updated_at}}</span>{{($item->updated_at != null && $item->updated_at != "")?date('d/m/Y H:i', strtotime($item->updated_at)):''}}</td>
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
            <th>OHC Date</th>
            <th>Department</th>
            <th>GIR</th>
            <th>Causation</th>
            <th>Updated At</th>
            <th>HC/Accident</th>
        </tr>
        </thead>
        <tbody>
        @foreach($hs as $item)
            <tr class="report-tr" data-type="accidents" data-item="{{$item->id}}" style="cursor: pointer;">
                <td class="admin-view">{{$item->member ? $item->member->member_no : "" }}</td>
                <td class="admin-view">{{$item->member ? $item->member->name : "" }}</td>
                <td class="admin-view">{{$item->member ? $item->member->surname : "" }}</td>
                <td>{{ $item->group_code ? $item->group_code->group_code : "" }}</td>
                <td>{{ isset($item->body_part) ? $item->body_part->body_part : ""}}</td>
                <td><span>{{$item->accident_date}}</span>{{($item->accident_date != null && $item->accident_date != "")?date('d/m/Y', strtotime($item->accident_date)):''}}</td>
                <td><span>{{$item->logged_date}}</span>{{($item->logged_date != null && $item->logged_date != "")?date('d/m/Y', strtotime($item->logged_date)):''}}</td>
                <td>{{$item->member ? $item->member->department : "" }}</td>
                <td>{{ ($item->gir_definition) ? $item->gir_definition->definition : '' }}</td>
                <td>{{$item->causation_factor->causation_factor}}</td>
                <td><span>{{$item->updated_at}}</span>{{($item->updated_at != null && $item->updated_at != "")?date('d/m/Y H:i', strtotime($item->updated_at)):''}}</td>
                <td>Accident</td>
            </tr>
        @endforeach
        @if(isset($health))
            @foreach($health as $item)
                <tr>
                    <td class="admin-view">{{ $item->member ? $item->member->member_no : "" }}</td>
                    <td class="admin-view">{ {$item->member ? $item->member->name : "" }}</td>
                    <td class="admin-view">{ {$item->member ? $item->member->surname : "" }}</td>
                    <td>{{ $item->group_code ? $item->group_code->group_code : "" }}</td>
                    <td><span>{{$item->concern_date}}</span>{{($item->concern_date != null && $item->concern_date != "")?date('d/m/Y', strtotime($item->concern_date)):''}}</td>
                    <td></td>
                    <td><span>{{$item->ohc_appointment}}</span>{{($item->ohc_appointment != null && $item->ohc_appointment != "")?date('d/m/Y', strtotime($item->ohc_appointment)):''}}</td>
                    <td>{{ $item->member ? $item->member->department : "" }}</td>
                    <td>{{$item->mss_causation->mss_causation}}</td>
                    <td><span>{{$item->updated_at}}</span>{{($item->updated_at != null && $item->updated_at != "")?date('d/m/Y H:i', strtotime($item->updated_at)):''}}</td>
                    <td>HC</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endif

