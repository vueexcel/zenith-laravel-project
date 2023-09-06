<style type="text/css">
    div.dt-buttons {
    margin-top: -2px;
    float: right;
    margin-left: 10px;
}
</style>
<div class="table-responsive list-records" style="padding: 10px;">
    <table class="table table-hover table-bordered" id="accidents_list">
        <thead>
            <!--<th style="width: 10px;"><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>-->
            <th data-field="reported_date">Reported Date</th>
            <th data-field="accident_date">Accident Date</th>
            <th data-field="reported_date">OHC Date</th>
            <th data-field="member_no">Member No</th>
            <th data-field="member_name">Name</th>
            <th data-field="member_surname">Surname</th>
            <th data-field="group_code">Group</th>
            <th data-field="causation_factor">Causation</th>
            <th data-field="member_department">Department</th>
            <th data-field="updated_at">Updated At</th>
            <?php if(Auth::user()->is_admin > 1): ?>
            <th style="width: 120px;">Actions</th>
            <?php endif; ?>
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
                            <label class="control-label col-md-3">Date to / from:</label>
                            <div class="col-md-9">
                                <input class="form-control datetimepicker-single" style="display: inline; width: 48%;"
                                    id="date_from" placeholder="Enter Date From">
                                <input class="form-control datetimepicker-single" style="display: inline; width: 48%;"
                                    id="date_to" placeholder="Enter Date To">
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
                            <label class="control-label col-md-3">Reported Date to / from:</label>
                            <div class="col-md-9">
                                <input class="form-control datetimepicker-single" style="display: inline; width: 48%;"
                                    id="reported_date_from" placeholder="Enter Reported Date From">
                                <input class="form-control datetimepicker-single" style="display: inline; width: 48%;"
                                    id="reported_date_to" placeholder="Enter Reported Date To">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Accident Date to / from:</label>
                            <div class="col-md-9">
                                <input class="form-control datetimepicker-single" style="display: inline; width: 48%;"
                                    id="accident_date_from" placeholder="Enter Accident Date From">
                                <input class="form-control datetimepicker-single" style="display: inline; width: 48%;"
                                    id="accident_date_to" placeholder="Enter Accident Date To">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">OHC Appoitment Date to / from:</label>
                            <div class="col-md-9">
                                <input class="form-control datetimepicker-single" style="display: inline; width: 48%;"
                                    id="ohc_date_from" placeholder="Enter OHC Appoitment Date From">
                                <input class="form-control datetimepicker-single" style="display: inline; width: 48%;"
                                    id="ohc_date_to" placeholder="Enter OHC Appoitment Date To">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="injurys">Injury Type:</label>
                            <div class="col-md-9">
                                <input class="form-control" id="injurys" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="body_parts">Body Parts:</label>
                            <div class="col-md-9">
                                <input class="form-control" id="body_parts" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="outcomes">Outcome:</label>
                            <div class="col-md-9">
                                <input class="form-control" id="outcomes" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="causations">Causation:</label>
                            <div class="col-md-9">
                                <input class="form-control" id="causations" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="escalations">Escalation:</label>
                            <div class="col-md-9">
                                <select id="escalations" class="form-control">
                                    <option value="">All</option>
                                    <option value="None">None</option>
                                    <option value="Lost Time">Lost Time</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Absence Date to / from:</label>
                            <div class="col-md-9">
                                <input class="form-control datetimepicker-single" style="display: inline; width: 48%;"
                                    id="absence_date_from" placeholder="Enter Absence Date From">
                                <input class="form-control datetimepicker-single" style="display: inline; width: 48%;"
                                    id="absence_date_to" placeholder="Enter Absence Date To">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Days Lost from / to:</label>
                            <div class="col-md-9">
                                <input class="form-control" style="display: inline; width: 48%;" type="number"
                                    id="days_lost_from" placeholder="Enter Days Lost From">
                                <input class="form-control" style="display: inline; width: 48%;" type="number"
                                    id="days_lost_to" placeholder="Enter Days Lost To">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="gir_definitions">Gir Definition:</label>
                            <div class="col-md-9">
                                <input class="form-control" id="gir_definitions" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="wi_required">WI Required:</label>
                            <div class="col-md-9">
                                <select id="wi_required" class="form-control">
                                    <option value="">All</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="wi_required">Riddor:</label>
                            <div class="col-md-9">
                                <select id="riddor" class="form-control">
                                    <option value="">All</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="stop_6">Stop6:</label>
                            <div class="col-md-9">
                                <select id="stop_6" class="form-control">
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

