@extends('layouts.app')

@section('content')

<div id="project-area" name="Step1">
  @include('partials.slide-right-menu')
  @include('partials.projects-bar',['projects'=>$projects])
    <div id="all-projects">
        <h2>Whats the name of the new project</h2>
        <div id="create-project">
           <input type="text" name="name" placeholder="Project Name">
        </div>
        <div id="c-button">
          <input type="button" onclick="location.href='step2';" value="Continue" />
        </div>
        <div id="creatingYP">
        <h5>Creating your project-step 1 of 3</h5>   
        </div>    
    </div>
  </div>
  
  
@endsection
