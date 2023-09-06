<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Shift Setting</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-cogs"></i> System Setup</a></li>
            <li><a href="active">Shift Setting</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Shift Setting (Manual)</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="alert alert-success" style="display: none;"></div>
                        <div style="width: 100%;">
                            <?php
                            $shiftKinds = array('days', 'night', 'fnight');
                            ?>
                            <form id="shift_setting_form" action="<?php echo base_url() ?>shift/updateShift">
                                <table class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th colspan="2" style="text-align: center;">
                                            Shift1
                                        </th>
                                        <th colspan="2" style="text-align: center;">
                                           Shift2
                                        </th>
                                        <th colspan="2" style="text-align: center;">
                                            Shift2(Friday)
                                        </th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th style="text-align: center;">Start</th>
                                        <th style="text-align: center;">End</th>
                                        <th style="text-align: center;">Start</th>
                                        <th style="text-align: center;">End</th>
                                        <th style="text-align: center;">Start</th>
                                        <th style="text-align: center;">End</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td style="text-align: center;">Time</td>
                                        <td style="text-align: center;">
                                            <?php
                                            echo '<div class="input-group bootstrap-timepicker timepicker" style="width: 100%">';
                                            echo '<input type="text" class="time-picker form-control input-small" name="days_start" value="'.$shifts['days']['start'].'" style="min-width:70px;">';
                                            echo '</div>';
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php
                                            echo '<div class="input-group bootstrap-timepicker timepicker" style="width: 100%">';
                                            echo '<input type="text" class="time-picker form-control input-small" name="days_end" value="'.$shifts['days']['end'].'" style="min-width:70px;">';
                                            echo '</div>';
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php
                                            echo '<div class="input-group bootstrap-timepicker timepicker" style="width: 100%">';
                                            echo '<input type="text" class="time-picker form-control input-small" name="night_start" value="'.$shifts['night']['start'].'" style="min-width:70px;">';
                                            echo '</div>';
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php
                                            echo '<div class="input-group bootstrap-timepicker timepicker" style="width: 100%">';
                                            echo '<input type="text" class="time-picker form-control input-small" name="night_end" value="'.$shifts['night']['end'].'" style="min-width:70px;">';
                                            echo '</div>';
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php
                                            echo '<div class="input-group bootstrap-timepicker timepicker" style="width: 100%">';
                                            echo '<input type="text" class="time-picker form-control input-small" name="fnight_start" value="'.$shifts['fnight']['start'].'" style="min-width:70px;">';
                                            echo '</div>';
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php
                                            echo '<div class="input-group bootstrap-timepicker timepicker"  style="width: 100%">';
                                            echo '<input type="text" class="time-picker form-control input-small" name="fnight_end" value="'.$shifts['fnight']['end'].'" style="min-width:70px;">';
                                            echo '</div>';
                                            ?>
                                        </td>
                                    </tr>

                                    <?php
                                    for($i = 1; $i<5; $i++){
                                        echo "<tr>";
                                        echo "<td style=\"text-align: center;\">Break ".$i."</td>";
                                        foreach ($shiftKinds as $key=>$kinds) {
                                            echo "<td>";
                                            echo '<div class="input-group bootstrap-timepicker timepicker" style="width: 100%">';
                                            echo '<input type="text" class="time-picker form-control input-small" name="'.$kinds.'_break_start[]" value="'.$shifts[$kinds]['breaks']['start'.$i].'" style="min-width:70px;">';
                                            echo '</div>';
                                            echo "</td>";

                                            echo "<td>";
                                            echo '<div class="input-group bootstrap-timepicker timepicker" style="width: 100%">';
                                            echo '<input type="text" class="time-picker form-control input-small" name="'.$kinds.'_break_end[]" value="'.$shifts[$kinds]['breaks']['end'.$i].'" style="min-width:70px;">';
                                            echo '</div>';
                                            echo "</td>";

                                        }
                                        echo "<tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div style="width: 100%; text-align: right;padding-top: 10px;">
                            <button class="btn btn-primary" id="shift_save" style="width: 200px;"> Save </button>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/admin.js"></script>
<script type="text/javascript">
    $(function () {
        $('.time-picker').timepicker({
            minuteStep: 1,
            template: 'modal',
            appendWidgetTo: 'body',
            showSeconds: false,
            showMeridian: false,
            defaultTime: false
        });

        $("#shift_save").on('click', function () {
            var url = $('#shift_setting_form').attr('action');
            var data = $('#shift_setting_form').serialize();

            $.ajax({
                type: 'ajax',
                method: 'post',
                url: url,
                data: data,
                async: true,
                dataType: 'json',
                success: function(response){
                    if(response.success){
                        $('.alert-success').html('Shift Setting saved successfully').fadeIn().delay(4000).fadeOut('slow');
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