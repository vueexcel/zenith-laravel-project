$(function () {
    $(document).on("click", ".item-edit", function () {
        var item = $(this).data('item');
        var item_id = $(this).data('item_id');
        $.ajax({
            url: "/admin/"+item+"/edit/",
            method: "GET",
            data: {id:item_id},
            dataType: "HTML",
            statusCode: {
                401: function () {
                    console.log('Login expired. Please sign in again.')
                }
            },
            success: function (html) {
                $("#form-modal").find(".modal-body").html(html);
                var title = "EDIT " + item.replace("_", " ").toUpperCase();
                $("#form-modal").find(".modal-title").html(title);
                $('select.select2').select2();
                $("#form-modal").modal('show');
            }
        });
    });

    $(document).on('click', '.item-create', function () {
        var item = $(this).data('item');
        var item_id = 0;
        $.ajax({
            url: "/admin/"+item+"/edit/",
            method: "GET",
            data: {id:item_id},
            dataType: "HTML",
            statusCode: {
                401: function () {
                    console.log('Login expired. Please sign in again.')
                }
            },
            success: function (html) {
                $("#form-modal").find(".modal-body").html(html);
                var title = "ADD " + item.replace("_", " ").toUpperCase();
                $("#form-modal").find(".modal-title").html(title);
                $('select.select2').select2();
                $("#form-modal").modal('show');
            }
        });
    });

    $(document).on('click', '.save-item', function () {
        var form = $("#edit-form");
        var form_val = true;
        form.find(".required-field").each(function () {
            if($(this).val() == '' || $(this).val() == null) {
                $(this).focus();
                form_val = false;
            }
        });

        if(form_val == false)
            return false;

        var item = form.find('input[name=item]').val();

        $.ajax({
            url: "/admin/"+item+"/save",
            method: "POST",
            data: form.serialize(),
            statusCode: {
                401: function () {
                    console.log('Login expired. Please sign in again.')
                }
            },
            success: function (result) {
                if(typeof result.errors !== "undefined" && result.errors.length > 0) {
                    jQuery.each(result.errors, function(key, value){
                        jQuery('.alert-danger').append('<p>'+value+'</p>');
                    });

                    $(".alert-danger").fadeTo(2000, 500).slideUp(500, function () {
                        $(".alert-danger").slideUp(500);
                        $(".alert-danger").text('');
                    });

                } else {
                    var func = 'read_' + item;
                    window[func]();
                    $("#form-modal").modal('hide');
                }
            }
        });
    });

    $(document).on('click', '.item-delete', function () {
        var item = $(this).data('item');
        var item_id = $(this).data('item_id');
        var form = $("#delete-form");
        form.find('input[name=delete_item]').val(item);
        form.find('input[name=delete_item_id]').val(item_id);
        $("#confirm-delete-modal").modal('show');
    });

    $(document).on('click', '.delete-item', function () {
        var form = $("#delete-form");
        var item = form.find('input[name=delete_item]').val();

        $.ajax({
            url: "/admin/"+item+"/delete",
            method: "POST",
            data: form.serialize(),
            statusCode: {
                401: function () {
                    console.log('Login expired. Please sign in again.')
                }
            },
            success: function (result) {
                var func = 'read_' + item;
                window[func]();
                $("#confirm-delete-modal").modal('hide');
            }
        });


    });

});


function read_group_codes()
{
    $.ajax({
        url: "/admin/group_codes/all",
        method: "GET",
        dataType: "HTML",
        statusCode: {
            401: function () {
                console.log('Login expired. Please sign in again.')
            }
        },
        success: function (html) {
            $("#div_group_codes").html(html);
            $("#group_codes_table").DataTable({
                columnDefs: [{
                    targets: [3],
                    orderable: false
                }],
                "pageLength": 10,
                "lengthChange": false

            });
        }
    });
}

function read_body_parts()
{
    $.ajax({
        url: "/admin/body_parts/all",
        method: "GET",
        dataType: "HTML",
        statusCode: {
            401: function () {
                console.log('Login expired. Please sign in again.')
            }
        },
        success: function (html) {
            $("#div_body_parts").html(html);
            $("#body_parts_table").DataTable({
                columnDefs: [{
                    targets: [1],
                    orderable: false
                }],
                "pageLength": 10,
                "lengthChange": false

            });
        }
    });
}

function read_mss_causation()
{
    $.ajax({
        url: "/admin/mss_causation/all",
        method: "GET",
        dataType: "HTML",
        statusCode: {
            401: function () {
                console.log('Login expired. Please sign in again.')
            }
        },
        success: function (html) {
            $("#div_mss_causation").html(html);
            $("#mss_causation_table").DataTable({
                columnDefs: [{
                    targets: [2],
                    orderable: false
                }],
                "pageLength": 10,
                "lengthChange": false

            });
        }
    });
}

function read_supervisors()
{
    $.ajax({
        url: "/admin/supervisors/all",
        method: "GET",
        dataType: "HTML",
        statusCode: {
            401: function () {
                console.log('Login expired. Please sign in again.')
            }
        },
        success: function (html) {
            $("#div_supervisors").html(html);
            $("#supervisors_table").DataTable({
                columnDefs: [{
                    targets: [4],
                    orderable: false
                }],
                "pageLength": 10,
                "lengthChange": false

            });
        }
    });
}

function read_origin_types()
{
    $.ajax({
        url: "/admin/origin_types/all",
        method: "GET",
        dataType: "HTML",
        statusCode: {
            401: function () {
                console.log('Login expired. Please sign in again.')
            }
        },
        success: function (html) {
            $("#div_origin_types").html(html);
            $("#origin_types_table").DataTable({
                columnDefs: [{
                    targets: [1],
                    orderable: false
                }],
                "pageLength": 10,
                "lengthChange": false

            });
        }
    });
}

