@extends('layouts.app')

@section('content')
<script type="text/javascript" src={{ asset('js/project-page.js') }} defer></script>
<div id="project-area">
    
    @include('partials.projects-bar',['projects'=>$projects])
    @include('partials.slide-right-menu')
    
    <div id="search-results">
        @include('partials.edit-task-form')
        @include('partials.task-page')
        <div id="project-overview-opaque-cover"></div>
        <div class="search-results-header">
            <h2>Search results:</h2>
            <a href="/project/{{$project->id}}">GO BACK</a>
        </div>
        
        <div class="search-results-area">
        @each('partials.task-preview',$searchResults,'task')
        </div>
    </div>
    
</div>
@endsection
