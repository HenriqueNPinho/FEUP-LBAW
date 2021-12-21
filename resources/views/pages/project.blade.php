@extends('layouts.app')

@section('content')
<div id="project-area">



  @include('partials.projects-bar',['projects'=>$projects])

  @include('partials.slide-right-menu')
    <div class="project-overview" data-id="{{$project->id}}">
        <div id="project-overview-opaque-cover"></div>
        <div id="new-task-form">
            <div id="new-task-form-header">
                <h2>Create a new task</h2>
                <img id="close-task-form" src="/images/icons/close.png" alt="">
                
            </div>
            
            <input type="text" name="name" placeholder="Task Name">
            <textarea name="description" placeholder="Description of your task" cols="40" rows="5"></textarea>
            <div id="member-selection">
                <h4>ASSIGN MEMBERS TO THE TASK</h4>
                @foreach ($project->members as $member)
                <div id="member-selection-option">
                    <input type = "checkbox" id = "{{$member->id}}" name = "{{$member->name}}" >
                    <label for = "{{$member->id}}"> {{$member->name}}</label>
                </div>
                @endforeach
            </div>
            <div id="createNewTaskButton" class="button"><h4>ADD TASK</h4></div>
        </div>
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
