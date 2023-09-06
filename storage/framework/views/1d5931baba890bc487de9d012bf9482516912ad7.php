<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo Breadcrumbs::render('dashboard'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-title', $page_title); ?>


<?php $__env->startSection('page-subtitle', ''); ?>


<?php $__env->startSection('head-extras'); ?>
<style>

</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border" style="text-align: center;">
                    
                    <a id="download_<?php echo e($page, false); ?>"
                       data-chart = "<?php echo e($page, false); ?>_chart"
                       download="<?php echo e($page, false); ?>.jpg"
                       href="#"
                       class="download-chart btn btn-primary float-right bg-flat-color-1"
                       title="Download"
                       style="float: right; margin-bottom: -100px;">
                        <!-- Download Icon -->
                        <i class="fa fa-download"></i>
                    </a>
                    <select class="form-control" id="graph_year" style="display: inline; width: 100px; margin-right: 50px; float: right; margin-bottom: -100px;">
                        <?php
                            $year = date('Y');
                        ?>
                        <?php for($i = $year; $i > $year - 5; $i--): ?>
                            <option value="<?php echo e($i, false); ?>"><?php echo e($i, false); ?></option>
                        <?php endfor; ?>
                    </select>

                </div>
                <div class="box-body">
                    <div class="chart" data-graph="<?php echo e($page, false); ?>_chart" tyle="height: 400px;">
                        <canvas id="<?php echo e($page, false); ?>_chart" style="height: 400px;"></canvas>
                    </div>
                    <div class="col-md-6" style="text-align: center">
                        <?php if($page == 'manufacturing'): ?>
                            <button type="button" class="btn btn-default go-list" style="width: 200px;" value="<?php echo e($page, false); ?>_accident"><?php echo str_replace(" &", "<br/>&", $page_title); ?><br/>Accidents</button>
                        <?php else: ?>
                            <button type="button" class="btn btn-default go-list" style="width: 200px;" value="<?php echo e($page, false); ?>_accident"><?php echo e($page_title, false); ?><br/>Accidents</button>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6" style="text-align: center">
                        <?php if($page == 'manufacturing'): ?>
                            <button type="button" class="btn btn-default go-list" style="width: 200px;" value="<?php echo e($page, false); ?>_mss"><?php echo str_replace(" &", "<br/>&", $page_title); ?><br/>MSS</button>
                        <?php else: ?>
                            <button type="button" class="btn btn-default go-list" style="width: 200px;" value="<?php echo e($page, false); ?>_mss"><?php echo e($page_title, false); ?><br/>MSS</button>
                        <?php endif; ?>

                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <?php $__currentLoopData = $sub_buttons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub_button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($page_title == "Paint / Plastic" || $page_title == "Body Shop"): ?>
                <div class="col-md-6">
            <?php else: ?>
                <div class="col-md-4">
            <?php endif; ?>
                <div class="box box-success">
                    <div class="box-header with-border" style="text-align: center;">
                        <?php if($page_title == "Paint / Plastic"): ?>
                            
                            <a id="download_<?php echo e($key, false); ?>"
                               data-chart = "<?php echo e($key, false); ?>_chart"
                               download="<?php echo e($key, false); ?>.jpg"
                               href="#"
                               class="download-chart btn btn-primary float-right bg-flat-color-1"
                               title="Download" style="float: right; margin-bottom: -100px;">
                                <!-- Download Icon -->
                                <i class="fa fa-download"></i>
                            </a>
                        <?php else: ?>
                            
                            <a id="download_<?php echo e($page, false); ?>_<?php echo e($key, false); ?>"
                               data-chart = "<?php echo e($page, false); ?>_<?php echo e($key, false); ?>_chart"
                               download="<?php echo e($page, false); ?>_<?php echo e($key, false); ?>.jpg"
                               href="#"
                               class="download-chart btn btn-primary bg-flat-color-1"
                               title="Download" style="float: right; margin-bottom: -100px;">
                                <!-- Download Icon -->
                                <i class="fa fa-download"></i>
                            </a>
                        <?php endif; ?>

                    </div>
                    <div class="box-body">
                        <?php if($page_title == "Paint / Plastic"): ?>
                            <div class="chart" data-graph="<?php echo e($key, false); ?>_chart">
                                <canvas id="<?php echo e($key, false); ?>_chart" style="height: 230px; width: 100%;"></canvas>
                            </div>
                        <?php else: ?>
                            <div class="chart" data-graph="<?php echo e($page, false); ?>_<?php echo e($key, false); ?>_chart">
                                <canvas id="<?php echo e($page, false); ?>_<?php echo e($key, false); ?>_chart" style="height: 230px; width: 100%;"></canvas>
                            </div>
                        <?php endif; ?>

                        <div class="col-md-6" style="text-align: center">
                            <?php if($page_title == "Paint / Plastic"): ?>
                                <button type="button" class="btn btn-default go-list" style="width: 150px;" value="<?php echo e($key, false); ?>_accident"><?php echo str_replace("  ", "<br/>", $sub_button); ?><br/>Accidents</button>
                            <?php else: ?>
                                <button type="button" class="btn btn-default go-list" style="width: 150px;" value="<?php echo e($page, false); ?>_<?php echo e($key, false); ?>_accident"><?php echo e($page_title, false); ?><br/><?php echo e($sub_button, false); ?><br/>Accidents</button>
                            <?php endif; ?>

                        </div>
                        <div class="col-md-6" style="text-align: center">
                            <?php if($page_title == "Paint / Plastic"): ?>
                                <button type="button" class="btn btn-default go-list" style="width: 150px;" value="<?php echo e($key, false); ?>_mss"><?php echo str_replace("  ", "<br/>", $sub_button); ?><br/>MSS</button>
                            <?php else: ?>
                                <button type="button" class="btn btn-default go-list" style="width: 150px;" value="<?php echo e($page, false); ?>_<?php echo e($key, false); ?>_mss"><?php echo e($page_title, false); ?><br/><?php echo e($sub_button, false); ?><br/>MSS</button>
                            <?php endif; ?>

                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="row" style="display: none;">
        <form action="<?php echo e(route('dashboard.go_list'), false); ?>" method="post" id="go_list_form">
            <?php echo e(csrf_field(), false); ?>

            <input type="hidden" id="graph_type" name="graph_type" value="">
            <input type="hidden" id="year" name="year" value="">
        </form>
    </div>

    <div id="listModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" style="width:90%;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="listModalHeader">Modal Header</h4>
                </div>
                <div class="modal-body" style="min-height: 400px; height: auto;">
                    <div class="col-md-12" id="dash_list"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="graph_export">Export to Excel</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer-extras'); ?>
    <script src="<?php echo e(cdn_asset('/adminlte/js/Chart.min.js'), false); ?>" type="text/javascript"></script>
    <script>
        $(function () {
            var user_permission = $("#user_permission").val();
            var assembly_chart = null;
            var body_shop_chart = null;
            var paint_plastic_chart = null;
            var qa_chart = null;
            var manufacturing_chart = null;
            var corporate_chart = null;
            var deeside_chart = null;

            var assembly_production_chart = null;
            var assembly_logistics_chart = null;
            var assembly_maint_eng_chart = null;

            var body_shop_production_chart = null;
            var body_shop_maint_eng_chart = null;

            var paint_shop_production_chart = null;
            var paint_shop_maint_eng_chart = null;
            var plastics_shop_production_chart = null;
            var plastics_shop_maint_eng_chart = null;

            $(".chart").each(function () {
                var chart = $(this).data('graph')
                draw_one_graph(chart)
            })

            $("#graph_year").on('change', function () {
                draw_graph();
            });

            $(".go-list").on('click', function () {
                if(user_permission == 0)
                    return false;
                var graph_type = $(this).val();
                $("#graph_type").val(graph_type);
                $("#year").val($("#graph_year").val());
                var form = $("#go_list_form");
                $.ajax({
                    url: "<?php echo e(route('dashboard.go_list'), false); ?>",
                    method: "POST",
                    data: form.serialize(),
                    dataType: "HTML",
                    statusCode: {
                        401: function () {
                            console.log('Login expired. Please sign in again.')
                        }
                    },
                    success: function (result) {
                        $("#dash_list").html(result);
                        $("#listModalHeader").text(graph_type.replace(/_/g," ").toUpperCase());
                        $("#report_list").DataTable({
                            "order": [[ 5, "desc" ]]
                        });
                        if(user_permission == 2) {
                            $(".admin-view").show()
                        } else {
                            $(".admin-view").hide()
                        }
                        $("#listModal").modal();
                    }
                });
            });

            $("#graph_export").on('click', function () {
                $("#report_list_form").submit();
            });

            $(document).on('draw.dt', '#report_list', function () {
                if(user_permission == 2) {
                    $(".admin-view").show()
                } else {
                    $(".admin-view").hide()
                }
            })

            function draw_one_graph(chart)
            {
                var graph_year = $("#graph_year").val();
                $.ajax({
                    url: "<?php echo e(route('dashboard::standard_graph'), false); ?>",
                    method: "POST",
                    data: {e_chart:chart, graph_year:graph_year},
                    dataType: "JSON",
                    statusCode: {
                        401: function () {
                            console.log('Login expired. Please sign in again.')
                        }
                    },
                    success: function (result) {
                        var chartData = {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            datasets: [{
                                label: 'Accidents',
                                backgroundColor: "#F4B183",
                                data: result.accidents
                            },{
                                label: 'MSS',
                                backgroundColor: "#FFE699",
                                data: result.mss
                            }]
                        };

                        var chartOptions = {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        stepSize: 1,
                                        beginAtZero: true
                                    }
                                }]
                            },
                            maintainAspectRatio: false,
                            title: {
                                display: true,
                                text: 'TEST',
                                fontColor: '#000',
                                fontSize: '20'
                            }
                        }

                        var graph = $('#'+chart).get(0).getContext('2d');
                        switch(chart) {
                            case 'assembly_chart':
                                if(assembly_chart != null)
                                    assembly_chart.destroy();
                                chartOptions.title.text = 'Assembly';
                                assembly_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'body_shop_chart':
                                if(body_shop_chart != null)
                                    body_shop_chart.destroy();
                                chartOptions.title.text = 'Body Shop';
                                body_shop_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'paint_plastic_chart':
                                if(paint_plastic_chart != null)
                                    paint_plastic_chart.destroy();
                                chartOptions.title.text = 'Paint / Plastic';
                                paint_plastic_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'qa_chart':
                                if(qa_chart != null)
                                    qa_chart.destroy();
                                chartOptions.title.text = 'QA';
                                qa_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'manufacturing_chart':
                                if(manufacturing_chart != null)
                                    manufacturing_chart.destroy();
                                chartOptions.title.text = 'Manufacturing Support & Revenue';
                                manufacturing_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'corporate_chart':
                                if(corporate_chart != null)
                                    corporate_chart.destroy();
                                chartOptions.title.text = 'Corporate';
                                corporate_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'deeside_chart':
                                if(deeside_chart != null)
                                    deeside_chart.destroy();
                                chartOptions.title.text = 'Deeside';
                                deeside_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'assembly_production_chart':
                                if(assembly_production_chart != null)
                                    assembly_production_chart.destroy();
                                chartOptions.title.text = 'Assembly Production';
                                assembly_production_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'assembly_logistics_chart':
                                if(assembly_logistics_chart != null)
                                    assembly_logistics_chart.destroy();
                                chartOptions.title.text = 'Assembly Logistics';
                                assembly_logistics_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'assembly_maint_eng_chart':
                                if(assembly_maint_eng_chart != null)
                                    assembly_maint_eng_chart.destroy();
                                chartOptions.title.text = 'Assembly Maint/Eng';
                                assembly_maint_eng_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options:chartOptions
                                });
                                break;
                            case 'body_shop_production_chart':
                                if(body_shop_production_chart != null)
                                    body_shop_production_chart.destroy();
                                chartOptions.title.text = 'Body Shop Production';
                                body_shop_production_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options:chartOptions
                                });
                                break;
                            case 'body_shop_maint_eng_chart':
                                if(body_shop_maint_eng_chart != null)
                                    body_shop_maint_eng_chart.destroy();
                                chartOptions.title.text = 'Body Shop Maint/Eng';
                                body_shop_maint_eng_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options:chartOptions
                                });
                                break;
                            case 'paint_shop_production_chart':
                                if(paint_shop_production_chart != null)
                                    paint_shop_production_chart.destroy();
                                chartOptions.title.text = 'Paint Shop Production';
                                paint_shop_production_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'paint_shop_maint_eng_chart':
                                if(paint_shop_maint_eng_chart != null)
                                    paint_shop_maint_eng_chart.destroy();
                                chartOptions.title.text = 'Paint Shop Maint/Eng';
                                paint_shop_maint_eng_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'plastics_shop_production_chart':
                                if(plastics_shop_production_chart != null)
                                    plastics_shop_production_chart.destroy();
                                chartOptions.title.text = 'Plastics Shop Production';
                                plastics_shop_production_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                            case 'plastics_shop_maint_eng_chart':
                                if(plastics_shop_maint_eng_chart != null)
                                    plastics_shop_maint_eng_chart.destroy();
                                chartOptions.title.text = 'Plastics Shop Maint/Eng';
                                plastics_shop_maint_eng_chart = new Chart(graph, {
                                    type: 'bar',
                                    data: chartData,
                                    options: chartOptions
                                });
                                break;
                        }
                    }
                });
            }

            function draw_graph() {
                $(".chart").each(function () {
                    var chart = $(this).data('graph')
                    draw_one_graph(chart)
                })
            }

            $(".download-chart").on('click', function () {
                var chart_id = $(this).data('chart');
                var canvas = document.getElementById(chart_id);
                if(canvas.msToBlob){
                    var blob = canvas.msToBlob();
                    window.navigator.msSaveBlob(blob, chart_id + '.png');
                }
                else{
                    var a_id = $(this).attr('id');
                    var url_base64jp = document.getElementById(chart_id).toDataURL("image/jpg");
                    /*get download button (tag: <a></a>) */
                    var a =  document.getElementById(a_id);
                    /*insert chart image url to download button (tag: <a></a>) */
                    a.href = url_base64jp;
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>