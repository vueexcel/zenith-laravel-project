<table class="table table-bordered table-striped">
    <tr>
        <th>Level_1_Date</th>
        <th>Mbr No</th>
        <th>Surname</th>
        <th>Name</th>
        <th>Occupation</th>
        <th>Group_Code</th>
        <th>Section</th>
        <th>Department</th>
        <th>Division</th>
        <th>Supervisor</th>
        <th>Logged_Date</th>
        <th>Concern_Date</th>
        <th>Repeat</th>
        <th>Body_Part</th>
        <th>Symptoms</th>
        <th>Origin</th>
        <th>Origin_Type</th>
        <th>WI_Required</th>
        <th>WI_Part_2_Received</th>
        <th>Group_Stats</th>
        <th>Department_Stats</th>
        <th>Level_1_Discharged</th>
        <th>OHC_Appointment</th>
        <th>Appointment_Reason</th>
        <th>Initial_Advice</th>
        <th>Next_Steps_1_Date</th>
        <th>Next_Steps_1</th>
        <th>Next_Steps_2_Date</th>
        <th>Next_Steps_2</th>
        <th>Next_Steps_3_Date</th>
        <th>Next_Steps_3</th>
        <th>Next_Steps_4_Date</th>
        <th>Next_Steps_4</th>
        <th>Next_Steps_5_Date</th>
        <th>Next_Steps_5</th>
        <th>Next_Steps_6_Date</th>
        <th>Next_Steps_6</th>
        <th>Next_Steps_7_Date</th>
        <th>Next_Steps_7</th>
        <th>Next_Steps_8_Date</th>
        <th>Next_Steps_8</th>
        <th>Next_Steps_9_Date</th>
        <th>Next_Steps_9</th>
        <th>GMIR</th>
        <th>Outcome</th>
        <th>Next_Step</th>
        <th>Level_2_Date</th>
        <th>Level_2_Discharged</th>
        <th>Level_3_Date</th>
        <th>Level_3_Discharged</th>
        <th>Level_4_Date</th>
        <th>Level_4_Discharged</th>
        <th>RTW_Date</th>
        <th>RTW_Date_Revised</th>
        <th>Current_Level</th>
        <th>Ramp_Up</th>
        <th>Fully_Fit</th>
        <th>Discharge_Date</th>
        <th>Rest_Days_1</th>
        <th>Rest_Days_2</th>
        <th>Rest_Days_3</th>
        <th>Rest_Days_4</th>
        <th>Rest_Days_5</th>
        <th>Rest_Days_6</th>
        <th>Rest_Days_7</th>
        <th>Rest_Days_8</th>
        <th>Rest_Days_9</th>
        <th>Total_Rest_Days</th>
        <th>Total_Rest_Weekdays</th>
    </tr>
    @foreach($report_data as $record)
        <tr>
            <td>{{!empty($record->level_1_date)?date('d-M-Y', strtotime($record->level_1_date)):''}}</td>
            <td>{{$record->member->member_no}}</td>
            <td>{{$record->member->surname}}</td>
            <td>{{$record->member->name}}</td>
            <td>{{$record->member->occupation}}</td>
            <td>{{$record->member->group_code}}</td>
            <td>{{$record->member->section}}</td>
            <td>{{$record->member->department}}</td>
            <td>{{$record->member->division}}</td>
            <td>{{$record->member->supervisor}}</td>
            <td>{{!empty($record->logged_date)?date('d-M-Y', strtotime($record->logged_date)):''}}</td>
            <td>{{!empty($record->concern_date)?date('d-M-Y', strtotime($record->concern_date)):''}}</td>
            <td>{{$record->repeat}}</td>
            <td>{{($record->body_part) ? $record->body_part->body_part : ''}}</td>
            <td>{{$record->symptoms}}</td>
            <td>{{$record->origin}}</td>
            <td>{{($record->origin_type) ? $record->origin_type->origin_type : ''}}</td>
            <td>{{$record->wi_required}}</td>
            <td>{{!empty($record->wi_part_2_received)?date('d-M-Y', strtotime($record->wi_part_2_received)):''}}</td>
            <td>{{$record->group_code->group_code}}</td>
            <td></td>
            <td>{{!empty($record->level_1_discharged)?date('d-M-Y', strtotime($record->level_1_discharged)):''}}</td>
            <td>{{!empty($record->ohc_appointment)?date('d-M-Y', strtotime($record->ohc_appointment)):''}}</td>
            <td>{{$record->appointment_reason}}</td>
            <td>{{$record->initial_advice}}</td>
            <td>{{!empty($record->ohc_appointment)?date('d-M-Y', strtotime($record->ohc_appointment)):''}}</td>
            <td>
                @php
                    if(!empty($record->next_steps_1)){
                        $nx_st = \App\Models\NextStep::find($record->next_steps_1);
                        if($nx_st)
                            echo $nx_st->next_step;
                    }
                @endphp
            </td>
            <td>{{!empty($record->next_steps_2_date)?date('d-M-Y', strtotime($record->next_steps_2_date)):''}}</td>
            <td>
                @php
                    if(!empty($record->next_steps_2)){
                        $nx_st = \App\Models\NextStep::find($record->next_steps_2);
                        if($nx_st)
                            echo $nx_st->next_step;
                    }
                @endphp
            </td>
            <td>{{!empty($record->next_steps_3_date)?date('d-M-Y', strtotime($record->next_steps_3_date)):''}}</td>
            <td>
                @php
                    if(!empty($record->next_steps_3)){
                        $nx_st = \App\Models\NextStep::find($record->next_steps_3);
                        if($nx_st)
                            echo $nx_st->next_step;
                    }
                @endphp
            </td>
            <td>{{!empty($record->next_steps_4_date)?date('d-M-Y', strtotime($record->next_steps_4_date)):''}}</td>
            <td>
                @php
                    if(!empty($record->next_steps_4)){
                        $nx_st = \App\Models\NextStep::find($record->next_steps_4);
                        if($nx_st)
                            echo $nx_st->next_step;
                    }
                @endphp
            </td>
            <td>{{!empty($record->next_steps_5_date)?date('d-M-Y', strtotime($record->next_steps_5_date)):''}}</td>
            <td>
                @php
                    if(!empty($record->next_steps_5)){
                        $nx_st = \App\Models\NextStep::find($record->next_steps_5);
                        if($nx_st)
                            echo $nx_st->next_step;
                    }
                @endphp
            </td>
            <td>{{!empty($record->next_steps_6_date)?date('d-M-Y', strtotime($record->next_steps_6_date)):''}}</td>
            <td>
                @php
                    if(!empty($record->next_steps_6)){
                        $nx_st = \App\Models\NextStep::find($record->next_steps_6);
                        if($nx_st)
                            echo $nx_st->next_step;
                    }
                @endphp
            </td>
            <td>{{!empty($record->next_steps_7_date)?date('d-M-Y', strtotime($record->next_steps_7_date)):''}}</td>
            <td>
                @php
                    if(!empty($record->next_steps_7)){
                        $nx_st = \App\Models\NextStep::find($record->next_steps_7);
                        if($nx_st)
                            echo $nx_st->next_step;
                    }
                @endphp
            </td>
            <td>{{!empty($record->next_steps_8_date)?date('d-M-Y', strtotime($record->next_steps_8_date)):''}}</td>
            <td>
                @php
                    if(!empty($record->next_steps_8)){
                        $nx_st = \App\Models\NextStep::find($record->next_steps_8);
                        if($nx_st)
                            echo $nx_st->next_step;
                    }
                @endphp
            </td>
            <td>{{!empty($record->next_steps_9_date)?date('d-M-Y', strtotime($record->next_steps_9_date)):''}}</td>
            <td>
                @php
                    if(!empty($record->next_steps_9)){
                        $nx_st = \App\Models\NextStep::find($record->next_steps_9);
                        if($nx_st)
                            echo $nx_st->next_step;
                    }
                @endphp
            </td>
            <td>{{$record->gmir}}</td>
            <td>{{$record->outcome}}</td>
            <td>{{!empty($record->next_step_id)?$record->next_step->next_step:''}}</td>
            <td>{{!empty($record->level_2_date)?date('d-M-Y', strtotime($record->level_2_date)):''}}</td>
            <td>{{!empty($record->level_2_discharged)?date('d-M-Y', strtotime($record->level_2_discharged)):''}}</td>
            <td>{{!empty($record->level_3_date)?date('d-M-Y', strtotime($record->level_3_date)):''}}</td>
            <td>{{!empty($record->level_3_discharged)?date('d-M-Y', strtotime($record->level_3_discharged)):''}}</td>
            <td>{{!empty($record->level_4_date)?date('d-M-Y', strtotime($record->level_4_date)):''}}</td>
            <td>{{!empty($record->level_4_discharged)?date('d-M-Y', strtotime($record->level_4_discharged)):''}}</td>
            <td>{{!empty($record->rtw_date)?date('d-M-Y', strtotime($record->ohc_appointment)):''}}</td>
            <td>{{!empty($record->rtw_date_revised)?date('d-M-Y', strtotime($record->rtw_date_revised)):''}}</td>
            <td>{{$record->current_level}}</td>
            <td>{{$record->ramp_up}}</td>
            <td>{{!empty($record->fully_fit)?date('d-M-Y', strtotime($record->fully_fit)):''}}</td>
            <td>{{!empty($record->discharge_date)?date('d-M-Y', strtotime($record->discharge_date)):''}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    @endforeach
</table>
