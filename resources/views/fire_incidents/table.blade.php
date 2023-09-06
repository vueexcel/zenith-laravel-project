<style type="text/css">
    div.dt-buttons {
    margin-top: -2px;
    float: right;
    margin-left: 10px;
}
</style>
<div class="table-responsive list-records" style="padding: 10px;">
    <table class="table table-hover table-bordered" id="fire_incidents_list">
        <thead>
            <th data-field="reported_date">Reported Date</th>
            <th data-field="logged_date">Logged Date</th>
            <th data-field="incident_date">Incident Date</th>
            <th data-field="member_no">Member No</th>
            <th data-field="member_name">Name</th>
            <th data-field="member_surname">Surname</th>
            <th data-field="member_occupation">Occupation</th>
            <th data-field="group_code">Group Code</th>
            <th data-field="member_department">Department</th>
            <th data-field="group_stat">Group Stat</th>
            <th data-field="location">Location</th>
            <th data-field="summary">Summary</th>
            <th data-field="work_type">Work Type</th>
            <th data-field="root_cause">Root Cause</th>
            <th data-field="significant">Significant</th>
            <th data-field="stop6">Stop6</th>
            <th data-field="updated_at">Updated At</th>
            @if(Auth::user()->is_admin > 1)
            <th style="width: 120px;">Actions</th>
            @endif
        </thead>
        <tbody>
        </tbody>
    </table>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 750px;">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Zenith Advanced Search</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="/action_page.php">
                        <div class="form-group">
                            <label class="control-label col-md-3">Logged Date to / from:</label>
                            <div class="col-md-9">
                                <input class="form-control datetimepicker-single" style="display: inline; width: 48%;"
                                    id="logged_date_from" placeholder="Enter Logged Date From">
                                <input class="form-control datetimepicker-single" style="display: inline; width: 48%;"
                                    id="logged_date_to" placeholder="Enter Logged Date To">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Incident Date to / from:</label>
                            <div class="col-md-9">
                                <input class="form-control datetimepicker-single" style="display: inline; width: 48%;"
                                    id="incident_date_from" placeholder="Enter Incident Date From">
                                <input class="form-control datetimepicker-single" style="display: inline; width: 48%;"
                                    id="incident_date_to" placeholder="Enter Incident Date To">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Reported Date to / from:</label>
                            <div class="col-md-9">
                                <input class="form-control datetimepicker-single" style="display: inline; width: 48%;"
                                    id="reported_date_from" placeholder="Enter Reported Date From">
                                <input class="form-control datetimepicker-single" style="display: inline; width: 48%;"
                                    id="reported_date_to" placeholder="Enter Reported Date To">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="member_nos">Member No:</label>
                            <div class="col-md-9">
                                <input class="form-control" id="member_nos" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="names">Name:</label>
                            <div class="col-md-9">
                                <input class="form-control" id="names" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="surnames">Surname:</label>
                            <div class="col-md-9">
                                <input class="form-control" id="surnames" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="group_codes">Group Code:</label>
                            <div class="col-md-9">
                                <input class="form-control" id="group_codes" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="location">Location:</label>
                            <div class="col-md-9">
                                <input class="form-control" id="location" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="summary">Summary:</label>
                            <div class="col-md-9">
                                <input class="form-control" id="summary" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="root_cause">Root Cause:</label>
                            <div class="col-md-9">
                                <input class="form-control" id="root_cause" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="significant">Significant:</label>
                            <div class="col-md-9">
                                <select id="significant" class="form-control">
                                    <option value="">All</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="stop6">Stop6:</label>
                            <div class="col-md-9">
                                <select id="stop6" class="form-control">
                                    <option value="">All</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-6 col-sm-6">
                                <button type="button" id="table-redraw" class="btn btn-default">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@push('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var user_permission = $("#user_permission").val();
            if(user_permission == 2) {
                var dt = $("#fire_incidents_list").DataTable({
                    'dom': "<'row'<'col-sm-6'l><'col-sm-6'Bf>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
                    'buttons': [{
                        className: "btn-advanced",
                        text: 'Advanced Search',
                        action: function(e, dt, node, config) {
                            $("#myModal").modal()
                        }
                    }, {
                        extend: "excel",
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]
                        },
                        action: function(e, dt, button, config) {
                          var self = this;
                          var oldStart = dt.settings()[0]._iDisplayStart;

                          dt.one('preXhr', function(e, s, data) {
                            // Just this once, load all data from the server...
                            data.start = 0;
                            data.length = 2147483647;

                            dt.one('preDraw', function(e, settings) {
                              // Call the original action function
                              if (button[0].className.indexOf('buttons-excel') >= 0) {
                                if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
                                  $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
                                } else {
                                  $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                                }
                              } else if (button[0].className.indexOf('buttons-print') >= 0) {
                                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                              }

                              dt.one('preXhr', function(e, s, data) {
                                // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                                // Set the property to what it was before exporting.
                                settings._iDisplayStart = oldStart;
                                data.start = oldStart;
                              });

                              // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                              setTimeout(dt.ajax.reload, 0);

                              // Prevent rendering of the full data to the DOM
                              return false;
                            });
                          });

                          // Requery the server with the new one-time export settings
                          dt.ajax.reload();
                        }
                    }],
                    'processing': true,
                    'serverSide': true,
                    'stateSave': true,
                    "order": [[ 9, "desc" ]],
                    'ajax': {
                        url: "{{ route('fire_incidents_list') }}",
                        type: "POST",
                        data: function(d) {
                            var ext = {};
                            $("#logged_date_from").val() && (ext['logged_date_from'] = $("#logged_date_from").val());
                            $("#logged_date_to").val() && (ext['logged_date_to'] = $("#logged_date_to").val());
                            $("#incident_date_from").val() && (ext['incident_date_from'] = $("#incident_date_from").val());
                            $("#incident_date_to").val() && (ext['incident_date_to'] = $("#incident_date_to").val());
                            $("#reported_date_from").val() && (ext['reported_date_from'] = $("#reported_date_from").val());
                            $("#reported_date_to").val() && (ext['reported_date_to'] = $("#reported_date_to").val());
                            $("#member_nos").val() && (ext['member_nos'] = $("#member_nos").val());
                            $("#names").val() && (ext['names'] = $("#names").val());
                            $("#surnames").val() && (ext['surnames'] = $("#surnames").val());
                            $("#group_codes").val() && (ext['group_codes'] = $("#group_codes").val());
                            $("#location").val() && (ext['location'] = $("#location").val());
                            $("#summary").val() && (ext['summary'] = $("#summary").val());
                            $("#root_cause").val() && (ext['root_cause'] = $("#root_cause").val());
                            $("#stop6").val() && (ext['stop6'] = $("#stop6").val());
                            $("#significant").val() && (ext['significant'] = $("#significant").val());
                            return $.extend({}, d, ext);
                        }
                    },
                    'columns': [
                        { data: 'reported_date', name: 'reported_date' },
                        { data: 'logged_date', name: 'logged_date' },
                        { data: 'incident_date', name: 'incident_date' },
                        { data: 'member.member_no', name: 'member.member_no' },
                        { data: 'member.name', name: 'member.name' },
                        { data: 'member.surname', name: 'member.surname' },
                        { data: 'member.occupation', name: 'member.occupation' },
                        { data: 'member.group_code', name: 'member.group_code' },
                        { data: 'member.department', name: 'member.department' },
                        { data: 'group_code.group_code', name: 'group_code.group_code' },
                        { data: 'location', name: 'location' },
                        { data: 'summary', name: 'summary' },
                        { data: 'work_type.work_type', name: 'work_type.work_type' },
                        { data: 'root_cause', name: 'root_cause' },
                        { data: 'significant', name: 'significant' },
                        { data: 'stop6', name: 'stop6' },
                        { data: 'updated_at', name: 'updated_at' },
                        { data: 'action', name:'action', orderable: false }
                    ],
                    "columnDefs": [ {
                        targets: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16],
                        render: function ( data, type, row, meta ) {
                            if(data == null)
                                return '';
                            else {
                                return '<a href="fire_incidents/' + row.id + '/edit" style="color:#2b2b2b;">' + data + '</a>';
                            }
                        },

                    },{
                        "targets": 7,
                        "orderable": false
                    }],
                    'rowCallback': function(row, data, index){
                        // if(data.accident_date != null) {
                        //     var accident_dates = data.accident_date.split("/");
                        //     var accident_date = accident_dates[2] + "-" + accident_dates[1] + "-" + accident_dates[0];
                        // } else
                        //     var accident_date = "";

                        // if(data.reported_date != null) {
                        //     var reported_dates = data.reported_date.split("/");
                        //     var reported_date = reported_dates[2] + "-" + reported_dates[1] + "-" + reported_dates[0];
                        // } else
                        //     var reported_date = "";

                        // if( (   data.member_id == null ||
                        //         data.reported_date == null ||
                        //         data.reported_date == null ||
                        //         data.member_statement == null ||
                        //         data.injury_type_id == null ||
                        //         data.body_part_id == null ||
                        //         data.ohc_comment == null ||
                        //         data.outcome_id == null ||
                        //         data.gir_definition_id == null ||
                        //         data.wi_required == null ||
                        //         data.group_code_id == null ||
                        //         data.stop_6 == null ||
                        //         data.riddor == null ||
                        //         data.escalation == null ||
                        //         accident_date == ""
                        //     ) &&
                        //     (accident_date >= '2020-01-01' || accident_date == "") && (reported_date >= '2020-01-01' || reported_date == null)
                        // ) {
                        //     $(row).css('background-color', '#ff9c9c');
                        // }
                    }
                })
            } else {
                var dt = $("#fire_incidents_list").DataTable({
                    'dom': "<'row'<'col-sm-6'l><'col-sm-6'Bf>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
                    'buttons': [{
                        className: "btn-advanced",
                        text: 'Advanced Search',
                        action: function(e, dt, node, config) {
                            $("#myModal").modal()
                        }
                    }, {
                        extend: "excel",
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
                        },
                        action: function(e, dt, button, config) {
                          var self = this;
                          var oldStart = dt.settings()[0]._iDisplayStart;

                          dt.one('preXhr', function(e, s, data) {
                            // Just this once, load all data from the server...
                            data.start = 0;
                            data.length = 2147483647;

                            dt.one('preDraw', function(e, settings) {
                              // Call the original action function
                              if (button[0].className.indexOf('buttons-excel') >= 0) {
                                if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
                                  $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
                                } else {
                                  $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                                }
                              } else if (button[0].className.indexOf('buttons-print') >= 0) {
                                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                              }

                              dt.one('preXhr', function(e, s, data) {
                                // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                                // Set the property to what it was before exporting.
                                settings._iDisplayStart = oldStart;
                                data.start = oldStart;
                              });

                              // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                              setTimeout(dt.ajax.reload, 0);

                              // Prevent rendering of the full data to the DOM
                              return false;
                            });
                          });

                          // Requery the server with the new one-time export settings
                          dt.ajax.reload();
                        }
                    }],
                    'processing': true,
                    'serverSide': true,
                    'stateSave': true,
                    "order": [[ 9, "desc" ]],
                    'ajax': {
                        url: "{{ route('fire_incidents_list') }}",
                        type: "POST",
                        data: function(d) {
                            var ext = {};
                            $("#logged_date_from").val() && (ext['logged_date_from'] = $("#logged_date_from").val());
                            $("#logged_date_to").val() && (ext['logged_date_to'] = $("#logged_date_to").val());
                            $("#incident_date_from").val() && (ext['incident_date_from'] = $("#incident_date_from").val());
                            $("#incident_date_to").val() && (ext['incident_date_to'] = $("#incident_date_to").val());
                            $("#reported_date_from").val() && (ext['reported_date_from'] = $("#reported_date_from").val());
                            $("#reported_date_to").val() && (ext['reported_date_to'] = $("#reported_date_to").val());
                            $("#member_nos").val() && (ext['member_nos'] = $("#member_nos").val());
                            $("#names").val() && (ext['names'] = $("#names").val());
                            $("#surnames").val() && (ext['surnames'] = $("#surnames").val());
                            $("#group_codes").val() && (ext['group_codes'] = $("#group_codes").val());
                            $("#location").val() && (ext['location'] = $("#location").val());
                            $("#summary").val() && (ext['summary'] = $("#summary").val());
                            $("#root_cause").val() && (ext['root_cause'] = $("#root_cause").val());
                            $("#stop6").val() && (ext['stop6'] = $("#stop6").val());
                            $("#significant").val() && (ext['significant'] = $("#significant").val());
                            return $.extend({}, d, ext);
                        }
                    },
                    'columns': [
                        { data: 'reported_date', name: 'reported_date' },
                        { data: 'logged_date', name: 'logged_date' },
                        { data: 'incident_date', name: 'incident_date' },
                        { data: 'member.member_no', name: 'member.member_no' },
                        { data: 'member.name', name: 'member.name' },
                        { data: 'member.surname', name: 'member.surname' },
                        { data: 'member.occupation', name: 'member.occupation' },
                        { data: 'member.group_code', name: 'member.group_code' },
                        { data: 'member.department', name: 'member.department' },
                        { data: 'group_code.group_code', name: 'group_code.group_code' },
                        { data: 'location', name: 'location' },
                        { data: 'summary', name: 'summary' },
                        { data: 'work_type.work_type', name: 'work_type.work_type' },
                        { data: 'root_cause', name: 'root_cause' },
                        { data: 'significant', name: 'significant' },
                        { data: 'stop6', name: 'stop6' },
                        { data: 'updated_at', name: 'updated_at' }
                    ],
                    'rowCallback': function(row, data, index){
                        // if(data.accident_date != null) {
                        //     var accident_dates = data.accident_date.split("/");
                        //     var accident_date = accident_dates[2] + "-" + accident_dates[1] + "-" + accident_dates[0];
                        // } else
                        //     var accident_date = "";

                        // if(data.reported_date != null) {
                        //     var reported_dates = data.reported_date.split("/");
                        //     var reported_date = reported_dates[2] + "-" + reported_dates[1] + "-" + reported_dates[0];
                        // } else
                        //     var reported_date = "";

                        // if( (   data.member_id == null ||
                        //         data.reported_date == null ||
                        //         data.reported_date == null ||
                        //         data.member_statement == null ||
                        //         data.injury_type_id == null ||
                        //         data.body_part_id == null ||
                        //         data.ohc_comment == null ||
                        //         data.outcome_id == null ||
                        //         data.gir_definition_id == null ||
                        //         data.wi_required == null ||
                        //         data.group_code_id == null ||
                        //         data.stop_6 == null ||
                        //         data.riddor == null ||
                        //         data.escalation == null ||
                        //         accident_date == ""
                        //     ) &&
                        //     (accident_date >= '2020-01-01' || accident_date == "") && (reported_date >= '2020-01-01' || reported_date == null)
                        // ) {
                        //     $(row).css('background-color', '#ff9c9c');
                        // }
                    }
                })
            }
            $("#table-redraw").on('click', function(e) {
                dt.ajax.reload()
            })
        });
    </script>
@endpush
