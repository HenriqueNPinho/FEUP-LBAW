@extends('layouts.app')

@section('content')
<div id="project-area">



  @include('partials.projects-bar')

  @include('partials.slide-right-menu')
    <div class="project-overview" data-id="{{$project->id}}">
        <div id="project-overview-opaque-cover"></div>
        @include('partials.new-task-form')
        @include('partials.task-page')
        
        <h2 id="project-title">{{$project->name}}</h2>
        <div class="boards-container">
            <div id="not-started" class="board">
                <div class="board-header">
                    <h2>TO DO</h2>
                    <img class="new-task-plus" src="/images/icons/plus-blue.png" data-id="Not Started">
                </div>
                @each('partials.task-preview',$project->tasks()->where('status','Not Started')->get(),'task')
            </div>
            <div id="started" class="board">
                <div class="board-header">
                    <h2>DOING</h2>
                    <img class="new-task-plus" src="/images/icons/plus-blue.png" data-id="In Progress">
                </div>
                @each('partials.task-preview',$project->tasks()->where('status','In Progress')->get(),'task')
            </div>
            <div id="complete" class="board">
                <div class="board-header">
                    <h2>DONE</h2>
                    <img class="new-task-plus" src="/images/icons/plus-blue.png" data-id="Complete">
                </div>
                @each('partials.task-preview',$project->tasks()->where('status','Complete')->get(),'task')
            </div>
        </div>

       
    </div>
</div>

@endsection
