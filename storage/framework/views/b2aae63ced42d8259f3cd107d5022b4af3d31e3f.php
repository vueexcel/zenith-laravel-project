<?php if($breadcrumbs): ?>
    <ol class="breadcrumb">
        <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($loop->first): ?>
                <li><a href="<?php echo e($breadcrumb->url, false); ?>"><i class="fa fa-dashboard"></i><?php echo e($breadcrumb->title, false); ?></a></li>
            <?php elseif(!$loop->last): ?>
                <li><a href="<?php echo e($breadcrumb->url, false); ?>"><?php echo e($breadcrumb->title, false); ?></a></li>
            <?php else: ?>
                <li class="active"><?php echo e($breadcrumb->title, false); ?></li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ol>
<?php endif; ?>
