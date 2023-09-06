<?php $__env->startSection('page-title', 'Import CSV'); ?>


<?php $__env->startSection('page-subtitle', 'import members from csv'); ?>


<?php $__env->startSection('head-extras'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">

            <!-- Edit Form -->
            <div class="box box-info" id="">
                <div class="box-header with-border">
                    <h3 class="box-title">Import CSV Settings</h3>
                </div>
                <form class="form form-horizontal" id="import-form" method="POST" >
                    <?php echo e(csrf_field(), false); ?>

                    <div class="box-body" >
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


                        <div class="form-group">
                            <label class="control-label col-sm-2" for="import_url">Import URL / Directory: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control required-field" id="import_url" name="import_url" value="<?php echo e(isset($settings->import_url)?$settings->import_url:'', false); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="set_time">Time of Import: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control required-field" id="set_time" name="set_time" value="<?php echo e(isset($settings->set_time)?$settings->set_time:'', false); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="set_time">Last Import: </label>
                            <div class="col-sm-10">
                                <span id="last_import"><?php echo e((isset($settings->last_import) && $settings->last_import != "")?date('d/m/Y H:i:s', strtotime($settings->last_import)):'', false); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <!-- Edit Button -->
                        <div class="col-xs-6">
                            <div class="text-center margin-b-5 margin-t-5">
                                <button class="btn btn-info" type="button" id="import_csv" style="width: 180px;">
                                    <i class="fa fa-arrow-right"></i>  <span>Manual Import Now</span>
                                </button>
                            </div>
                        </div>
                        <!-- /.col-xs-6 -->
                        <div class="col-xs-6">
                            <div class="text-center margin-b-5 margin-t-5">
                                <button class="btn btn-primary" id="import_setting_save" type="button">
                                    <i class="fa fa-save"></i> <span>Save Import Settings</span>
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


<?php $__env->startSection('footer-extras'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer-scripts'); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '#import_setting_save', function () {
            var form = $("#import-form");
            var form_val = true;
            form.find(".required-field").each(function () {
                if($(this).val() == '' || $(this).val() == null) {
                    $(this).focus();
                    form_val = false;
                }
            });

            if(form_val == false)
                return false;

            $.ajax({
                url: "<?php echo e(route('import_admin.save'), false); ?>",
                method: "POST",
                data: form.serialize(),
                statusCode: {
                    401: function () {
                        console.log('Login expired. Please sign in again.')
                    }
                },
                success: function (result) {
                    console.log(result);
                    if(result.message == "ok") {
                        $("#success-alert").show();
                    } else {
                        $("#fault-alert").show();
                    }


                }
            });
        });

        $(document).on('click', '#import_csv', function () {
            $(this).text("Importing....");
            $(this).attr('disabled', true);
            $.ajax({
                url: "<?php echo e(route('import_admin.import'), false); ?>",
                method: "GET",
                data: {},
                statusCode: {
                    401: function () {
                        console.log('Login expired. Please sign in again.')
                    }
                },
                success: function (result) {
                    //console.log(result);
                    if(typeof result.errors !== "undefined" && result.errors.length > 0) {
                        jQuery.each(result.errors, function(key, value){
                            jQuery('#fault_message').append('<p>'+value+'</p>');
                        });
                        $(".alert-danger").fadeTo(2000, 500).slideUp(500, function () {
                            $(".alert-danger").slideUp(500);
                            $(".alert-danger").text('');
                        });
                    } else {
                        $("#alert_message").text("Successfully imported.");
                        $("#success-alert").show();
                        $("#import_csv").html('<i class="fa fa-arrow-right"></i>  <span>Manual Import Now</span>');
                        $("#last_import").text(result.message);
                    }

                    $("#import_csv").html('<i class="fa fa-arrow-right"></i>  <span>Manual Import Now</span>');
                    $("#import_csv").attr('disabled', false);


                }
            });
        });

    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>