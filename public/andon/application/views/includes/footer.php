<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2019-2020 <a href="https://adminlte.io">Inspired</a>.</strong> All rights
    reserved.
</footer>

<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
</div>
<!-- ./wrapper -->
<div id="password_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Password</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" id="password_alert" style="display: none">
                    <strong>Warning!</strong> Password is incorrect.
                </div>
                <input class="form-control" type="password" name="unlock_password" id="unlock_password" placeholder="Enter Password">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="check_password">Confirm</button>
                <button type="button" class="btn btn-default" id="cancel_password">Cancel</button>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($admin_password)){
    echo '<input type="hidden" id="setting_password" name="setting_password" value="'.$admin_password.'">';
} else{
    echo '<input type="hidden" id="setting_password" name="setting_password" value="">';
}

?>
</body>
</html>