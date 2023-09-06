<style type="text/css">
    div.dt-buttons {
    margin-top: -2px;
    float: right;
    margin-left: 10px;
}
</style>
<div class="table-responsive list-records" style="padding: 10px;">
    <table class="table table-hover table-bordered" id="health_concerns">
        <thead>
            <th data-field="episode_reference">Episode Reference</th>
            <th data-field="member_no">Member No</th>
            <th data-field="member_name">Name</th>
            <th data-field="member_surname">Surname</th>
            <th data-field="group_code">Group Code</th>
            <th data-field="ohc_appointment">OHC Date</th>
            <th data-field="body_part">Body Part</th>
            <th data-field="outcome">Outcome</th>
            <th data-field="discharge_date">Discharge Date</th>
            <th data-field="current_level">Current Level</th>
            <th data-field="updated_at">Updated At</th>
            @if (Auth::user()->is_admin > 1)
                <th style="width: 120px;">Actions</th>
            @endif
        </thead>
        <tbody></tbody>
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
                            <label class="control-label col-md-3">Logged Date to / from:</label>
                            <div class="col-md-9">
                                <input class="form-control datetimepicker-single" style="display: inline; width: 48%;"
                                    id="logged_date_from" placeholder="Enter Logged Date From">
                                <input class="form-control datetimepicker-single" style="display: inline; width: 48%;"
                                    id="logged_date_to" placeholder="Enter Logged Date To">
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
                            <label class="control-label col-md-3" for="body_parts">Body Parts:</label>
                            <div class="col-md-9">
                                <input class="form-control" id="body_parts" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="gmir">GMIR:</label>
                            <div class="col-md-9">
                                <select id="gmir" class="form-control">
                                    <option value="">All</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="riddor">Riddor(non-acc):</label>
                            <div class="col-md-9">
                                <select id="riddor" class="form-control">
                                    <option value="">All</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="repeat">Repeat:</label>
                            <div class="col-md-9">
                                <select id="repeat" class="form-control">
                                    <option value="">All</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="origins">Origin:</label>
                            <div class="col-md-9">
                                <select multiple id="origins" class="form-control">
                                    <option value="Non-Work" selected>Non-Work</option>
                                    <option value="Work" selected>Work</option>
                                    <option value="Word Aggrvated" selected>Word Aggrvated</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="origin_types">Origin Type:</label>
                            <div class="col-md-9">
                                <input class="form-control" id="origin_types" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="wpi_required">WPI Required:</label>
                            <div class="col-md-9 checkbox">
                                <select id="wpi_required" class="form-control">
                                    <option value="">All</option>
                                    <option value="YES">Yes</option>
                                    <option value="NO">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="mss_causations">MSS causation:</label>
                            <div class="col-md-9">
                                <input class="form-control" id="mss_causations" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="lost_mss">Lost Time MSS:</label>
                            <div class="col-md-9">
                                <select multiple id="lost_mss" class="form-control">
                                    <option value="No" selected>No</option>
                                    <option value="Yes" selected>Yes</option>
                                    <option value="Under Investigation" selected>Under Investigation</option>
                                    <option value="N/A" selected>N/A</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="current_levels">Current Level:</label>
                            <div class="col-md-9">
                                <select multiple id="current_levels" class="form-control">
                                    <option selected value="Level 1" >Level 1</option>
                                    <option selected value="Level 2" >Level 2</option>
                                    <option selected value="Level 3" >Level 3</option>
                                    <option selected value="Level 4 Not Placed" >Level 4 Not Placed</option>
                                    <option selected value="Level 1 Discharged" >Level 1 - Discharged</option>
                                    <option selected value="Level 2 Discharged" >Level 2 - Discharged</option>
                                    <option selected value="Level 3 Discharged" >Level 3 - Discharged</option>
                                    <option selected value="Level 4 (Red Flex) Discharged" >Level 4 (Red Flex) Discharged</option>
                                    <option selected value="Level 4 (Red Flex)" >Level 4 (Red Flex)</option>
                                    <option selected value="Level 4 Placed" >Level 4 Placed</option>
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
        $(document).ready(function() {
            var user_permission = $("#user_permission").val();
            if (user_permission == 2) {
                var dt = $("#health_concerns").DataTable({
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
                            columns: [0,1,2,3,4,5,6,7,8,9,10]
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
                    "order": [
                        [10, "desc"]
                    ],
                    'ajax': {
                        url: "{{ route('health_concerns_list') }}",
                        type: "POST",
                        data: function(d) {
                            var ext = {};
                            $("#date_from").val() && (ext['date_from'] = $("#date_from").val());
                            $("#date_to").val() && (ext['date_to'] = $("#date_to").val());
                            $("#member_nos").val() && (ext['member_nos'] = $("#member_nos").val());
                            $("#names").val() && (ext['names'] = $("#names").val());
                            $("#surnames").val() && (ext['surnames'] = $("#surnames").val());
                            $("#group_codes").val() && (ext['group_codes'] = $("#group_codes").val());
                            $("#logged_date_from").val() && (ext['logged_date_from'] = $("#logged_date_from").val());
                            $("#logged_date_to").val() && (ext['logged_date_to'] = $("#logged_date_to").val());
                            $("#ohc_date_from").val() && (ext['ohc_date_from'] = $("#ohc_date_from").val());
                            $("#ohc_date_to").val() && (ext['ohc_date_to'] = $("#ohc_date_to").val());
                            $("#body_parts").val() && (ext['body_parts'] = $("#body_parts").val());
                            $("#gmir").val() && (ext['gmir'] = $("#gmir").val());
                            $("#riddor").val() && (ext['riddor'] = $("#riddor").val());
                            $("#repeat").val() && (ext['repeat'] = $("#repeat").val());
                            $("#origins").val().length < 3 && (ext['origins'] = $("#origins").val());
                            $("#origin_types").val() && (ext['origin_types'] = $("#origin_types").val());
                            $("#wpi_required").val() && (ext['wpi_required'] = $("#wpi_required").val());
                            $("#mss_causations").val() && (ext['mss_causations'] = $("#mss_causations").val());
                            $("#lost_mss").val().length < 4 && (ext['lost_mss'] = $("#lost_mss").val());
                            $("#current_levels").val().length < 10 && (ext['current_levels'] = $("#current_levels").val());

                            return $.extend({}, d, ext);
                        }
                    },
                    'columns': [{
                            data: 'episode_reference',
                            name: 'episode_reference'
                        },
                        {
                            data: 'member.member_no',
                            name: 'member.member_no'
                        },
                        {
                            data: 'member.name',
                            name: 'member.name'
                        },
                        {
                            data: 'member.surname',
                            name: 'member.surname'
                        },
                        {
                            data: 'member.group_code',
                            name: 'member.group_code'
                        },
                        {
                            data: 'ohc_appointment',
                            name: 'ohc_appointment'
                        },
                        {
                            data: 'body_part.body_part',
                            name: 'body_part.body_part'
                        },
                        {
                            data: 'outcome',
                            name: 'outcome'
                        },
                        {
                            data: 'discharge_date',
                            name: 'discharge_date'
                        },
                        {
                            data: 'current_level',
                            name: 'current_level'
                        },
                        {
                            data: 'updated_at',
                            name: 'updated_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false
                        }
                    ],
                    "columnDefs": [{
                        targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                        render: function(data, type, row, meta) {
                            if (data == null)
                                return '';
                            else
                                return '<a href="health_concerns/' + row.id +
                                    '/edit" style="color:#2b2b2b;">' + data + '</a>';
                        }
                    }],
                    'rowCallback': function(row, data, index) {
                        if (data.ohc_appointment != null) {
                            var ohc_dates = data.ohc_appointment.split("/");
                            var ohc_date = ohc_dates[2] + "-" + ohc_dates[1] + "-" + ohc_dates[0];
                        } else
                            var ohc_date = "";
                        if( (   data.member_id == null ||
                            data.body_part_id == null ||
                            data.symptoms == null ||
                            data.origin == null ||
                            data.origin_type_id == null ||
                            data.group_code_id == null ||
                            data.current_level == null ||
                            ohc_date == ""
                        ) &&
                        (ohc_date >= '2020-01-01' || ohc_date == "") && (data.concern_date >= '2020-01-01' || data.concern_date == null)
                        ) {
                            $(row).css('background-color', '#ff9c9c');
                        }
                    }
                })
            } else {
                var dt = $("#health_concerns").DataTable({
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
                            columns: [0,1,2,3,4,5,6,7,8,9,10]
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
                    "order": [
                        [10, "desc"]
                    ],
                    'ajax': {
                        url: "{{ route('health_concerns_list') }}",
                        type: "POST",
                        data: function(d) {
                            var ext = {};
                            $("#date_from").val() && (ext['date_from'] = $("#date_from").val());
                            $("#date_to").val() && (ext['date_to'] = $("#date_to").val());
                            $("#member_nos").val() && (ext['member_nos'] = $("#member_nos").val());
                            $("#names").val() && (ext['names'] = $("#names").val());
                            $("#surnames").val() && (ext['surnames'] = $("#surnames").val());
                            $("#group_codes").val() && (ext['group_codes'] = $("#group_codes").val());
                            $("#logged_date_from").val() && (ext['logged_date_from'] = $("#logged_date_from").val());
                            $("#logged_date_to").val() && (ext['logged_date_to'] = $("#logged_date_to").val());
                            $("#ohc_date_from").val() && (ext['ohc_date_from'] = $("#ohc_date_from").val());
                            $("#ohc_date_to").val() && (ext['ohc_date_to'] = $("#ohc_date_to").val());
                            $("#body_parts").val() && (ext['body_parts'] = $("#body_parts").val());
                            $("#gmir").val() && (ext['gmir'] = $("#gmir").val());
                            $("#riddor").val() && (ext['riddor'] = $("#riddor").val());
                            $("#repeat").val() && (ext['repeat'] = $("#repeat").val());
                            $("#origins").val().length < 3 && (ext['origins'] = $("#origins").val());
                            $("#origin_types").val() && (ext['origin_types'] = $("#origin_types").val());
                            $("#wpi_required").val() && (ext['wpi_required'] = $("#wpi_required").val());
                            $("#mss_causations").val() && (ext['mss_causations'] = $("#mss_causations").val());
                            $("#lost_mss").val().length < 4 && (ext['lost_mss'] = $("#lost_mss").val());
                            $("#current_levels").val().length < 10 && (ext['current_levels'] = $("#current_levels").val());

                            return $.extend({}, d, ext);
                        }
                    },
                    'columns': [{
                            data: 'episode_reference',
                            name: 'episode_reference'
                        },
                        {
                            data: 'member.member_no',
                            name: 'member.member_no'
                        },
                        {
                            data: 'member.name',
                            name: 'member.name'
                        },
                        {
                            data: 'member.surname',
                            name: 'member.surname'
                        },
                        {
                            data: 'member.group_code',
                            name: 'member.group_code'
                        },
                        {
                            data: 'ohc_appointment',
                            name: 'ohc_appointment'
                        },
                        {
                            data: 'body_part.body_part',
                            name: 'body_part.body_part'
                        },
                        {
                            data: 'outcome',
                            name: 'outcome'
                        },
                        {
                            data: 'discharge_date',
                            name: 'discharge_date'
                        },
                        {
                            data: 'current_level',
                            name: 'current_level'
                        },
                        {
                            data: 'updated_at',
                            name: 'updated_at'
                        }
                    ],
                    'rowCallback': function(row, data, index) {
                        if (data.ohc_appointment != null) {
                            var ohc_dates = data.ohc_appointment.split("/");
                            var ohc_date = ohc_dates[2] + "-" + ohc_dates[1] + "-" + ohc_dates[0];
                        } else
                            var ohc_date = "";
                        if( (   data.member_id == null ||
                            data.body_part_id == null ||
                            data.symptoms == null ||
                            data.origin == null ||
                            data.origin_type_id == null ||
                            data.group_code_id == null ||
                            data.current_level == null ||
                            ohc_date == ""
                        ) &&
                        (ohc_date >= '2020-01-01' || ohc_date == "") && (data.concern_date >= '2020-01-01' || data.concern_date == null)
                        ) {
                            $(row).css('background-color', '#ff9c9c');
                        }
                    }
                })
            }
            $("#table-redraw").on('click', function(e) {
                dt.ajax.reload()
            })
        })
    </script>
@endpush