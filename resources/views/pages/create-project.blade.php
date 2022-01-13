<html>
<body>
 
@extends('layouts.app')
@section('content')

<script type="text/javascript" src={{ asset('js/create-project-page.js') }} defer></script>
  <div id="project-area" name="create-project">
    @include('partials.slide-right-menu')
    @include('partials.projects-bar',['projects'=>$projects])
<div id="regForm">
 
  <div class="tab">
    <h1>Whats the name of the project:</h1>
    <p><input placeholder="Project Name" oninput="this.className = ''" name="pname" id="cp-projectname"></p>
    <h1>Company name:</h1>
    <select id="cp-company" name="company">
      <option value="none"></option>
    </select>
  </div>
  
  <div class="tab">
    <h1>When is the delivery date:</h1>
    <p><input type ="date" this.className = '' name="date" id="cp-date" min ='<?php echo date('Y-m-d',time()+86400);?>' ></p>  <!-- 24*60*60 -->
    <h1> <p> Give your project a description </p>  <p>(Optional)</p></h1>
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

  <div style="margin-top:47px; margin-left:48%;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</div>
  
  </div>
@endsection
</body>
<script>
  //enter
document.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        document.getElementById("nextBtn").click();
    }
});
</script>
</html>



  

