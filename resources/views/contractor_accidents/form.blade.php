<div class="col-md-6">
    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('t_number') ? ' has-error' : '' }}">
            <label for="t_number">T Number *</label>
            <input type="text" class="form-control" id="t_number" name="t_number" placeholder="" value="{{ old('t_number', $record->t_number) }}" required tabindex="1">
            @if ($errors->has('t_number'))
                <span class="help-block">
                    <strong>{{ $errors->first('t_number') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('member_id') ? ' has-error' : '' }}">
            <label for="member_id">TCR Member No *</label>
            <select name="member_id" id="member_id" class="form-control select2" style="width: 100%" required tabindex="2">
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
            <label for="tcr_name" style="display: block">TCR Name</label>
            <input type="text" class="form-control member-name" name="tcr_name" id="tcr_name" value="" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="tcr_surname" style="display: block">TCR Surname</label>
            <input type="hidden" id="new_member_id" name="new_member_id" value="0">
            <input type="text" class="form-control member-surname" name="tcr_surname" id="tcr_surname" value="" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="tcr_group_code" style="display: block">TCR Group Code</label>
            <input type="text" class="form-control member-group-code" name="tcr_group_code" id="tcr_group_code" value="" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="tcr_department" style="display: block">TCR Department</label>
            <input type="text" class="form-control member-department" name="tcr_department" id="tcr_department" value="" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('contractor_name') ? ' has-error' : '' }}">
            <label for="contractor_name">Contractor Name *</label>
            <input type="text" class="form-control" name="contractor_name" id="contractor_name" placeholder="Contractor Name" value="{{ old('contractor_name', $record->contractor_name) }}" required tabindex="3">
            @if ($errors->has('contractor_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('contractor_name') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('contracting_company') ? ' has-error' : '' }}">
            <label for="contracting_company">Contracting Company *</label>
            <input type="text" class="form-control" name="contracting_company" id="contracting_company" placeholder="Contracting Company" value="{{ old('contracting_company', $record->contracting_company) }}" required tabindex="4">
            @if ($errors->has('contracting_company'))
                <span class="help-block">
                    <strong>{{ $errors->first('contracting_company') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('accident_date') ? ' has-error' : '' }}">
            <label for="accident_date">Accident Date *</label>
            <input type="text" class="form-control datetimepicker-single" name="accident_date" id="accident_date" placeholder="Accident Date" value="{{ old('accident_date', $record->accident_date)?date('d/m/Y', strtotime(old('accident_date', $record->accident_date))):'' }}" required tabindex="5">

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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('reported_date') ? ' has-error' : '' }}">
            <label for="reported_date">Reported Date *</label>
            <input type="text" class="form-control datetimepicker-single" name="reported_date" id="reported_date" placeholder="Report Date" value="{{ (old('reported_date', $record->reported_date))?date('d/m/Y', strtotime(old('reported_date', $record->reported_date))):'' }}" required tabindex="6">

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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('logged_date') ? ' has-error' : '' }}">
            <label for="logged_date">Logged Date *</label>
            <input type="text" class="form-control datetimepicker-single" name="logged_date" id="logged_date" placeholder="Logged Date" value="{{ (old('logged_date', $record->logged_date))?date('d/m/Y', strtotime(old('logged_date', $record->logged_date))):date('d/m/Y') }}" required tabindex="7">
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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('contractor_statement') ? ' has-error' : '' }}">
            <label for="contractor_statement">Contractor Statement</label>
            <textarea name="contractor_statement" id="contractor_statement" style="width: 100%; height: 100px;" tabindex="8">{{ old('contracting_company', $record->contractor_statement) }}</textarea>
            @if ($errors->has('contracting_company'))
                <span class="help-block">
                    <strong>{{ $errors->first('contractor_statement') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('body_part_id') ? ' has-error' : '' }}">
            <label for="body_part_id">Body Part</label>
            <select name="body_part_id" id="body_part_id" class="form-control select2" style="width: 100%" tabindex="9">
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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('injury_type_id') ? ' has-error' : '' }}">
            <label for="injury_type_id">Injury Type</label>
            <select name="injury_type_id" id="injury_type_id" class="form-control select2" style="width: 100%" tabindex="10">
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


</div>
<!-- /.col-md-7 -->

