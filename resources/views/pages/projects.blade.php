@extends('layouts.app')

@section('content')


<div id="project-area">

  @include('partials.projects-bar',['projects'=>$projects])

  @include('partials.slide-right-menu')
  

</div>

@endsection
