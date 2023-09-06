<table class="table table-bordered table-striped">
    <tr>
        <td>Mbr No</td>
        <td>Surname</td>
        <td>Name</td>
        <td>Occupation</td>
        <td>Group_Code</td>
        <td>Department</td>
        <td>Supervisor</td>
        <td>Concern_Date</td>
        <td>Repeat</td>
        <td>Body_Part</td>
        <td>Origin</td>
        <td>Origin_Type</td>
        <td>Outcome</td>
        <td>Next_Steps</td>
        <td>OHC_Appointment</td>
        <td>Level_1_Date</td>
        <td>Level_2_Date</td>
        <td>Level_3_Date</td>
        <td>Discharge_Date</td>
        <td>Status</td>
    </tr>
    @foreach($report_data as $record)
        @php
            if(!empty($record->ramp_up) && $record->ramp_up != 'None' && $record->fully_fit >= date('Y-m-d'))
                $style = 'style="background: #00FF00; color:#000000"';
            else if($record->next_step_id == 3)
                $style = 'style="background: #FF0000; color:#FFFFFF"';
            else
                $style = '';
        @endphp

        <tr>
            <td <?php echo $style; ?>>{{$record->member->member_no}}</td>
            <td <?php echo $style; ?>>{{$record->member->surname}}</td>
            <td <?php echo $style; ?>>{{$record->member->name}}</td>
            <td <?php echo $style; ?>>{{$record->member->occupation}}</td>
            <td <?php echo $style; ?>>{{$record->member->group_code}}</td>
            <td <?php echo $style; ?>>{{$record->member->department}}</td>
            <td <?php echo $style; ?>>{{$record->member->supervisor}}</td>
            <td <?php echo $style; ?>>{{!empty($record->concern_date)?date('d-M-Y', strtotime($record->concern_date)):''}}</td>
            <td <?php echo $style; ?>>{{$record->repeat}}</td>
            <td <?php echo $style; ?>>{{($record->body_part) ? $record->body_part->body_part : ''}}</td>
            <td <?php echo $style; ?>>{{$record->origin}}</td>
            <td <?php echo $style; ?>>{{($record->origin_type) ? $record->origin_type->origin_type : ''}}</td>
            <td <?php echo $style; ?>>{{$record->outcome}}</td>
            <td <?php echo $style; ?>>{{($record->next_step) ? $record->next_step->next_step : ''}}</td>
            <td <?php echo $style; ?>>{{!empty($record->ohc_appointment)?date('d-M-Y', strtotime($record->ohc_appointment)):''}}</td>
            <td <?php echo $style; ?>>{{!empty($record->level_1_date)?date('d-M-Y', strtotime($record->level_1_date)):''}}</td>
            <td <?php echo $style; ?>>{{!empty($record->level_2_date)?date('d-M-Y', strtotime($record->level_2_date)):''}}</td>
            <td <?php echo $style; ?>>{{!empty($record->level_3_date)?date('d-M-Y', strtotime($record->level_3_date)):''}}</td>
            <td <?php echo $style; ?>>{{!empty($record->discharge_date)?date('d-M-Y', strtotime($record->discharge_date)):''}}</td>
            <td <?php echo $style; ?>>{{$record->status}}</td>
        </tr>
    @endforeach
</table>
