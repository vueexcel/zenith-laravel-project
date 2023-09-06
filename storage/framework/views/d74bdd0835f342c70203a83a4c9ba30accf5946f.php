<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        

        <!-- search form -->
        
        <!-- /.search form -->

        <?php echo $__env->make('layouts.partials.backend.sidebar-menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </section>
    <!-- /.sidebar -->
</aside>