<?php $__env->startPush('footer-scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            var user_permission = $("#user_permission").val();
            if(user_permission == 2) {
                var dt = $("#accidents_list").DataTable({
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
                            columns: [0,1,2,3,4,5,6,7,8,9]
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
                        url: "<?php echo e(route('accidents_list'), false); ?>",
                        type: "POST",
                        data: function(d) {
                            var ext = {};
                            $("#date_from").val() && (ext['date_from'] = $("#date_from").val());
                            $("#date_to").val() && (ext['date_to'] = $("#date_to").val());
                            $("#member_nos").val() && (ext['member_nos'] = $("#member_nos").val());
                            $("#names").val() && (ext['names'] = $("#names").val());
                            $("#surnames").val() && (ext['surnames'] = $("#surnames").val());
                            $("#group_codes").val() && (ext['group_codes'] = $("#group_codes").val());
                            $("#reported_date_from").val() && (ext['reported_date_from'] = $("#reported_date_from").val());
                            $("#reported_date_to").val() && (ext['reported_date_to'] = $("#reported_date_to").val());
                            $("#accident_date_to").val() && (ext['accident_date_to'] = $("#accident_date_to").val());
                            $("#accident_date_from").val() && (ext['accident_date_from'] = $("#accident_date_from").val());
                            $("#ohc_date_from").val() && (ext['ohc_date_from'] = $("#ohc_date_from").val());
                            $("#ohc_date_to").val() && (ext['ohc_date_to'] = $("#ohc_date_to").val());
                            $("#injurys").val() && (ext['injurys'] = $("#injurys").val());
                            $("#body_parts").val() && (ext['body_parts'] = $("#body_parts").val());
                            $("#outcomes").val() && (ext['outcomes'] = $("#outcomes").val());
                            $("#causations").val() && (ext['causations'] = $("#causations").val());
                            $("#escalations").val() && (ext['escalations'] = $("#escalations").val());
                            $("#absence_date_to").val() && (ext['absence_date_to'] = $("#absence_date_to").val());
                            $("#absence_date_from").val() && (ext['absence_date_from'] = $("#absence_date_from").val());
                            $("#days_lost_from").val() && (ext['days_lost_from'] = $("#absence_date_from").val());
                            $("#days_lost_to").val() && (ext['days_lost_to'] = $("#days_lost_to").val());
                            $("#gir_definitions").val() && (ext['gir_definitions'] = $("#gir_definitions").val());
                            $("#wi_required").val() && (ext['wi_required'] = $("#wi_required").val());
                            $("#riddor").val() && (ext['riddor'] = $("#riddor").val());
                            $("#stop_6").val() && (ext['stop_6'] = $("#stop_6").val());
                            return $.extend({}, d, ext);
                        }
                    },
                    'columns': [
                        { data: 'reported_date', name: 'reported_date' },
                        { data: 'accident_date', name: 'accident_date' },
                        { data: 'reported_date', name: 'reported_date' },
                        { data: 'member.member_no', name: 'member.member_no' },
                        { data: 'member.name', name: 'member.name' },
                        { data: 'member.surname', name: 'member.surname' },
                        { data: 'group_code.group_code', name: 'group_code.group_code' },
                        { data: 'causation_factor.causation_factor', name: 'causation_factor.causation_factor' },
                        { data: 'member.department', name: 'member.department' },
                        { data: 'updated_at', name: 'updated_at' },
                        { data: 'action', name:'action', orderable: false }
                    ],
                    "columnDefs": [ {
                        targets: [0,1,2,3,4,5,6,7,8,9],
                        render: function ( data, type, row, meta ) {
                            if(data == null)
                                return '';
                            else {
                                return '<a href="accidents/' + row.id + '/edit" style="color:#2b2b2b;">' + data + '</a>';
                            }
                        },

                    },{
                        "targets": 7,
                        "orderable": false
                    }],
                    'rowCallback': function(row, data, index){
                        if(data.accident_date != null) {
                            var accident_dates = data.accident_date.split("/");
                            var accident_date = accident_dates[2] + "-" + accident_dates[1] + "-" + accident_dates[0];
                        } else
                            var accident_date = "";

                        if(data.reported_date != null) {
                            var reported_dates = data.reported_date.split("/");
                            var reported_date = reported_dates[2] + "-" + reported_dates[1] + "-" + reported_dates[0];
                        } else
                            var reported_date = "";

                        if( (   data.member_id == null ||
                                data.reported_date == null ||
                                data.reported_date == null ||
                                data.member_statement == null ||
                                data.injury_type_id == null ||
                                data.body_part_id == null ||
                                data.ohc_comment == null ||
                                data.outcome_id == null ||
                                data.gir_definition_id == null ||
                                data.wi_required == null ||
                                data.group_code_id == null ||
                                data.stop_6 == null ||
                                data.riddor == null ||
                                data.escalation == null ||
                                accident_date == ""
                            ) &&
                            (accident_date >= '2020-01-01' || accident_date == "") && (reported_date >= '2020-01-01' || reported_date == null)
                        ) {
                            $(row).css('background-color', '#ff9c9c');
                        }
                    }
                })
            } else {
                var dt = $("#accidents_list").DataTable({
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
                            columns: [0,1,2,3,4,5,6,7,8,9]
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
                        url: "<?php echo e(route('accidents_list'), false); ?>",
                        type: "POST",
                        data: function(d) {
                            var ext = {};
                            $("#date_from").val() && (ext['date_from'] = $("#date_from").val());
                            $("#date_to").val() && (ext['date_to'] = $("#date_to").val());
                            $("#member_nos").val() && (ext['member_nos'] = $("#member_nos").val());
                            $("#names").val() && (ext['names'] = $("#names").val());
                            $("#surnames").val() && (ext['surnames'] = $("#surnames").val());
                            $("#group_codes").val() && (ext['group_codes'] = $("#group_codes").val());
                            $("#reported_date_from").val() && (ext['reported_date_from'] = $("#reported_date_from").val());
                            $("#reported_date_to").val() && (ext['reported_date_to'] = $("#reported_date_to").val());
                            $("#accident_date_to").val() && (ext['accident_date_to'] = $("#accident_date_to").val());
                            $("#accident_date_from").val() && (ext['accident_date_from'] = $("#accident_date_from").val());
                            $("#ohc_date_from").val() && (ext['ohc_date_from'] = $("#ohc_date_from").val());
                            $("#ohc_date_to").val() && (ext['ohc_date_to'] = $("#ohc_date_to").val());
                            $("#injurys").val() && (ext['injurys'] = $("#injurys").val());
                            $("#body_parts").val() && (ext['body_parts'] = $("#body_parts").val());
                            $("#outcomes").val() && (ext['outcomes'] = $("#outcomes").val());
                            $("#causations").val() && (ext['causations'] = $("#causations").val());
                            $("#escalations").val() && (ext['escalations'] = $("#escalations").val());
                            $("#absence_date_to").val() && (ext['absence_date_to'] = $("#absence_date_to").val());
                            $("#absence_date_from").val() && (ext['absence_date_from'] = $("#absence_date_from").val());
                            $("#days_lost_from").val() && (ext['days_lost_from'] = $("#absence_date_from").val());
                            $("#days_lost_to").val() && (ext['days_lost_to'] = $("#days_lost_to").val());
                            $("#gir_definitions").val() && (ext['gir_definitions'] = $("#gir_definitions").val());
                            $("#wi_required").val() && (ext['wi_required'] = $("#wi_required").val());
                            $("#riddor").val() && (ext['riddor'] = $("#riddor").val());
                            $("#stop_6").val() && (ext['stop_6'] = $("#stop_6").val());
                            return $.extend({}, d, ext);
                        }
                    },
                    'columns': [
                        { data: 'reported_date', name: 'reported_date' },
                        { data: 'accident_date', name: 'accident_date' },
                        { data: 'reported_date', name: 'reported_date' },
                        { data: 'member.member_no', name: 'member.member_no' },
                        { data: 'member.name', name: 'member.name' },
                        { data: 'member.surname', name: 'member.surname' },
                        { data: 'member.group_code', name: 'member.group_code' },
                        { data: 'causation_factor.causation_factor', name: 'causation_factor.causation_factor' },
                        { data: 'member.department', name: 'member.department' },
                        { data: 'updated_at', name: 'updated_at' }
                    ],
                    'rowCallback': function(row, data, index){
                        if(data.accident_date != null) {
                            var accident_dates = data.accident_date.split("/");
                            var accident_date = accident_dates[2] + "-" + accident_dates[1] + "-" + accident_dates[0];
                        } else
                            var accident_date = "";

                        if(data.reported_date != null) {
                            var reported_dates = data.reported_date.split("/");
                            var reported_date = reported_dates[2] + "-" + reported_dates[1] + "-" + reported_dates[0];
                        } else
                            var reported_date = "";

                        if( (   data.member_id == null ||
                                data.reported_date == null ||
                                data.reported_date == null ||
                                data.member_statement == null ||
                                data.injury_type_id == null ||
                                data.body_part_id == null ||
                                data.ohc_comment == null ||
                                data.outcome_id == null ||
                                data.gir_definition_id == null ||
                                data.wi_required == null ||
                                data.group_code_id == null ||
                                data.stop_6 == null ||
                                data.riddor == null ||
                                data.escalation == null ||
                                accident_date == ""
                            ) &&
                            (accident_date >= '2020-01-01' || accident_date == "") && (reported_date >= '2020-01-01' || reported_date == null)
                        ) {
                            $(row).css('background-color', '#ff9c9c');
                        }
                    }
                })
            }
            $("#table-redraw").on('click', function(e) {
                dt.ajax.reload()
            })
        });
    </script>
<?php $__env->stopPush(); ?>
