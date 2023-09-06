<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale(), false); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="robots" content="noindex, nofollow, noarchive">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">

        <title><?php echo e(config('app.name', 'Laravel'), false); ?> | Error <?php if (! empty(trim($__env->yieldContent('title')))): ?> | <?php echo $__env->yieldContent('title'); ?> <?php endif; ?></title>

        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo e(cdn_asset('/css/bootstrap.min.css'), false); ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo e(cdn_asset('/css/font-awesome.min.css'), false); ?>">

        <!-- Theme CSS -->
        <link rel="stylesheet" href="/adminlte/css/AdminLTE.min.css">
        <!-- AdminLTE Skin. -->
        <link rel="stylesheet" href="/adminlte/css/skins/<?php echo e(config('adminlte.theme'), false); ?>.min.css">

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
    <body class="hold-transition <?php echo e(config('adminlte.theme'), false); ?> layout-top-nav">
        <!-- Site wrapper -->
        <div class="wrapper">

            <?php echo $__env->make('layouts.partials.errors.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- Full Width Column -->
            <div class="content-wrapper">
                <div class="container">

                    <!-- Main content -->
                    <section class="content">

                        <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <h2 class="page-header text-center text-danger">Error</h2>
                                <div class="box box-solid">
                                    <div class="box-body text-center text-danger">
                                        <?php echo $__env->yieldContent('message'); ?>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>

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

        <!-- AdminLTE App -->
        <script src="/adminlte/js/adminlte.min.js"></script>
    </body>
</html>
