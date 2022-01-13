@extends('layouts.app')

@section('content')
<div class="auth-page">
    
    <form method="POST" action="{{ url('/login') }}">
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
    </form>
</div>
@endsection