<div class="col-md-6">
    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('ohc_comment') ? ' has-error' : '' }}">
            <label for="ohc_comment">OHC Comment</label>
            <textarea name="ohc_comment" id="ohc_comment" style="width: 100%; height: 240px;" tabindex="11">{{ old('ohc_comment', $record->ohc_comment) }}</textarea>
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
            <select name="outcome_id" id="outcome_id" class="form-control select2" style="width: 100%"  tabindex="12">
                <?php
                $outcomes = App\Models\Outcome::all();
                ?>
                @foreach($outcomes as $outcome)
                    <option value="{{$outcome->id}}" {{(isset($record->outcome_id) && $record->outcome_id == $outcome->id )? 'selected':''}}>{{ $outcome->outcome }}</option>
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
            <select name="causation_factor_id" id="causation_factor_id" class="form-control select2" style="width: 100%" tabindex="13">
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
            <select class="form-control" name="escalation" id="escalation" tabindex="14">
                <option value="none" {{(old('escalation', $record->escalation)=='none') ? 'selected':''}}>None</option>
                <option value="lost_time" {{(old('escalation', $record->escalation)=='lost_time') ? 'selected':''}}>Lost Time</option>
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
            <label for="lt_start_date">LT Start Date</label>
            <input type="text" class="form-control datetimepicker-single" name="lt_start_date" id="lt_start_date" placeholder="LT Start Date" value="{{ (old('lt_start_date', $record->lt_start_date))?date('d/m/Y', strtotime(old('lt_start_date', $record->lt_start_date))):'' }}" tabindex="15">
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
            <input type="number" class="form-control" name="days_lost" id="days_lost" placeholder="Days Lost" value="{{ old('days_lost', $record->days_lost) }}" tabindex="16">
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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('report_required') ? ' has-error' : '' }}">
            <label for="wi_required">Report Required</label>
            <select class="form-control" name="report_required" id="report_required" tabindex="17">
                <option value="no" {{(old('report_required', $record->report_required)=='no') ? 'selected':''}}>NO</option>
                <option value="yes" {{(old('report_required', $record->report_required)=='yes') ? 'selected':''}}>YES</option>
            </select>
            @if ($errors->has('report_required'))
                <span class="help-block">
                    <strong>{{ $errors->first('report_required') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('report_received') ? ' has-error' : '' }}">
            <label for="report_received">Report Received</label>
            <select class="form-control" name="report_received" id="report_received" tabindex="18">
                <option value="no" {{(old('report_received', $record->report_received)=='no') ? 'selected':''}}>NO</option>
                <option value="yes" {{(old('report_received', $record->report_received)=='yes') ? 'selected':''}}>YES</option>
            </select>
            @if ($errors->has('report_received'))
                <span class="help-block">
                    <strong>{{ $errors->first('report_received') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('report_received_date') ? ' has-error' : '' }}">
            <label for="report_received_date">Report Received Date</label>
            <input type="text" class="form-control datetimepicker-single" name="report_received_date" id="report_received_date" placeholder="Report Received Date" value="{{ (old('report_received_date', $record->report_received_date))?date('d/m/Y', strtotime(old('report_received_date', $record->report_received_date))):''}}" tabindex="19">
            @if ($errors->has('report_received_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('report_received_date') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('significant_incident') ? ' has-error' : '' }}">
            <label for="significant_incident">Significant Incident</label>
            <select class="form-control" name="significant_incident" id="significant_incident" tabindex="20">
                <option value="no" {{(old('significant_incident', $record->significant_incident)=='no') ? 'selected':''}}>NO</option>
                <option value="yes" {{(old('significant_incident', $record->significant_incident)=='yes') ? 'selected':''}}>YES</option>
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
                <input type="text" class="form-control" name="user_id" id="user_id" value="{{$updated_by}}" readonly="" style="display: inline" tabindex="-1">
                <span class="input-group-btn">
                    <button class="btn btn-primary btnOpenModalHistory" type="button" data-record="{{old('id', $record->id)}}" data-record-table="contractor_accidents"><span class="fa fa-history" aria-hidden="true"></span> History</button>
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
                $updated_at = DateTime::createFromFormat('Y-m-d H:i:s' ,$record->updated_at)->format('d/m/Y H:i:s');
            } else{
                $updated_at = date('d/m/Y H:i:s');
            }
            ?>
            <input type="text" class="form-control" name="updated_at" id="updated_at" value="{{$updated_at}}" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

</div>
<!-- /.col-md-5 -->

@push('footer-scripts')
<script type="text/javascript">
    $(document).ready(function () {

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
    });
</script>
@endpush
