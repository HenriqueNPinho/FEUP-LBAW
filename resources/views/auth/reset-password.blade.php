@extends('layouts.app')

@section('content')
<div class="auth-page">
    <form method="POST" action="{{ url('/reset-password') }}">
        @csrf
        <h2>Reset your password</h2>
        @if ($errors->has('email'))
        <span class="error">
            {{ $errors->first('email') }}
        </span>
        @endif
        <input type="hidden" name="token" value="{{$token}}">
        <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
        @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
        @endif
        <input id="password" type="password" placeholder="Password" name="password" required>
        

        @if (\Session::has('status'))
            <span class="alert-success">
            {!! \Session::get('status') !!}
            </span>
        @endif
        <input id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required>

        <button type="submit">
        RESET PASSWORD
        </button>
    </form>
</div>
@endsection