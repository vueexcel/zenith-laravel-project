<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Andon Configuration</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cogs"></i> System Setup</a></li>
            <li><a href="active">Andon Configuration</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">ANDON</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="alert alert-success" style="display: none;"></div>

                        <?php
                        if(isset($andons) && count($andons) > 0) {
                            echo '<table id="andon_table" class="table table-bordered table-hover">';
                            echo '<thead>';
                            echo '<tr>
                                    <th style="display: none;">andon_id</th>
                                    <th style="width: 5%;">Andon NO.</th>
                                    <th style="width: 10%;">Name</th>
                                    <th style="width: 10%;">State</th>
                                    <th style="width: 10%;">Group</th>
                                    <th style="width: 10%;">ANDON TYPE (BIT)</th>
                                    <th style="width: 10%;">YELLOW ANDON (BIT)</th>
                                    <th style="width: 10%;">RED ANDON TIMER</th>
                                    <th style="width: 10%;">ANDON TIMER PRESET</th>
                                    <th style="width: 10%;">RED ANDON (BIT)</th>
                                    <th style="width: 10%;">LINE RUNNING BIT</th>
                                </tr>';
                            echo '</thead>';
                            echo '<tbody id="show_group">';
                            foreach ($andons as $andon) {
                                echo '<tr>';
                                echo '<td style="display: none;">'.$andon->id.'</td>';
                                echo '<td style="width:5%;">'.$andon->andon_no.'</td>';
                                echo '<td style="width: 10%;">'.$andon->andon_name.'</td>';

                                echo '<td>';
                                echo '<select class="form-control andon-dropdown" data-kind="status" id="status_'.$andon->id.'" style="width: 100%;">';
                                if($andon->status == 1) {
                                    echo '<option value="1" selected>Enabled</option>';
                                    echo '<option value="0">Disabled</option>';
                                } else {
                                    echo '<option value="1">Enabled</option>';
                                    echo '<option value="0" selected>Disabled</option>';
                                }

                                echo '</select>';
                                echo '</td>';

                                //Group
                                echo '<td style="width: 10%;">';
                                echo '<select class="form-control andon-dropdown" data-kind="group_id" id="group_id_'.$andon->id.'" style="width: 100%;">';
                                foreach ($groups as $group){
                                    if($group->id == $andon->group_id )
                                        echo '<option value="'.$group->id.'" selected>'.$group->group_name.'</option>';
                                    else
                                        echo '<option value="'.$group->id.'">'.$group->group_name.'</option>';
                                }
                                echo '</select>';
                                echo '</td>';

                                //ANDON TYPE
                                echo '<td style="width: 10%;">';
                                echo '<select class="form-control select2 andon-dropdown" data-kind="andon_type" id="andon_type_'.$andon->id.'" style="width: 100%;">';
                                echo '<option value="" selected disabled>[Select Tag]</option>';
                                foreach ($tags as $tag){
                                    if($andon->andon_type == $tag->tag_name )
                                        echo '<option value="'.$tag->tag_name.'" selected>'.$tag->tag_name.'</option>';
                                    else
                                        echo '<option value="'.$tag->tag_name.'">'.$tag->tag_name.'</option>';
                                }
                                echo '</select>';
                                echo '</td>';

                                //Yellow Andon
                                echo '<td style="width: 10%;">';
                                echo '<select class="form-control select2 andon-dropdown" data-kind="yellow_andon" id="yellow_andon_'.$andon->id.'" style="width: 100%;">';
                                echo '<option value="" selected disabled>[Select Tag]</option>';
                                foreach ($tags as $tag){
                                    if($andon->yellow_andon == $tag->tag_name )
                                        echo '<option value="'.$tag->tag_name.'" selected>'.$tag->tag_name.'</option>';
                                    else
                                        echo '<option value="'.$tag->tag_name.'">'.$tag->tag_name.'</option>';
                                }
                                echo '</select>';
                                echo '</td>';

                                //Red Andon Timer
                                echo '<td style="width: 10%;">';
                                echo '<select class="form-control select2 andon-dropdown" data-kind="red_andon_timer" id="red_andon_timer_'.$andon->id.'" style="width: 100%;">';
                                echo '<option value="" selected disabled>[Select Tag]</option>';
                                foreach ($tags as $tag){
                                    if($andon->red_andon_timer == $tag->tag_name )
                                        echo '<option value="'.$tag->tag_name.'" selected>'.$tag->tag_name.'</option>';
                                    else
                                        echo '<option value="'.$tag->tag_name.'">'.$tag->tag_name.'</option>';
                                }
                                echo '</select>';
                                echo '</td>';

                                //Red Andon Timer Reset
                                echo '<td style="width: 10%;">';
                                echo '<select class="form-control select2 andon-dropdown" data-kind="andon_timer_reset" id="andon_timer_reset_'.$andon->id.'" style="width: 100%;">';
                                echo '<option value="" selected disabled>[Select Tag]</option>';
                                foreach ($tags as $tag){
                                    if($andon->andon_timer_reset == $tag->tag_name )
                                        echo '<option value="'.$tag->tag_name.'" selected>'.$tag->tag_name.'</option>';
                                    else
                                        echo '<option value="'.$tag->tag_name.'">'.$tag->tag_name.'</option>';
                                }
                                echo '</select>';
                                echo '</td>';

                                //Red Andon
                                echo '<td style="width: 10%;">';
                                echo '<select class="form-control select2 andon-dropdown" data-kind="red_andon" id="red_andon_'.$andon->id.'" style="width: 100%;">';
                                echo '<option value="" selected disabled>[Select Tag]</option>';
                                foreach ($tags as $tag){
                                    if($andon->red_andon == $tag->tag_name )
                                        echo '<option value="'.$tag->tag_name.'" selected>'.$tag->tag_name.'</option>';
                                    else
                                        echo '<option value="'.$tag->tag_name.'">'.$tag->tag_name.'</option>';
                                }
                                echo '</select>';
                                echo '</td>';

                                //Line Running
                                echo '<td style="width: 10%;">';
                                echo '<select class="form-control select2 andon-dropdown" data-kind="line_running" id="line_running_'.$andon->id.'" style="width: 100%;">';
                                echo '<option value="" selected disabled>[Select Tag]</option>';
                                foreach ($tags as $tag){
                                    if($andon->line_running == $tag->tag_name )
                                        echo '<option value="'.$tag->tag_name.'" selected>'.$tag->tag_name.'</option>';
                                    else
                                        echo '<option value="'.$tag->tag_name.'">'.$tag->tag_name.'</option>';
                                }
                                echo '</select>';
                                echo '</td>';

                                echo '</tr>';
                            }
                            echo '</tbody>';
                            echo '</table>';
                        } else {
                            echo '<table id="" class="table table-bordered table-hover">';
                            echo '<thead>';
                            echo '<tr>
                                    <th style="width: 5%;">Andon NO.</th>
                                    <th style="width: 10%;">Name</th>
                                    <th style="width: 10%;">State</th>
                                    <th style="width: 10%;">Group</th>
                                    <th style="width: 10%;">ANDON TYPE (BIT)</th>
                                    <th style="width: 10%;">YELLOW ANDON (BIT)</th>
                                    <th style="width: 10%;">RED ANDON TIMER</th>
                                    <th style="width: 10%;">ANDON TIMER PRESET</th>
                                    <th style="width: 10%;">RED ANDON (BIT)</th>
                                    <th style="width: 10%;">LINE RUNNING BIT</th>
                                </tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            echo '<tr><td style="text-align: center;" colspan="10">No Andons</td></tr>';
                            echo '</tbody>';
                            echo '</table>';
                        }

                        echo '<form id="andonForm" action="'.base_url().'Andon/addAndon">';
                        echo '<table id="" class="table table-bordered table-hover">';
                        echo '<tbody>';
                        echo '<tr>';
                        echo '<td style="width:5%;">';
                        echo '<input type="number" class="form-control" id="andon_no" name="andon_no" min="1">';
                        echo '</td>';

                        echo '<td style="width: 10%;">';
                        echo '<input type="text" class="form-control" id="andon_name" name="andon_name">';
                        echo '</td>';

                        echo '<td style="width: 10%;">';
                        echo '<select class="form-control" id="status" name="status" style="width: 100%;">
                                    <option selected="selected" value="1">Enabled</option>
                                    <option value="0">Disabled</option>
                                </select>';
                        echo '</td>';

                        echo '<td style="width: 10%;">';
                        echo '<select class="form-control" id="group_id" name="group_id" style="width: 100%;">';
                        echo '<option value="" selected disabled>[Select Group]</option>';
                        foreach ($groups as $group){
                            echo '<option value="'.$group->id.'">'.$group->group_name.'</option>';
                        }
                        echo '</select>';
                        echo '</td>';

                        //ANDON TYPE
                        echo '<td style="width: 10%;">';
                        echo '<select class="form-control select2" id="andon_type" name="andon_type" style="width: 100%;">';
                        echo '<option value="" selected disabled>[Select Tag]</option>';
                        foreach ($tags as $tag){
                            echo '<option value="'.$tag->tag_name.'">'.$tag->tag_name.'</option>';
                        }
                        echo '</select>';
                        echo '</td>';

                        //Yellow Andon
                        echo '<td style="width: 10%;">';
                        echo '<select class="form-control select2" id="yellow_andon" name="yellow_andon" style="width: 100%;">';
                        echo '<option value="" selected disabled>[Select Tag]</option>';
                        foreach ($tags as $tag){
                            echo '<option value="'.$tag->tag_name.'">'.$tag->tag_name.'</option>';
                        }
                        echo '</select>';
                        echo '</td>';

                        //Red Andon Timer
                        echo '<td style="width: 10%;">';
                        echo '<select class="form-control select2" id="red_andon_timer" name="red_andon_timer" style="width: 100%;">';
                        echo '<option value="" selected disabled>[Select Tag]</option>';
                        foreach ($tags as $tag){
                            echo '<option value="'.$tag->tag_name.'">'.$tag->tag_name.'</option>';
                        }
                        echo '</select>';
                        echo '</td>';

                        //Andon Timer Reset
                        echo '<td style="width: 10%;">';
                        echo '<select class="form-control select2" id="andon_timer_reset" name="andon_timer_reset" style="width: 100%;">';
                        echo '<option value="" selected disabled>[Select Tag]</option>';
                        foreach ($tags as $tag){
                            echo '<option value="'.$tag->tag_name.'">'.$tag->tag_name.'</option>';
                        }
                        echo '</select>';
                        echo '</td>';

                        //Red Andon
                        echo '<td style="width: 10%;">';
                        echo '<select class="form-control select2" id="red_andon" name="red_andon" style="width: 100%;">';
                        echo '<option value="" selected disabled>[Select Tag]</option>';
                        foreach ($tags as $tag){
                            echo '<option value="'.$tag->tag_name.'">'.$tag->tag_name.'</option>';
                        }
                        echo '</select>';
                        echo '</td>';

                        //Line Running
                        echo '<td style="width: 10%;">';
                        echo '<select class="form-control select2" id="line_running" name="line_running" style="width: 100%;">';
                        echo '<option value="" selected disabled>[Select Tag]</option>';
                        foreach ($tags as $tag){
                            echo '<option value="'.$tag->tag_name.'">'.$tag->tag_name.'</option>';
                        }
                        echo '</select>';
                        echo '</td>';

                        echo '<td style="width: 5%;"><button type="button" class="btn btn-success" id="save_andon">Add</button></td>';
                        echo '</tr>';
                        echo '</tbody>';
                        echo '</table>';
                        echo '</form>';
                        ?>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </section>
