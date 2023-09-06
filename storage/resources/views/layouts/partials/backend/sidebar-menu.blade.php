<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="{{ \App\Utils::checkRoute(['dashboard::index', 'admin::index']) ? 'active': '' }}">
        <a href="{{ route('dashboard::index') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="{{ \App\Utils::checkRoute(['members.show', 'members.edit', 'members.index', 'members.create']) ? 'active': '' }}">
        <a href="{{ route('members.index') }}">
            <i class="fa fa-users"></i> <span>Member List</span>
        </a>
    </li>
    <li class="">
        <a href="{{ route('exceptions') }}">
            <i class="fa fa-bars"></i> <span>Exceptions</span>
        </a>
    </li>
    <li class="{{ \App\Utils::checkRoute(['health_concerns.index', 'health_concerns.edit', 'health_concerns.create']) ? 'active': '' }}">
        <a href="{{ route('health_concerns.index') }}">
            <i class="fa fa-bars"></i> <span>Health Concerns</span>
        </a>
    </li>
    <li class="{{ \App\Utils::checkRoute(['accidents.index', 'accidents.edit', 'accidents.create']) ? 'active': '' }}">
        <a href="{{ route('accidents.index') }}">
            <i class="fa fa-bars"></i> <span>Accidents</span>
        </a>
    </li>
    {{--<li class="{{ \App\Utils::checkRoute(['quick_near_misses.index', 'quick_near_misses.edit', 'quick_near_misses.create']) ? 'active': '' }}">
        <a href="{{ route('quick_near_misses.index') }}">
            <i class="fa fa-bars"></i> <span>Quick Near Miss</span>
        </a>
    </li>--}}
    <li class="{{ \App\Utils::checkRoute(['workplace_investigations.index', 'workplace_investigations.edit', 'workplace_investigations.create']) ? 'active': '' }}">
        <a href="{{ route('workplace_investigations.index') }}">
            <i class="fa fa-bars"></i> <span>Incident Investigations</span>
        </a>
    </li>
    <li class="{{ \App\Utils::checkRoute(['reduced_flexibilities.index', 'reduced_flexibilities.edit', 'reduced_flexibilities.create']) ? 'active': '' }}">
        <a href="{{ route('reduced_flexibilities.index') }}">
            <i class="fa fa-bars"></i> <span>Reduced Flexibility</span>
        </a>
    </li>
    <li class="{{ \App\Utils::checkRoute(['contractor_accidents.index', 'contractor_accidents.edit', 'contractor_accidents.create']) ? 'active': '' }}">
        <a href="{{ route('contractor_accidents.index') }}">
            <i class="fa fa-bars"></i> <span>Contractor Accidents</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-bars"></i> <span>Reporting</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-o"></i> <span>Company Statistics</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="{{ route('report::company_statistics', ['report_type' => 'lt_incidents']) }}"><i class="fa fa-circle-o"></i> <span>LT Incidents</span></a>
                    </li>
                    <li class="">
                        <a href="{{ route('report::company_statistics', ['report_type' => 'all_accidents']) }}"><i class="fa fa-circle-o"></i> <span>All Accidents</span></a>
                    </li>
                    <li class="">
                        <a href="{{ route('report::company_statistics', ['report_type' => 'tme_accidents']) }}"><i class="fa fa-circle-o"></i> <span>TME Accidents</span></a>
                    </li>
                    <li class="">
                        <a href="{{ route('report::company_statistics', ['report_type' => 'aid_accidents']) }}"><i class="fa fa-circle-o"></i> <span>1st Aid Accidents</span></a>
                    </li>
                    <li class="">
                        <a href="{{ route('report::company_statistics', ['report_type' => 'work_mss']) }}"><i class="fa fa-circle-o"></i> <span>Work MSS</span></a>
                    </li>
                    <li class="">
                        <a href="{{ route('report::company_statistics', ['report_type' => 'g_mir']) }}"><i class="fa fa-circle-o"></i> <span>G MIR</span></a>
                    </li>
                    <li class="">
                        <a href="{{ route('report::company_statistics', ['report_type' => 'fires']) }}"><i class="fa fa-circle-o"></i> <span>Fires</span></a>
                    </li>
                    <li class="">
                        <a href="{{ route('report::company_statistics', ['report_type' => 'riddor']) }}"><i class="fa fa-circle-o"></i> <span>RIDDOR</span></a>
                    </li>
                    <li class="">
                        <a href="{{ route('report::company_statistics', ['report_type' => 'work_other']) }}"><i class="fa fa-circle-o"></i> <span>Work Other</span></a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="{{ route('report::lost_time_incidents') }}">
                    <i class="fa fa-circle-o"></i> <span>Lost Time Incidents</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-o"></i> <span>All Accidents</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="{{ route('report::all_accidents', ['report_type' => 'all']) }}"><i class="fa fa-circle-o"></i> <span>All Accidents</span></a>
                    </li>
                    <li class="">
                        <a href="{{ route('report::all_accidents', ['report_type' => 'first_aid']) }}"><i class="fa fa-circle-o"></i> <span>1st Aid Accidents</span></a>
                    </li>
                    <li class="">
                        <a href="{{ route('report::all_accidents', ['report_type' => 'gir']) }}"><i class="fa fa-circle-o"></i> <span>GIR Accidents</span></a>
                    </li>
                    <li class="">
                        <a href="{{ route('report::all_accidents', ['report_type' => 'stop_6']) }}"><i class="fa fa-circle-o"></i> <span>Stop-6 Accidents</span></a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-o"></i> <span>MSS Incidents</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="{{ route('report::mss_incidents', ['report_type' => 'work_mss']) }}"><i class="fa fa-circle-o"></i> <span>Work MSS</span></a>
                    </li>
                    <li class="">
                        <a href="{{ route('report::mss_incidents', ['report_type' => 'g_mir']) }}"><i class="fa fa-circle-o"></i> <span>G MIR</span></a>
                    </li>
                    <li class="">
                        <a href="{{ route('report::mss_incidents', ['report_type' => 'g_mir_part']) }}"><i class="fa fa-circle-o"></i> <span>G MIR (Part)</span></a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="{{ route('report::illness_incidents') }}">
                    <i class="fa fa-circle-o"></i> <span>Illness Incidents</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('report::near_misses') }}">
                    <i class="fa fa-circle-o"></i> <span>Near Misses</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('report::riddor_incidents') }}">
                    <i class="fa fa-circle-o"></i> <span>RIDDOR Incidents</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-o"></i> <span>Restriction Cost</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="{{ route('report::restriction_cost', ['report_type' => 'days']) }}"><i class="fa fa-circle-o"></i> <span>Days</span></a>
                    </li>
                    <li class="">
                        <a href="{{ route('report::restriction_cost', ['report_type' => 'cost']) }}"><i class="fa fa-circle-o"></i> <span>Cost</span></a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="{{ route('report::work_other_incidents') }}">
                    <i class="fa fa-circle-o"></i> <span>Work Other Incidents</span>
                </a>
            </li>
        </ul>
    </li>

    @if(Auth::user()->is_admin)
        <li class="treeview">
            <a href="#">
                <i class="fa fa-cogs"></i> <span>Administration</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
            @if (Auth::user()->can('viewList', \App\User::class))
                <li class="{{ \App\Utils::checkRoute(['admin::users.index', 'admin::users.create', 'admin::users.edit']) ? 'active': '' }}">
                    <a href="{{ route('admin::users.index') }}">
                        <i class="fa fa-bars"></i> <span>Users</span>
                    </a>
                </li>
            @endif
                <li class="{{ \App\Utils::checkRoute(['members.show', 'members.edit', 'members.index', 'members.create']) ? 'active': '' }}">
                    <a href="{{ route('members.index') }}">
                        <i class="fa fa-bars"></i> <span>Member List</span>
                    </a>
                </li>
                <li class="{{ \App\Utils::checkRoute(['admin::dashboard']) ? 'active': '' }}">
                    <a href="{{ route('admin::dashboard') }}">
                        <i class="fa fa-bars"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ \App\Utils::checkRoute(['admin::health_concerns']) ? 'active': '' }}">
                    <a href="{{ route('admin::health_concerns') }}">
                        <i class="fa fa-bars"></i> <span>Health Concerns</span>
                    </a>
                </li>
                <li class="{{ \App\Utils::checkRoute(['admin::accident']) ? 'active': '' }}">
                    <a href="{{ route('admin::accident') }}">
                        <i class="fa fa-bars"></i> <span>Accidents</span>
                    </a>
                </li>
                {{--<li class="{{ \App\Utils::checkRoute(['admin::q_near_miss']) ? 'active': '' }}">
                    <a href="{{ route('admin::q_near_miss') }}">
                        <i class="fa fa-bars"></i> <span>Quick Near Miss</span>
                    </a>
                </li>--}}
                <li class="{{ \App\Utils::checkRoute(['admin::workplace_invest']) ? 'active': '' }}">
                    <a href="{{ route('admin::workplace_invest') }}">
                        <i class="fa fa-bars"></i> <span>Incident Investigations</span>
                    </a>
                </li>
                <li class="{{ \App\Utils::checkRoute(['admin::reduce_flex']) ? 'active': '' }}">
                    <a href="{{ route('admin::reduce_flex') }}">
                        <i class="fa fa-bars"></i> <span>Reduced Flexibility</span>
                    </a>
                </li>
                <li class="{{ \App\Utils::checkRoute(['admin::con_accidents']) ? 'active': '' }}">
                    <a href="{{ route('admin::con_accidents') }}">
                        <i class="fa fa-bars"></i> <span>Contractor Accidents</span>
                    </a>
                </li>
                <li class="{{ \App\Utils::checkRoute(['import_admin']) ? 'active': '' }}">
                    <a href="{{ route('import_admin') }}">
                        <i class="fa fa-bars"></i> <span>Import Members</span>
                    </a>
                </li>
                <li class="{{ \App\Utils::checkRoute(['import_xml']) ? 'active': '' }}">
                    <a href="{{ route('import_xml') }}">
                        <i class="fa fa-bars"></i> <span>Import XML</span>
                    </a>
                </li>
            </ul>
        </li>
    @endif
</ul>
