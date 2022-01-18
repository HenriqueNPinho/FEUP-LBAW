@extends('layouts.app')

@section('content')
<div class="auth-page">
    <form id="register-redirect">
        <h2>Are you creating an account for yourself or for your company?</h2>
        <div>
            <a class="button" href="/register">FOR ME</a>
            <h3>or</h3>
            <a  class="button" href="/register/admin">FOR A COMPANY</a>
        </div>
    </form>
    
</div>
@endsection