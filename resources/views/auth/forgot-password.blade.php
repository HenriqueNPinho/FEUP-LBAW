@extends('layouts.app')

@section('content')
<div class="auth-page">
    
    <form method="POST" action="{{ url('/forgot-password') }}">
        @csrf
        <h2>Reset your password</h2>
        <h4 id="reset-password-instructions">We'll send an email to the email you registered with a link to reset your password</h4>
        @if (\Session::has('status'))
            <span class="alert-success">
            {!! \Session::get('status') !!}
            </span>
        @endif
        <input id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
        <button type="submit">
            Send Recovery Email
        </button>    
    </form>
</div>
@endsection
