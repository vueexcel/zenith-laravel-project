<!-- Save Confirm - Helper. Show a modal box -->
<div id="modalHistoryModel" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="modalHistoryModelLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalHistoryModelLabel"><i class="fa fa-history"> History</i>
                </h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btnModalHistoryModel">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Save Confirm - Helper. Show a modal box -->
<div id="modalConfirmModelSave" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="modalConfirmModelSaveLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalConfirmModelSaveLabel">Are you sure <i class="fa fa-question"></i>
                </h4>
            </div>
            <div class="modal-body">
                <p> Do you really want to save<i class="fa fa-question"></i></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnModalConfirmModelSave">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btnModalCancelModelSave">No</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Cancel Confirm - Helper. Show a modal box -->
<div id="modalConfirmModelCancel" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="modalConfirmModelCancelLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red color-palette">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalConfirmModelCancelLabel">Are you sure <i class="fa fa-question"></i>
                </h4>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to cancel<i class="fa fa-question"></i></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnModalConfirmModelCancel" data-form-link="">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" id="btnModalCancelModelCancel">No</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Page scripts -->

{{-- Initiate Confirm Delete --}}
<script type="text/javascript">
    $(function () {

        $(document).on('click', '.btnOpenModalHistory', function (e) {
            e.preventDefault();
            var record_id = $(this).data('record');
            var record_table = $(this).data('record-table');
            if(record_id == "") {
                alert("You are adding new.");
                return false;
            } else {
                $.ajax({
                    url: "/histories",
                    method: "GET",
                    data: {record_id:record_id, record_table:record_table},
                    dataType:"HTML",
                    statusCode: {
                        401: function () {
                            console.log('Login expired. Please sign in again.')
                        }
                    },
                    success: function (html) {
                        $('#modalHistoryModel').find(".modal-body").html(html);
                        $('#modalHistoryModel').modal('show');
                    }
                });

            }


        });


        $(document).on('click', '.btnOpenerModalConfirmModelSave', function (e) {
            e.preventDefault();
            $('#modalConfirmModelSave').modal('show');
        });

        // Modal Button Confirm Cancel
        $(document).on('click', '#btnModalConfirmModelSave', function (e) {
            e.preventDefault();
            $(".form").submit();
            $('#modalConfirmModelSave').modal('hide');
        });

        // Modal Button Cancel Cancel
        $(document).on('click', '#modalConfirmModelCancel #btnModalCancelModelSave', function (e) {
            e.preventDefault();
            $('#modalConfirmModelDelete').modal('hide');
        });


        $(document).on('click', '.btnOpenerModalConfirmModelCancel', function (e) {
            e.preventDefault();
            var href = $(this).attr('data-form-link');
            var btnConfirm = $('#modalConfirmModelCancel').find('#btnModalConfirmModelCancel');
            if (btnConfirm.length) {
                btnConfirm.attr('data-form-link', href);
            }
            $('#modalConfirmModelCancel').modal('show');
        });

        // Modal Button Confirm Cancel
        $(document).on('click', '#btnModalConfirmModelCancel', function (e) {
            e.preventDefault();
            var href = $(this).attr('data-form-link');
            $('#modalConfirmModelDelete').modal('hide');
            location.href = href;
        });

        // Modal Button Cancel Cancel
        $(document).on('click', '#modalConfirmModelCancel #btnModalCancelModelCancel', function (e) {
            e.preventDefault();
            var btnConfirm = $('#modalConfirmModelCancel').find('#btnModalConfirmModelCancel');
            if (btnConfirm.length) {
                btnConfirm.attr('data-form-link', "");
            }
            $('#modalConfirmModelDelete').modal('hide');
        });
    });
</script>
<!-- End Delete Confirm - Helper. Show a modal box -->
