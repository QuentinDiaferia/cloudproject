@extends('layouts.simple')

@section('title')
    Log in
@stop

@section('content')
<form class="form-signin" role="form" method="POST" action="{{ url('/login') }}">
    <h2 class="form-signin-heading">Login</h2>
    {!! csrf_field() !!}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" autofocus required>

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" class="form-control" name="password" placeholder="Password" required>

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-lg btn-primary btn-block">
            <i class="fa fa-btn fa-sign-in"></i> Login
        </button>
    </div>
</form>
@endsection
