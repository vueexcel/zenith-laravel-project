<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="<?php echo e(\App\Utils::checkRoute(['dashboard::index', 'admin::index']) ? 'active': '', false); ?>">
        <a href="<?php echo e(route('dashboard::index'), false); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    <?php if(!Auth::check()): ?>
        <li class="">
            <a href="<?php echo e(route('login'), false); ?>">
                <i class="fa fa-user"></i> <span>Login</span>
            </a>
        </li>
    <?php endif; ?>
    <?php if(Auth::check()): ?>
        
        <?php if(Auth::user()->is_admin > 1): ?>
        

        <li class="">
            <a href="<?php echo e(route('exceptions'), false); ?>">
                <i class="fa fa-bars"></i> <span>Exceptions</span>
            </a>
        </li>
        <li class="<?php echo e(\App\Utils::checkRoute(['health_concerns.index', 'health_concerns.edit', 'health_concerns.create']) ? 'active': '', false); ?>">
            <a href="<?php echo e(route('health_concerns.index'), false); ?>">
                <i class="fa fa-bars"></i> <span>Health Concerns</span>
            </a>
        </li>
        <li class="<?php echo e(\App\Utils::checkRoute(['fire_incidents.index', 'fire_incidents.edit', 'fire_incidents.create']) ? 'active': '', false); ?>">
            <a href="<?php echo e(route('fire_incidents.index'), false); ?>">
                <i class="fa fa-bars"></i> <span>Fire Incidents</span>
            </a>
        </li>
        <li class="<?php echo e(\App\Utils::checkRoute(['accidents.index', 'accidents.edit', 'accidents.create']) ? 'active': '', false); ?>">
            <a href="<?php echo e(route('accidents.index'), false); ?>">
                <i class="fa fa-bars"></i> <span>Accidents</span>
            </a>
        </li>
            <li class="">
                <a href="<?php echo e(route('mss'), false); ?>">
                    <i class="fa fa-bars"></i> <span>MSS</span>
                </a>
            </li>
        <li class="<?php echo e(\App\Utils::checkRoute(['contractor_accidents.index', 'contractor_accidents.edit', 'contractor_accidents.create']) ? 'active': '', false); ?>">
            <a href="<?php echo e(route('contractor_accidents.index'), false); ?>">
                <i class="fa fa-bars"></i> <span>Contractor Accidents</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if(Auth::user()->is_hr > 0 || Auth::user()->is_admin > 1): ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-bars"></i> <span>Reporting</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <?php if(Auth::user()->is_admin > 1): ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-circle-o"></i> <span>Company Statistics</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="">
                            <a href="<?php echo e(route('report::company_statistics', ['report_type' => 'lt_incidents']), false); ?>"><i class="fa fa-circle-o"></i> <span>LT Incidents</span></a>
                        </li>
                        <li class="">
                            <a href="<?php echo e(route('report::company_statistics', ['report_type' => 'all_accidents']), false); ?>"><i class="fa fa-circle-o"></i> <span>All Accidents</span></a>
                        </li>
                        <li class="">
                            <a href="<?php echo e(route('report::company_statistics', ['report_type' => 'tme_accidents']), false); ?>"><i class="fa fa-circle-o"></i> <span>TME Accidents</span></a>
                        </li>
                        <li class="">
                            <a href="<?php echo e(route('report::company_statistics', ['report_type' => 'aid_accidents']), false); ?>"><i class="fa fa-circle-o"></i> <span>1st Aid Accidents</span></a>
                        </li>
                        <li class="">
                            <a href="<?php echo e(route('report::company_statistics', ['report_type' => 'work_mss']), false); ?>"><i class="fa fa-circle-o"></i> <span>Work MSS</span></a>
                        </li>
                        <li class="">
                            <a href="<?php echo e(route('report::company_statistics', ['report_type' => 'g_mir']), false); ?>"><i class="fa fa-circle-o"></i> <span>G MIR</span></a>
                        </li>
                        <li class="">
                            <a href="<?php echo e(route('report::company_statistics', ['report_type' => 'fires']), false); ?>"><i class="fa fa-circle-o"></i> <span>Fires</span></a>
                        </li>
                        <li class="">
                            <a href="<?php echo e(route('report::company_statistics', ['report_type' => 'riddor']), false); ?>"><i class="fa fa-circle-o"></i> <span>RIDDOR</span></a>
                        </li>
                        <li class="">
                            <a href="<?php echo e(route('report::company_statistics', ['report_type' => 'work_other']), false); ?>"><i class="fa fa-circle-o"></i> <span>Work Other</span></a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="<?php echo e(route('report::lost_time_incidents'), false); ?>">
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
                            <a href="<?php echo e(route('report::all_accidents', ['report_type' => 'all']), false); ?>"><i class="fa fa-circle-o"></i> <span>All Accidents</span></a>
                        </li>
                        <li class="">
                            <a href="<?php echo e(route('report::all_accidents', ['report_type' => 'first_aid']), false); ?>"><i class="fa fa-circle-o"></i> <span>1st Aid Accidents</span></a>
                        </li>
                        <li class="">
                            <a href="<?php echo e(route('report::all_accidents', ['report_type' => 'gir']), false); ?>"><i class="fa fa-circle-o"></i> <span>GIR Accidents</span></a>
                        </li>
                        <li class="">
                            <a href="<?php echo e(route('report::all_accidents', ['report_type' => 'stop_6']), false); ?>"><i class="fa fa-circle-o"></i> <span>Stop-6 Accidents</span></a>
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
                            <a href="<?php echo e(route('report::mss_incidents', ['report_type' => 'work_mss']), false); ?>"><i class="fa fa-circle-o"></i> <span>Work MSS</span></a>
                        </li>
                        <li class="">
                            <a href="<?php echo e(route('report::mss_incidents', ['report_type' => 'g_mir']), false); ?>"><i class="fa fa-circle-o"></i> <span>G MIR</span></a>
                        </li>
                        <li class="">
                            <a href="<?php echo e(route('report::mss_incidents', ['report_type' => 'g_mir_part']), false); ?>"><i class="fa fa-circle-o"></i> <span>G MIR (Part)</span></a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="<?php echo e(route('report::illness_incidents'), false); ?>">
                        <i class="fa fa-circle-o"></i> <span>Illness Incidents</span>
                    </a>
                </li>
                <li class="">
                    <a href="<?php echo e(route('report::near_misses'), false); ?>">
                        <i class="fa fa-circle-o"></i> <span>Near Misses</span>
                    </a>
                </li>
                <li class="">
                    <a href="<?php echo e(route('report::riddor_incidents'), false); ?>">
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
                            <a href="<?php echo e(route('report::restriction_cost', ['report_type' => 'days']), false); ?>"><i class="fa fa-circle-o"></i> <span>Days</span></a>
                        </li>
                        <li class="">
                            <a href="<?php echo e(route('report::restriction_cost', ['report_type' => 'cost']), false); ?>"><i class="fa fa-circle-o"></i> <span>Cost</span></a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="<?php echo e(route('report::work_other_incidents'), false); ?>">
                        <i class="fa fa-circle-o"></i> <span>Work Other Incidents</span>
                    </a>
                </li>
                <li class="">
                    <a href="<?php echo e(route('report::contractor_accidents'), false); ?>">
                        <i class="fa fa-circle-o"></i> <span>Contractor Accidents</span>
                    </a>
                </li>
                <li class="">
                    <a href="<?php echo e(route('report::daily_restriction_status'), false); ?>">
                        <i class="fa fa-circle-o"></i> <span>Daily Restriction Status</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-circle-o"></i> <span>Master KPI</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="">
                            <a href="<?php echo e(route('report::master_kpi', ['report_type' => 'tmuk_b']), false); ?>"><i class="fa fa-circle-o"></i> <span>Master KPI TMUK-B</span></a>
                        </li>
                        <li class="">
                            <a href="<?php echo e(route('report::master_kpi', ['report_type' => 'tmuk_d']), false); ?>"><i class="fa fa-circle-o"></i> <span>Master KPI TMUK-D</span></a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <li class="">
                    <a href="<?php echo e(route('report::health_concerns_by_member'), false); ?>">
                        <i class="fa fa-circle-o"></i> <span>Health Concerns By Member</span>
                    </a>
                </li>

                <?php if(Auth::user()->is_admin > 1): ?>
                    <li class="">
                        <a href="<?php echo e(route('report::all_health_concerns_db'), false); ?>">
                            <i class="fa fa-circle-o"></i> <span>All Health Concerns</span>
                        </a>
                    </li>
                        <li class="">
                            <a href="<?php echo e(route('report::all_accidents_db'), false); ?>">
                                <i class="fa fa-circle-o"></i> <span>All Accidents</span>
                            </a>
                        </li>
                <?php endif; ?>

                <li class="">
                    <a href="<?php echo e(route('report::forms'), false); ?>">
                        <i class="fa fa-circle-o"></i> <span>Forms</span>
                    </a>
                </li>

            </ul>
        </li>
        <?php endif; ?>
        <?php if(Auth::user()->is_admin > 1): ?>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-cogs"></i> <span>Administration</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
            <?php if(Auth::check() && Auth::user()->can('viewList', \App\User::class)): ?>
                <li class="<?php echo e(\App\Utils::checkRoute(['admin::users.index', 'admin::users.create', 'admin::users.edit']) ? 'active': '', false); ?>">
                    <a href="<?php echo e(route('admin::users.index'), false); ?>">
                        <i class="fa fa-bars"></i> <span>Users</span>
                    </a>
                </li>
            <?php endif; ?>
                <li class="<?php echo e(\App\Utils::checkRoute(['members.show', 'members.edit', 'members.index', 'members.create']) ? 'active': '', false); ?>">
                    <a href="<?php echo e(route('members.index'), false); ?>">
                        <i class="fa fa-bars"></i> <span>Member List</span>
                    </a>
                </li>
                <li class="<?php echo e(\App\Utils::checkRoute(['admin::dashboard']) ? 'active': '', false); ?>">
                    <a href="<?php echo e(route('admin::dashboard'), false); ?>">
                        <i class="fa fa-bars"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="<?php echo e(\App\Utils::checkRoute(['admin::health_concerns']) ? 'active': '', false); ?>">
                    <a href="<?php echo e(route('admin::health_concerns'), false); ?>">
                        <i class="fa fa-bars"></i> <span>Health Concerns</span>
                    </a>
                </li>
                <li class="<?php echo e(\App\Utils::checkRoute(['admin::accident']) ? 'active': '', false); ?>">
                    <a href="<?php echo e(route('admin::accident'), false); ?>">
                        <i class="fa fa-bars"></i> <span>Accidents</span>
                    </a>
                </li>
                
                <li class="<?php echo e(\App\Utils::checkRoute(['admin::workplace_invest']) ? 'active': '', false); ?>">
                    <a href="<?php echo e(route('admin::workplace_invest'), false); ?>">
                        <i class="fa fa-bars"></i> <span>Incident Investigations</span>
                    </a>
                </li>
                <li class="<?php echo e(\App\Utils::checkRoute(['admin::reduce_flex']) ? 'active': '', false); ?>">
                    <a href="<?php echo e(route('admin::reduce_flex'), false); ?>">
                        <i class="fa fa-bars"></i> <span>Reduced Flexibility</span>
                    </a>
                </li>
                <li class="<?php echo e(\App\Utils::checkRoute(['admin::con_accidents']) ? 'active': '', false); ?>">
                    <a href="<?php echo e(route('admin::con_accidents'), false); ?>">
                        <i class="fa fa-bars"></i> <span>Contractor Accidents</span>
                    </a>
                </li>
                <li class="<?php echo e(\App\Utils::checkRoute(['import_admin']) ? 'active': '', false); ?>">
                    <a href="<?php echo e(route('import_admin'), false); ?>">
                        <i class="fa fa-bars"></i> <span>Import Members</span>
                    </a>
                </li>
                <li class="<?php echo e(\App\Utils::checkRoute(['import_xml']) ? 'active': '', false); ?>">
                    <a href="<?php echo e(route('import_xml'), false); ?>">
                        <i class="fa fa-bars"></i> <span>Import XML</span>
                    </a>
                </li>
                <li class="<?php echo e(\App\Utils::checkRoute(['export_options']) ? 'active': '', false); ?>">
                    <a href="<?php echo e(route('export_options'), false); ?>">
                        <i class="fa fa-bars"></i> <span>Export Options</span>
                    </a>
                </li>

                <li class="<?php echo e(\App\Utils::checkRoute(['admin::forms']) ? 'active': '', false); ?>">
                    <a href="<?php echo e(route('admin::forms'), false); ?>">
                        <i class="fa fa-bars"></i> <span>Forms</span>
                    </a>
                </li>
            </ul>
        </li>
        <?php endif; ?>
    <?php endif; ?>
</ul>
