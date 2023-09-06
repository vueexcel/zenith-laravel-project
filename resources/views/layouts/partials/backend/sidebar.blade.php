<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        {{--<div class="user-panel">
            <div class="pull-left image">
                <a href="{{ route('dashboard::profile') }}">
                    @if (Auth::check())
                        <img src="{{ Auth::user()->getLogoPath() }}" class="img-circle" alt="{{ Auth::user()->name }}">
                    @else
                        <img src="{{ cdn_asset('/adminlte/img/avatar_2.png') }}" class="img-circle" alt="">
                    @endif

                </a>
            </div>
            <div class="pull-left info">
                @if (Auth::check())
                    <p><a href="{{ route('dashboard::profile') }}">{{ Auth::user()->name }}</a></p>
                    <a href="{{ route('dashboard::profile') }}"><i class="fa fa-circle text-success"></i> Online</a>
                @else
                    <p>GUEST</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                @endif

            </div>
        </div>--}}

        <!-- search form -->
        {{--<form action="#" method="get" class="sidebar-form" id="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..." id="search-input">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>--}}
        <!-- /.search form -->

        @include('layouts.partials.backend.sidebar-menu')

    </section>
    <!-- /.sidebar -->
</aside>
