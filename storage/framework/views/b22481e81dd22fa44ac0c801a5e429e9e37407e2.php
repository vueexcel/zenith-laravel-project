<div class="table-responsive list-records">
    <table class="table table-hover table-bordered" id="supervisors_table">
        <thead>
            <th style="width: 100px;">Surname</th>
            <th>Name</th>
            <th>Occupation</th>
            <th>Group Code</th>
            <th style="width: 120px;">Actions</th>
        </thead>
        <tbody>
        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($record->surname, false); ?></td>
                <td>
                    <a class="item-edit" data-item="supervisors" data-item_id="<?php echo e($record->id, false); ?>"><?php echo e($record->name, false); ?></a>
                </td>
                <td><?php echo e($record->occupation, false); ?></td>
                <td><?php echo e(($record->group_code)?$record->group_code->group_code:'', false); ?></td>
                <!-- we will also add show, edit, and delete buttons -->
                <td>
                    <a class="btn btn-info btn-xs item-edit" data-item="supervisors" data-item_id="<?php echo e($record->id, false); ?>" style="cursor: pointer"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger btn-xs item-delete" data-item="supervisors" data-item_id="<?php echo e($record->id, false); ?>"  style="cursor: pointer"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
