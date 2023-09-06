<div class="col-md-6">

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('member_id') ? ' has-error' : '' }}">
            <label for="member_id">Member *</label>
            <select name="member_id" id="member_id" class="form-control select2" style="width: 100%" required>
                <option></option>
                <?php
                $members = App\Models\Member::where('is_deleted', 0)->get();
                ?>
                @foreach($members as $member)
                    <option value="{{$member->id}}" {{(isset($record->member_id) && $record->member_id == $member->id )? 'selected':''}}>
                        {{$member->member_no}}
                    </option>
                @endforeach
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
            <label for="tcr_name" style="display: block">Name</label>
            <input type="text" class="form-control member-name" name="name" id="tcr_name" value="" readonly="">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="tcr_surname" style="display: block">Surname</label>
            <input type="text" class="form-control member-surname" name="surname" id="tcr_surname" value="" readonly="">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('incident_date') ? ' has-error' : '' }}">
            <label for="incident_date">Date of Incident *</label>
            <input type="text" class="form-control datetimepicker-single" name="incident_date" placeholder="Date of Incident" value="{{ old('incident_date', $record->incident_date) }}" required>
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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('group_code_id') ? ' has-error' : '' }}">
            <label for="group_code_id">Group Stats</label>
            <select name="group_code_id" id="group_code_id" class="form-control select2" style="width: 100%">
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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('supervisor') ? ' has-error' : '' }}">
            <label for="supervisor">Supervisor</label>
            <input type="text" class="form-control" name="supervisor" placeholder="Supervisor" value="{{ old('supervisor', $record->supervisor) }}">
            @if ($errors->has('supervisor'))
                <span class="help-block">
                    <strong>{{ $errors->first('supervisor') }}</strong>
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
            <input type="text" class="form-control" name="user_id" id="user_id" value="{{$updated_by}}" readonly="">
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
            <input type="text" class="form-control" name="updated_at" id="updated_at" value="{{$updated_at}}" readonly="">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->
</div>
<!-- /.col-md-7 -->

<div class="col-md-6">

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('nature_incident') ? ' has-error' : '' }}">
            <label for="nature_incident">Nature of Incident</label>
            <textarea name="nature_incident" style="width: 100%; height: 100px;">{{ old('nature_incident', $record->nature_incident) }}</textarea>
            @if ($errors->has('nature_incident'))
                <span class="help-block">
                    <strong>{{ $errors->first('nature_incident') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('initial_countermeasure') ? ' has-error' : '' }}">
            <label for="initial_countermeasure">Initial Countermeasure</label>
            <textarea name="initial_countermeasure" style="width: 100%; height: 100px;">{{ old('initial_countermeasure', $record->initial_countermeasure) }}</textarea>
            @if ($errors->has('initial_countermeasure'))
                <span class="help-block">
                    <strong>{{ $errors->first('initial_countermeasure') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('completed') ? ' has-error' : '' }}">
            <label for="completed">Completed?</label>
            <select class="form-control" name="completed">
                <option value="yes" {{(old('completed', $record->completed)=='yes') ? 'selected':''}}>Yes</option>
                <option value="no" {{(old('completed', $record->completed)=='no') ? 'selected':''}}>No</option>
            </select>
            @if ($errors->has('completed'))
                <span class="help-block">
                    <strong>{{ $errors->first('completed') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('causation_factor_id') ? ' has-error' : '' }}">
            <label for="causation_factor_id">Causation Factor</label>
            <select name="causation_factor_id" class="form-control select2" style="width: 100%">
                <?php
                $items = App\Models\CausationFactor::all();
                ?>
                @foreach($items as $item)
                    <option value="{{$item->id}}" {{(isset($record->causation_factor_id) && $record->causation_factor_id == $item->id )? 'selected':''}}>{{ $item->causation_factor }}</option>
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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('stop_6') ? ' has-error' : '' }}">
            <label for="stop_6">Stop-6</label>
            <select class="form-control" name="stop_6">
                <option value="yes" {{(old('stop_6', $record->stop_6)=='yes') ? 'selected':''}}>Yes</option>
                <option value="no" {{(old('stop_6', $record->stop_6)=='no') ? 'selected':''}}>No</option>
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

</div>
<!-- /.col-md-5 -->

@push('footer-scripts')
<script type="text/javascript">
    $(document).ready(function () {

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