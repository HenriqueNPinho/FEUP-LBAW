@extends('layouts.app')

@section('content')

<div id="project-area" name="Step2">
    @include('partials.slide-right-menu')
    @include('partials.projects-bar',['projects'=>$projects])
    <div id="all-projects">
        <div id="create-project">
        <h3>When is the delivery date </h3>
        </div>
        <div id="create-project">
            <input type="date" name="date">
        </div>

        <div id="create-project">
            <h3> <p> Give your project a description </p>  <p>(Optional)</p></h3>
    
        </div>
        <div id="create-project">
            <textarea id="description" name="description" rows="4" cols="50">
            </textarea>
         </div>
         <div id="c-button">
             <input type="button" onclick="location.href='step3';" value="Continue" />
        </div>
        <div id="create-project">
             <h5>Creating your project-step 2 of 3</h5>   
        </div>    
        
    </div>
</div>
@endsection