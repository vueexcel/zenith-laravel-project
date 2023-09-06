<!-- Main Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('dashboard::index') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">{!! config('adminlte.logo_mini') !!}</span>
        <!-- logo for regular state and mobile devices -->
        <span style="font-size: 20px;top: -12px;color: white;left: 85px;font-weight: 600;position: absolute;">Zenith</span>
        <span class="logo-lg" style="position: relative;top: 10px;">{!! config('adminlte.logo_lg') !!}</span>
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

                @if (Route::has('impersonate.stop') && Auth::user()->can('stopImpersonate', \App\User::class))
                    <li class="dropdown impersonate-menu">
                        <a href="{{ route('impersonate.stop') }}" class="bg-red">
                            <i class="fa fa-user-secret"></i> <!-- Stop Impersonating -->
                        </a>
                    </li>
                @endif

                <!-- User Account -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if (Auth::check())
                            {{-- <img src="{{ Auth::user()->getLogoPath() }}" class="user-image"
                                 alt="{{ Auth::user()->name }}"> --}}
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        @else
                            {{-- <img src="{{ cdn_asset('/adminlte/img/avatar_2.png') }}" class="user-image"> --}}
                            <span class="hidden-xs guest_user_no"></span>
                        @endif

                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header" style="height: auto;">
                            @if (Auth::check())
                                {{-- <img src="{{ Auth::user()->getLogoPath() }}" class="img-circle"
                                     alt="{{ Auth::user()->name }}"> --}}
                                <p>
                                    {{ Auth::user()->name }}
                                    <small>Member since
                                        {{ Carbon::parse(Auth::user()->created_at)->toFormattedDateString() }}</small>
                                </p>
                            @else
                                {{-- <img src="{{ cdn_asset('/adminlte/img/avatar_2.png') }}" class="img-circle" alt=""> --}}
                                <p>
                                    <span class="guest_user_no"></span>
                                    <small>Member since {{ date('d/m/Y') }}</small>
                                </p>
                            @endif

                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            @if (Auth::check())
                                <div class="pull-left">
                                    <a href="{{ route('dashboard::profile') }}"
                                        class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"
                                        class="btn btn-default btn-flat">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            @else
                                <div class="" style="text-align: center">
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-flat">Login</a>
                                </div>
                            @endif
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<script type="text/javascript"></script>
