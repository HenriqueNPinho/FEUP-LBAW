@extends('layouts.app')

@section('content')
<div id="project-area">



  @include('partials.projects-bar')

  @include('partials.slide-right-menu')

  @foreach($project->forumPosts as $forumPost)
    <h2> Post! </h2>
    <p> Content: {{$forumPost->content}}</p>
    <p> Post Date: {{$forumPost->post_date}}</p>
  @endforeach

  <textarea id="new-post-content-input" data-project-id="{{$project->id}}" name="content" placeholder="Type a new message..." cols="50" rows="4"></textarea>
  <div id="createNewPostButton" type="button" ><h4>ADD TASK</h4></div>

</div>

@endsection
