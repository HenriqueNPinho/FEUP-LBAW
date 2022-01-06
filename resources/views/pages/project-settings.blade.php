@extends('layouts.app')

@section('content')
<script type="text/javascript" src={{ asset('js/forum.js') }} defer></script>

<div id="project-area">
    @include('partials.projects-bar')

    @include('partials.slide-right-menu')

    <div class="project-overview" data-id="{{$project->id}}">
       <h1>{{$project->name}}</h1>
    </div>
</div>

@endsection
