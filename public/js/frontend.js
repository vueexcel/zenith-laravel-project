
function get_member_info(id) {
    $.ajax({
        url: "/member_info",
        method: "GET",
        data: {id:id},
        statusCode: {
            401: function () {
                console.log('Login expired. Please sign in again.')
            }
        },
        success: function (data) {
            //console.log(data);
            if(data.member != null) {
                $("input.member-surname").val(data.member.surname);
                $("input.member-name").val(data.member.name);
                $("input.member-group-code").val(data.member.group_code);
                $("input.member-department").val(data.member.department);
                $("input.member-occupation").val(data.member.occupation);
                $("input.member-section").val(data.member.section);
                $("input.member-birthday").val(data.member.birthday);
                $("input.member-start-date").val(data.member.start_date);
                $("input.member-leaving-date").val(data.member.leaving_date);
                $("input.member-status").val(data.member.status);
                $("input.member-dos").val(data.member.dos);
                $("input.member-dol").val(data.member.dol);
                $("input.member-division").val(data.member.division);
                $("input.member-supervisor").val(data.member.supervisor);
            }
        }
    });
}

function get_supervisor_by_group_code(group_code)
{
    $.ajax({
        url: "/supervisor_by_group_code",
        method: "GET",
        data: {group_code:group_code},
        statusCode: {
            401: function () {
                console.log('Login expired. Please sign in again.')
            }
        },
        success: function (options) {
            var html = "";
            for(var key in options) {
                html += "<option value='"+ options[key].id +"'>"+ options[key].surname + ", "+ options[key].name +"</option>";
            }
            $("select.group-supervisor").html(html);
        }
    });
}

