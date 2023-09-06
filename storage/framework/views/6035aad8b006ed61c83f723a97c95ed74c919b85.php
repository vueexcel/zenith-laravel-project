<!-- Main Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo e(route('dashboard::index'), false); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><?php echo config('adminlte.logo_mini'); ?></span>
        <!-- logo for regular state and mobile devices -->
        <span style="font-size: 20px;top: -12px;color: white;left: 85px;font-weight: 600;position: absolute;">Zenith</span>
        <span class="logo-lg" style="position: relative;top: 10px;"><?php echo config('adminlte.logo_lg'); ?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <?php if(Route::has('impersonate.stop') && Auth::user()->can('stopImpersonate', \App\User::class)): ?>
                    <li class="dropdown impersonate-menu">
                        <a href="<?php echo e(route('impersonate.stop'), false); ?>" class="bg-red">
                            <i class="fa fa-user-secret"></i> <!-- Stop Impersonating -->
                        </a>
                    </li>
                <?php endif; ?>

                <!-- User Account -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php if(Auth::check()): ?>
                            
                            <span class="hidden-xs"><?php echo e(Auth::user()->name, false); ?></span>
                        <?php else: ?>
                            
                            <span class="hidden-xs guest_user_no"></span>
                        <?php endif; ?>

                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header" style="height: auto;">
                            <?php if(Auth::check()): ?>
                                
                                <p>
                                    <?php echo e(Auth::user()->name, false); ?>

                                    <small>Member since
                                        <?php echo e(Carbon::parse(Auth::user()->created_at)->toFormattedDateString(), false); ?></small>
                                </p>
                            <?php else: ?>
                                
                                <p>
                                    <span class="guest_user_no"></span>
                                    <small>Member since <?php echo e(date('d/m/Y'), false); ?></small>
                                </p>
                            <?php endif; ?>

                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <?php if(Auth::check()): ?>
                                <div class="pull-left">
                                    <a href="<?php echo e(route('dashboard::profile'), false); ?>"
                                        class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo e(route('logout'), false); ?>"
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"
                                        class="btn btn-default btn-flat">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="<?php echo e(route('logout'), false); ?>" method="POST"
                                        style="display: none;">
                                        <?php echo e(csrf_field(), false); ?>

                                    </form>
                                </div>
                            <?php else: ?>
                                <div class="" style="text-align: center">
                                    <a href="<?php echo e(route('login'), false); ?>" class="btn btn-primary btn-flat">Login</a>
                                </div>
                            <?php endif; ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<script type="text/javascript"></script>
