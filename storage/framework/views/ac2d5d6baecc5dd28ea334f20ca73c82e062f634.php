<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale(), false); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="robots" content="noindex, nofollow, noarchive">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">

        <title><?php echo e(config('app.name', 'HealthSafety'), false); ?> <?php if (! empty(trim($__env->yieldContent('page-title')))): ?> | <?php echo $__env->yieldContent('page-title'); ?> <?php endif; ?></title>

        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo e(cdn_asset('/css/bootstrap.min.css'), false); ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo e(cdn_asset('/css/font-awesome.min.css'), false); ?>">
        <!-- Ionicons -->
        <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->

        <!-- Plugins -->
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="<?php echo e(cdn_asset('/adminlte/plugins/iCheck/all.css'), false); ?>" rel="stylesheet" type="text/css">
        <!-- Select2 -->
        <link href="<?php echo e(cdn_asset('/adminlte/plugins/select2/css/select2.min.css'), false); ?>" rel="stylesheet" type="text/css">
        <!-- datetimepicker -->
        <link href="<?php echo e(cdn_asset('/css/bootstrap-datetimepicker.min.css'), false); ?>" rel="stylesheet" type="text/css">
        <!-- END - Plugins -->

        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?php echo e(cdn_asset('/adminlte/css/AdminLTE.min.css'), false); ?>">
        <!-- AdminLTE Skin. -->
        <link rel="stylesheet" href="<?php echo e(cdn_asset('/adminlte/css/skins/' . config('adminlte.theme') . '.min.css'), false); ?>">

        <!-- Custom CSS -->
        <link href="<?php echo e(cdn_asset('/css/frontend.css?version=' . config('adminlte.version')), false); ?>" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="<?php echo e(cdn_asset('/js/html5shiv.js'), false); ?>"></script>
        <script src="<?php echo e(cdn_asset('/js/respond.min.js'), false); ?>"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <?php echo $__env->yieldContent('head-extras'); ?>
    </head>

    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
    <body class="hold-transition <?php echo e(config('adminlte.theme'), false); ?> layout-top-nav" onload="startTime()">
        <!-- Site wrapper -->
        <div class="wrapper">

            <?php echo $__env->make('layouts.partials.frontend.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- Full Width Column -->
            <div class="content-wrapper">
                <div class="container">
                    <?php $__env->startSection('content-header'); ?>
                        <!-- Content Header (Page header) -->
                        <section class="content-header">
                            <h1>
                                <?php echo $__env->yieldContent('page-title'); ?>
                                <small><?php echo $__env->yieldContent('page-subtitle'); ?></small>
                            </h1>
                            <?php echo $__env->yieldContent('breadcrumbs'); ?>
                        </section>
                    <?php echo $__env->yieldSection(); ?>

                    <!-- Main content -->
                    <section class="content">

                        <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <?php echo $__env->yieldContent('content'); ?>

                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.container -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="container text-center">
                    <strong>Copyright &copy; <?php echo e(date('Y'), false); ?>. <?php echo config('adminlte.credits'); ?></strong>
                </div>
                <!-- /.container -->
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <script src="<?php echo e(cdn_asset('/js/jquery-3.2.1.min.js'), false); ?>"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo e(cdn_asset('/js/bootstrap.min.js'), false); ?>"></script>
        <!-- SlimScroll -->
        <script src="<?php echo e(cdn_asset('/adminlte/plugins/jquery-slimscroll/jquery.slimscroll.min.js'), false); ?>"></script>
        <!-- FastClick -->
        <script src="<?php echo e(cdn_asset('/adminlte/plugins/fastclick/fastclick.js'), false); ?>"></script>

        <!-- Plugins -->
        <!-- iCheck for checkboxes and radio inputs -->
        <script src="<?php echo e(cdn_asset('/adminlte/plugins/iCheck/icheck.min.js'), false); ?>" type="text/javascript"></script>
        <!-- Select2 -->
        <script src="<?php echo e(cdn_asset('/adminlte/plugins/select2/js/select2.min.js'), false); ?>" type="text/javascript"></script>
        <!-- Moment Js-->
        <script src="<?php echo e(cdn_asset('/js/moment.min.js'), false); ?>"></script>
        <!-- DatetimePicker Js-->
        <script src="<?php echo e(cdn_asset('/js/bootstrap-datetimepicker.min.js'), false); ?>"></script>
        <!-- END - Plugins -->

        <!-- AdminLTE App -->
        <script src="<?php echo e(cdn_asset('/adminlte/js/adminlte.min.js'), false); ?>"></script>
        <!-- Custom Js -->
        <script src="<?php echo e(cdn_asset('/js/frontend.js?version=' . config('adminlte.version')), false); ?>"></script>

        <script type="text/javascript">
            (function ($) {
                if (document.head.querySelector('meta[name="csrf-token"]')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                } else {
                    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
                }
            })(jQuery);
        </script>
        <script type="text/javascript">
            var WinNetwork = new ActiveXObject("WScript.Network");
            $(".guest_user_no").text(WinNetwork.UserName)
            $("#guest_user_no").val(WinNetwork.UserName)
        </script>
        <script src="<?php echo e(asset('js/custom.js'), false); ?>"></script>

        <?php echo $__env->yieldContent('footer-extras'); ?>

        <?php echo $__env->yieldPushContent('footer-scripts'); ?>
    </body>
</html>
