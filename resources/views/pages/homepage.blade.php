@extends('layouts.app')

@section('content')
    <div id="homepage-content">
        <div class="homepage-column">
            <h2>Join Project Clinic today and improve your team's productivity</h2>
            <p>Project Clinic offers a platform that helps you organize every aspect of your team's workflow, so you can do more in less time.</p>
            <a class="button white" href="{{ url('/register') }}">Signup here</a>
        </div>
        <div class="homepage-column">
            <img src="./images/ProjectOverview.png" alt="">
        </div>
    </div>
@endsection