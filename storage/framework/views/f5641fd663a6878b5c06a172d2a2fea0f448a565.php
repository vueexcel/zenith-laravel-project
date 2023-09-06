<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale(), false); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="robots" content="noindex, nofollow, noarchive">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">

        <title><?php echo $__env->yieldContent('page-title'); ?> <?php if (! empty(trim($__env->yieldContent('page-subtitle')))): ?> | <?php echo $__env->yieldContent('page-subtitle'); ?> <?php endif; ?></title>

        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo e(cdn_asset('/css/bootstrap.min.css'), false); ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo e(cdn_asset('/css/font-awesome.min.css'), false); ?>">
        <!-- Ionicons -->
        <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->

        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo e(cdn_asset('/css/dataTables.bootstrap.min.css'), false); ?>">
        <link rel="stylesheet" href="<?php echo e(cdn_asset('/css/buttons.dataTables.min.css'), false); ?>">
        <!-- Plugins -->
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="<?php echo e(cdn_asset('/adminlte/plugins/iCheck/all.css'), false); ?>" rel="stylesheet" type="text/css">
        <!-- Select2 -->
        <link href="<?php echo e(cdn_asset('/adminlte/plugins/select2/css/select2.min.css'), false); ?>" rel="stylesheet" type="text/css">
        <!-- datetimepicker -->
        <link href="<?php echo e(cdn_asset('/css/bootstrap-datetimepicker.min.css'), false); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo e(cdn_asset('/css/tableexport.css'), false); ?>" rel="stylesheet" type="text/css">

        <!-- EXTRAS -->
        <?php echo $__env->yieldPushContent('head-scripts'); ?>

        <!-- END - Plugins -->

        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?php echo e(cdn_asset('/adminlte/css/AdminLTE.min.css'), false); ?>">
        <!-- AdminLTE Skin. -->
        <link rel="stylesheet" href="<?php echo e(cdn_asset('/adminlte/css/skins/' . config('adminlte.theme') . '.min.css'), false); ?>">

        <!-- Custom CSS -->
        <link href="<?php echo e(cdn_asset('/css/backend.css?version=' . config('adminlte.version')), false); ?>" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="<?php echo e(cdn_asset('/js/html5shiv.js'), false); ?>"></script>
        <script src="<?php echo e(cdn_asset('/js/respond.min.js'), false); ?>"></script>
        <![endif]-->

        <?php echo $__env->yieldContent('head-extras'); ?>
        <?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>
    </head>

    <body class="hold-transition <?php echo e(config('adminlte.theme'), false); ?> sidebar-mini">
        <?php if(auth()->guard()->check()): ?>
            <script type="text/javascript">
                /* Recover sidebar state */
                (function () {
                    if (Boolean(localStorage.getItem('sidebar-toggle-collapsed'))) {
                        var body = document.getElementsByTagName('body')[0];
                        body.className = body.className + ' sidebar-collapse';
                    }
                })();
            </script>
        <?php endif; ?>

        <!-- Site wrapper -->
        <div class="wrapper">

         

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="margin-left: unset;">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo $__env->yieldContent('page-title'); ?>
                        <small><?php echo $__env->yieldContent('page-subtitle'); ?></small>
                    </h1>
                    <?php echo $__env->yieldContent('last_import_time'); ?>

                    <?php echo $__env->yieldContent('breadcrumbs'); ?>
                </section>

                <!-- Main content -->
                <section class="content">

                    <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <?php echo $__env->yieldContent('content'); ?>

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer" style="margin-left:unset; ">
                <div class="pull-right hidden-xs">
                    <b>Version</b> <?php echo e(config('adminlte.version'), false); ?>

                </div>
                <strong>Copyright &copy; <?php echo e(date('Y'), false); ?>. <?php echo config('adminlte.credits'); ?></strong>
            </footer>
        </div>
        <!-- ./wrapper -->
        <div id="loading">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        <?php if(Auth::check()): ?>
            <input type="hidden" id="user_permission" value="<?php echo e(Auth::user()->is_admin, false); ?>">
        <?php else: ?>
            <input type="hidden" id="user_permission" value="0">
        <?php endif; ?>

        <!-- jQuery 3 -->
        <script src="<?php echo e(cdn_asset('/js/jquery-3.2.1.min.js'), false); ?>"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo e(cdn_asset('/js/bootstrap.min.js'), false); ?>"></script>
        <!-- SlimScroll -->
        <script src="<?php echo e(cdn_asset('/adminlte/plugins/jquery-slimscroll/jquery.slimscroll.min.js'), false); ?>"></script>
        <!-- FastClick -->
        <script src="<?php echo e(cdn_asset('/adminlte/plugins/fastclick/fastclick.js'), false); ?>"></script>

        <script src="<?php echo e(cdn_asset('/js/jquery.dataTables.min.js'), false); ?>"></script>
        <script src="<?php echo e(cdn_asset('/js/dataTables.bootstrap.min.js'), false); ?>"></script>
        <script src="<?php echo e(cdn_asset('/js/dataTables.buttons.min.js'), false); ?>"></script>
        <script src="<?php echo e(cdn_asset('/js/buttons.html5.min.js'), false); ?>"></script>
        <script src="<?php echo e(cdn_asset('/js/jszip.min.js'), false); ?>"></script>

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
        <script src="<?php echo e(cdn_asset('/js/backend.js?version=' . config('adminlte.version')), false); ?>"></script>

        <script src="<?php echo e(cdn_asset('js/FileSaver.min.js'), false); ?>"></script>
        <script src="<?php echo e(cdn_asset('js/Blob.min.js'), false); ?>"></script>
        <script src="<?php echo e(cdn_asset('js/xls.core.min.js'), false); ?>"></script>
        <script src="<?php echo e(cdn_asset('js/tableexport.min.js'), false); ?>"></script>
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
            (function ($) {
                /* Store sidebar state */
                $('.sidebar-toggle').click(function(event) {
                    event.preventDefault();
                    if (Boolean(localStorage.getItem('sidebar-toggle-collapsed'))) {
                        localStorage.setItem('sidebar-toggle-collapsed', '');
                    } else {
                        localStorage.setItem('sidebar-toggle-collapsed', '1');
                    }
                });

                var windowURL = window.location.href;
                //pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
                pageURL = windowURL;
                /*var x= $('a[href="'+pageURL+'"]');
                    x.addClass('active');
                    x.parent().addClass('active');
                    x.closest('ul').closest('li').addClass('active');*/
                var y= $('a[href="'+windowURL+'"]');
                y.addClass('active');
                y.parent().addClass('active');
                y.closest('ul').closest('li').addClass('active');

                y.parent().parent().addClass('active');
                y.closest('ul').closest('li').closest('ul').closest('li').addClass('active');
            })(jQuery);

        </script>
        <script type="text/javascript">
            var WinNetwork = new ActiveXObject("WScript.Network");
            $(".guest_user_no").text(WinNetwork.UserName)
            $("#guest_user").val(WinNetwork.UserName)
            /*function IEdetection() {
                var ua = window.navigator.userAgent;
                var msie = ua.indexOf('MSIE ');
                if (msie > 0) {
                    // IE 10 or older, return version number
                    return ('IE ' + parseInt(ua.substring(
                        msie + 5, ua.indexOf('.', msie)), 10));
                }
                var trident = ua.indexOf('Trident/');
                if (trident > 0) {
                    // IE 11, return version number
                    var rv = ua.indexOf('rv:');
                    return ('IE ' + parseInt(ua.substring(
                        rv + 3, ua.indexOf('.', rv)), 10));
                }
                var edge = ua.indexOf('Edge/');
                if (edge > 0) {
                    //Edge (IE 12+), return version number
                    return ('IE ' + parseInt(ua.substring(
                        edge + 5, ua.indexOf('.', edge)), 10));
                }
                // User uses other browser
                return ('Not IE');
            }
            var result = IEdetection();
            console.log(result);*/
        </script>
        <script src="<?php echo e(cdn_asset('/js/frontend.js'), false); ?>"></script>

        <?php echo $__env->yieldContent('footer-extras'); ?>

        <?php echo $__env->yieldPushContent('footer-scripts'); ?>
    </body>
</html>
