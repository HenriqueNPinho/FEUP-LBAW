@extends('layouts.app')

@section('content')
<div id="verify-email-page" class="auth-page">
    <h2 id="verify-your-email">A verification email was sent to: {{Auth::user()->email}}.
    Please access the link in the email to verify your account and start using Project Clinic.</h2>
    @if($errors->any())
    <h4>{{$errors->first()}}</h4>
    @endif
    @if (\Session::has('message'))
        <h4 class="green-message">{!! \Session::get('message') !!}</h4>
        
    @endif
    <form method="post" action="{{route('verification.send')}}">
        @csrf
        <button type="submit">Send Again</button>
    </form>
    
</div>
@endsection
