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
</div>

@endsection