</div>
<script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.tabledit.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('.select2').select2();

        if($("#andon_table").length > 0) {
            $('#andon_table').Tabledit({
                url: '<?php echo base_url() ?>Andon/updateAndon',
                columns: {
                    identifier: [0, 'id'],
                    editable: [
                        /*[1, 'andon_no'],*/
                        [2, 'andon_name']]
                },
                onDraw: function() {
                    //console.log('onDraw()');
                },
                onSuccess: function(data, textStatus, jqXHR) {
                    /*console.log('onSuccess(data, textStatus, jqXHR)');
                    console.log(data);*/
                    if(data.action == "delete") {
                        location.reload();
                    }
                    /*console.log(textStatus);
                    console.log(jqXHR);*/
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

        $("#save_andon").on('click', function () {
            var url = $('#andonForm').attr('action');
            var data = $('#andonForm').serialize();

            var andon_no = $("#andon_no").val();
            if(andon_no == "" || andon_no == null) {
                $("#andon_no").focus();
                return false;
            }

            var andon_name = $("#andon_name").val();
            if(andon_name == "") {
                $("#andon_name").focus();
                return false;
            }

            var group_id = $("#group_id").val();
            if(group_id == "" || group_id == null || group_id === 'undefined') {
                $("#group_id").focus();
                return false;
            }

            $.ajax({
                type: 'ajax',
                method: 'post',
                url: url,
                data: data,
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

        $(document).on('change', '.andon-dropdown', function () {
            var kind = $(this).data('kind');
            var id = $(this).attr('id').replace(kind+"_", "");
            var val = $(this).val();
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: '<?php echo base_url() ?>Andon/updateAndon',
                data: {id:id, kind:kind, val:val},
                async: true,
                dataType: 'json',
                success: function(response){
                    $('.alert-success').html('Andon data saved successfully').fadeIn().delay(4000).fadeOut('slow');
                },
                error: function(){
                    alert('Could not update data');
                }
            });
        });


    });
</script>