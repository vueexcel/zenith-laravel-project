<table class="table table-bordered table-striped">
    <tr>
        <td>Mbr No</td>
        <td>Surname</td>
        <td>Name</td>
        <td>Occupation</td>
        <td>Group_Code</td>
        <td>Department</td>
        <td>Supervisor</td>
        <td>Logged_Date</td>
        <td>Concern_Date</td>
        <td>Repeat</td>
        <td>Body_Part</td>
        <td>Origin</td>
        <td>Origin_Type</td>
        <td>WI_Required</td>
        <td>WI_Part_1_Received</td>
        <td>WI_Part_2_Received</td>
        <td>OHC_Appointment</td>
        <td>Appointment_Reason</td>
        <td>Initial_Advice</td>
        <td>Outcome</td>
        <td>Next_Steps</td>
        <td>Level_1_Date</td>
        <td>Level_1_Discharged</td>
        <td>Level_2_Date</td>
        <td>Level_2_Discharged</td>
        <td>Level_3_Date</td>
        <td>Level_3_Discharged</td>
        <td>Level_4_Date</td>
        <td>Level_4_Discharged</td>
        <td>RTW_Date</td>
        <td>RTW_Date_Revised</td>
    </tr>
    @foreach($report_data as $record)
    <tr>
        <td>{{$record->member->member_no}}</td>
        <td>{{$record->member->surname}}</td>
        <td>{{$record->member->name}}</td>
        <td>{{$record->member->occupation}}</td>
        <td>{{$record->member->group_code}}</td>
        <td>{{$record->member->department}}</td>
        <td>{{$record->member->supervisor}}</td>
        <td>{{!empty($record->logged_date)?date('d-M-Y', strtotime($record->logged_date)):''}}</td>
        <td>{{!empty($record->concern_date)?date('d-M-Y', strtotime($record->concern_date)):''}}</td>
        <td>{{$record->repeat}}</td>
        <td>{{($record->body_part) ? $record->body_part->body_part : ''}}</td>
        <td>{{$record->origin}}</td>
        <td>{{($record->origin_type) ? $record->origin_type->origin_type : ''}}</td>
        <td>{{$record->wi_required}}</td>
        <td>{{!empty($record->wi_part_1_received)?date('d-M-Y', strtotime($record->wi_part_1_received)):''}}</td>
        <td>{{!empty($record->wi_part_2_received)?date('d-M-Y', strtotime($record->wi_part_2_received)):''}}</td>
        <td>{{!empty($record->ohc_appointment)?date('d-M-Y', strtotime($record->ohc_appointment)):''}}</td>
        <td></td>
        <td>{{$record->initial_advice}}</td>
        <td>{{$record->outcome}}</td>
        <td>{{($record->next_step) ? $record->next_step->next_step : ''}}</td>
        <td>{{!empty($record->level_1_date)?date('d-M-Y', strtotime($record->level_1_date)):''}}</td>
        <td>{{!empty($record->level_1_discharged)?date('d-M-Y', strtotime($record->level_1_discharged)):''}}</td>
        <td>{{!empty($record->level_2_date)?date('d-M-Y', strtotime($record->level_2_date)):''}}</td>
        <td>{{!empty($record->level_2_discharged)?date('d-M-Y', strtotime($record->level_2_discharged)):''}}</td>
        <td>{{!empty($record->level_3_date)?date('d-M-Y', strtotime($record->level_3_date)):''}}</td>
        <td>{{!empty($record->level_3_discharged)?date('d-M-Y', strtotime($record->level_3_discharged)):''}}</td>
        <td>{{!empty($record->level_4_date)?date('d-M-Y', strtotime($record->level_4_date)):''}}</td>
        <td>{{!empty($record->level_4_discharged)?date('d-M-Y', strtotime($record->level_4_discharged)):''}}</td>
        <td>{{!empty($record->rtw_date)?date('d-M-Y', strtotime($record->ohc_appointment)):''}}</td>
        <td>{{!empty($record->rtw_date_revised)?date('d-M-Y', strtotime($record->rtw_date_revised)):''}}</td>
    </tr>
@endforeach
</table>
