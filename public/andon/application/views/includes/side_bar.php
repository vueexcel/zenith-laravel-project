<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php if ($pageName == 'Home') {echo 'active';} ?>"><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> <span>HOME</span></a></li>
            <li class="<?php if ($pageName == 'Analysis') {echo 'active';} ?>"><a href="<?php echo base_url(); ?>Analysis"><i class="fa fa-bar-chart"></i> <span>ANDON ANALYSIS</span></a></li>
            <li class="treeview <?php if ($pageName == 'Andon' || $pageName == 'Group' || $pageName == "Shift_Setting") {echo 'active';} ?>">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>SYSTEM SETUP</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($pageName == 'Andon') {echo 'active';} ?>">
                        <a href="<?php echo base_url(); ?>Andon"><i class="fa fa-circle-o"></i> ANDON CONFIGURATION</a>
                    </li>
                    <li class="<?php if ($pageName == 'Group') {echo 'active';} ?>">
                        <a href="<?php echo base_url(); ?>AndonGroup"><i class="fa fa-circle-o"></i> ANDON GROUP SETUP</a>
                    </li>
                    <li class="<?php if ($pageName == 'Shift_Setting') {echo 'active';} ?>">
                        <a href="<?php echo base_url(); ?>Shift"><i class="fa fa-circle-o"></i> SHIFT SETTING</a>
                    </li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
