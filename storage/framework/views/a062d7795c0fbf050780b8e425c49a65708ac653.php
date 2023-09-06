<?php $__env->startSection('head-extras'); ?>
    <link href="//cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-title', 'Accident'); ?>


<?php $__env->startSection('page-subtitle', 'Control panel'); ?>


<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo Breadcrumbs::render('admin'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('head-extras'); ?>
    ##parent-placeholder-eabe76b5c33d3d1e8dad24cd5afb8f00710c56db##
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Small boxes (Stat box) -->
    <div class="row">

        <div class="col-lg-6 col-xs-12">
            <h3 style="color: #00a7d0;">Supervisors &nbsp;&nbsp;<a class="btn btn-success btn-sm item-create" data-item="supervisors">Add New</a></h3>
            <div class="col-md-12" id="div_supervisors" style="background-color: #fff; padding: 10px; min-height: 560px; height: auto"></div>
        </div>

        <div class="col-lg-6 col-xs-12">
            <h3 style="color: #00a7d0;">Injury Types &nbsp;&nbsp;<a class="btn btn-success btn-sm item-create" data-item="injury_types">Add New</a></h3>
            <div class="col-md-12" id="div_injury_types" style="background-color: #fff; padding: 10px; min-height: 560px; height: auto"></div>
        </div>

        <div class="col-lg-6 col-xs-12">
            <h3 style="color: #00a7d0;">Body Parts&nbsp;&nbsp;<a class="btn btn-success btn-sm item-create" data-item="body_parts">Add New</a></h3></h3>
            <div class="col-md-12" id="div_body_parts" style="background-color: #fff; padding: 10px; min-height: 560px; height: auto"></div>
        </div>

        <div class="col-lg-6 col-xs-12">
            <h3 style="color: #00a7d0;">Outcomes &nbsp;&nbsp;<a class="btn btn-success btn-sm item-create" data-item="outcomes">Add New</a></h3>
            <div class="col-md-12" id="div_outcomes" style="background-color: #fff; padding: 10px; min-height: 560px; height: auto"></div>
        </div>

        <div class="col-lg-6 col-xs-12">
            <h3 style="color: #00a7d0;">Seen By &nbsp;&nbsp;<a class="btn btn-success btn-sm item-create" data-item="seen_by">Add New</a></h3>
            <div class="col-md-12" id="div_seen_by" style="background-color: #fff; padding: 10px; min-height: 560px; height: auto"></div>
        </div>

        <div class="col-lg-6 col-xs-12">
            <h3 style="color: #00a7d0;">Causation &nbsp;&nbsp;<a class="btn btn-success btn-sm item-create" data-item="causation_factors">Add New</a></h3>
            <div class="col-md-12" id="div_causation" style="background-color: #fff; padding: 10px; min-height: 560px; height: auto"></div>
        </div>

        <div class="col-lg-6 col-xs-12">
            <h3 style="color: #00a7d0;">GIR Definitions &nbsp;&nbsp;<a class="btn btn-success btn-sm item-create" data-item="gir_definitions">Add New</a></h3>
            <div class="col-md-12" id="div_gir_definitions" style="background-color: #fff; padding: 10px; min-height: 560px; height: auto"></div>
        </div>

        <div class="col-lg-6 col-xs-12">
            <h3 style="color: #00a7d0;">Group Codes &nbsp;&nbsp;<a class="btn btn-success btn-sm item-create" data-item="group_codes">Add New</a></h3>
            <div class="col-md-12" id="div_group_codes" style="background-color: #fff; padding: 10px; min-height: 560px; height: auto"></div>
        </div>


        <!-- ./col -->

        <!--------modal-------->
        <div class="modal fade" id="form-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Default Modal</h4>
                    </div>
                    <div class="modal-body" style="height: auto">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save-item">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-------./modal------->

        <div id="confirm-delete-modal" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-red color-palette">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="modalConfirmModelDeleteLabel">Are you sure <i class="fa fa-question"></i>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <p> Are you sure you want to delete this item<i class="fa fa-question"></i></p>
                        <form id="delete-form">
                            <?php echo e(csrf_field(), false); ?>

                            <input type="hidden" name="delete_item">
                            <input type="hidden" name="delete_item_id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger delete-item">Confirm</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer-extras'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-scripts'); ?>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo e(asset('js/admin.js'), false); ?>"></script>

<script type="text/javascript">
    $(document).ready(function () {
        read_supervisors();
        read_injury_types();
        read_body_parts();
        read_outcomes();
        read_seen_by();
        read_causation();
        read_gir_definitions();
        read_group_codes();

    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>