<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="robots" content="noindex, nofollow, noarchive">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('page-title') @hasSection('page-subtitle') | @yield('page-subtitle') @endif</title>

        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ cdn_asset('/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ cdn_asset('/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->

        <!-- DataTables -->
        <link rel="stylesheet" href="{{ cdn_asset('/css/dataTables.bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ cdn_asset('/css/buttons.dataTables.min.css') }}">
        <!-- Plugins -->
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="{{ cdn_asset('/adminlte/plugins/iCheck/all.css') }}" rel="stylesheet" type="text/css">
        <!-- Select2 -->
        <link href="{{ cdn_asset('/adminlte/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
        <!-- datetimepicker -->
        <link href="{{ cdn_asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ cdn_asset('/css/tableexport.css') }}" rel="stylesheet" type="text/css">

        <!-- EXTRAS -->
        @stack('head-scripts')

        <!-- END - Plugins -->

        <!-- Theme CSS -->
        <link rel="stylesheet" href="{{ cdn_asset('/adminlte/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skin. -->
        <link rel="stylesheet" href="{{ cdn_asset('/adminlte/css/skins/' . config('adminlte.theme') . '.min.css') }}">

        <!-- Custom CSS -->
        <link href="{{ cdn_asset('/css/backend.css?version=' . config('adminlte.version')) }}" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="{{ cdn_asset('/js/html5shiv.js') }}"></script>
        <script src="{{ cdn_asset('/js/respond.min.js') }}"></script>
        <![endif]-->

        @yield('head-extras')
        @routes
    </head>

    <body class="hold-transition {{ config('adminlte.theme') }} sidebar-mini">
        @auth
            <script type="text/javascript">
                /* Recover sidebar state */
                (function () {
                    if (Boolean(localStorage.getItem('sidebar-toggle-collapsed'))) {
                        var body = document.getElementsByTagName('body')[0];
                        body.className = body.className + ' sidebar-collapse';
                    }
                })();
            </script>
        @endauth

        <!-- Site wrapper -->
        <div class="wrapper">

            @if(auth()->user())
                @include('layouts.partials.backend.header')
                @include('layouts.partials.backend.sidebar')
            @else
                <style>
                    .content-wrapper,.main-footer{
                    margin-left: unset;
                    } 
                </style>
            @endif

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        @yield('page-title')
                        <small>@yield('page-subtitle')</small>
                    </h1>
                    @yield('last_import_time')

                    @yield('breadcrumbs')
                </section>

                <!-- Main content -->
                <section class="content">

                    @include('flash::message')

                    @yield('content')

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> {{ config('adminlte.version') }}
                </div>
                <strong>Copyright &copy; {{ date('Y') }}. {!! config('adminlte.credits') !!}</strong>
            </footer>
        </div>
        <!-- ./wrapper -->
        <div id="loading">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        @if(Auth::check())
            <input type="hidden" id="user_permission" value="{{ Auth::user()->is_admin }}">
        @else
            <input type="hidden" id="user_permission" value="0">
        @endif

        <!-- jQuery 3 -->
        <script src="{{ cdn_asset('/js/jquery-3.2.1.min.js') }}"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="{{ cdn_asset('/js/bootstrap.min.js') }}"></script>
        <!-- SlimScroll -->
        <script src="{{ cdn_asset('/adminlte/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ cdn_asset('/adminlte/plugins/fastclick/fastclick.js') }}"></script>

        <script src="{{ cdn_asset('/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ cdn_asset('/js/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ cdn_asset('/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ cdn_asset('/js/buttons.html5.min.js') }}"></script>
        <script src="{{ cdn_asset('/js/jszip.min.js') }}"></script>

        <!-- Plugins -->
        <!-- iCheck for checkboxes and radio inputs -->
        <script src="{{ cdn_asset('/adminlte/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
        <!-- Select2 -->
        <script src="{{ cdn_asset('/adminlte/plugins/select2/js/select2.min.js') }}" type="text/javascript"></script>
        <!-- Moment Js-->
        <script src="{{ cdn_asset('/js/moment.min.js') }}"></script>
        <!-- DatetimePicker Js-->
        <script src="{{ cdn_asset('/js/bootstrap-datetimepicker.min.js') }}"></script>
        <!-- END - Plugins -->

        <!-- AdminLTE App -->
        <script src="{{ cdn_asset('/adminlte/js/adminlte.min.js') }}"></script>
        <!-- Custom Js -->
        <script src="{{ cdn_asset('/js/backend.js?version=' . config('adminlte.version')) }}"></script>

        <script src="{{ cdn_asset('js/FileSaver.min.js') }}"></script>
        <script src="{{ cdn_asset('js/Blob.min.js') }}"></script>
        <script src="{{ cdn_asset('js/xls.core.min.js') }}"></script>
        <script src="{{ cdn_asset('js/tableexport.min.js') }}"></script>
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
        <script src="{{ cdn_asset('/js/frontend.js') }}"></script>

        @yield('footer-extras')

        @stack('footer-scripts')
    </body>
</html>
