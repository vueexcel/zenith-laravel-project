$(document).ready(function () {

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;

    setProgressBar(current);

    $(".next").click(function () {
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        var btn_val = $(this).val();
        var required = true;
        var fieldset = $(this).closest('fieldset');
        var required_element = [];
        fieldset.find('.form-data').each(function () {
            if($(this).prop('required') && $(this).val() == '') {
                required_element.push($(this));
                required = false;
            }
        });

        if(required == false)
        {
            alert('You should fill all data for required field.');
            required_element[0].focus();
            return false;
        }

        var section_title = next_fs.attr('data-section');

        if(section_title != 'Complete Form') {
            $("#btn_section_name").show();
            $("#btn_section_name").text(section_title);
        }
        else
            $("#btn_section_name").hide();

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({'opacity': opacity});
            },
            duration: 500
        });
        setProgressBar(++current);

        if(btn_val == 'finish') {
            var form_id = current_fs.attr('data-item');
            var form_name = $("#form_name").val();
            $.ajax({
                url: route('forms::complete_form'),
                type: "POST",
                data: {
                    form_name: form_name,
                    form_id: form_id
                },
                success: function(result) {
                    console.log(result);
                },
            });
        }
    });

    $(".previous").click(function () {
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({'opacity': opacity});
            },
            duration: 500
        });
        setProgressBar(--current);
    });

    function setProgressBar(curStep) {
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
            .css("width", percent + "%")
    }

    $(".submit").click(function () {
        return false;
    })

});
