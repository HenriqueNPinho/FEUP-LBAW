@extends('layouts.app')
@section('title', $project->name." Search Results")
@section('content')
<script src={{ asset('js/project-page.js') }} defer></script>
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
        <div class="search-results-filters">
            <label for="all-tasks">All</label>
            <input type="checkbox" name="all-tasks" id="all-tasks-filter" checked="true">
            <label for="all-tasks">To Do</label>
            <input type="checkbox" name="to-do-tasks" id="to-do-tasks-filter">
            <label for="all-tasks">Doing</label>
            <input type="checkbox" name="doing-tasks" id="doing-tasks-filter">
            <label for="all-tasks">Done</label>
            <input type="checkbox" name="done-tasks" id="done-tasks-filter">
        </div>
        <div class="search-results-area">
            @each('partials.task-preview',$searchResults,'task')
        </div>
    </div>
    
</div>
@endsection
