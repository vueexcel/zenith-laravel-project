<table class="table table-bordered table-striped">
    <tr>
        <th>Episode Reference</th>
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
        <td>L1 Date</td>
        <td>L2 Date</td>
        <td>L3 Date</td>
        <td>Original RTW_Date</td>
        <td>Current RTW_Date</td>
        <td>Discharge_Date</td>
        <td>Availability</td>
        <td>Last Change</td>
    </tr>
    <?php $__currentLoopData = $report_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            if(!empty($record->ramp_up) && $record->ramp_up != 'None' && $record->fully_fit >= date('Y-m-d'))
                $style = 'style="background: #00FF00; color:#000000"';
            else if($record->next_step_id == 3)
                $style = 'style="background: #FF0000; color:#FFFFFF"';
            else
                $style = '';
        ?>

        <tr>
            <td <?php echo $style; ?>><?php echo e($record->episode_reference, false); ?></td>
            <td <?php echo $style; ?>><?php echo e($record->member->member_no, false); ?></td>
            <td <?php echo $style; ?>><?php echo e($record->member->surname, false); ?></td>
            <td <?php echo $style; ?>><?php echo e($record->member->name, false); ?></td>
            <td <?php echo $style; ?>><?php echo e($record->member->occupation, false); ?></td>
            <td <?php echo $style; ?>><?php echo e($record->member->group_code, false); ?></td>
            <td <?php echo $style; ?>><?php echo e($record->member->department, false); ?></td>
            <td <?php echo $style; ?>><?php echo e($record->member->supervisor, false); ?></td>

            <td <?php echo $style; ?>><?php echo e(!empty($record->concern_date)?date('d-M-Y', strtotime($record->concern_date)):'', false); ?></td>
            <td <?php echo $style; ?>><?php echo e($record->repeat, false); ?></td>
            <td <?php echo $style; ?>><?php echo e(($record->body_part) ? $record->body_part->body_part : '', false); ?></td>
            <td <?php echo $style; ?>><?php echo e($record->origin, false); ?></td>
            <td <?php echo $style; ?>><?php echo e(($record->origin_type) ? $record->origin_type->origin_type : '', false); ?></td>
            <td <?php echo $style; ?>><?php echo e($record->outcome, false); ?></td>
            <td <?php echo $style; ?>><?php echo e(($record->next_step) ? $record->next_step->next_step : '', false); ?></td>
            <td <?php echo $style; ?>><?php echo e(!empty($record->level_1_date)?date('d-M-Y', strtotime($record->level_1_date)):'', false); ?></td>
            <td <?php echo $style; ?>><?php echo e(!empty($record->level_2_date)?date('d-M-Y', strtotime($record->level_2_date)):'', false); ?></td>
            <td <?php echo $style; ?>><?php echo e(!empty($record->level_3_date)?date('d-M-Y', strtotime($record->level_3_date)):'', false); ?></td>
            <td <?php echo $style; ?>><?php echo e(!empty($record->rtw_date)?date('d-M-Y', strtotime($record->ohc_appointment)):'', false); ?></td>
            <td <?php echo $style; ?>></td>
            <td <?php echo $style; ?>><?php echo e(!empty($record->discharge_date)?date('d-M-Y', strtotime($record->discharge_date)):'', false); ?></td>
            <td <?php echo $style; ?>></td>
            <td <?php echo $style; ?>><?php echo e(!empty($record->updated_at)?date('d-M-Y', strtotime($record->updated_at)):'', false); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
