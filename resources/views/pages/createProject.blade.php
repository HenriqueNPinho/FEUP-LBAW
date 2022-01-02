@extends('layouts.app')

@section('content')


<body>
  <div id="project-area" name="create-project">
    @include('partials.slide-right-menu')
    @include('partials.projects-bar',['projects'=>$projects])
<form id="regForm" action="/">
 
  <div class="tab">
    <h1>Whats the name of the project:</h1>
    <p><input placeholder="Project Name" oninput="this.className = ''" name="pname"></p>
    <h1>Company name:</h1>
    <select id="company" name="company">
      <option value="none">none</option>
    </select>
  </div>
  
  <div class="tab">
    <h1>When is the delivery date:</h1>
    <p><input type ="date" this.className = '' name="date"></p>
    <h1> <p> Give your project a description </p>  <p>(Optional)</p></h1>
    <div id="create-project">
      <textarea id= "description" name="description"
      rows="5" cols="33" placeholder="" ></textarea>
    </div>
  </div>

  <div class="tab">
    <h1>Assign a project coordinator</h1>   
        <h5>Invite them via e-mail</h5>
        <div id="create-project">
            <input type="text" name="project-coordinator" type="email" placeholder="eg:email@example.com">
         </div>
         <h1>Assign members to your team</h1>   
        <h5>Invite them via e-mail</h5>
        <div id="create-project">
            <input id= "project-members" name="project-members"
            type="email" multiple placeholder="eg: email@example.com; email1@example.com; email2@example.com; email3@example.com">
  </div>
  </div>

  <div style="overflow:auto;">
    <div style="float:right;">
      
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>

  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>

</form>
  
  </div>
<script>

var currentTab = 0; //first tab 
showTab(currentTab); // Display the current tab

function showTab(n) {
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";

  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  fixStepIndicator(n)
}

function nextPrev(n) {

  var x = document.getElementsByClassName("tab");

  if (n == 1 && !validateForm()) return false;

  x[currentTab].style.display = "none";

  currentTab = currentTab + n;
 
  if (currentTab >= x.length) {
 
    document.getElementById("regForm").submit();
    return false;
  }
 
  showTab(currentTab);
}

function validateForm() {
 
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
 
  for (i = 0; i < y.length; i++) {
   
    if (y[i].value == "") {
      
      y[i].className += " invalid";
     
      valid = false;
    }
  }
  
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; 
}

function fixStepIndicator(n) {
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  x[n].className += " active";
}

</script>
@endsection
</body>
</html>

  

