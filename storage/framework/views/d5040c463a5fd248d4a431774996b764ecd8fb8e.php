<table class="table table-bordered">
    <thead>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th></th>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tr>
    <tr>
        <th></th>
        <th class="th-center">Group</th>
        <th>Dept</th>
        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th><?php echo e($column['name'], false); ?></th>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tr>
    </thead>
    <tbody>
    <!--------A-------->
    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($key != 'J'): ?>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <?php for($i=0; $i<count($columns); $i++): ?>
                    <td>&nbsp;</td>
                <?php endfor; ?>
            </tr>
        <?php else: ?>
            <tr style="background-color: #B7DEE8">
                <td>&nbsp;</td>
                <td>J5???+JC???+JD???</td>
                <td style="text-align: left;">Paint Total</td>
                <?php $__currentLoopData = $j5_c_d; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e($item['value'], false); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        <?php endif; ?>

        <?php $__currentLoopData = $row['groups']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>&nbsp;</td>
                <td><?php echo e($group['code'], false); ?></td>
                <td style="text-align: left;"><?php echo e($group['department'], false); ?></td>
                <?php $__currentLoopData = $group['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e($column['value'], false); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if($key == 'J'): ?>
            <tr style="background-color: #B7DEE8">
                <td>&nbsp;</td>
                <td>J6???+JA???+JB???</td>
                <td style="text-align: left;">Plastics Total</td>
                <?php $__currentLoopData = $j6_a_b; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e($item['value'], false); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        <?php elseif($key == 'G'): ?>
            <tr style="background-color: #B7DEE8">
                <td>&nbsp;</td>
                <td>GA/F/G</td>
                <td style="text-align: left;">Assembly Engineering and Maintenance</td>
                <?php $__currentLoopData = $ga_f_g; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e($item['value'], false); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        <?php else: ?>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <?php for($i=0; $i<count($columns); $i++): ?>
                    <td>&nbsp;</td>
                <?php endfor; ?>
            </tr>
        <?php endif; ?>

        <?php if($key == "M" || $key == "H"): ?>
            <tr style="background-color: #00FFFF;">
        <?php else: ?>
            <tr style="background-color: yellow;">
        <?php endif; ?>
                <td>&nbsp;</td>
                <td><?php echo e($row['code'], false); ?></td>
                <td style="text-align: left;"><?php echo e($row['department'], false); ?></td>
            <?php if($key == "M"): ?>
                <?php $__currentLoopData = $burnaston; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e($item['value'], false); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <?php $__currentLoopData = $row['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e($column['value'], false); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <?php for($i=0; $i<count($columns); $i++): ?>
                <td>&nbsp;</td>
            <?php endfor; ?>
        </tr>

        <tr style="background-color: #FF99CC;">
            <td>&nbsp;</td>
            <td>TMUK</td>
            <td style="text-align: left;">Toyota UK Total</td>
            <?php $__currentLoopData = $tmuk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <td><?php echo e($item['value'], false); ?></td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
    </tbody>
</table>
