@extends('layouts.app')

@section('content')
<div class="auth-page">
    
    <form method="POST" action="{{ route('login') }}">
        <h2>Login to your account</h2>
        {{ csrf_field() }}

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

        <div id="remember-me">
            <h4>Remember me</h4>
            <input class="checkbox" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
        </div>
         
        <button type="submit">
            Login
        </button>

        <div class="divider"></div>
        <h4>New to Project Clinic?</h4>

        <h4>Are you creating an account for yourself?</h4>
        <a class="button" href="{{ route('register') }}">Sign Up HERE</a>

        <h4>Are you creating an account for your company?</h4>
        <a class="button" href="{{ route('registerAdministrator') }}">Sign Up your Company HERE</a>
    </form>
</div>
@endsection