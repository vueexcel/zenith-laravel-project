<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Andon Group Setup</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cogs"></i> System Setup</a></li>
            <li><a href="active">Andon Group Setup</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="alert alert-success" style="display: none;"></div>
                            <?php
                            if(isset($groups) && count($groups) > 0) {
                                echo '<table id="group_table" class="table table-bordered table-hover">';
                                echo '<thead><tr><th style="display: none;">group_id</th><th style="width:150px;">Group NO.</th><th>Group Name</th></tr></thead>';
                                echo '<tbody id="show_group">';
                                foreach ($groups as $group) {
                                    echo '<tr>';
                                    echo '<td style="display: none;">'.$group->id.'</td>';
                                    echo '<td style="width:150px;">'.$group->group_number.'</td>';
                                    echo '<td>'.$group->group_name.'</td>';
                                    echo '</tr>';
                                }
                                echo '</tbody>';
                                echo '</table>';
                            } else {
                                echo '<table class="table table-bordered table-hover">';
                                echo '<thead><tr><th style="width:150px;">Group NO.</th><th>Group Name</th></tr></thead>';
                                echo '<tbody>';
                                echo '<tr><td style="text-align: center;" colspan="2">No Groups</td></tr>';
                                echo '</tbody>';
                                echo '</table>';
                            }


                            echo '<table class="table table-bordered table-hover">';
                            echo '<tbody>';
                            echo '<tr>';
                            echo '<td style="width: 150px;">';
                            echo '<select class="form-control" id="group_number" name="group_number" >';
                            echo '<option value="0" selected disabled>[Group NO]</option>';
                            for($i=1;$i<21;$i++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            echo '</select>';
                            echo '</td>';
                            echo '<td>';
                            echo '<input type="text" class="form-control" id="group_name" name="group_name">';
                            echo '</td>';
                            echo '<td style="width: 150px;"><button class="btn btn-success" id="save_group">Add New</button></td>';
                            echo '</tr>';
                            echo '</tbody>';
                            echo '</table>';
                            ?>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.tabledit.min.js"></script>
<script type="text/javascript">
    $(function () {

        if($("#group_table").length > 0) {
            $('#group_table').Tabledit({
                url: '<?php echo base_url() ?>AndonGroup/updateGroup',
                columns: {
                    identifier: [0, 'id'],
                    editable: [
                        [1, 'group_number',
                        '{"1": "1", "2": "2", "3": "3", "4": "4", "5": "5", "6": "6", "7": "7", "8": "8", "9": "9", "10": "10",' +
                        '"11": "11", "12": "12", "13": "13", "14": "14", "15": "15", "16": "16", "17": "17", "18": "18", "19": "19", "20": "20"}'
                        ],
                        [2, 'group_name']]
                },
                onDraw: function() {
                    console.log('onDraw()');
                },
                onSuccess: function(data, textStatus, jqXHR) {
                    //console.log('onSuccess(data, textStatus, jqXHR)');
                    //console.log(data);
                    if(data.action == "delete") {
                        location.reload();
                    }
                    //console.log(textStatus);
                    //console.log(jqXHR);
                },
                onFail: function(jqXHR, textStatus, errorThrown) {
                    /*console.log('onFail(jqXHR, textStatus, errorThrown)');
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);*/
                },
                onAlways: function() {
                    //console.log('onAlways()');
                },
                onAjax: function(action, serialize) {
                    /*console.log('onAjax(action, serialize)');
                    console.log(action);
                    console.log(serialize);*/
                }
            });
        }

        $("#save_group").on('click', function () {
            var group_name = $("#group_name").val();
            if(group_name == "") {
                $("#group_name").focus();
                return false;
            }

            var group_number = $("#group_number").val();
            if(group_number == "" || group_number == 0 || group_number == null) {
                $("#group_number").focus();
                return false;
            }

            $.ajax({
                type: 'ajax',
                method: 'post',
                url: '<?php echo base_url() ?>AndonGroup/addGroup',
                data: {group_number:group_number, group_name:group_name},
                async: true,
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        location.reload();
                    }else{
                        alert('Error');
                    }
                },
                error: function(){
                    alert('Could not add data');
                }
            });
        });
    });
</script>