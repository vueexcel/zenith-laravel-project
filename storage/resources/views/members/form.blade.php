<div class="col-md-6">
    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('member_no') ? ' has-error' : '' }}">
            <label for="member_no">Mbr No. *</label>
            <input type="text" class="form-control" name="member_no" placeholder="Member No." value="{{ old('member_no', $record->member_no) }}" required>

            @if ($errors->has('member_no'))
                <span class="help-block">
                    <strong>{{ $errors->first('member_no') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('surname') ? ' has-error' : '' }}">
            <label for="surname">Surname *</label>
            <input type="text" class="form-control" name="surname" placeholder="Surname" value="{{ old('surname', $record->surname) }}" required>

            @if ($errors->has('surname'))
                <span class="help-block">
                    <strong>{{ $errors->first('surname') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name">Name *</label>
            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name', $record->name) }}" required>

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('birthday') ? ' has-error' : '' }}">
            <label for="birthday">DOB *</label>
            <input type="text" class="form-control datetimepicker-single" name="birthday" id="birthday" placeholder="Birthday" value="{{ (old('birthday', $record->birthday))?date('d/m/Y', strtotime($record->birthday)):''}}" required>
            @if ($errors->has('birthday'))
                <span class="help-block">
                    <strong>{{ $errors->first('birthday') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="age" style="display: block">Age (Years)</label>
            <input type="text" class="form-control" name="age" id="age" value="" readonly="">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('gender') ? ' has-error' : '' }}">
            <label for="gender">Gender</label>
            <select class="form-control" name="gender">
                <option value="M" {{(old('gender', $record->gender)=='M') ? 'selected':''}}>Men</option>
                <option value="W" {{(old('gender', $record->gender)=='W') ? 'selected':''}}>Women</option>
            </select>
            @if ($errors->has('gender'))
                <span class="help-block">
                    <strong>{{ $errors->first('gender') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('address1') ? ' has-error' : '' }}">
            <label for="address1">Address 1</label>
            <input type="text" class="form-control" name="address1" placeholder="Address 1" value="{{ old('address1', $record->address1) }}">
            @if ($errors->has('address1'))
                <span class="help-block">
                    <strong>{{ $errors->first('address1') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('address2') ? ' has-error' : '' }}">
            <label for="address2">Address 2</label>
            <input type="text" class="form-control" name="address2" placeholder="Address 2" value="{{ old('address2', $record->address2) }}">
            @if ($errors->has('address2'))
                <span class="help-block">
                    <strong>{{ $errors->first('address2') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('address3') ? ' has-error' : '' }}">
            <label for="address3">Address 3</label>
            <input type="text" class="form-control" name="address3" placeholder="Address 3" value="{{ old('address3', $record->address3) }}">
            @if ($errors->has('address3'))
                <span class="help-block">
                    <strong>{{ $errors->first('address3') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('postal') ? ' has-error' : '' }}">
            <label for="postal">Postal Code</label>
            <input type="text" class="form-control" name="postal" placeholder="Postal Code" value="{{ old('postal', $record->postal) }}">
            @if ($errors->has('postal'))
                <span class="help-block">
                    <strong>{{ $errors->first('postal') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('phone') ? ' has-error' : '' }}">
            <label for="phone">Telephone</label>
            <input type="text" class="form-control" name="phone" placeholder="Telephone" value="{{ old('phone', $record->phone) }}">
            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('group_code') ? ' has-error' : '' }}">
            <label for="group_code">Group</label>
            <input type="text" class="form-control" name="group_code" placeholder="Group" value="{{ old('group_code', $record->group_code) }}">

            @if ($errors->has('group_code'))
                <span class="help-block">
                    <strong>{{ $errors->first('group_code') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('section') ? ' has-error' : '' }}">
            <label for="section">Section</label>
            <input type="text" class="form-control" name="section" placeholder="Section" value="{{ old('section', $record->section) }}">

            @if ($errors->has('section'))
                <span class="help-block">
                    <strong>{{ $errors->first('section') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('department') ? ' has-error' : '' }}">
            <label for="department">Department</label>
            <input type="text" class="form-control" name="department" placeholder="Department" value="{{ old('department', $record->department) }}">

            @if ($errors->has('department'))
                <span class="help-block">
                    <strong>{{ $errors->first('department') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('division') ? ' has-error' : '' }}">
            <label for="division">Division</label>
            <input type="text" class="form-control" name="division" placeholder="Division" value="{{ old('division', $record->division) }}">

            @if ($errors->has('division'))
                <span class="help-block">
                    <strong>{{ $errors->first('division') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('occupation') ? ' has-error' : '' }}">
            <label for="occupation">Occupation</label>
            <input type="text" class="form-control" name="occupation" placeholder="Occupation" value="{{ old('occupation', $record->occupation) }}">

            @if ($errors->has('occupation'))
                <span class="help-block">
                    <strong>{{ $errors->first('occupation') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('status') ? ' has-error' : '' }}">
            <label for="status">Status</label>
            <select class="form-control" name="status">
                <option value="A" {{(old('status', $record->status)=='A') ? 'selected':''}}>Active</option>
                <option value="T" {{(old('status', $record->status)=='T') ? 'selected':''}}>Terminated</option>
                <option value="X" {{(old('status', $record->status)=='X') ? 'selected':''}}>Transferred</option>
                <option value="L" {{(old('status', $record->status)=='L') ? 'selected':''}}>Leave</option>
                <option value="R" {{(old('status', $record->status)=='R') ? 'selected':''}}>Retired</option>
            </select>
            @if ($errors->has('status'))
                <span class="help-block">
                    <strong>{{ $errors->first('status') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('start_date') ? ' has-error' : '' }}">
            <label for="start_date">Start Date</label>
            <input type="text" class="form-control datetimepicker-single" name="start_date" id="start_date" placeholder="Start Date" value="{{ (old('start_date', $record->start_date))?date('d/m/Y', strtotime(old('start_date', $record->start_date))):'' }}">

            @if ($errors->has('start_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('start_date') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('leaving_date') ? ' has-error' : '' }}">
            <label for="leaving_date">Leaving Date</label>
            <input type="text" class="form-control datetimepicker-single" name="leaving_date" id="leaving_date" placeholder="Leaving Date" value="{{ (old('leaving_date', $record->leaving_date))?date('d/m/Y', strtotime(old('leaving_date', $record->leaving_date))):'' }}">

            @if ($errors->has('leaving_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('leaving_date') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="service">Service (Years)</label>
            <input type="text" class="form-control" name="service" id="service" value="" readonly="">
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('ni_number') ? ' has-error' : '' }}">
            <label for="ni_number">NI Number</label>
            <input type="text" class="form-control" name="ni_number" placeholder="NI Number" value="{{ old('ni_number', $record->ni_number) }}">
            @if ($errors->has('ni_number'))
                <span class="help-block">
                    <strong>{{ $errors->first('ni_number') }}</strong>
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
        if($("#birthday").val() != "") {
            var birthday = convert_date_string($("#birthday").val());

            var date1 = new Date(birthday);
            var date2 = new Date();
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            var age = (diffDays / 365).toFixed(2);
            $("#age").val(age);
        }

        if($("#start_date").val() != "" & $("#leaving_date").val() != "") {
            var date1 = new Date(convert_date_string($("#start_date").val()));
            var date2 = new Date(convert_date_string($("#leaving_date").val()));
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            var service = (diffDays / 365).toFixed(2);
            $("#service").val(service);

        }

        $('#birthday').datetimepicker().on('dp.change',function(e){
            var birthday = convert_date_string($(this).val());
            var date1 = new Date(birthday);
            var date2 = new Date();
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            var age = (diffDays / 365).toFixed(2);
            $("#age").val(age);
        });

        $('#start_date, #leaving_date').datetimepicker().on('dp.change',function(e){
            if($("#start_date").val() != "" & $("#leaving_date").val() != "") {
                var date1 = new Date(convert_date_string($("#start_date").val()));
                var date2 = new Date(convert_date_string($("#leaving_date").val()));
                var timeDiff = Math.abs(date2.getTime() - date1.getTime());
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
                var service = (diffDays / 365).toFixed(2);
                $("#service").val(service);

            }
        });
    });

    function convert_date_string(date)
    {
        var date_string = date.split('/');
        return date_string[2] + '-' + date_string[1] + '-' + date_string[0];
    }
</script>
@endpush