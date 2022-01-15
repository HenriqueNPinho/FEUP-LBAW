@extends('layouts.app')

@section('content')
<div class="auth-page">
    
    <form method="POST" action="{{ url('/login') }}">
        <h2>Login to your account</h2>
        {{ csrf_field() }}
        @if (\Session::has('status'))
            <span class="alert-success">
            {!! \Session::get('status') !!}
            </span>
        @endif
        <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
        @if ($errors->has('email'))
            <span class="error">
            {{ $errors->first('email') }}
            </span>
        @endif
        <input id="password" type="password" placeholder="Password" name="password" required>
        @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
        @endif

        <a href="{{ url('/forgot-password') }}" id="forgot-password">Forgot your password? Click here</a>
        <button type="submit">
            Login
        </button>
        <div class="divider"></div>
        <h4>Don't have an account?</h4>

        <a class="button" href="{{ url('/register') }}">Sign Up Here</a>
    </form>
</div>
@endsection
