$(function () {
    $("#year_picker").datetimepicker({
        format: 'YYYY',
    });
    $("#month_picker").datetimepicker({
        format: 'MM/YYYY',
    });

    $("#week_picker").datetimepicker({
        format: 'DD/MM/YYYY'
    });

    //Get the value of Start and End of Week
    $('#week_picker').on('dp.change', function (e) {
        var value = $("#week_picker").val();
        var firstDate = moment(value, "DD/MM/YYYY").day(0).format("DD/MM/YYYY");
        var lastDate =  moment(value, "DD/MM/YYYY").day(6).format("DD/MM/YYYY");
        $("#week_picker").val(firstDate + " - " + lastDate);
    });

    $("#from_date").datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $("#to_date").datetimepicker({
        format: 'DD/MM/YYYY',
        useCurrent: false
    });

    $("#from_date").on("dp.change", function (e) {
        $('#to_date').data("DateTimePicker").minDate(e.date);
    });
    $("#to_date").on("dp.change", function (e) {
        $('#from_date').data("DateTimePicker").maxDate(e.date);
    });

    $("#date_type").on('change', function () {
        var date_type = $(this).val();
        $(".date").hide();
        $("#"+date_type+"_range").show();
    });

    $(document).on('click', '#load_report_data', function () {
        var form = $("#report_form");
        var date_type = $("#date_type").val();
        var form_val = true;

        if(date_type == "year" && $("#year_picker").val() == "") {
            $("#year_picker").focus();
            form_val = false;
        }

        if(date_type == "month" && $("#month_picker").val() == "") {
            $("#month_picker").focus();
            form_val = false;
        }

        if(date_type == "week" && $("#week_picker").val() == "") {
            $("#week_picker").focus();
            form_val = false;
        }

        if(date_type == "custom" && ($("#from_date").val() == "" || $("#to_date").val() == "")) {
            if($("#from_date").val() == "")
                $("#from_date").focus();
            if($("#to_date").val() == "")
                $("#to_date").focus();
            form_val = false;
        }

        if(form_val == false)
            return false;

        var report = form.find('input[name=report_name]').val();
        $("#loading").fadeIn(500);
        $.ajax({
            url: "/report/" + report + "/get_report",
            method: "POST",
            data: form.serialize(),
            statusCode: {
                401: function () {
                    console.log('Login expired. Please sign in again.')
                }
            },
            success: function (result) {
                $("#report_data").html(result);
                $("#loading").fadeOut(500);
            }
        });
    });

    $(document).on('click', '#export_to_excel', function () {
        var form = $("#report_form");
        form.submit();
    });
});
