@extends('layouts.frontend')

{{-- Page Title --}}
@section('page-title', '')

{{-- Page Subtitle --}}
@section('page-subtitle', '')

{{-- Breadcrumbs --}}
{{--@section('breadcrumbs')
    {!! Breadcrumbs::render('login') !!}
@endsection--}}

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('guest_login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('guest_user_no') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Logged in MBR</label>

                            <div class="col-md-6">
                                <input id="guest_user_no" type="text" class="form-control" name="guest_user_no" value="{{ old('guest_user_no') }}" required autofocus readonly>

                                @if ($errors->has('guest_user_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('guest_user_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Administrator Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('member_no') ? ' has-error' : '' }}">
                            <label for="member_no" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="member_no" type="text" class="form-control" name="member_no" value="{{ old('member_no') }}" required autofocus>

                                @if ($errors->has('member_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('member_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
