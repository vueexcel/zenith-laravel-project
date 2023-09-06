<div class="col-md-7">
    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name">Name *</label>
            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name', $record->name) }}" required>
            <input type="hidden" class="form-control" name="email" value="{{ old('email', $record->email) }}" required>
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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('surname') ? ' has-error' : '' }}">
            <label for="surname">Surname *</label>
            <input type="text" class="form-control" id="inputSurname" name="surname" placeholder="Surname" value="{{ old('surname', $record->surname) }}" required>

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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('member_no') ? ' has-error' : '' }}">
            <label for="inputMemberNo">Member No * / Username</label>
            <input type="text" class="form-control" id="inputMemberNo" name="member_no" placeholder="Member NO" value="{{ old('member_no', $record->member_no) }}" required>

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
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="inputConfirmPassword" name="password_confirmation" placeholder="Confirm Password">

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('is_admin') ? ' has-error' : '' }}">
            <label for="is_admin">User Permission</label>
            <select class="form-control" id="is_admin" name="is_admin">
                <option value="0" {{ old('is_admin', $record->is_admin) == 0 ? 'selected' : '' }}>General User</option>
                <option value="1" {{ old('is_admin', $record->is_admin) == 1 ? 'selected' : '' }}>Manager</option>
                <option value="2" {{ old('is_admin', $record->is_admin) == 2 ? 'selected' : '' }}>Admin</option>
            </select>

            @if ($errors->has('is_admin'))
                <span class="help-block">
                    <strong>{{ $errors->first('is_admin') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

    <div class="col-md-12">
        <div class="form-group margin-b-5 margin-t-5{{ $errors->has('is_hr') ? ' has-error' : '' }}">
            <label for="is_admin">HR User?</label>
            <select class="form-control" id="is_hr" name="is_hr">
                <option value="0" {{ old('is_hr', $record->is_hr) == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ old('is_hr', $record->is_hr) == 1 ? 'selected' : '' }}>Yes</option>
            </select>

            @if ($errors->has('is_hr'))
                <span class="help-block">
                    <strong>{{ $errors->first('is_hr') }}</strong>
                </span>
            @endif
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-md-12 -->

</div>
<!-- /.col-md-7 -->

{{-- <div class="col-md-5">

    <div class="col-xs-12">
        <div class="form-group margin-b-5 margin-t-5">
            <label for="logo_number">Logo</label><br/>
            <div class="box box-info">
                <div class="box-body no-padding">
                    <ul class="logo-number users-list clearfix">
                    @foreach (\App\Utils::getLogosNumber() as $logoNumber)
                        <li>
                            <img class="profile-user-img img-responsive img-circle" src="{{ \App\Utils::logoPath($logoNumber) }}" alt="Profile picture {{ $logoNumber }}">
                            <span class="users-list-date">
                                <input type="radio" name="logo_number" value="{{ $logoNumber }}" {{ old('logo_number', $record->logo_number) == $logoNumber ? 'checked' : '' }}>
                            </span>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="form-group{{ $errors->has('logo_file') ? ' has-error' : '' }}">
            <label for="logo_file" class="col-sm-3 control-label">Logo Upload</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" id="avatar" name="avatar">
                @if ($errors->has('logo_file'))
                    <span class="help-block">
                        <strong>{{ $errors->first('logo_file') }}</strong>
                    </span>
                @endif
            </div>

        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.col-xs-12 -->

</div> --}}
<!-- /.col-md-5 -->