function read_outcomes()
{
    $.ajax({
        url: "/admin/outcomes/all",
        method: "GET",
        dataType: "HTML",
        statusCode: {
            401: function () {
                console.log('Login expired. Please sign in again.')
            }
        },
        success: function (html) {
            $("#div_outcomes").html(html);
            $("#outcomes_table").DataTable({
                columnDefs: [{
                    targets: [1],
                    orderable: false
                }],
                "pageLength": 10,
                "lengthChange": false

            });
        }
    });
}

function read_next_steps()
{
    $.ajax({
        url: "/admin/next_steps/all",
        method: "GET",
        dataType: "HTML",
        statusCode: {
            401: function () {
                console.log('Login expired. Please sign in again.')
            }
        },
        success: function (html) {
            $("#div_next_steps").html(html);
            $("#next_steps_table").DataTable({
                columnDefs: [{
                    targets: [1],
                    orderable: false
                }],
                "pageLength": 10,
                "lengthChange": false

            });
        }
    });
}

function read_ramp_up()
{
    $.ajax({
        url: "/admin/ramp_up/all",
        method: "GET",
        dataType: "HTML",
        statusCode: {
            401: function () {
                console.log('Login expired. Please sign in again.')
            }
        },
        success: function (html) {
            $("#div_ramp_up").html(html);
            $("#ramp_up_table").DataTable({
                columnDefs: [{
                    targets: [1],
                    orderable: false
                }],
                "pageLength": 10,
                "lengthChange": false

            });
        }
    });
}


function read_injury_types()
{
    $.ajax({
        url: "/admin/injury_types/all",
        method: "GET",
        dataType: "HTML",
        statusCode: {
            401: function () {
                console.log('Login expired. Please sign in again.')
            }
        },
        success: function (html) {
            $("#div_injury_types").html(html);
            $("#injury_types_table").DataTable({
                columnDefs: [{
                    targets: [1],
                    orderable: false
                }],
                "pageLength": 10,
                "lengthChange": false

            });
        }
    });
}

function read_seen_by()
{
    $.ajax({
        url: "/admin/seen_by/all",
        method: "GET",
        dataType: "HTML",
        statusCode: {
            401: function () {
                console.log('Login expired. Please sign in again.')
            }
        },
        success: function (html) {
            $("#div_seen_by").html(html);
            $("#seen_by_table").DataTable({
                columnDefs: [{
                    targets: [1],
                    orderable: false
                }],
                "pageLength": 10,
                "lengthChange": false

            });
        }
    });
}

function read_gir_definitions()
{
    $.ajax({
        url: "/admin/gir_definitions/all",
        method: "GET",
        dataType: "HTML",
        statusCode: {
            401: function () {
                console.log('Login expired. Please sign in again.')
            }
        },
        success: function (html) {
            $("#div_gir_definitions").html(html);
            $("#gir_definitions_table").DataTable({
                columnDefs: [{
                    targets: [1],
                    orderable: false
                }],
                "pageLength": 10,
                "lengthChange": false

            });
        }
    });
}

function read_causation()
{
    $.ajax({
        url: "/admin/causation_factors/all",
        method: "GET",
        dataType: "HTML",
        statusCode: {
            401: function () {
                console.log('Login expired. Please sign in again.')
            }
        },
        success: function (html) {
            $("#div_causation").html(html);
            $("#causation_table").DataTable({
                columnDefs: [{
                    targets: [1],
                    orderable: false
                }],
                "pageLength": 10,
                "lengthChange": false

            });
        }
    });
}

function read_causation_factors()
{
    $.ajax({
        url: "/admin/causation_factors/all",
        method: "GET",
        dataType: "HTML",
        statusCode: {
            401: function () {
                console.log('Login expired. Please sign in again.')
            }
        },
        success: function (html) {
            $("#div_causation_factors").html(html);
            $("#causation_factors_table").DataTable({
                columnDefs: [{
                    targets: [2],
                    orderable: false
                }],
                "pageLength": 10,
                "lengthChange": false

            });
        }
    });
}

function read_incident_types()
{
    $.ajax({
        url: "/admin/incident_types/all",
        method: "GET",
        dataType: "HTML",
        statusCode: {
            401: function () {
                console.log('Login expired. Please sign in again.')
            }
        },
        success: function (html) {
            $("#div_incident_types").html(html);
            $("#incident_types_table").DataTable({
                columnDefs: [{
                    targets: [1],
                    orderable: false
                }],
                "pageLength": 10,
                "lengthChange": false

            });
        }
    });
}

function read_work_types()
{
    $.ajax({
        url: "/admin/work_types/all",
        method: "GET",
        dataType: "HTML",
        statusCode: {
            401: function () {
                console.log('Login expired. Please sign in again.')
            }
        },
        success: function (html) {
            $("#div_work_types").html(html);
            $("#work_types_table").DataTable({
                columnDefs: [{
                    targets: [1],
                    orderable: false
                }],
                "pageLength": 10,
                "lengthChange": false

            });
        }
    });
}

function read_categories()
{
    $.ajax({
        url: "/admin/categories/all",
        method: "GET",
        dataType: "HTML",
        statusCode: {
            401: function () {
                console.log('Login expired. Please sign in again.')
            }
        },
        success: function (html) {
            $("#div_categories").html(html);
            $("#categories_table").DataTable({
                columnDefs: [{
                    targets: [1],
                    orderable: false
                }],
                "pageLength": 10,
                "lengthChange": false

            });
        }
    });
}
