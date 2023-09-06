<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Andon Analysis</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="active">Andon Analysis</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <form class="form-inline" id="groupForm" action="<?php echo base_url() ?>analysis/getAnalysisGraph">
                            <div class="form-group">
                                <label>From</label>
                                <input type="text" class="form-control datepicker" id="from_date" name="from_date" value="<?php echo date('d/m/Y', strtotime($live_date)); ?>">
                            </div>
                            <div class="form-group" style="margin-left: 10px;">
                                <label>To</label>
                                <input type="text" class="form-control datepicker" id="to_date" name="to_date" value="<?php echo date('d/m/Y', strtotime($live_date)); ?>">
                            </div>
                            <div class="form-group" style="margin-left: 20px;">
                                <label>Group</label>
                                <select class="form-control" id="group_id" name="group_id">
                                    <?php
                                    foreach ($groups as $group){
                                        echo '<option value="'.$group->id.'">'.$group->group_name.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group" style="margin-left: 20px;">
                                <label>Shift</label>
                                <select class="form-control" id="shift" name="shift">
                                    <option value="shift1" <?php echo ($live_shift=="shift1")?"selected":"";?>>Shift 1</option>
                                    <option value="shift2" <?php echo ($live_shift=="shift2")?"selected":"";?>>Shift 2</option>
                                    <option value="both_shift">Both Shift</option>
                                </select>
                            </div>

                            <div class="form-group" style="margin-left: 30px;">
                                <button type="button" class="btn btn-success" id="btn_analysis" style="width: 120px;">Load Data</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="min-height: 300px;">
                        <div class="" style="width: 100%; height: 540px;" id="analysis_graph"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-xs-12" id="andons_section"></div>

            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-body" style="min-height: 300px;" id="grid_section">
                        <!------Grid Section---------->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</div>
<div id="loading">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div>
<style>
    #loading {
        position: fixed;
        top: 0;
        z-index: 100;
        width: 100%;
        height: 100%;
        display: none;
        background: rgba(0, 0, 0, 0.6);
    }

    .cv-spinner {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 4px #ddd solid;
        border-top: 4px #2e93e6 solid;
        border-radius: 50%;
        animation: sp-anime 0.8s infinite linear;
    }

    @keyframes sp-anime {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(359deg);
        }
    }

    .is-hide {
        display: none;
    }
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/amcharts/plugins/export/export.css" type="text/css" media="all"/>
<script src="<?php echo base_url(); ?>assets/amcharts/amcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/amcharts/serial.js"></script>
<script src="<?php echo base_url(); ?>assets/amcharts/themes/light.js"></script>
<script src="<?php echo base_url(); ?>assets/amcharts/plugins/export/export.min.js"></script>

<script type="text/javascript">
    $(function () {

        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

        $(".datepicker").datepicker({
            format: "dd/mm/yyyy",
            todayHighlight: true,
            setDate: new Date(),
            autoclose: true
        });

        //$( '#from_date, #to_date' ).datepicker( 'setDate', today );

        analysis_graph();
        show_grid();

        $("#btn_analysis").on('click', function () {
            $("#loading").fadeIn(500);
            analysis_graph();
            show_grid();
        });

        function analysis_graph()
        {
            var url = $('#groupForm').attr('action');
            var data = $('#groupForm').serialize();

            $.ajax({
                type: 'ajax',
                method: 'post',
                url: url,
                data: data,
                async: false,
                dataType: 'json',
                success: function(response){
                    var g_data = response;
                    AmCharts.makeChart("analysis_graph", {
                        "theme": "light",
                        "type": "serial",
                        "dataProvider": g_data,
                        "sortColumns": true,
                        /*"titles": [
                            {
                                "text": "Own Issues",
                                "size": 14,
                                "color":"#a36821"
                            }
                        ],*/
                        "valueAxes": [{
                            "id":"v1",
                            "position": "left",
                            "title": "Mins & Occurrences",
                            "stackType": "regular",
                        }, {
                            "id": "v2",
                            "gridAlpha": 0,
                            "position": "right",
                            "autoGridCount": false
                        }],
                        "startDuration": 1,
                        "graphs": [{
                            "fillAlphas": 0.9,
                            "lineAlpha": 0.9,
                            "type": "column",
                            "clustered":false,
                            "columnWidth":0.7,
                            "valueField": "time",
                            "valueAxis": "v1",
                            "lineColor": "red",
                            "lineThickness": 2,
                            "fillColors":"grey",
                            "labelText": "[[value]]",
                            "labelPosition": "top",
                            "labelColorField":"time_color"
                        },{
                            "fillAlphas": 0.9,
                            "lineAlpha": 0.2,
                            "type": "column",
                            "clustered":true,
                            "columnWidth":0.5,
                            "valueField": "red_andon",
                            "valueAxis": "v2",
                            "lineColor": "red",
                            "labelText": "[[value]]",
                            "labelPosition": "inside",
                            "labelColorField":"count_color"
                        },{
                            "fillAlphas": 0.9,
                            "lineAlpha": 0.2,
                            "type": "column",
                            "clustered":true,
                            "columnWidth":0.5,
                            "valueField": "yellow_andon",
                            "valueAxis": "v2",
                            "labelText": "[[value]]",
                            "labelPosition": "inside",
                            "lineColor": "yellow"
                        }],
                        "plotAreaFillAlphas": 0.1,
                        "categoryField": "andon",
                        "categoryAxis": {
                            "gridPosition": "start"
                        },
                        "export": {
                            "enabled": false
                        }

                    });

                    var andon_section = "";
                    for(var key in response) {
                        andon_section += '<div class="col-md-3"><div class="box box-widget widget-user"><div class="widget-user-header bg-aqua-active"><h3 class="widget-user-username">';
                        andon_section += response[key]['andon'];
                        andon_section += '</h3><h5 class="widget-user-desc"></h5></div>';
                        andon_section += '<div class="box-footer"><div class="row"><div class="col-sm-4 border-right"><div class="description-block"><h5 class="description-header">';
                        andon_section += response[key]['yellow_andon'];
                        andon_section += '</h5><span class="description-text">Yello Andon</span></div></div>';
                        andon_section += '<div class="col-sm-4 border-right"><div class="description-block"><h5 class="description-header">' + response[key]['red_andon'] + '</h5>';
                        andon_section += '<span class="description-text">Red Andon</span></div></div>';
                        andon_section += '<div class="col-sm-4"><div class="description-block"><h5 class="description-header">' + response[key]['time'] + '</h5>';
                        andon_section += '<span class="description-text">Andon Time</span></div></div></div></div></div></div>';
                    }

                    $("#andons_section").html(andon_section);

                    $("#loading").fadeOut(500);
                },
                error: function(){
                    alert('Could not add data');
                }
            });
        }

        function show_grid()
        {
            var data = $('#groupForm').serialize();
            $.ajax({
                type: 'ajax',
                method: 'post',
                url: '<?php echo base_url() ?>analysis/getAnalysisGrid',
                data: data,
                async: false,
                dataType: 'html',
                success: function(response){
                    //console.log(response);
                    $("#grid_section").html(response);
                },
                error: function(){
                    alert('Could not add data');
                }
            });
        }

    });
</script>