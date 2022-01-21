@extends('layouts.app')
@section('title', 'Create Project')
@section('content')

<script src={{ asset('js/create-project-page.js') }} defer></script>
  <div id="project-area">
    @include('partials.slide-right-menu')
    @include('partials.projects-bar',['projects'=>$projects])
<div id="regForm">
 
  <div class="tab">
    @if (\Session::has('message'))
        <span class="alert-success">
        {!! \Session::get('message') !!}
        </span>
    @endif
    <h1>Whats the name of the project:</h1>
    <p><input placeholder="Project Name" oninput="this.className = ''" name="pname" id="cp-projectname"></p>
    <h1>Company name:</h1>
    <select id="cp-company" name="cp-company">
      @foreach(Auth::user()->companies as $company)
        <option value="{{$company->id}}">{{$company->name}}</option>
      @endforeach
    </select>
  </div>
  
  <div class="tab">
    <h1>When is the delivery date:</h1>
    <p><input type ="date" name="date" id="cp-date" min ='<?php echo date('Y-m-d',time()+86400);?>' ></p>  <!-- 24*60*60 -->
    <h1> Give your project a description </h1> 
    <h1>(Optional)</h1>
    <div id="create-project">
      <textarea id= "cp-description" name="description"
      rows="5" cols="33" placeholder="" ></textarea>
    </div>
  </div>

  <div class="tab">  
    <h1>Assign members to your team</h1>   
    <h5>Invite them via e-mail</h5>
    <div id="create-project">
      <input id= "cp-project-members" name="project-members"
        type="email" multiple placeholder="eg: email@example.com; email1@example.com; email2@example.com; email3@example.com">
  </div>
  </div>

    <div style="float:right;margin-top:40px; overflow:auto;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>

  <div id="pointsStepIndicator" style="margin-top:47px; margin-left:48%;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</div>
  
  </div>
@endsection




  

