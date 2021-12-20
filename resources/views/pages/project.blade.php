@extends('layouts.app')

@section('content')
<div id="project-area">



  @include('partials.projects-bar',['projects'=>$projects])

  @include('partials.slide-right-menu')
    <div class="project-overview">
        <h2 id="project-title">{{$project->name}}</h2>
        <div class="boards-container">
            <div class="board">
                <h2>TO DO</h2>
                @each('partials.task-preview',$project->tasks()->where('status','Not Started')->get(),'task')
            </div>
            <div class="board">
                <h2>DOING</h2>
                @each('partials.task-preview',$project->tasks()->where('status','In Progress')->get(),'task')
            </div>
            <div class="board">
                <h2>DONE</h2>
                @each('partials.task-preview',$project->tasks()->where('status','Complete')->get(),'task')
            </div>
        </div>
    </div>
</div>

@endsection
