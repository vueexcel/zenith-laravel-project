<div class="table-responsive list-records">
    <table class="table table-hover table-bordered" id="outcomes_table">
        <thead>
            <th>Outcome</th>
            <th style="width: 120px;">Actions</th>
        </thead>
        <tbody>
        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <a class="item-edit" data-item="outcomes" data-item_id="<?php echo e($record->id, false); ?>"><?php echo e($record->outcome, false); ?></a>
                </td>
                <!-- we will also add show, edit, and delete buttons -->
                <td>
                    <a class="btn btn-info btn-xs item-edit" data-item="outcomes" data-item_id="<?php echo e($record->id, false); ?>" style="cursor: pointer"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger btn-xs item-delete" data-item="outcomes" data-item_id="<?php echo e($record->id, false); ?>"  style="cursor: pointer"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
