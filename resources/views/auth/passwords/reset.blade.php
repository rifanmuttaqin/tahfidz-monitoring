<!-- PERLU DIGANTI -->

@extends('login.indexlogin')

@section('content')

<div class="login100-pic js-tilt" data-tilt>
    <img style="width:300px;height:300px;" src="<?= URL::to('/layout_login/images/reset_password.png') ?>" alt="IMG">
</div>

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@else
<div class="alert alert-error">
    {{ session('status') }}
</div>
@endif

<form role="form" method="POST" class="login100-form validate-form" action="{{ route('password.reset') }}">
    
    {{ csrf_field() }}

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

        @if ($errors->has('email'))
        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
        @endif

        <div class="wrap-input100" data-validate = "Valid email is required: ex@abc.xyz">
        <input class="input100" type="text" name="email" placeholder="Email" id="email">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-envelope" aria-hidden="true"></i>
        </span>
        </div>

    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        @if ($errors->has('password'))
        <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
        @endif

        <div class="wrap-input100">
        <input class="input100" type="password" placeholder="Password" id="password" name="password">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
        </span>
        </div>
    </div>

    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        @if ($errors->has('password_confirmation'))
        <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
        @endif

        <div class="wrap-input100">
        <input class="input100" type="password_confirmation" placeholder="Password Confirm" id="password_confirmation" name="password_confirmation">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
        </span>
        </div>
    </div>


    <div class="container-login100-form-btn">
        <button type="submit" class="login100-form-btn">
            Reset Password
        </button>
    </div>

    <div class="clearfix"></div>

    <div class="separator">

        <div class="clearfix"></div>
        <br />

        <div>
            <p style="text-align: center;">©2020 Al Barr Software House.</p>
        </div>

    </div>
</form>
                   
@endsection