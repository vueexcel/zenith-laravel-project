$(function () {

    var password = $("#setting_password").val();
    if (password == "") {
        $("#password_modal").modal({backdrop: 'static', keyboard: false});
    }

    $('#unlock_password').keypress(function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            $("#check_password").click();
        }
        event.stopPropagation();
    });


    $("#check_password").on('click', function () {
        var password = $("#unlock_password").val();
        if (password == "") {
            $("#unlock_password").focus();
            return false;
        }

        $.ajax({
            url: 'Home/adminLogin',
            method: "post",
            data: {password: password}
        }).done(function (res) {
            if (res == "fail") {
                $("#password_alert").fadeTo(2000, 500).slideUp(500, function () {
                    $("#password_alert").slideUp(500);
                });
                return false;
            } else {
                $("#password_modal").modal('hide');
            }
        });
    });

    $("#cancel_password").on('click', function () {
        $("#password_modal").modal('hide');
        window.history.back();
    });
});