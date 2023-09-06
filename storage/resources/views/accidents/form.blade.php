<div class="col-md-6">

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('member_id') ? ' has-error' : '' }}">
            <label for="member_id">Member *</label>
            <select name="member_id" id="member_id" class="form-control select2" style="width: 100%" required autofocus tabindex="1">
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
            <label for="surname" style="display: block">Surname</label>
            <input type="text" class="form-control member-surname" name="surname" id="surname" value="" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="name" style="display: block">Name</label>
            <input type="text" class="form-control member-name" name="name" id="name" value="" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="group_code" style="display: block">Group</label>
            <input type="text" class="form-control member-group-code" name="group_code" id="group_code" value="" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="tcr_department" style="display: block">Department</label>
            <input type="text" class="form-control member-department" name="department" id="department" value="" readonly="" tabindex="-1">
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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('reported_date') ? ' has-error' : '' }}">
            <label for="reported_date">Reported Date *</label>
            <input type="text" class="form-control datetimepicker-single" name="reported_date" id="reported_date" placeholder="Reported Date" value="{{ (old('reported_date', $record->reported_date))?date('d/m/Y', strtotime(old('reported_date', $record->reported_date))):date('d/m/Y') }}" required tabindex="2">
            @if ($errors->has('reported_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('reported_date') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('accident_date') ? ' has-error' : '' }}">
            <label for="accident_date">Accident Date *</label>
            <input type="text" class="form-control datetimepicker-single" name="accident_date" id="accident_date" placeholder="Accident Date" value="{{ (old('accident_date', $record->accident_date))?date('d/m/Y', strtotime(old('accident_date', $record->accident_date))):'' }}" required tabindex="3">
            @if ($errors->has('accident_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('accident_date') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('logged_date') ? ' has-error' : '' }}">
            <label for="logged_date">OHC Date *</label>
            <input type="text" class="form-control datetimepicker-single" name="logged_date" id="logged_date" placeholder="OHC Date" value="{{ (old('logged_date', $record->logged_date))?date('d/m/Y', strtotime(old('logged_date', $record->logged_date))):'' }}" required tabindex="4">
            @if ($errors->has('logged_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('logged_date') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->



    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('member_statement') ? ' has-error' : '' }}">
            <label for="member_statement">Member Statement</label>
            <textarea name="member_statement" id="member_statement" style="width: 100%; height: 235px;" tabindex="5">{{ old('member_statement', $record->member_statement) }}</textarea>
            @if ($errors->has('member_statement'))
                <span class="help-block">
                    <strong>{{ $errors->first('member_statement') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('injury_type_id') ? ' has-error' : '' }}">
            <label for="injury_type_id">Injury Type</label>
            <select name="injury_type_id" id="injury_type_id" class="form-control select2" style="width: 100%" tabindex="6">
                <option></option>
                <?php
                $injury_types = App\Models\InjuryType::all();
                ?>
                @foreach($injury_types as $injury_type)
                    <option value="{{$injury_type->id}}" {{(isset($record->injury_type_id) && $record->injury_type_id == $injury_type->id )? 'selected':''}}>{{ $injury_type->injury }}</option>
                @endforeach
            </select>
            @if ($errors->has('injury_type_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('injury_type_id') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('body_part_id') ? ' has-error' : '' }}">
            <label for="body_part_id">Body Part</label>
            <select name="body_part_id" id="body_part_id" class="form-control select2" style="width: 100%" tabindex="7">
                <option></option>
                <?php
                $body_parts = App\Models\BodyPart::all();
                ?>
                @foreach($body_parts as $body_part)
                    <option value="{{$body_part->id}}" {{(isset($record->body_part_id) && $record->body_part_id == $body_part->id )? 'selected':''}}>{{$body_part->body_part}}</option>
                @endforeach
            </select>
            @if ($errors->has('body_part_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('body_part_id') }}</strong>
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
            if(old('user_id', $record->user_id)){
                $updated_by = \App\User::find(old('user_id', $record->user_id))->name;
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
                $updated_at = date('Y-m-d H:i:s');
            }
            ?>
            <input type="text" class="form-control" name="updated_at" id="updated_at" value="{{date('d/m/Y H:i:s', strtotime($updated_at))}}" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->
</div>
<!-- /.col-md-7 -->

<div class="col-md-6">

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('ohc_comment') ? ' has-error' : '' }}">
            <label for="ohc_comment">OHC Comment</label>
            <textarea name="ohc_comment" id="ohc_comment" style="width: 100%; height: 100px;" tabindex="8">{{ old('ohc_comment', $record->ohc_comment) }}</textarea>
            @if ($errors->has('ohc_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('ohc_comment') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('outcome_id') ? ' has-error' : '' }}">
            <label for="outcome_id">Outcome</label>
            <select name="outcome_id" id="outcome_id" class="form-control select2" style="width: 100%" tabindex="9">
                <?php
                $outcomes = App\Models\Outcome::all();
                ?>
                @foreach($outcomes as $outcome)
                    <option value="{{$outcome->id}}" {{(isset($record->injury_type_id) && $record->injury_type_id == $outcome->id )? 'selected':''}}>{{ $outcome->outcome }}</option>
                @endforeach
            </select>
            @if ($errors->has('outcome_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('outcome_id') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->


    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('causation_factor_id') ? ' has-error' : '' }}">
            <label for="causation_factor_id">Causation</label>
            <select name="causation_factor_id" id="causation_factor_id" class="form-control select2" style="width: 100%" tabindex="10">
                <?php
                $items = App\Models\CausationFactor::all();
                ?>
                @foreach($items as $item)
                    <option value="{{$item->id}}" {{(isset($record->causation_factor_id) && $record->causation_factor_id == $item->id )? 'selected':''}}>{{ $item->number }} - {{ $item->causation_factor }}</option>
                @endforeach
            </select>
            @if ($errors->has('causation_factor_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('causation_factor_id') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('escalation') ? ' has-error' : '' }}">
            <label for="escalation">Escalation</label>
            <select class="form-control" name="escalation" id="escalation" tabindex="11">
                <option value="None" {{(old('escalation', $record->escalation)=='None') ? 'selected':''}}>None</option>
                <option value="Lost Time" {{(old('escalation', $record->escalation)=='Lost Time') ? 'selected':''}}>Lost Time</option>
            </select>
            @if ($errors->has('escalation'))
                <span class="help-block">
                    <strong>{{ $errors->first('escalation') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('lt_start_date') ? ' has-error' : '' }}">
            <label for="lt_start_date">Absence Start Date</label>
            <input type="text" class="form-control datetimepicker-single" name="lt_start_date" id="lt_start_date" placeholder="Absence Start Date" value="{{ (old('lt_start_date', $record->lt_start_date))?date('d/m/Y', strtotime(old('lt_start_date', $record->lt_start_date))):'' }}" tabindex="12">
            @if ($errors->has('lt_start_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('lt_start_date') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('days_lost') ? ' has-error' : '' }}">
            <label for="days_lost">Days Lost</label>
            <input type="number" class="form-control" name="days_lost" id="days_lost" placeholder="Days Lost" value="{{ old('days_lost', $record->days_lost) }}" tabindex="13">
            @if ($errors->has('days_lost'))
                <span class="help-block">
                    <strong>{{ $errors->first('days_lost') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('gir_definition_id') ? ' has-error' : '' }}">
            <label for="gir_definition_id">GIR Definition</label>
            <select name="gir_definition_id" id="gir_definition_id" class="form-control select2" style="width: 100%" tabindex="14">
                <?php
                $items = App\Models\GirDefinition::all();
                ?>
                @foreach($items as $item)
                    <option value="{{$item->id}}" {{(isset($record->gir_definition_id) && $record->gir_definition_id == $item->id )? 'selected':''}}>{{ $item->definition }}</option>
                @endforeach
            </select>
            @if ($errors->has('gir_definition_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('gir_definition_id') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('gir_reason') ? ' has-error' : '' }}">
            <label for="gir_reason">Reason</label>
            <input type="text" class="form-control" name="gir_reason" id="gir_reason" placeholder="Reason" value="{{ old('gir_reason', $record->gir_reason) }}" tabindex="15">
            @if ($errors->has('gir_reason'))
                <span class="help-block">
                    <strong>{{ $errors->first('gir_reason') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('wi_required') ? ' has-error' : '' }}">
            <label for="wi_required">WI Required</label>
            <select class="form-control" name="wi_required" id="wi_required" tabindex="16">
                <option value="yes" {{(old('wi_required', $record->wi_required)=='yes') ? 'selected':''}}>YES</option>
                <option value="no" {{(old('wi_required', $record->wi_required)=='no') ? 'selected':''}}>NO</option>
            </select>
            @if ($errors->has('wi_required'))
                <span class="help-block">
                    <strong>{{ $errors->first('wi_required') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('wi_part_1_received') ? ' has-error' : '' }}">
            <label for="wi_part_1_received">WI Part1 Received</label>
            <input type="text" class="form-control datetimepicker-single" name="wi_part_1_received" id="wi_part_1_received" placeholder="WI Part1 Received" value="{{ (old('wi_part_1_received', $record->wi_part_1_received))?date('d/m/Y', strtotime(old('wi_part_1_received', $record->wi_part_1_received))):'' }}" tabindex="17">
            @if ($errors->has('wi_part_1_received'))
                <span class="help-block">
                    <strong>{{ $errors->first('wi_part_1_received') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('wi_part_2_received') ? ' has-error' : '' }}">
            <label for="wi_part_2_received">WI Part2 Received</label>
            <input type="text" class="form-control datetimepicker-single" name="wi_part_2_received" id="wi_part_2_received" placeholder="WI Part1 Received" value="{{ (old('wi_part_2_received', $record->wi_part_2_received))?date('d/m/Y', strtotime(old('wi_part_2_received', $record->wi_part_2_received))):'' }}" tabindex="18">
            @if ($errors->has('wi_part_2_received'))
                <span class="help-block">
                    <strong>{{ $errors->first('wi_part_2_received') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('riddor') ? ' has-error' : '' }}">
            <label for="riddor">RIDDOR?</label>
            <select class="form-control" name="riddor" id="riddor" tabindex="19">
                <option value="no" {{(old('riddor', $record->riddor)=='no') ? 'selected':''}}>NO</option>
                <option value="yes" {{(old('riddor', $record->riddor)=='yes') ? 'selected':''}}>YES</option>
            </select>
            @if ($errors->has('significant_incident'))
                <span class="help-block">
                    <strong>{{ $errors->first('significant_incident') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('riddor_reason') ? ' has-error' : '' }}">
            <label for="riddor_reason">RIDDOR Reason</label>
            <input type="text" class="form-control" name="riddor_reason" id="riddor_reason" value="{{ old('riddor_reason', $record->riddor_reason) }}" tabindex="20">
            @if ($errors->has('riddor_reason'))
                <span class="help-block">
                    <strong>{{ $errors->first('riddor_reason') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('stop_6') ? ' has-error' : '' }}">
            <label for="stop_6">Stop-6</label>
            <select class="form-control" name="stop_6" id="stop_6" tabindex="21">
                <option value="no" {{(old('stop_6', $record->stop_6)=='no') ? 'selected':''}}>NO</option>
                <option value="yes" {{(old('stop_6', $record->stop_6)=='yes') ? 'selected':''}}>YES</option>
            </select>
            @if ($errors->has('stop_6'))
                <span class="help-block">
                    <strong>{{ $errors->first('stop_6') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('group_code_id') ? ' has-error' : '' }}">
            <label for="group_code_id">Group Stats</label>
            <select name="group_code_id" id="group_code_id" class="form-control select2" style="width: 100%" tabindex="22">
                <option></option>
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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('monthly_stats') ? ' has-error' : '' }}">
            <label for="monthly_stats">Monthly Stats</label>
            <select class="form-control" name="monthly_stats" id="monthly_stats" disabled value="{{ (old('monthly_stats', $record->monthly_stats))?$record->monthly_stats:'' }}" tabindex="23">
                @for($i=1;$i<13;$i++)
                    @if(isset($record->monthly_stats) && $record->monthly_stats == $i)
                        <option value="{{$i}}" selected>{{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
                    @else
                        <option value="{{$i}}">{{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
                    @endif
                @endfor
            </select>
            @if ($errors->has('monthly_stats'))
                <span class="help-block">
                    <strong>{{ $errors->first('monthly_stats') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
</div>
<!-- /.col-md-5 -->

@push('footer-scripts')
<script type="text/javascript">
    $(document).ready(function () {

        var causation = $("#causation_factor_id").val();

        if(causation > 3) {
            $("#monthly_stats").attr('disabled', false);
        } else {
            $("#monthly_stats").attr('disabled', true);
        }

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

        if($("#member_id").val() != null && typeof $("#member_id").val() !== 'undefined') {
            var id = $("#member_id").val();
            get_member_info(id);
        }

        $("#member_id").on('change', function () {
            if($(this).val() == null || typeof $(this).val() === 'undefined') {
                return false;
            }
            var id = $(this).val();
            get_member_info(id);
        });

        if($("#escalation").val() == 'none') {
            $("#lt_start_date").attr('disabled', true);
            $("#days_lost").attr('disabled', true);
        } else {
            $("#lt_start_date").attr('disabled', false);
            $("#days_lost").attr('disabled', false);
        }

        $("#escalation").on('change', function () {
            if($("#escalation").val() == 'none') {
                $("#lt_start_date").attr('disabled', true);
                $("#days_lost").attr('disabled', true);
            } else {
                $("#lt_start_date").attr('disabled', false);
                $("#days_lost").attr('disabled', false);
            }
        });

        $("#causation_factor_id").on('change', function () {
            var causation = $(this).val();
            if(causation > 3) {
                $("#monthly_stats").attr('disabled', false);
            } else {
                $("#monthly_stats").attr('disabled', true);
            }

        });
    });
</script>
@endpush
