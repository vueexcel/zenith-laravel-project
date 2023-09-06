<?php
$_pageTitle = (isset($addVarsForView['_pageTitle']) && ! empty($addVarsForView['_pageTitle']) ? $addVarsForView['_pageTitle'] : ucwords($resourceTitle));
$_pageSubtitle = (isset($addVarsForView['_pageSubtitle']) && ! empty($addVarsForView['_pageSubtitle']) ? $addVarsForView['_pageSubtitle'] : 'List');
$_listLink = route($resourceRoutesAlias.'.index');
$_createLink = route($resourceRoutesAlias.'.create');

$tableCounter = 0;
$total = 0;
if (count($records) > 0) {
    $total = $records->total();
    $tableCounter = ($records->currentPage() - 1) * $records->perPage();
    $tableCounter = $tableCounter > 0 ? $tableCounter : 0;
}
?>


<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo Breadcrumbs::render($resourceRoutesAlias); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-title', $_pageTitle); ?>





<?php $__env->startSection('head-extras'); ?>
    ##parent-placeholder-eabe76b5c33d3d1e8dad24cd5afb8f00710c56db##
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Default box -->
    <div class="box box-info">
        

        <?php if ($__env->exists($resourceAlias.'._search')) echo $__env->make($resourceAlias.'._search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="box-body no-padding">
            <?php if(Auth::user()->is_admin > 1): ?>
            <div class="padding-5">

                <div class="col-md-6">
                    <span class="text-green padding-l-5">Total: <?php echo e($total, false); ?></span>&nbsp;
                </div>
                <div class="col-md-6">
                    <a href="<?php echo e($_createLink, false); ?>" class="btn btn-sm btn-primary pull-right">
                        <i class="fa fa-plus"></i> <span>Add</span>
                    </a>
                </div>
            </div>
            <?php endif; ?>
            <?php if(count($records) > 0): ?>
                <?php echo $__env->make($resourceAlias.'.table', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php else: ?>
                <p class="margin-l-5 lead text-green">No records found.</p>
            <?php endif; ?>

        </div>
        <!-- /.box-body -->
        

    </div>
    <!-- /.box -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer-extras'); ?>
    <?php echo $__env->make('_resources._list-footer-extras', ['sortByParams' => []], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>