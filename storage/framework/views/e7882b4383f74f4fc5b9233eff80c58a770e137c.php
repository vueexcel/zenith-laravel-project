<!-- Main Header -->
<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="/" class="navbar-brand"><?php echo config('adminlte.logo_lg'); ?></a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                  <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->

            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <?php if(auth()->guard()->guest()): ?>
                        
                        <li>
                            <a>
                                <span><?php echo date('d / m / Y'); ?></span>
                                <span id="current_time" style="margin-left: 10px;"><?php echo date('G:i:s A'); ?></span>
                            </a>
                        </li>
                    <?php else: ?>
                        <?php if(Route::has('impersonate.stop') && Auth::user()->can('stopImpersonate', \App\User::class)): ?>
                        <li>
                            <a href="<?php echo e(route('impersonate.stop'), false); ?>" class="bg-red">
                                <i class="fa fa-user-secret"></i><!-- Stop Impersonating -->
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if(Route::has('dashboard::index')): ?>
                            <li><a href="<?php echo e(route('dashboard::index'), false); ?>"><i class="fa fa-dashboard"></i></a></li>
                        <?php endif; ?>
                        <!-- User Account -->
                        <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo e(Auth::user()->getLogoPath(), false); ?>" class="user-image"
                                         alt="<?php echo e(Auth::user()->name, false); ?>">
                                    <span class="hidden-xs"><?php echo e(Auth::user()->name, false); ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo e(Auth::user()->getLogoPath(), false); ?>" class="img-circle"
                                             alt="<?php echo e(Auth::user()->name, false); ?>">

                                        <p>
                                            <?php echo e(Auth::user()->name, false); ?>

                                            <small>Member since <?php echo e(Carbon::parse(Auth::user()->created_at)->toFormattedDateString(), false); ?></small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo e(route('dashboard::profile'), false); ?>" class="btn btn-default btn-flat">Profile</a>
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
                                    </li>
                                </ul>
                            </li>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>
