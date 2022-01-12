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
  if(currentTab<2){
   if (n == 1 && !validateForm()) return false;
  }
  else {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }

  x[currentTab].style.display = "none";

  currentTab = currentTab + n;
 
  if (currentTab >= x.length) {
   
   sendCreateProjectRequest();
   window.location.replace("/projects");
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

function sendCreateProjectRequest(){
    let projectName = document.querySelector("#cp-projectname");
    let company = document.querySelector("#cp-company");
    let date= document.querySelector("#cp-date");
    let description = document.querySelector("#cp-description");
    let memberInput=document.querySelector("#cp-project-members");
    sendAjaxRequest('put', 'api/project/create',{name:projectName.value, company:company.value, date:date.value, description:description.value, members:memberInput.value}, genericResponseHandler);
  }

