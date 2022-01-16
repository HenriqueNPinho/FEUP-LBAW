@extends('layouts.app')

@section('content')
<div class="auth-page">
  <form method="POST" action="{{ url('/register/admin') }}">
      <h2>Create a new account</h2>
      {{ csrf_field() }}

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

      <input id="companyName" type="text" placeholder="Company Name" name="companyName" value="{{ old('companyName') }}" required autofocus>
      @if ($errors->has('companyName'))
        <span class="error">
            {{ $errors->first('Company Name') }}
        </span>
      @endif

      <input id="password" type="password" placeholder="Password" name="password" required>
      @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
      @endif

      <input id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required>

      <input id="is_admin" name= "is_admin" type="boolean" class="hiddenIsAdmin" value = "true" required>

      <button type="submit">
        Register
      </button>

      <div class="divider"></div>
        <h4>Already have an account?</h4>

      <a class="button" href="{{ url('/login') }}">Login</a>
  </form>
</div>
@endsection