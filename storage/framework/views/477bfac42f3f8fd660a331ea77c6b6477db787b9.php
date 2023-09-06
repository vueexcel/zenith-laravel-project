<?php $__env->startSection('head-extras'); ?>
    <link href="//cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-title', 'Export Options'); ?>


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
        <div class="col-md-12">
            <div class="my-alert alert alert-success" id="success-alert" style="display: none">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong id="alert_title">Success! </strong>
                <span id="alert_message">Successfully saved.</span>
            </div>

            <div class="my-alert alert alert-danger" id="fault-alert" style="display: none">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong id="fault_title">Fail! </strong>
                <span id="fault_message">Save failed.</span>
            </div>
        </div>
        <div class="col-xs-12">
            <!-- Edit Form -->
            <div class="box box-info" id="">
                <form class="form form-horizontal" id="import-form" method="POST" >
                    <?php echo e(csrf_field(), false); ?>

                    <div class="box-body" >

                        <div class="checkbox">
                            <label style="font-size: 16px;">
                                <input type="checkbox" id="select_all" value="all"> Select All
                            </label>
                        </div>
                        <hr>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" <?php echo e((in_array('company_statistics', $options))?'checked':'', false); ?> value="company_statistics"> Company Statistics
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" <?php echo e((in_array('lost_incidents', $options))?'checked':'', false); ?> value="lost_incidents"> Lost Time Incidents
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" <?php echo e((in_array('all_accidents', $options))?'checked':'', false); ?> value="all_accidents"> All Accidents
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" <?php echo e((in_array('mss_incidents', $options))?'checked':'', false); ?> value="mss_incidents"> MSS Incidents
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" <?php echo e((in_array('illness_incidents', $options))?'checked':'', false); ?> value="illness_incidents"> Illness Incidents
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" <?php echo e((in_array('near_misses', $options))?'checked':'', false); ?> value="near_misses"> Near Misses
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" <?php echo e((in_array('riddor_incidents', $options))?'checked':'', false); ?> value="riddor_incidents"> RIDDOR Incidents
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" <?php echo e((in_array('restriction_cost', $options))?'checked':'', false); ?> value="restriction_cost"> Restriction Cost
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" <?php echo e((in_array('work_other_incidents', $options))?'checked':'', false); ?> value="work_other_incidents"> Work Other Incidents
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" <?php echo e((in_array('contractor_accidents', $options))?'checked':'', false); ?> value="contractor_accidents"> Contractor Accidents
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" <?php echo e((in_array('daily_restriction_status', $options))?'checked':'', false); ?> value="daily_restriction_status"> Daily Restriction Status
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="options" name="export_options[]" <?php echo e((in_array('master_kpi', $options))?'checked':'', false); ?> value="master_kpi"> Master KPI
                            </label>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <div class="col-xs-12">
                            <div class="margin-b-5 margin-t-5">
                                <button class="btn btn-primary" id="export_options_save" type="button">
                                    <i class="fa fa-save"></i> <span>Save Settings</span>
                                </button>
                            </div>
                        </div>
                        <!-- /.col-xs-6 -->
                    </div>
                </form>
            </div>
            <!-- /.box -->
            <!-- /End Edit Form -->
        </div>
    </div>
    <!-- /.row -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-scripts'); ?>
    <script src="<?php echo e(asset('js/admin.js'), false); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#select_all").on('change', function () {
                if(this.checked) {
                    $(".options").prop("checked", true);
                }
            });

            $(document).on('click', '#export_options_save', function () {
                var form = $("#import-form");
                $.ajax({
                    url: "<?php echo e(route('export_options.save'), false); ?>",
                    method: "POST",
                    data: form.serialize(),
                    statusCode: {
                        401: function () {
                            console.log('Login expired. Please sign in again.')
                        }
                    },
                    success: function (result) {
                        if(result.message == "ok") {
                            $("#success-alert").show();
                        } else {
                            $("#fault-alert").show();
                        }
                    }
                });
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>