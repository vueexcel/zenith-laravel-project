<?php $__env->startSection('page-title', 'Forms'); ?>


<?php $__env->startSection('page-subtitle', 'Control panel'); ?>


<?php $__env->startSection('breadcrumbs'); ?>
    <?php echo Breadcrumbs::render('admin'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('head-extras'); ?>
    ##parent-placeholder-eabe76b5c33d3d1e8dad24cd5afb8f00710c56db##
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-sm-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="<?php echo e(($index == 0)?'active':'', false); ?>">
                            <a href="#form<?php echo e($form->id, false); ?>" data-toggle="tab" aria-expanded="<?php echo e(($index == 0)?'true':'false', false); ?>"><?php echo e($form->name, false); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
                <div class="tab-content">
                    <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="tab-pane <?php echo e(($index == 0)?'active':'', false); ?>" id="form<?php echo e($form->id, false); ?>">
                            <form method="post" >
                                <div class="form-group">
                                    <label>New Section: </label>
                                    <input type="text" name="section_name" class="form-control" style="display: inline; width: 450px;">
                                    <button type="button" class="btn btn-primary add-section">Add</button>
                                </div>
                                <input type="hidden" name="form_id" value="<?php echo e($form->id, false); ?>">
                            </form>

                            <?php $__currentLoopData = $form->sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="box box-primary collapsed-box"  id="card<?php echo e($section->id, false); ?>">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><?php echo e($section->name, false); ?></h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn bg-green btn-box-tool edit-section" value="<?php echo e($section->id, false); ?>"
                                                    data-form="<?php echo e($form->id, false); ?>" data-section="<?php echo e($section->name, false); ?>">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn bg-red btn-box-tool delete-section" value="<?php echo e($section->id, false); ?>">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <button type="button" class="btn bg-aqua btn-box-tool" data-widget="collapse">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-bordered field-table" id="section_table<?php echo e($section->id, false); ?>">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 420px">Question</th>
                                                        <th style="width: 220px">Answer Type</th>
                                                        <th>Is Required</th>
                                                        <th>Comment</th>
                                                        <th style="width: 220px">DB Field Name</th>
                                                        <th style="width: 120px"></th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="field_name" class="form-control" placeholder="Question">
                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="input_type">
                                                                <option value="Text">Text</option>
                                                                <option value="Textarea">Textarea</option>
                                                                <option value="Date">Date</option>
                                                                <option value="Datetime">Datetime</option>
                                                                <option value="Dropdown options">Dropdown options</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="is_required">
                                                                <option value="1">Required</option>
                                                                <option value="0">Optional</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="comment" class="form-control" placeholder="Comment">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="db_field" class="form-control" placeholder="DB Field Name">
                                                        </td>

                                                        <td style="text-align: center;">
                                                            <button type="button" class="btn btn-primary add-field">Add</button>
                                                        </td>
                                                    </tr>
                                                    </thead>
                                                    <?php $__currentLoopData = $section->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr id="field_<?php echo e($field->id, false); ?>">
                                                            <td class="field_name"><?php echo e($field->name, false); ?></td>
                                                            <td class="input_type">
                                                                <?php echo e($field->input_type, false); ?>

                                                                <?php if($field->input_type == 'Dropdown options'): ?>
                                                                    <button class="btn btn-sm btn-warning view-answers" value="<?php echo e($field->id, false); ?>">Answers</button>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td class="is_required" data-required="<?php echo e($field->is_required, false); ?>" style="text-align: center;color: <?php echo e(($field->is_required == 1)?'red':'black', false); ?>;">
                                                                <?php if($field->is_required == 1): ?>
                                                                    Required
                                                                <?php else: ?>
                                                                    Optional
                                                                <?php endif; ?>
                                                            </td>
                                                            <td class="comment"><?php echo e($field->comment, false); ?></td>
                                                            <td class="db_field"><?php echo e($field->db_field, false); ?></td>
                                                            <td style="text-align: center;">
                                                                <button type="button" class="btn bg-green btn-sm edit-field" value="<?php echo e($field->id, false); ?>">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger btn-sm delete-field" value="<?php echo e($field->id, false); ?>">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Default Modal</h4>
                </div>
                <div class="modal-body">
                    <p>One fine body&hellip;</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-------------- Modals ---------------->
    <!----Section Modal---->
    <div class="modal fade" id="section_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Section</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="section_form">
                        <div class="form-group">
                            <input type="text" name="section_name" class="form-control">
                        </div>
                        <input type="hidden" name="section_id" value="">
                        <input type="hidden" name="form_id" value="">
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update-section">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!----Field Modal---->
    <div class="modal fade" id="field_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Question</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="field_form">
                        <div class="form-group">
                            <label>Question</label>
                            <input type="text" name="field_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Input type</label>
                            <select class="form-control" name="input_type">
                                <option value="Text">Text</option>
                                <option value="Textarea">Textarea</option>
                                <option value="Date">Date</option>
                                <option value="Datetime">Datetime</option>
                                <option value="Dropdown options">Dropdown options</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Is Required</label>
                            <select class="form-control" name="is_required">
                                <option value="1">Required</option>
                                <option value="0">Optional</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Comment</label>
                            <input type="text" name="comment" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>DB Field Name</label>
                            <input type="text" name="db_field" class="form-control">
                        </div>
                        <input type="hidden" name="field_id" value="">
                        <input type="hidden" name="section_id" value="">
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update-field">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!----Answer Modal---->
    <div class="modal fade" id="answer_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Answers</h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer-extras'); ?>
    <script src="<?php echo e(asset('js/jquery-ui.min.js'), false); ?>"></script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".tab-pane").sortable({
                //items: 'tr:not(thead>tr)',
                cursor: 'pointer',
                axis: 'y',
                dropOnEmpty: false,
                start: function (e, ui) {
                    ui.item.addClass("selected");
                },
                stop: function (e, ui) {
                    ui.item.removeClass("selected");
                    var updated_order = [];
                    $(this).find(".box").each(function (index) {
                        var field = $(this).attr('id').replace('card', '');
                        updated_order.push(field);
                    });
                    update_order('section', updated_order);
                }
            });

            $(".field-table").sortable({
                items: 'tr:not(thead>tr)',
                cursor: 'pointer',
                axis: 'y',
                dropOnEmpty: false,
                start: function (e, ui) {
                    ui.item.addClass("selected");
                },
                stop: function (e, ui) {
                    ui.item.removeClass("selected");
                    var updated_order = [];
                    $(this).find("tr").each(function (index) {
                        if (index > 1) {
                            var field = $(this).attr('id').replace('field_', '');
                            updated_order.push(field);
                        }
                    });
                    update_order('field', updated_order);
                }
            });

            // Section
            $(document).on('click', '.add-section', function (e) {
                var form = $(this).closest('form');
                var section_name = form.find('input[name="section_name"]').val();
                var form_id = form.find('input[name="form_id"]').val();
                if(section_name == ''){
                    form.find('input[name="section_name"]').focus();
                    return false;
                }

                $.ajax({
                    url: route('admin::save_section'),
                    type: "POST",
                    data: form.serialize(),
                    success: function(result) {
                        if(result == 'Ok')
                            location.reload();
                        else
                            alert('Section Creation Failed');
                    },
                });
            });

            $(document).on('click', '.edit-section', function () {
                var section_name = $(this).attr('data-section');
                var form_id = $(this).attr('data-form');
                var section_id = $(this).val();
                $("#section_form").find('input[name="section_name"]').val(section_name);
                $("#section_form").find('input[name="section_id"]').val(section_id);
                $("#section_form").find('input[name="form_id"]').val(form_id);
                $("#section_modal").modal();
            });

            $(document).on('click', '.update-section', function () {
                var form = $("#section_form");
                var section_name = form.find('input[name="section_name"]').val();
                var section_id = form.find('input[name="section_id"]').val();
                if(section_name == ''){
                    form.find('input[name="section_name"]').focus();
                    return false;
                }

                $.ajax({
                    url: route('admin::update_section'),
                    type: "POST",
                    data: {
                        section_name:section_name,
                        section_id:section_id,
                    },
                    success: function(result) {
                        $("#card"+section_id).find('.box-title').text(section_name);
                        $("#card"+section_id).find('button.edit-section').attr('data-section', section_name);
                        form.find('input[name="section_name"]').val('');
                        form.find('input[name="section_id"]').val('');
                        $("#section_modal").modal('hide');
                    },
                });
            });

            $(document).on('click', '.delete-section', function () {
                var section_id = $(this).val();
                if(confirm('Are you sure?')) {
                    $.ajax({
                        url: route('admin::delete_section', section_id),
                        type: "DELETE",
                        data: {},
                        success: function(result) {
                            $("#card" + section_id).remove();
                        },
                    });
                }
            });

            // Fields (Questions)
            $(document).on('click', '.add-field', function (e) {
                var table = $(this).closest('table');
                var tr = $(this).closest('tr');
                var field_name = tr.find('input[name="field_name"]').val();
                var db_field = tr.find('input[name="db_field"]').val();
                var input_type = tr.find('select[name="input_type"]').val();
                var comment = tr.find('input[name="comment"]').val();
                var is_required = tr.find('select[name="is_required"]').val();
                var section_id = table.attr('id').replace('section_table', '');
                if(field_name == ''){
                    tr.find('input[name="field_name"]').focus();
                    return false;
                }

                if(db_field == ''){
                    tr.find('input[name="db_field"]').focus();
                    return false;
                }

                $.ajax({
                    url: route('admin::save_field'),
                    type: "POST",
                    data: {
                        field_name: field_name,
                        db_field: db_field,
                        input_type: input_type,
                        is_required: is_required,
                        comment: comment,
                        section_id: section_id,
                    },
                    dataType: 'HTML',
                    success: function(html) {
                        $("#card"+section_id).find('.box-body').html(html);
                        $(".field-table").sortable({
                            items: 'tr:not(thead>tr)',
                            cursor: 'pointer',
                            axis: 'y',
                            dropOnEmpty: false,
                            start: function (e, ui) {
                                ui.item.addClass("selected");
                            },
                            stop: function (e, ui) {
                                ui.item.removeClass("selected");
                                var updated_order = [];
                                $(this).find("tr").each(function (index) {
                                    if (index > 1) {
                                        var field = $(this).attr('id').replace('field_', '');
                                        updated_order.push(field);
                                    }
                                });
                                update_order('field', updated_order);
                            }
                        });
                    },
                });

            });

            $(document).on('click', '.edit-field', function (e) {
                var field_id = $(this).val();
                var tr = $(this).closest('tr');
                var field_name = tr.find('td.field_name').text().trim();
                var input_type = tr.find('td.input_type').text().trim();
                if(input_type.includes('Dropdown options'))
                    input_type = 'Dropdown options';
                var comment = tr.find('td.comment').text().trim();
                var is_required = tr.find('td.is_required').attr('data-required');
                var db_field = tr.find('td.db_field').text().trim();
                var table = $(this).closest('table');
                var section_id = table.attr('id').replace('section_table', '');
                $("#field_form").find('input[name="field_name"]').val(field_name);
                $("#field_form").find('select[name="input_type"]').val(input_type);
                $("#field_form").find('input[name="comment"]').val(comment);
                $("#field_form").find('input[name="field_id"]').val(field_id);
                $("#field_form").find('select[name="is_required"]').val(is_required);
                $("#field_form").find('input[name="db_field"]').val(db_field);
                $("#field_form").find('input[name="section_id"]').val(section_id);
                $("#field_modal").modal();
            });

            $(document).on('click', '.update-field', function () {
                var form = $("#field_form");
                var field_name = form.find('input[name="field_name"]').val();
                var section_id = form.find('input[name="section_id"]').val();
                if(field_name == ''){
                    form.find('input[name="field_name"]').focus();
                    return false;
                }

                $.ajax({
                    url: route('admin::update_field'),
                    type: "POST",
                    data: form.serialize(),
                    dataType:'HTML',
                    success: function(html) {
                        $("#field_modal").modal('hide');
                        $("#card"+section_id).find('.box-body').html(html);
                        $(".field-table").sortable({
                            items: 'tr:not(thead>tr)',
                            cursor: 'pointer',
                            axis: 'y',
                            dropOnEmpty: false,
                            start: function (e, ui) {
                                ui.item.addClass("selected");
                            },
                            stop: function (e, ui) {
                                ui.item.removeClass("selected");
                                var updated_order = [];
                                $(this).find("tr").each(function (index) {
                                    if (index > 1) {
                                        var field = $(this).attr('id').replace('field_', '');
                                        updated_order.push(field);
                                    }
                                });
                                update_order('field', updated_order);
                            }
                        });
                    },
                });
            });

            $(document).on('click', '.delete-field', function () {
                var field_id = $(this).val();
                var table = $(this).closest('table');
                var section_id = table.attr('id').replace('section_table', '');
                if(confirm('Are you sure?')) {
                    $.ajax({
                        url: route('admin::delete_field', field_id),
                        type: "DELETE",
                        data: {},
                        dataType: "HTML",
                        success: function(html) {
                            $("#card"+section_id).html(html);
                        },
                    });
                }
            });

            // Answer
            $(document).on('click', '.view-answers', function () {
                var field_id = $(this).val();
                $.ajax({
                    url: route('admin::answers'),
                    type: "POST",
                    data: {
                        field_id: field_id,
                    },
                    dataType: 'HTML',
                    success: function(html) {
                        $("#answer_modal").find('.modal-body').html(html);
                        $("#answers_table").sortable({
                            items: 'tr:not(thead>tr)',
                            cursor: 'pointer',
                            axis: 'y',
                            dropOnEmpty: false,
                            start: function (e, ui) {
                                ui.item.addClass("selected");
                            },
                            stop: function (e, ui) {
                                ui.item.removeClass("selected");
                                var updated_order = [];
                                $(this).find("tr").each(function (index) {
                                    if (index > 1) {
                                        var field = $(this).attr('id').replace('answer_', '');
                                        updated_order.push(field);
                                    }
                                });
                                update_order('answer', updated_order);
                            }
                        });
                        $("#answer_modal").modal();
                    },
                });
            });

            $(document).on('click', '.add-answer', function (e) {
                var tr = $(this).closest('tr');
                var answer_name = tr.find('input[name="answer_name"]').val();
                var answer_id = tr.find('input[name="answer_id"]').val();
                var field_id = tr.attr('data-field');
                if(answer_name == ''){
                    tr.find('input[name="answer_name"]').focus();
                    return false;
                }

                $.ajax({
                    url: route('admin::save_answer'),
                    type: "POST",
                    data: {
                        field_id: field_id,
                        answer_name: answer_name,
                        answer_id:answer_id,
                    },
                    dataType: 'HTML',
                    success: function(html) {
                        $("#answer_modal").find('.modal-body').html(html);
                        $("#answers_table").sortable({
                            items: 'tr:not(thead>tr)',
                            cursor: 'pointer',
                            axis: 'y',
                            dropOnEmpty: false,
                            start: function (e, ui) {
                                ui.item.addClass("selected");
                            },
                            stop: function (e, ui) {
                                ui.item.removeClass("selected");
                                var updated_order = [];
                                $(this).find("tr").each(function (index) {
                                    if (index > 1) {
                                        var field = $(this).attr('id').replace('answer_', '');
                                        updated_order.push(field);
                                    }
                                });
                                update_order('answer', updated_order);
                            }
                        });
                    },
                });
            });

            $(document).on('click', '.edit-answer', function () {
                var answer_name = $(this).attr('data-answer');
                var answer_id = $(this).val();
                var table = $(this).closest('table');
                table.find('input[name="answer_name"]').val(answer_name);
                table.find('input[name="answer_id"]').val(answer_id);
                table.find('button.add-answer').text('Save');
            });

            $(document).on('click', '.delete-answer', function () {
                var answer_id = $(this).val();
                var tr = $(this).closest('tr');
                if(confirm('Are you sure?')) {
                    $.ajax({
                        url: route('admin::delete_answer', answer_id),
                        type: "DELETE",
                        data: {},
                        success: function(result) {
                            tr.remove();
                        },
                    });
                }
            });


            function update_order(target, updated_order)
            {
                $.ajax({
                    url: route('admin::update_order'),
                    type: "POST",
                    data: {"updated_order": updated_order, 'target': target},
                    success: function(result) {
                        console.log('Updated order number');
                    },
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>