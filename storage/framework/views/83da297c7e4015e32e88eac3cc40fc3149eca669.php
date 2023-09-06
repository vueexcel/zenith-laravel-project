<?php $__env->startSection('page-title', ''); ?>


<?php $__env->startSection('page-subtitle', ''); ?>




<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('guest_login'), false); ?>">
                        <?php echo e(csrf_field(), false); ?>


                        <div class="form-group<?php echo e($errors->has('guest_user_no') ? ' has-error' : '', false); ?>">
                            <label for="email" class="col-md-4 control-label">Logged in MBR</label>

                            <div class="col-md-6">
                                <input id="guest_user_no" type="text" class="form-control" name="guest_user_no" value="<?php echo e(old('guest_user_no'), false); ?>" required autofocus readonly>

                                <?php if($errors->has('guest_user_no')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('guest_user_no'), false); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Administrator Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('login'), false); ?>">
                        <?php echo e(csrf_field(), false); ?>


                        <div class="form-group<?php echo e($errors->has('member_no') ? ' has-error' : '', false); ?>">
                            <label for="member_no" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="member_no" type="text" class="form-control" name="member_no" value="<?php echo e(old('member_no'), false); ?>" required autofocus>

                                <?php if($errors->has('member_no')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('member_no'), false); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : '', false); ?>">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password'), false); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : '', false); ?>> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>