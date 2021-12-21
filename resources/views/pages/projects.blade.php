@extends('layouts.app')

@section('content')


<div id="project-area">

  @include('partials.projects-bar',['projects'=>$projects])

  @include('partials.slide-right-menu')
  
  <div id="all-projects">
    @if (count($projects)>0)
    <h2>Your Projects</h2>
    <div id="project-select">
      @foreach($projects as $project)
        <a href="/project/{{$project->id}}">
          <div class="project-icon-big" data-id="{{ $project->id }}">
            <h5 class="noselect">{{ $project->name }}</h5>
          </div>
        </a>
      @endforeach
      
    </div>
    @else
    <h2>Currently you have no projects.</h2>
    @endif
  </div>

</div>

@endsection
