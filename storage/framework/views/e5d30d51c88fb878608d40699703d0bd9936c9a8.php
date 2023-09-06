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
                    <li><a href="/">Link</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <?php if(auth()->guard()->guest()): ?>
                        <?php if(Route::has('login')): ?>
                            <li><a href="<?php echo e(route('login'), false); ?>">Login</a></li>
                        <?php endif; ?>
                        <?php if(Route::has('register')): ?>
                            <li><a href="<?php echo e(route('register'), false); ?>">Register</a></li>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if(Route::has('dashboard::index')): ?>
                            <li><a href="<?php echo e(route('dashboard::index'), false); ?>">Dashboard</a></li>
                        <?php endif; ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <?php echo e(Auth::user()->name, false); ?> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="<?php echo e(route('logout'), false); ?>"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout'), false); ?>" method="POST" style="display: none;">
                                        <?php echo e(csrf_field(), false); ?>

                                    </form>
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
