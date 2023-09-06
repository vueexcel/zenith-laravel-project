<div class="col-md-6">

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('logged_date') ? ' has-error' : (old('logged_date', $record->logged_date)) ?? '' ?? ' has-error' }}">
            <label for="logged_date">Logged Date</label>
            <input type="text" class="form-control datetimepicker-single" name="logged_date" id="logged_date" placeholder="Logged Date" value="{{ (old('logged_date', $record->logged_date))?date('d/m/Y', strtotime(old('logged_date', $record->logged_date))):'' }}" required tabindex="4">
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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('reported_date') ? ' has-error' : (old('reported_date', $record->reported_date)) ?? '' ?? ' has-error' }}">
            <label for="reported_date">Reported Date</label>
            <input type="text" class="form-control datetimepicker-single" name="reported_date" id="reported_date" placeholder="Reported Date" value="{{ (old('reported_date', $record->reported_date))?date('d/m/Y', strtotime(old('reported_date', $record->reported_date))):'' }}" required tabindex="4">
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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('incident_date') ? ' has-error' : (old('incident_date', $record->incident_date)) ?? '' ?? ' has-error' }}">
            <label for="incident_date">Incident Date</label>
            <input type="text" class="form-control datetimepicker-single" name="incident_date" id="incident_date" placeholder="Incident Date" value="{{ (old('incident_date', $record->incident_date))?date('d/m/Y', strtotime(old('incident_date', $record->incident_date))):'' }}" required tabindex="4">
            @if ($errors->has('incident_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('incident_date') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

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
            <label for="name" style="display: block">First Name</label>
            <input type="text" class="form-control member-name" name="name" id="name" value="" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="group_code" style="display: block">Occupation</label>
            <input type="text" class="form-control member-occupation" name="group_code" id="group_code" value="" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="department" style="display: block">Department</label>
            <input type="text" class="form-control member-department" name="department" id="department" value="" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('group_code_id') ? ' has-error' : (old('group_code_id', $record->group_code_id)) ?? '' ?? ' has-error' }}">
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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('location') ? ' has-error' : (!empty(old('location', $record->location))) ?? '' ?? ' has-error' }}">
            <label for="location">Location</label>
            <textarea name="location" id="location" style="width: 100%; height: 235px;" tabindex="5">{{ old('location', $record->location) }}</textarea>
            @if ($errors->has('location'))
                <span class="help-block">
                    <strong>{{ $errors->first('location') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('summary') ? ' has-error' : (!empty(old('summary', $record->summary))) ?? '' ?? ' has-error' }}">
            <label for="summary">Summary</label>
            <textarea name="summary" id="summary" style="width: 100%; height: 235px;" tabindex="5">{{ old('summary', $record->summary) }}</textarea>
            @if ($errors->has('summary'))
                <span class="help-block">
                    <strong>{{ $errors->first('summary') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('root_cause') ? ' has-error' : (!empty(old('root_cause', $record->root_cause))) ?? '' ?? ' has-error' }}">
            <label for="root_cause">Root Cause</label>
            <textarea name="root_cause" id="root_cause" style="width: 100%; height: 235px;" tabindex="5">{{ old('root_cause', $record->root_cause) }}</textarea>
            @if ($errors->has('root_cause'))
                <span class="help-block">
                    <strong>{{ $errors->first('root_cause') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('significant') ? ' has-error' : (old('significant', $record->significant)) ?? '' ?? ' has-error' }}">
            <label for="significant">Significant</label>
            <select class="form-control" name="significant" id="significant" tabindex="16">
                <option value="Yes" {{(old('significant', $record->significant)=='Yes') ? 'selected':''}}>YES</option>
                <option value="No" {{(old('significant', $record->significant)=='No') ? 'selected':''}}>NO</option>
            </select>
            @if ($errors->has('significant'))
                <span class="help-block">
                    <strong>{{ $errors->first('significant') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('stop6') ? ' has-error' : (old('stop6', $record->stop6)) ?? '' ?? ' has-error' }}">
            <label for="stop6">Stop6</label>
            <select class="form-control" name="stop6" id="stop6" tabindex="16">
                <option value="Yes" {{(old('stop6', $record->stop6)=='Yes') ? 'selected':''}}>YES</option>
                <option value="No" {{(old('stop6', $record->stop6)=='No') ? 'selected':''}}>NO</option>
            </select>
            @if ($errors->has('stop6'))
                <span class="help-block">
                    <strong>{{ $errors->first('stop6') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->


    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('work_type_id') ? ' has-error' : (old('work_type_id', $record->work_type_id)) ?? '' ?? ' has-error' }}">
            <label for="work_type_id">Work Type</label>
            <select name="work_type_id" id="work_type_id" class="form-control select2" style="width: 100%" tabindex="6">
                <option></option>
                <?php
                $work_types = App\Models\WorkType::all();
                ?>
                @foreach($work_types as $work_type)
                    <option value="{{$work_type->id}}" {{(isset($record->work_type_id) && $record->work_type_id == $work_type->id )? 'selected':''}}>{{ $work_type->work_type }}</option>
                @endforeach
            </select>
            @if ($errors->has('work_type_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('work_type_id') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->
</div>
<!-- /.col-md-7 -->

<div class="col-md-6">
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
