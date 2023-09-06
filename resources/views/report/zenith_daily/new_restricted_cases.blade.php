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
        <td>Section</td>
        <td>Division</td>
        <td>Symptoms</td>
        <td>GroupStatus</td>
        <td>Department Stats</td>
        <td>Next_Steps_1_Date</td>
        <td>Next_Steps_1</td>
        <td>Next_Steps_2_Date</td>
        <td>Next_Steps_2</td>
        <td>Next_Steps_3_Date</td>
        <td>Next_Steps_3</td>
        <td>Next_Steps_4_Date</td>
        <td>Next_Steps_4</td>
        <td>Next_Steps_5_Date</td>
        <td>Next_Steps_5</td>
        <td>Next_Steps_6_Date</td>
        <td>Next_Steps_6</td>
        <td>Next_Steps_7_Date</td>
        <td>Next_Steps_7</td>
        <td>Next_Steps_8_Date</td>
        <td>Next_Steps_8</td>
        <td>Next_Steps_9_Date</td>
        <td>Next_Steps_9</td>
        <td>GMIR</td>
        <td>Current_Level</td>
        <td>Ramp_UP</td>
        <td>Fully_Fit</td>
        <td>Discharge_Date</td>
        <td>MSS_Causation_Factor</td>
        <td>Causation_Factor_MSS</td>
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
            <td>{{$record->member->section}}</td>
            <td>{{$record->member->division}}</td>
            <td>{{$record->symptoms}}</td>
            <td>{{!empty($record->group_code_id)?\App\Models\GroupCode::find($record->group_code_id)->group_code:''}}</td>
            <td>{{!empty($record->group_code_id)?\App\Models\GroupCode::find($record->group_code_id)->department:''}}</td>
            <td>{{!empty($record->next_steps_1_date)?date('d-M-Y', strtotime($record->next_steps_1_date)):''}}</td>
            <td>{{!empty($record->next_steps_1)?\App\Models\NextStep::find($record->next_steps_1)->next_step:''}}</td>
            <td>{{!empty($record->next_steps_2_date)?date('d-M-Y', strtotime($record->next_steps_2_date)):''}}</td>
            <td>{{!empty($record->next_steps_2)?\App\Models\NextStep::find($record->next_steps_2)->next_step:''}}</td>
            <td>{{!empty($record->next_steps_3_date)?date('d-M-Y', strtotime($record->next_steps_3_date)):''}}</td>
            <td>{{!empty($record->next_steps_3)?\App\Models\NextStep::find($record->next_steps_3)->next_step:''}}</td>
            <td>{{!empty($record->next_steps_4_date)?date('d-M-Y', strtotime($record->next_steps_4_date)):''}}</td>
            <td>{{!empty($record->next_steps_4)?\App\Models\NextStep::find($record->next_steps_4)->next_step:''}}</td>
            <td>{{!empty($record->next_steps_5_date)?date('d-M-Y', strtotime($record->next_steps_5_date)):''}}</td>
            <td>{{!empty($record->next_steps_5)?\App\Models\NextStep::find($record->next_steps_5)->next_step:''}}</td>
            <td>{{!empty($record->next_steps_6_date)?date('d-M-Y', strtotime($record->next_steps_6_date)):''}}</td>
            <td>{{!empty($record->next_steps_6)?\App\Models\NextStep::find($record->next_steps_6)->next_step:''}}</td>
            <td>{{!empty($record->next_steps_7_date)?date('d-M-Y', strtotime($record->next_steps_7_date)):''}}</td>
            <td>{{!empty($record->next_steps_7)?\App\Models\NextStep::find($record->next_steps_7)->next_step:''}}</td>
            <td>{{!empty($record->next_steps_8_date)?date('d-M-Y', strtotime($record->next_steps_8_date)):''}}</td>
            <td>{{!empty($record->next_steps_8)?\App\Models\NextStep::find($record->next_steps_8)->next_step:''}}</td>
            <td>{{!empty($record->next_steps_9_date)?date('d-M-Y', strtotime($record->next_steps_9_date)):''}}</td>
            <td>{{!empty($record->next_steps_9)?\App\Models\NextStep::find($record->next_steps_9)->next_step:''}}</td>
            <td>{{$record->gmir}}</td>
            <td>{{$record->current_level}}</td>
            <td>{{$record->ramp_up}}</td>
            <td>{{!empty($record->fully_fit)?date('d-M-Y', strtotime($record->fully_fit)):''}}</td>
            <td>{{!empty($record->discharge_date)?date('d-M-Y', strtotime($record->discharge_date)):''}}</td>
            <td>{{!empty($record->mss_causation)?$record->mss_causation->mss_causation:''}}</td>
            <td></td>
        </tr>
    @endforeach
</table>
