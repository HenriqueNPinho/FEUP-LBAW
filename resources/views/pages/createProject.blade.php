@extends('layouts.app')

@section('content')


<body>
  <div id="project-area" name="create-project">
    @include('partials.slide-right-menu')
    @include('partials.projects-bar',['projects'=>$projects])
<form id="regForm" action="???">
 
  <div class="tab">
    <h1>Whats the name of the project:</h1>
    <p><input placeholder="Project Name" oninput="this.className = ''" name="pname"></p>
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
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

</script>
@endsection
</body>
</html>

  

