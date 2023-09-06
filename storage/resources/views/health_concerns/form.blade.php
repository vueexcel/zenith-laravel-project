<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">DETAILS</a></li>
        <li><a href="#tab_2" data-toggle="tab" tabindex="23">REVIEWS</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('member_id') ? ' has-error' : '' }}">
                            <label for="member_id">Member *</label>
                            <select name="member_id" id="member_id" class="form-control select2" style="width: 100%" required tabindex="1" autofocus>
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
                            <input type="text" class="form-control member-surname" name="surname" id="tcr_surname" value="" readonly="" tabIndex="-1">
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5">
                            <label for="tcr_name" style="display: block">Name</label>
                            <input type="text" class="form-control member-name" name="name" id="tcr_name" value="" readonly="" tabIndex="-1">
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5">
                            <label for="occupation" style="display: block">Occupation</label>
                            <input type="text" class="form-control member-occupation" name="occupation" id="occupation" value="" readonly="" tabIndex="-1">
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5">
                            <label for="tcr_group_code" style="display: block">Group Code</label>
                            <input type="text" class="form-control member-group-code" name="group_code" id="tcr_group_code" value="" readonly="" tabIndex="-1">
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5">
                            <label for="section" style="display: block">Section</label>
                            <input type="text" class="form-control member-section" name="section" id="section" value="" readonly="" tabIndex="-1">
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5">
                            <label for="tcr_department" style="display: block">Department</label>
                            <input type="text" class="form-control member-department" name="department" id="tcr_department" value="" readonly="" tabIndex="-1">
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5">
                            <label for="birthday" style="display: block">Division</label>
                            <input type="text" class="form-control member-division" name="division" id="division" value="" readonly="" tabIndex="-1">
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('supervisor_id') ? ' has-error' : '' }}">
                            <label for="supervisor">Supervisor</label>
                            <input type="text" class="form-control member-supervisor" name="supervisor" id="supervisor" value="" readonly="" tabIndex="-1">

                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('logged_date') ? ' has-error' : '' }}">
                            <label for="logged_date">Logged Date</label>
                            <input type="text" class="form-control datetimepicker-single" name="logged_date" id="logged_date" placeholder="Logged Date" value="{{ (old('logged_date', $record->logged_date))?date('d/m/Y', strtotime(old('logged_date', $record->logged_date))):date('d/m/Y') }}" tabindex="2">
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
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('level1_raised_date') ? ' has-error' : '' }}">
                            <label for="level1_raised_date">Level 1 - Kanban Raised Date</label>
                            <input type="text" class="form-control datetimepicker-single" tabindex="3" name="level1_raised_date" id="level1_raised_date" placeholder="" value="{{ (old('level1_raised_date', $record->level1_raised_date))?date('d/m/Y', strtotime(old('level1_raised_date', $record->level1_raised_date))):'' }}">
                            @if ($errors->has('level1_raised_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('level1_raised_date') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->
                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('ohc_appointment') ? ' has-error' : (old('ohc_appointment', $record->ohc_appointment)) ? '' : ' has-error' }}">
                            <label for="ohc_appointment">OHC Appointment</label>
                            <input type="text" class="form-control datetimepicker-single" name="ohc_appointment" value="{{ (old('ohc_appointment', $record->ohc_appointment))?date('d/m/Y', strtotime(old('ohc_appointment', $record->ohc_appointment))):'' }}" tabindex="4">
                            @if ($errors->has('ohc_appointment'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ohc_appointment') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('concern_date') ? ' has-error' : '' }}">
                            <label for="concern_date">Date 1st Noted by MBR</label>
                            <input type="text" class="form-control datetimepicker-single" name="concern_date" placeholder="Concern Date" value="{{ (old('concern_date', $record->concern_date))?date('d/m/Y', strtotime(old('concern_date', $record->concern_date))):'' }}" tabindex="5">
                            @if ($errors->has('concern_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('concern_date') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('body_part_id') ? ' has-error' : (old('body_part_id', $record->body_part_id)) ? '' : ' has-error' }}">
                            <label for="body_part_id">Body Part</label>
                            <select name="body_part_id" id="body_part_id" class="form-control select2" style="width: 100%" tabindex="7">
                                <option></option>
                                <?php
                                $items = App\Models\BodyPart::all();
                                ?>
                                @foreach($items as $item)
                                    <option value="{{$item->id}}" {{(old('body_part_id', $record->body_part_id) == $item->id )? 'selected':''}}>{{ $item->body_part }}</option>
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
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('symptoms') ? ' has-error' : (old('symptoms', $record->symptoms)) ? '' : ' has-error' }}">
                            <label for="symptoms">Symptoms</label>
                            <textarea name="symptoms" id="symptoms" style="width: 100%; height: 100px; border-color: {{(old('symptoms', $record->symptoms))?'#000':'#f00'}}" tabindex="8">{{ old('symptoms', $record->symptoms) }}</textarea>
                            @if ($errors->has('symptoms'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('symptoms') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-6">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('gmir') ? ' has-error' : '' }}">
                            <label for="gmir">GMIR</label>
                            <select class="form-control" name="gmir" id="gmir" tabindex="9">
                                <option value="No" {{(old('gmir', $record->gmir)=='Work') ? 'selected':''}}>No</option>
                                <option value="GMIR_Full" {{(old('gmir', $record->gmir)=='GMIR_Full') ? 'selected':''}}>GMIR - Full</option>
                                <option value="GMIR_Part" {{(old('gmir', $record->gmir)=='GMIR_Part') ? 'selected':''}}>GMIR - Part</option>
                            </select>
                            @if ($errors->has('gmir'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gmir') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-6">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('riddor') ? ' has-error' : '' }}">
                            <label for="riddor">RIDDOR (Non-Acc)</label>
                            <select class="form-control" name="riddor" id="riddor" tabindex="10">
                                <option value="No" {{(old('riddor', $record->riddor)=='No') ? 'selected':''}}>No</option>
                                <option value="Restricted_7" {{(old('riddor', $record->riddor)=='Restricted_7') ? 'selected':''}}>Restricted > 7days</option>
                                <option value="Absent_7" {{(old('riddor', $record->riddor)=='Absent_7') ? 'selected':''}}>Absent > 7days</option>
                                <option value="Industrial_disease" {{(old('riddor', $record->riddor)=='Industrial_disease') ? 'selected':''}}>Industrial Disease</option>
                            </select>
                            @if ($errors->has('riddor'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('riddor') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                </div>
                <!-- /.col-md-6 -->

                <div class="col-md-6">

                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('repeat') ? ' has-error' : '' }}">
                            <label for="repeat">Repeat</label>
                            <select class="form-control" name="repeat" id="repeat" tabindex="11">
                                <option value="No" {{(old('repeat', $record->repeat)=='No') ? 'selected':''}}>No</option>
                                <option value="Yes" {{(old('repeat', $record->repeat)=='Yes') ? 'selected':''}}>Yes</option>
                            </select>
                            @if ($errors->has('repeat'))
                                <span class="help-block">
                                <strong>{{ $errors->first('repeat') }}</strong>
                            </span>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('origin') ? ' has-error' : (old('origin', $record->origin)) ? '' : ' has-error' }}">
                            <label for="origin">Origin</label>
                            <select class="form-control" name="origin" id="origin" tabindex="12">
                                <option></option>
                                <option value="Non-Work" {{(old('origin', $record->origin)=='Non-Work') ? 'selected':''}}>Non-Work</option>
                                <option value="Work" {{(old('origin', $record->origin)=='Work') ? 'selected':''}}>Work</option>
                            </select>
                            @if ($errors->has('origin'))
                                <span class="help-block">
                                <strong>{{ $errors->first('origin') }}</strong>
                            </span>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('origin_type_id') ? ' has-error' : (old('origin_type_id', $record->origin_type_id)) ? '' : ' has-error' }}">
                            <label for="origin_type_id">Origin Type</label>
                            <select name="origin_type_id" id="origin_type_id" class="form-control select2" style="width: 100%" tabindex="13">
                                <option></option>
                                <?php
                                $items = App\Models\OriginType::all();
                                ?>
                                @foreach($items as $item)
                                    <option value="{{$item->id}}" {{(old('origin_type_id', $record->origin_type_id) == $item->id )? 'selected':''}}>{{ $item->origin_type }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('origin_type_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('origin_type_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('wi_required') ? ' has-error' : '' }}">
                            <label for="wi_required">WPI Required</label>
                            <select class="form-control" name="wi_required" id="wi_required" tabindex="14">
                                <option value="No" {{(old('wi_required', $record->wi_required)=='No') ? 'selected':''}}>No</option>
                                <option value="Yes" {{(old('wi_required', $record->wi_required)=='Yes') ? 'selected':''}}>Yes</option>
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
                            <label for="wi_part_1_received">WPI PT1 Received</label>
                            <input type="text" class="form-control datetimepicker-single" name="wi_part_1_received" id="wi_part_1_received" value="{{ (old('wi_part_1_received', $record->wi_part_1_received))?date('d/m/Y', strtotime(old('wi_part_1_received', $record->wi_part_1_received))):'' }}" tabindex="15">
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
                            <label for="wi_part_2_received">WPI PT2 Received</label>
                            <input type="text" class="form-control datetimepicker-single" name="wi_part_2_received" id="wi_part_2_received" value="{{ (old('wi_part_2_received', $record->wi_part_2_received))?date('d/m/Y', strtotime(old('wi_part_2_received', $record->wi_part_2_received))):'' }}" tabindex="16">
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
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('mss_causation_id') ? ' has-error' : '' }}">
                            <label for="mss_causation_id">MSS Causation</label>
                            <select name="mss_causation_id" class="form-control select2" style="width: 100%" tabindex="17" id="mss_causation_id" disabled>
                                <option></option>
                                <?php
                                $items = App\Models\MssCausation::all();
                                ?>
                                @foreach($items as $item)
                                    <option value="{{$item->id}}" {{(isset($record->mss_causation_id) && $record->mss_causation_id == $item->id)? 'selected':''}}>{{ $item->mss_number }} - {{ $item->mss_causation }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('mss_causation_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mss_causation_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-6">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('lost_time_mss') ? ' has-error' : '' }}">
                            <label for="lost_time_mss">Lost Time MSS</label>
                            <select class="form-control" name="lost_time_mss" id="lost_time_mss" tabindex="18" disabled>
                                <option value="No" {{(old('lost_time_mss', $record->lost_time_mss)=='No') ? 'selected':''}}>No</option>
                                <option value="Yes" {{(old('lost_time_mss', $record->lost_time_mss)=='Yes') ? 'selected':''}}>Yes</option>
                                <option value="Under_Investigation" {{(old('lost_time_mss', $record->lost_time_mss)=='Under_Investigation') ? 'selected':''}}>Under Investigation</option>
                                <option value="N/A" {{(old('lost_time_mss', $record->lost_time_mss)=='N/A') ? 'selected':''}}>N/A</option>
                            </select>
                            @if ($errors->has('lost_time_mss'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lost_time_mss') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-6">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('lt_start_date') ? ' has-error' : '' }}">
                            <label for="lt_start_date">Absence Start</label>
                            <input type="text" class="form-control datetimepicker-single" name="lt_start_date" id="lt_start_date" value="{{ (old('lt_start_date', $record->lt_start_date))?date('d/m/Y', strtotime(old('lt_start_date', $record->lt_start_date))):'' }}" tabindex="19" disabled>
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
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('group_code_id') ? ' has-error' : (old('group_code_id', $record->group_code_id)) ? '' : ' has-error' }}">
                            <label for="group_code_id">Group Stats</label>
                            <select name="group_code_id" id="group_code_id" class="form-control select2" style="width: 100%" tabindex="20">
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
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('initial_advice') ? ' has-error' : '' }}">
                            <label for="initial_advice">Current Advice</label>
                            <textarea name="initial_advice" id="initial_advice" style="width: 100%; height: 305px;" tabindex="21">{{ old('initial_advice', $record->initial_advice) }}</textarea>
                            @if ($errors->has('initial_advice'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('initial_advice') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('current_level') ? ' has-error' : (old('current_level', $record->current_level)) ? '' : ' has-error' }}">
                            <label for="current_level">Current Level</label>
                            <select name="current_level" id="current_level" class="form-control" style="width: 100%" tabindex="22">
                                <option></option>
                                <option value="Level 1" {{(isset($record->current_level) && $record->current_level == "Level 1" )? 'selected':''}}>Level 1</option>
                                <option value="Level 2" {{(isset($record->current_level) && $record->current_level == "Level 2" )? 'selected':''}}>Level 2</option>
                                <option value="Level 3" {{(isset($record->current_level) && $record->current_level == "Level 3" )? 'selected':''}}>Level 3</option>
                                <option value="Level 4 Not Placed" {{(isset($record->current_level) && $record->current_level == "Level 4 Not Placed" )? 'selected':''}}>Level 4 Not Placed</option>
                                <option value="Level 1 Discharged" {{(isset($record->current_level) && $record->current_level == "Level 1 Discharged" )? 'selected':''}}>Level 1 Discharged</option>
                                <option value="Level 2 Discharged" {{(isset($record->current_level) && $record->current_level == "Level 2 Discharged" )? 'selected':''}}>Level 2 Discharged</option>
                                <option value="Level 3 Discharged" {{(isset($record->current_level) && $record->current_level == "Level 3 Discharged" )? 'selected':''}}>Level 3 Discharged</option>
                                <option value="Level 4 Discharged" {{(isset($record->current_level) && $record->current_level == "Level 4 Discharged" )? 'selected':''}}>Level 4 Discharged</option>
                                <option value="Level 4 Placed" {{(isset($record->current_level) && $record->current_level == "Level 4 Placed" )? 'selected':''}}>Level 4 Placed</option>
                            </select>
                            @if ($errors->has('current_level'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current_level') }}</strong>
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
                                <input type="text" class="form-control" name="user_id" id="user_id" value="{{$updated_by}}" readonly="">
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
                <!-- /.col-md-6 -->
            </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
            <div class="row">
                <div class="col-md-7">
                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('outcome') ? ' has-error' : '' }}">
                            <label for="outcome">Outcome</label>
                            <select name="outcome" id="outcome" class="form-control" style="width: 100%" tabindex="24">
                                <option></option>
                                <option value="Level 1" {{(isset($record->outcome) && $record->outcome == "Level 1" )? 'selected':''}}>Level 1</option>
                                <option value="Level 2" {{(isset($record->outcome) && $record->outcome == "Level 2" )? 'selected':''}}>Level 2</option>
                                <option value="Level 3" {{(isset($record->outcome) && $record->outcome == "Level 3" )? 'selected':''}}>Level 3</option>
                                <option value="Level 4 Not Placed" {{(isset($record->outcome) && $record->outcome == "Level 4 Not Placed" )? 'selected':''}}>Level 4 Not Placed</option>
                                <option value="Level 1 Discharged" {{(isset($record->outcome) && $record->outcome == "Level 1 Discharged" )? 'selected':''}}>Level 1 Discharged</option>
                                <option value="Level 2 Discharged" {{(isset($record->outcome) && $record->outcome == "Level 2 Discharged" )? 'selected':''}}>Level 2 Discharged</option>
                                <option value="Level 3 Discharged" {{(isset($record->outcome) && $record->outcome == "Level 3 Discharged" )? 'selected':''}}>Level 3 Discharged</option>
                                <option value="Level 4 Discharged" {{(isset($record->outcome) && $record->outcome == "Level 4 Discharged" )? 'selected':''}}>Level 4 Discharged</option>
                                <option value="Level 4 Placed" {{(isset($record->outcome) && $record->outcome == "Level 4 Placed" )? 'selected':''}}>Level 4 Placed</option>
                            </select>
                            @if ($errors->has('outcome'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('outcome') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <?php
                        $next_steps = 1;
                    ?>

                    <?php
                    if((isset($record->next_steps_9) && $record->next_steps_9 != "") || (isset($record->next_steps_9_date) && $record->next_steps_9_date != "")) {
                        $next_step9 = "display:block";
                        $next_steps ++;
                    } else {
                        $next_step9 = "display:none";
                    }
                    ?>
                    <div class="col-md-12" id="next_step_9" style="{{$next_step9}}">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('next_steps_9') ? ' has-error' : '' }}">
                            <label for="next_steps_9_date">Next Step 9</label>&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-xs remove-step" data-step="9">X</button>
                            <select name="next_steps_9" id="next_steps_9" class="form-control select2 next-step" style="width: 100%" tabindex="26">
                                <option></option>
                                <?php
                                $items = App\Models\NextStep::all();
                                ?>
                                @foreach($items as $item)
                                    <option value="{{$item->id}}" {{(isset($record->next_steps_9) && $record->next_steps_9 == $item->id )? 'selected':''}}>{{ $item->next_step }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <?php
                    if((isset($record->next_steps_8) && $record->next_steps_8 != "") || (isset($record->next_steps_8_date) && $record->next_steps_8_date != "")) {
                        $next_step8 = "display:block";
                        $next_steps ++;
                    } else {
                        $next_step8 = "display:none";
                    }
                    ?>
                    <div class="col-md-12" id="next_step_8" style="{{$next_step8}}">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('next_steps_8') ? ' has-error' : '' }}">
                            <label for="next_steps_8_date">Next Step 8</label>&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-xs remove-step" data-step="8">X</button>
                            <select name="next_steps_8" id="next_steps_8" class="form-control select2 next-step" style="width: 100%" tabindex="28">
                                <option></option>
                                <?php
                                $items = App\Models\NextStep::all();
                                ?>
                                @foreach($items as $item)
                                    <option value="{{$item->id}}" {{(isset($record->next_steps_8) && $record->next_steps_8 == $item->id )? 'selected':''}}>{{ $item->next_step }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <?php
                    if((isset($record->next_steps_7) && $record->next_steps_7 != "") || (isset($record->next_steps_7_date) && $record->next_steps_7_date != "")) {
                        $next_step7 = "display:block";
                        $next_steps ++;
                    } else {
                        $next_step7 = "display:none";
                    }
                    ?>
                    <div class="col-md-12" id="next_step_7" style="{{$next_step7}}">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('next_steps_7') ? ' has-error' : '' }}">
                            <label for="next_steps_7_date">Next Step 7</label>&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-xs remove-step" data-step="7">X</button>
                            <select name="next_steps_7" id="next_steps_7" class="form-control select2 next-step" style="width: 100%" tabindex="30">
                                <option></option>
                                <?php
                                $items = App\Models\NextStep::all();
                                ?>
                                @foreach($items as $item)
                                    <option value="{{$item->id}}" {{(isset($record->next_steps_7) && $record->next_steps_7 == $item->id )? 'selected':''}}>{{ $item->next_step }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <?php
                    if((isset($record->next_steps_6) && $record->next_steps_6 != "") || (isset($record->next_steps_6_date) && $record->next_steps_6_date != "")) {
                        $next_step6 = "display:block";
                        $next_steps ++;
                    } else {
                        $next_step6 = "display:none";
                    }
                    ?>
                    <div class="col-md-12" id="next_step_6" style="{{$next_step6}}">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('next_steps_6') ? ' has-error' : '' }}">
                            <label for="next_steps_6_date">Next Step 6</label>&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-xs remove-step" data-step="6">X</button>
                            <select name="next_steps_6" id="next_steps_6" class="form-control select2 next-step" style="width: 100%" tabindex="32">
                                <option></option>
                                <?php
                                $items = App\Models\NextStep::all();
                                ?>
                                @foreach($items as $item)
                                    <option value="{{$item->id}}" {{(isset($record->next_steps_6) && $record->next_steps_6 == $item->id )? 'selected':''}}>{{ $item->next_step }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <?php
                    if((isset($record->next_steps_5) && $record->next_steps_5 != "") || (isset($record->next_steps_5_date) && $record->next_steps_5_date != "")) {
                        $next_step5 = "display:block";
                        $next_steps ++;
                    } else {
                        $next_step5 = "display:none";
                    }
                    ?>
                    <div class="col-md-12" id="next_step_5" style="{{$next_step5}}">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('next_steps_5') ? ' has-error' : '' }}">
                            <label for="next_steps_5_date">Next Step 5</label>&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-xs remove-step" data-step="5">X</button>
                            <select name="next_steps_5" id="next_steps_5" class="form-control select2 next-step" style="width: 100%">
                                <option></option>
                                <?php
                                $items = App\Models\NextStep::all();
                                ?>
                                @foreach($items as $item)
                                    <option value="{{$item->id}}" {{(isset($record->next_steps_5) && $record->next_steps_5 == $item->id )? 'selected':''}}>{{ $item->next_step }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <?php
                    if((isset($record->next_steps_4) && $record->next_steps_4 != "") || (isset($record->next_steps_4_date) && $record->next_steps_4_date != "")) {
                        $next_step4 = "display:block";
                        $next_steps ++;
                    } else {
                        $next_step4 = "display:none";
                    }
                    ?>
                    <div class="col-md-12" id="next_step_4" style="{{$next_step4}}">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('next_steps_4') ? ' has-error' : '' }}">
                            <label for="next_steps_4_date">Next Step 4</label>&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-xs remove-step" data-step="4">X</button>
                            <select name="next_steps_4" id="next_steps_4" class="form-control select2 next-step" style="width: 100%">
                                <option></option>
                                <?php
                                $items = App\Models\NextStep::all();
                                ?>
                                @foreach($items as $item)
                                    <option value="{{$item->id}}" {{(isset($record->next_steps_4) && $record->next_steps_4 == $item->id )? 'selected':''}}>{{ $item->next_step }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <?php
                    if((isset($record->next_steps_3) && $record->next_steps_3 != "") || (isset($record->next_steps_3_date) && $record->next_steps_3_date != "")) {
                        $next_step3 = "display:block";
                        $next_steps ++;
                    } else {
                        $next_step3 = "display:none";
                    }
                    ?>
                    <div class="col-md-12" id="next_step_3" style="{{$next_step3}}">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('next_steps_3') ? ' has-error' : '' }}">
                            <label for="next_steps_3_date">Next Step 3</label>&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-xs remove-step" data-step="3">X</button>
                            <select name="next_steps_3" id="next_steps_3" class="form-control select2 next-step" style="width: 100%">
                                <option></option>
                                <?php
                                $items = App\Models\NextStep::all();
                                ?>
                                @foreach($items as $item)
                                    <option value="{{$item->id}}" {{(isset($record->next_steps_3) && $record->next_steps_3 == $item->id )? 'selected':''}}>{{ $item->next_step }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <?php
                    if((isset($record->next_steps_2) && $record->next_steps_2 != "") || (isset($record->next_steps_2_date) && $record->next_steps_2_date != "")) {
                        $next_step2 = "display:block";
                        $next_steps ++;
                    } else {
                        $next_step2 = "display:none";
                    }
                    ?>
                    <div class="col-md-12" id="next_step_2" style="{{$next_step2}}">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('next_steps_2') ? ' has-error' : '' }}">
                            <label for="next_steps_2_date">Next Step 2</label>&nbsp;&nbsp;<button type="button" class="btn btn-danger btn-xs remove-step" data-step="2">X</button>
                            <select name="next_steps_2" id="next_steps_2" class="form-control select2 next-step" style="width: 100%">
                                <option value=""></option>
                                <?php
                                $items = App\Models\NextStep::all();
                                ?>
                                @foreach($items as $item)
                                    <option value="{{$item->id}}" {{(isset($record->next_steps_2) && $record->next_steps_2 == $item->id )? 'selected':''}}>{{ $item->next_step }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-md-12" id="next_step_1">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('next_steps_1') ? ' has-error' : '' }}">
                            <label for="next_steps_1_date">Next Step 1</label>
                            <select name="next_steps_1" id="next_steps_1" class="form-control select2 next-step" style="width: 100%"  tabindex="28">
                                <option value=""></option>
                                <?php
                                $items = App\Models\NextStep::all();
                                ?>
                                @foreach($items as $item)
                                    <option value="{{$item->id}}" {{(isset($record->next_steps_1) && $record->next_steps_1 == $item->id )? 'selected':''}}>{{ $item->next_step }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <input type="hidden" id="next_steps" value="{{$next_steps}}">
                    <div class="col-md-12">
                        <button type="button" id="add_new_step" class="btn btn-danger btn-sm pull-right"> + add new step</button>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('ramp_up') ? ' has-error' : '' }}">
                            <label for="ramp_up">Ramp Up</label>
                            <select name="ramp_up" id="ramp_up" class="form-control select2" style="width: 100%" tabindex="25">
                                <?php
                                $items = App\Models\RampUp::all();
                                ?>
                                @foreach($items as $item)
                                    <option value="{{$item->ramp_up}}" {{(isset($record->ramp_up) && $record->ramp_up == $item->ramp_up )? 'selected':''}}>{{ $item->ramp_up }}</option>
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

                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('fully_fit') ? ' has-error' : '' }}">
                            <label for="fully_fit">Ramp Up Completion Date</label>
                            <input type="text" class="form-control datetimepicker-single" name="fully_fit" id="fully_fit" placeholder="Fully Fit Date" value="{{ (old('fully_fit', $record->fully_fit))?date('d/m/Y', strtotime(old('fully_fit', $record->fully_fit))):'' }}" tabindex="26">
                            @if ($errors->has('fully_fit'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fully_fit') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->

                    <div class="col-md-12">
                        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('discharge_date') ? ' has-error' : '' }}">
                            <label for="discharge_date">Discharge Date</label>
                            <input type="text" class="form-control datetimepicker-single" tabindex="27" name="discharge_date" id="discharge_date" placeholder="Discharge Date" value="{{ (old('discharge_date', $record->discharge_date))?date('d/m/Y', strtotime(old('discharge_date', $record->discharge_date))):'' }}">
                            @if ($errors->has('discharge_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('discharge_date') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col-md-12 -->
                </div>

            </div>
        </div>
        <!-- /.tab-pane -->

    </div>
    <!-- /.tab-content -->
</div>

@push('footer-scripts')
<script type="text/javascript">
    $(document).ready(function () {

        $(".level_1_discharged").val($('#logged_date').val());

        if($("#next_steps").val() > 8) {
            $("#add_new_step").attr('disabled', true);
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

        check_origin();

        change_current_level($("#outcome").val());

        $("#group_code_id").select2({
            tags:true
        });

        $('#group_code_id').on('select2:select', function (e) {
            var data = e.params.data;
            var group_code = data.text;

            $.ajax({
                url: "/group_code/add",
                method: "GET",
                data: {group_code:group_code},
                statusCode: {
                    401: function () {
                        console.log('Login expired. Please sign in again.')
                    }
                },
                success: function (res) {
                    console.log("Successfully Added");
                }
            });
        });

        if($("#origin").val() == "Work" && $("#origin_type_id").val() == "1") {
            $("#group_code_id").prop("disabled", false);
        } else {
            $("#group_code_id").prop("disabled", true);
        }

        $("#origin").on('change', function () {
            check_origin();
            check_wi_required();

            if($("#origin").val() == "Work" && $("#origin_type_id").val() == "1") {
                $("#group_code_id").prop("disabled", false);
            } else {
                $("#group_code_id").prop("disabled", true);
            }

        });

        $("#wi_required").on('change', function () {
            check_wi_required();
        });

        var origin_type = $("#origin_type_id option:selected").text();

        if(origin_type == 'MSS') {
            $("#mss_causation_id").attr('disabled', false);
            $("#lost_time_mss").attr('disabled', false);
        } else {
            $("#mss_causation_id").attr('disabled', true);
            $("#lost_time_mss").attr('disabled', true);
        }

        $("#origin_type_id").on('change', function () {
            var origin_type = $("#origin_type_id option:selected").text();
            if(origin_type == 'MSS') {
                $("#mss_causation_id").attr('disabled', false);
                $("#lost_time_mss").attr('disabled', false);
            } else {
                $("#mss_causation_id").attr('disabled', true);
                $("#lost_time_mss").attr('disabled', true);
            }

            if($("#origin").val() == "Work" && $("#origin_type_id").val() == "1") {
                $("#group_code_id").prop("disabled", false);
            } else {
                $("#group_code_id").prop("disabled", true);
            }
        });

        $('#logged_date').datetimepicker().on('dp.change',function(e){
            $(".level_1_discharged").val($(this).val());
        });

        $("#current_level").on('change', function() {
            var current_level = $(this).val();
            change_current_level(current_level);
        });

        $("#outcome").on('change', function() {
            var current_level = $(this).val();
            change_current_level(current_level);
        });

        $("#lost_time_mss").on('change', function () {
            if($(this).val() == "Yes")
                $("#lt_start_date").attr('disabled', false);
            else
                $("#lt_start_date").attr('disabled', true);

        });

        $("#add_new_step").on('click', function () {
            var next_step = $("#next_steps").val();
            if(next_step > 8) {
                return false;
            }
            next_step ++;
            $("#next_step_" + next_step).show();
            $("#next_steps").val(next_step);
        });


        $(".next-step").select2({
            tags:true
        });

        $('.next-step').on('select2:select', function (e) {
            var data = e.params.data;
            var next_step = data.text;

            $.ajax({
                url: "/next_step/add",
                method: "GET",
                data: {next_step:next_step},
                statusCode: {
                    401: function () {
                        console.log('Login expired. Please sign in again.')
                    }
                },
                success: function (res) {
                    if(res.result != "fail") {
                        var new_option = "<option value='"+res.result.id+"'>"+res.result.next_step+"</option>";
                        $(".next-step").append(new_option);
                    }

                }
            });
        });


        $(document).on('change', '#ramp_up', function () {
            get_fully_fit_date();
        });

        $('#rtw_date_revised').datetimepicker().on('dp.change',function(e){
            get_fully_fit_date();
        });

        $(document).on('click', '.remove-step', function () {
            var step = $(this).data('step');
            var next_step;
            next_step = step - 1;
            $("#next_steps").val(next_step);
            $("#next_step_"+step).hide();
            $("#next_steps_"+step).val('');
            $("#next_steps_"+step).select2();

            for(var i=step; i<10; i++){
                $("#next_step_"+i).hide();
                $("#next_steps_"+i).val('');
                $("#next_steps_"+i).select2();
            }
        });


    });

    function check_origin()
    {
        if($("#origin").val() == 'Non-Work' || $("#origin").val() == "") {
            $("#wi_required").val('No');
            check_wi_required();
        } else {
            $("#wi_required").val('Yes');
        }
    }

    function check_wi_required()
    {
        if($("#wi_required").val() == 'No') {
            $("#wi_part_1_received").attr('disabled', true);
            $("#wi_part_2_received").attr('disabled', true);
        } else {
            $("#wi_part_1_received").attr('disabled', false);
            $("#wi_part_2_received").attr('disabled', false);
        }
    }


    function get_fully_fit_date()
    {
        var ramp_up = $("#ramp_up").val();
        var rtw_date_revised = $("#rtw_date_revised").val();
        if(rtw_date_revised == '' || rtw_date_revised == null) {
            return false;
        }

        $.ajax({
            url: "/get_fully_fit_date",
            method: "GET",
            data: {ramp_up:ramp_up, placement_date:rtw_date_revised},
            statusCode: {
                401: function () {
                    console.log('Login expired. Please sign in again.')
                }
            },
            success: function (data) {
                $("#fully_fit").val(data);
            }
        });
    }

    function change_current_level(level)
    {
        $("#outcome").val(level);
        $("#current_level").val(level);
    }

</script>
@endpush
