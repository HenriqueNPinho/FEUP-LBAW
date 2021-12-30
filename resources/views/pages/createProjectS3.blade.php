@extends('layouts.app')

@section('content')

<div id="project-area" name="Step3">
    @include('partials.slide-right-menu')
    @include('partials.projects-bar',['projects'=>$projects])
    <div id="all-projects"> 
        <h2>Assign a project coordinator</h2>   
        <h5>Invite them via e-mail</h5>
        <div id="create-project">
            <input type="text" name="project-coordinator" placeholder="eg:email@example.com">
         </div>
         <h2>Assign members to your team</h2>   
        <h5>Invite them via e-mail</h5>
        <div id="create-project">
            <textarea id= "project-members" name="project-members"
            rows="5" cols="33" placeholder="eg: email@example.com; 
email1@example.com; 
email2@example.com
email3@example.com" ></textarea>
         </div>
         
    <div id="c-button">
        <input type="button" onclick="location.href='------------------------------';" value="Finish" />
      </div>
      <div id="create-project">
          <h5>Creating your project - step 3 of 3</h5>   
      </div>  
</div> 
</div>
@endsection