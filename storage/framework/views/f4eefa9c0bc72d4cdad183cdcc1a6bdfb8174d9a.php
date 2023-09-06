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
    <?php $__currentLoopData = $report_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($record->member->member_no, false); ?></td>
            <td><?php echo e($record->member->surname, false); ?></td>
            <td><?php echo e($record->member->name, false); ?></td>
            <td><?php echo e($record->member->occupation, false); ?></td>
            <td><?php echo e($record->member->group_code, false); ?></td>
            <td><?php echo e($record->member->department, false); ?></td>
            <td><?php echo e($record->member->supervisor, false); ?></td>
            <td><?php echo e(!empty($record->logged_date)?date('d-M-Y', strtotime($record->logged_date)):'', false); ?></td>
            <td><?php echo e(!empty($record->concern_date)?date('d-M-Y', strtotime($record->concern_date)):'', false); ?></td>
            <td><?php echo e($record->repeat, false); ?></td>
            <td><?php echo e(($record->body_part) ? $record->body_part->body_part : '', false); ?></td>
            <td><?php echo e($record->origin, false); ?></td>
            <td><?php echo e(($record->origin_type) ? $record->origin_type->origin_type : '', false); ?></td>
            <td><?php echo e($record->wi_required, false); ?></td>
            <td><?php echo e(!empty($record->wi_part_1_received)?date('d-M-Y', strtotime($record->wi_part_1_received)):'', false); ?></td>
            <td><?php echo e(!empty($record->wi_part_2_received)?date('d-M-Y', strtotime($record->wi_part_2_received)):'', false); ?></td>
            <td><?php echo e(!empty($record->ohc_appointment)?date('d-M-Y', strtotime($record->ohc_appointment)):'', false); ?></td>
            <td></td>
            <td><?php echo e($record->initial_advice, false); ?></td>
            <td><?php echo e($record->outcome, false); ?></td>
            <td><?php echo e(($record->next_step) ? $record->next_step->next_step : '', false); ?></td>
            <td><?php echo e(!empty($record->level_1_date)?date('d-M-Y', strtotime($record->level_1_date)):'', false); ?></td>
            <td><?php echo e(!empty($record->level_1_discharged)?date('d-M-Y', strtotime($record->level_1_discharged)):'', false); ?></td>
            <td><?php echo e(!empty($record->level_2_date)?date('d-M-Y', strtotime($record->level_2_date)):'', false); ?></td>
            <td><?php echo e(!empty($record->level_2_discharged)?date('d-M-Y', strtotime($record->level_2_discharged)):'', false); ?></td>
            <td><?php echo e(!empty($record->level_3_date)?date('d-M-Y', strtotime($record->level_3_date)):'', false); ?></td>
            <td><?php echo e(!empty($record->level_3_discharged)?date('d-M-Y', strtotime($record->level_3_discharged)):'', false); ?></td>
            <td><?php echo e(!empty($record->level_4_date)?date('d-M-Y', strtotime($record->level_4_date)):'', false); ?></td>
            <td><?php echo e(!empty($record->level_4_discharged)?date('d-M-Y', strtotime($record->level_4_discharged)):'', false); ?></td>
            <td><?php echo e(!empty($record->rtw_date)?date('d-M-Y', strtotime($record->ohc_appointment)):'', false); ?></td>
            <td><?php echo e(!empty($record->rtw_date_revised)?date('d-M-Y', strtotime($record->rtw_date_revised)):'', false); ?></td>
            <td><?php echo e($record->member->section, false); ?></td>
            <td><?php echo e($record->member->division, false); ?></td>
            <td><?php echo e($record->symptoms, false); ?></td>
            <td><?php echo e(!empty($record->group_code_id)?\App\Models\GroupCode::find($record->group_code_id)->group_code:'', false); ?></td>
            <td><?php echo e(!empty($record->group_code_id)?\App\Models\GroupCode::find($record->group_code_id)->department:'', false); ?></td>
            <td><?php echo e(!empty($record->next_steps_1_date)?date('d-M-Y', strtotime($record->next_steps_1_date)):'', false); ?></td>
            <td><?php echo e(!empty($record->next_steps_1)?\App\Models\NextStep::find($record->next_steps_1)->next_step:'', false); ?></td>
            <td><?php echo e(!empty($record->next_steps_2_date)?date('d-M-Y', strtotime($record->next_steps_2_date)):'', false); ?></td>
            <td><?php echo e(!empty($record->next_steps_2)?\App\Models\NextStep::find($record->next_steps_2)->next_step:'', false); ?></td>
            <td><?php echo e(!empty($record->next_steps_3_date)?date('d-M-Y', strtotime($record->next_steps_3_date)):'', false); ?></td>
            <td><?php echo e(!empty($record->next_steps_3)?\App\Models\NextStep::find($record->next_steps_3)->next_step:'', false); ?></td>
            <td><?php echo e(!empty($record->next_steps_4_date)?date('d-M-Y', strtotime($record->next_steps_4_date)):'', false); ?></td>
            <td><?php echo e(!empty($record->next_steps_4)?\App\Models\NextStep::find($record->next_steps_4)->next_step:'', false); ?></td>
            <td><?php echo e(!empty($record->next_steps_5_date)?date('d-M-Y', strtotime($record->next_steps_5_date)):'', false); ?></td>
            <td><?php echo e(!empty($record->next_steps_5)?\App\Models\NextStep::find($record->next_steps_5)->next_step:'', false); ?></td>
            <td><?php echo e(!empty($record->next_steps_6_date)?date('d-M-Y', strtotime($record->next_steps_6_date)):'', false); ?></td>
            <td><?php echo e(!empty($record->next_steps_6)?\App\Models\NextStep::find($record->next_steps_6)->next_step:'', false); ?></td>
            <td><?php echo e(!empty($record->next_steps_7_date)?date('d-M-Y', strtotime($record->next_steps_7_date)):'', false); ?></td>
            <td><?php echo e(!empty($record->next_steps_7)?\App\Models\NextStep::find($record->next_steps_7)->next_step:'', false); ?></td>
            <td><?php echo e(!empty($record->next_steps_8_date)?date('d-M-Y', strtotime($record->next_steps_8_date)):'', false); ?></td>
            <td><?php echo e(!empty($record->next_steps_8)?\App\Models\NextStep::find($record->next_steps_8)->next_step:'', false); ?></td>
            <td><?php echo e(!empty($record->next_steps_9_date)?date('d-M-Y', strtotime($record->next_steps_9_date)):'', false); ?></td>
            <td><?php echo e(!empty($record->next_steps_9)?\App\Models\NextStep::find($record->next_steps_9)->next_step:'', false); ?></td>
            <td><?php echo e($record->gmir, false); ?></td>
            <td><?php echo e($record->current_level, false); ?></td>
            <td><?php echo e($record->ramp_up, false); ?></td>
            <td><?php echo e(!empty($record->fully_fit)?date('d-M-Y', strtotime($record->fully_fit)):'', false); ?></td>
            <td><?php echo e(!empty($record->discharge_date)?date('d-M-Y', strtotime($record->discharge_date)):'', false); ?></td>
            <td><?php echo e(!empty($record->mss_causation)?$record->mss_causation->mss_causation:'', false); ?></td>
            <td></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
