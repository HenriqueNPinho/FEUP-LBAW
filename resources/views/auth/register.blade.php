@extends('layouts.app')

@section('content')
<div class="auth-page">
  <form method="POST" action="{{ url('/register') }}">
      <h2>Create a new account</h2>
      {{ csrf_field() }}

      @if (\Session::has('companyInviteToken'))
        <input type="hidden" name="companyInviteToken" value="{!! \Session::get('companyInviteToken') !!}">
        
      @endif
      <input id="name" type="text" placeholder="Name" name="name" value="{{ old('name') }}" required autofocus>
      @if ($errors->has('name'))
        <span class="error">
            {{ $errors->first('name') }}
        </span>
      @endif

      <input id="email" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
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

      <input id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required>

      <input id="is_admin" name= "is_admin" type="boolean" value = "false" class="hiddenIsAdmin" required>

      <button type="submit">
        Register
      </button>

      <div class="divider"></div>
        <h4>Already have an account?</h4>

      <a class="button" href="{{ url('/login') }}">Login</a>
  </form>
</div>
@endsection
