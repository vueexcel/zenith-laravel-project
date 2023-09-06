<div class="col-md-6">

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('member_id') ? ' has-error' : '' }}">
            <label for="member_id">Member *</label>
            <select name="member_id" id="member_id" class="form-control select2" style="width: 100%" required tabindex="1">
                @if (isset($record->member_id))
                    <option value="{{$record->member_id}}">{{$record->member->member_no}}</option>
                @endif
            </select>
            @if ($errors->has('member_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('member_id') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="tcr_surname" style="display: block">Surname</label>
            <input type="text" class="form-control member-surname" name="surname" id="tcr_surname" value="" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="tcr_name" style="display: block">Name</label>
            <input type="text" class="form-control member-name" name="name" id="tcr_name" value="" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="tcr_group_code" style="display: block">Occupation</label>
            <input type="text" class="form-control member-occupation" name="occupation" id="tcr_group_code" value="" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="tcr_group_code" style="display: block">Group Code</label>
            <input type="text" class="form-control member-group-code" name="group_code" id="tcr_group_code" value="" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="section" style="display: block">Section</label>
            <input type="text" class="form-control member-section" name="section" id="section" value="" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="tcr_department" style="display: block">Department</label>
            <input type="text" class="form-control member-department" name="department" id="tcr_department" value="" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('supervisor_id') ? ' has-error' : '' }}">
            <label for="supervisor">Supervisor</label>
            <input type="text" class="form-control member-supervisor" name="supervisor" id="supervisor" value="" readonly="" tabindex="-1">

        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->


    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('group_code_id') ? ' has-error' : '' }}">
            <label for="group_code_id">Group Stats</label>
            <select name="group_code_id" id="group_code_id" class="form-control select2" style="width: 100%" tabindex="2">
                <?php
                $items = App\Models\GroupCode::all();
                ?>
                @foreach($items as $item)
                    <option value="{{$item->id}}" {{(isset($record->group_code_id) && $record->group_code_id == $item->id )? 'selected':''}}>{{ $item->group_code }}</option>
                @endforeach
            </select>
            @if ($errors->has('group_code_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('group_code_id') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="user_id" style="display: block">Updated By</label>
            <?php
            if(old('stop_6', $record->user_id)){
                $updated_by = \App\User::find(old('stop_6', $record->user_id))->name;
            } else{
                $updated_by = Auth::user()->name;
            }
            ?>
            <div class="input-group">
                <input type="text" class="form-control" name="user_id" id="user_id" value="{{$updated_by}}" readonly="" tabindex="-1">
                <span class="input-group-btn">
                    <button class="btn btn-primary btnOpenModalHistory" type="button" data-record="{{old('id', $record->id)}}" data-record-table="accidents"><span class="fa fa-history" aria-hidden="true"></span> History</button>
                </span>
            </div>
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="updated_at" style="display: block">Updated Date</label>
            <?php
            if(isset($record->updated_at)){
                $updated_at = $record->updated_at;
            } else{
                $updated_at = date('Y-m-d');
            }
            ?>
            <input type="text" class="form-control" name="updated_at" id="updated_at" value="{{ date('d/m/Y H:i:s', strtotime($updated_at))}}" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->
</div>
<!-- /.col-md-7 -->

<div class="col-md-6">

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('l4_date') ? ' has-error' : '' }}">
            <label for="l4_date">L4 Date</label>
            <input type="text" class="form-control datetimepicker-single" name="l4_date" id="l4_date" placeholder="L4 Date" value="{{ (old('l4_date', $record->l4_date))?date('d/m/Y', strtotime(old('l4_date', $record->l4_date))):'' }}" tabindex="3">
            @if ($errors->has('l4_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('l4_date') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('initial_medical_date') ? ' has-error' : '' }}">
            <label for="initial_medical_date">Assessment Date</label>
            <input type="text" class="form-control datetimepicker-single" name="initial_medical_date" id="initial_medical_date" placeholder="Assessment Date" value="{{ (old('initial_medical_date', $record->initial_medical_date))?date('d/m/Y', strtotime(old('initial_medical_date', $record->initial_medical_date))):'' }}" tabindex="4">
            @if ($errors->has('initial_medical_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('initial_medical_date') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->


    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('category_id') ? ' has-error' : '' }}">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control select2" style="width: 100%" tabindex="5">
                <option></option>
                <?php
                $items = App\Models\Category::all();
                ?>
                @foreach($items as $item)
                    <option value="{{$item->id}}" {{(isset($record->category_id) && $record->category_id == $item->id )? 'selected':''}}>{{ $item->category }}</option>
                @endforeach
            </select>
            @if ($errors->has('category_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('category_id') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-6">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('outcome') ? ' has-error' : '' }}">
            <label for="outcome_id">Outcome</label>
            <select name="outcome" id="outcome" class="form-control" style="width: 100%" tabindex="6">
                <option></option>
                <option value="level_4_placed" {{(isset($record->outcome) && $record->outcome == "level_4_placed" )? 'selected':''}}>Level 4 Placed</option>
                <option value="level_4_not_placed" {{(isset($record->outcome) && $record->outcome == "level_4_not_placed" )? 'selected':''}}>Level 4 Not Placed</option>
                <option value="not_on_red_flex" {{(isset($record->outcome) && $record->outcome == "not_on_red_flex" )? 'selected':''}}>Not on Red Flex</option>
            </select>
            @if ($errors->has('outcome'))
                <span class="help-block">
                    <strong>{{ $errors->first('outcome') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-6">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('restricted_status') ? ' has-error' : '' }}">
            <label for="restricted_status">Restricted Status</label>
            <select class="form-control" name="restricted_status" tabindex="7">
                <option value="Not Restricted" {{(old('restricted_status', $record->restricted_status)=='Not Restricted') ? 'selected':''}}>Not Restricted</option>
                <option value="Restricted" {{(old('restricted_status', $record->restricted_status)=='Restricted') ? 'selected':''}}>Restricted</option>
                <option value="N/A" {{(old('restricted_status', $record->restricted_status)=='N/A') ? 'selected':''}}>N/A</option>
            </select>
            @if ($errors->has('restricted_status'))
                <span class="help-block">
                    <strong>{{ $errors->first('restricted_status') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-6">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('temp_placed_in_headcount_position') ? ' has-error' : '' }}">
            <label for="temp_placed_in_headcount_position">Temp Placed in Headcount Position</label>
            <select class="form-control" id="temp_placed_in_headcount_position" name="temp_placed_in_headcount_position" tabindex="8">
                <option value="Yes" {{(old('temp_placed_in_headcount_position', $record->temp_placed_in_headcount_position)=='Yes') ? 'selected':''}}>Yes</option>
                <option value="No" {{(old('temp_placed_in_headcount_position', $record->temp_placed_in_headcount_position)=='No') ? 'selected':''}}>No</option>
                <option value="N/A" {{(old('temp_placed_in_headcount_position', $record->temp_placed_in_headcount_position)=='N/A') ? 'selected':''}}>N/A</option>
            </select>
            @if ($errors->has('temp_placed_in_headcount_position'))
                <span class="help-block">
                    <strong>{{ $errors->first('temp_placed_in_headcount_position') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-6">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('perm_placed_in_headcount_position') ? ' has-error' : '' }}">
            <label for="perm_placed_in_headcount_position">Perm Placed in Headcount Position</label>
            <select class="form-control" name="perm_placed_in_headcount_position" id="perm_placed_in_headcount_position" tabindex="9">
                <option value="Yes" {{(old('perm_placed_in_headcount_position', $record->perm_placed_in_headcount_position)=='Yes') ? 'selected':''}}>Yes</option>
                <option value="No" {{(old('perm_placed_in_headcount_position', $record->perm_placed_in_headcount_position)=='No') ? 'selected':''}}>No</option>
                <option value="N/A" {{(old('perm_placed_in_headcount_position', $record->perm_placed_in_headcount_position)=='N/A') ? 'selected':''}}>N/A</option>
            </select>
            @if ($errors->has('perm_placed_in_headcount_position'))
                <span class="help-block">
                    <strong>{{ $errors->first('perm_placed_in_headcount_position') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-6">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('no_of_online_processes') ? ' has-error' : '' }}">
            <label for="no_of_online_processes">No of Processes</label>
            <input type="number" class="form-control" name="no_of_online_processes" id="no_of_online_processes" placeholder="No of Processes" value="{{ old('no_of_online_processes', $record->no_of_online_processes) }}" tabindex="10">
            @if ($errors->has('no_of_online_processes'))
                <span class="help-block">
                    <strong>{{ $errors->first('no_of_online_processes') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-6">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('process') ? ' has-error' : '' }}">
            <label for="process">Process</label>
            <input type="text" class="form-control" name="process" id="process" placeholder="Process" value="{{ old('process', $record->process) }}" tabindex="11">
            @if ($errors->has('process'))
                <span class="help-block">
                    <strong>{{ $errors->first('process') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('action') ? ' has-error' : '' }}">
            <label for="action">Action</label>
            <textarea name="action" id="action" style="width: 100%; height: 160px;" tabindex="12">{{ old('action', $record->action) }}</textarea>
            @if ($errors->has('action'))
                <span class="help-block">
                    <strong>{{ $errors->first('action') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-6">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('placement_date') ? ' has-error' : '' }}">
            <label for="placement_date">Placement Date</label>
            <input type="text" class="form-control datetimepicker-single" name="placement_date" id="placement_date" placeholder="Placement Date" value="{{ (old('placement_date', $record->placement_date))?date('d/m/Y', strtotime(old('placement_date', $record->placement_date))):'' }}" tabindex="13">
            @if ($errors->has('placement_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('placement_date') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-6">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('ramp_up') ? ' has-error' : '' }}">
            <label for="ramp_up">Ramp Up</label>
            <select name="ramp_up" id="ramp_up" class="form-control select2" style="width: 100%" tabindex="14">
                <?php
                $items = App\Models\RampUp::all();
                ?>
                @foreach($items as $item)
                    <option value="{{$item->id}}" {{(isset($record->ramp_up) && $record->ramp_up == $item->id )? 'selected':''}}>{{ $item->ramp_up }}</option>
                @endforeach
            </select>
            @if ($errors->has('ramp_up'))
                <span class="help-block">
                    <strong>{{ $errors->first('ramp_up') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-6">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('fully_fit_date') ? ' has-error' : '' }}">
            <label for="fully_fit_date">Fully Fit Date</label>
            <input type="text" class="form-control" name="fully_fit_date" id="fully_fit_date" readonly="readonly" placeholder="Fully Fit Date" value="{{ (old('fully_fit_date', $record->fully_fit_date))?date('d/m/Y', strtotime(old('fully_fit_date', $record->fully_fit_date))):'' }}">
            @if ($errors->has('fully_fit_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('fully_fit_date') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

</div>
<!-- /.col-md-5 -->

@push('footer-scripts')
<script type="text/javascript">
    $(document).ready(function () {

        if($("#member_id").val() != null && typeof $("#member_id").val() !== 'undefined') {
            var id = $("#member_id").val();
            get_member_info(id);
        }

        /*if($("#group_code_id").val() != null && typeof $("#group_code_id").val() !== 'undefined') {
            var group_code = $("#group_code_id").val();
            get_supervisor_by_group_code(group_code);
        }*/

        $('#member_id').select2({
            placeholder: "Select Member No...",
            minimumInputLength: 2,
            ajax: {
                url: '/member/find',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });

        $("#member_id").on('change', function () {
            if($(this).val() == null || typeof $(this).val() === 'undefined') {
                return false;
            }
            var id = $(this).val();
            get_member_info(id);
        });

        $("#group_code_id").on('change', function () {
            var group_code = $(this).val();
            if(group_code == null || group_code === 'undefined') {
                return false;
            }
            get_supervisor_by_group_code(group_code);
        });

        $('.timepicker').datetimepicker({
            format: 'HH:mm'
        });

        $(document).on('change', '#ramp_up', function () {
            get_fully_fit_date();
        });

        $('#placement_date').datetimepicker().on('dp.change',function(e){
            get_fully_fit_date();
        })
    });

    function get_fully_fit_date()
    {
        var ramp_up = $("#ramp_up").val();
        var placement_date = $("#placement_date").val();
        if(placement_date == '' || placement_date == null) {
            return false;
        }

        $.ajax({
            url: "/get_fully_fit_date",
            method: "GET",
            data: {ramp_up:ramp_up, placement_date:placement_date},
            statusCode: {
                401: function () {
                    console.log('Login expired. Please sign in again.')
                }
            },
            success: function (data) {
                $("#fully_fit_date").val(data);
            }
        });
    }
</script>
@endpush