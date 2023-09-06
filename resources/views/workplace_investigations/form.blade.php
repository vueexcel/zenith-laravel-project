<div class="col-md-6">

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('site') ? ' has-error' : '' }}">
            <label for="site">Site</label>
            <select name="site" id="site" class="form-control" style="width: 100%" tabindex="1">
                <option></option>
                <option value="Burnaston" {{(old('site', $record->site)=='Burnaston') ? 'selected':''}}>Burnaston</option>
                <option value="Deeside" {{(old('site', $record->site)=='Deeside') ? 'selected':''}}>Deeside</option>
            </select>
            @if ($errors->has('site'))
                <span class="help-block">
                    <strong>{{ $errors->first('site') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('incident_type_id') ? ' has-error' : '' }}">
            <label for="incident_type_id">Incident Type *</label>
            <select name="incident_type_id" id="incident_type_id" class="form-control select2" style="width: 100%" required tabindex="2">
                <?php
                $items = App\Models\IncidentType::all();
                ?>
                @foreach($items as $item)
                    <option value="{{$item->id}}" {{(isset($record->incident_type_id) && $record->incident_type_id == $item->id )? 'selected':''}}>{{ $item->incident }}</option>
                @endforeach
            </select>
            @if ($errors->has('incident_type_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('incident_type_id') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('logged_date') ? ' has-error' : '' }}">
            <label for="logged_date">Logged Date</label>
            <input type="text" class="form-control datetimepicker-single" name="logged_date" id="logged_date" placeholder="Logged Date" value="{{ (old('logged_date', $record->logged_date))?date('d/m/Y', strtotime(old('logged_date', $record->logged_date))):date('d/m/Y') }}" tabindex="3">
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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('incident_date') ? ' has-error' : '' }}">
            <label for="incident_date">Incident Date</label>
            <input type="text" class="form-control datetimepicker-single" name="incident_date" id="incident_date" placeholder="Incident Date" value="{{ (old('incident_date', $record->incident_date))?date('d/m/Y', strtotime(old('incident_date', $record->incident_date))):'' }}" tabindex="4">
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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('reported_date') ? ' has-error' : '' }}">
            <label for="reported_date">Reported Date</label>
            <input type="text" class="form-control datetimepicker-single" name="reported_date" id="reported_date" placeholder="Reported Date" value="{{ (old('reported_date', $record->reported_date))?date('d/m/Y', strtotime(old('reported_date', $record->reported_date))):'' }}" tabindex="5">
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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('member_id') ? ' has-error' : '' }}">
            <label for="member_id">Reporting Member *</label>
            <select name="member_id" id="member_id" class="form-control select2" style="width: 100%" required tabindex="6">
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
            <input type="hidden" id="new_member_id" name="new_member_id" value="0">
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
            <label for="occupation" style="display: block">Occupation</label>
            <input type="text" class="form-control member-occupation" name="occupation" id="occupation" value="" readonly="" tabindex="-1">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->


    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="group_code" style="display: block">Group Code</label>
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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('group_code_id') ? ' has-error' : '' }}">
            <label for="group_code_id">Group Stats</label>
            <select name="group_code_id" id="group_code_id" class="form-control select2" style="width: 100%" tabindex="8">
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


</div>
<!-- /.col-md-7 -->

<div class="col-md-6">

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('incident_location') ? ' has-error' : '' }}">
            <label for="incident_location">Location</label>
            <input type="text" class="form-control" name="incident_location" id="incident_location" placeholder="Location" value="{{ old('incident_location', $record->incident_location) }}" tabindex="9">
            @if ($errors->has('incident_location'))
                <span class="help-block">
                    <strong>{{ $errors->first('incident_location') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('key_point_summary') ? ' has-error' : '' }}">
            <label for="key_point_summary">Summary</label>
            <textarea name="key_point_summary" id="key_point_summary" style="width: 100%; height: 272px;" tabindex="10">{{ old('key_point_summary', $record->key_point_summary) }}</textarea>
            @if ($errors->has('key_point_summary'))
                <span class="help-block">
                    <strong>{{ $errors->first('key_point_summary') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('work_type_id') ? ' has-error' : '' }}">
            <label for="work_type_id">Work Type</label>
            <select name="work_type_id" id="work_type_id" class="form-control select2" style="width: 100%" tabindex="11">
                <?php
                $items = App\Models\WorkType::all();
                ?>
                @foreach($items as $item)
                    <option value="{{$item->id}}" {{(isset($record->work_type_id) && $record->work_type_id == $item->id )? 'selected':''}}>{{ $item->work_type }}</option>
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

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('root_cause') ? ' has-error' : '' }}">
            <label for="root_cause">Root Cause</label>
            <textarea name="root_cause" id="root_cause" style="width: 100%; height: 272px;" tabindex="12">{{ old('root_cause', $record->root_cause) }}</textarea>
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
                $updated_at = date('Y-m-d H:i');
            }
            ?>
            <input type="text" class="form-control" name="updated_at" id="updated_at" value="{{date('d/m/Y H:i:s', strtotime($updated_at))}}" readonly="" tabindex="-1">
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
