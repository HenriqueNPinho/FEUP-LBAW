
function setUpInviteUsers(){
    let addButton=document.querySelector("#add-user-to-company-icon");
    let emailInput=document.querySelector("#add-user-to-company-input");
    addButton.addEventListener("click",function(){
        if(emailInput.value=="") return;
        sendAjaxRequest('post','api/admin/inviteUser/'+emailInput.value,null,function(){
            let responseHandler=genericResponseHandler.bind(this);
            responseHandler();
            successMessage("Invitation Sent");
            emailInput.value="";
        })
        
    })
}

function setUpRemoveUsers(){
    let removeButtons=document.querySelectorAll('.remove-user-from-company-icon');
    removeButtons.forEach(element => {
        element.addEventListener("click",function(){
            let workerID=element.getAttribute("data-id");
            if(!confirm("Are you sure you want to remove this user from your company's workspace?")) return;
            sendAjaxRequest('post','api/admin/removeUser/'+workerID,null,function(){
                let responseHandler=genericResponseHandlerWithRefresh.bind(this);
                responseHandler();
            })
        });
    });
}

function showCurrentProjects(){
    let showCurrentProjectsButton = document.getElementById('showCurrentProjects');
    showCurrentProjectsButton.addEventListener("click", function(){
        document.getElementById('showCurrentProjects').style.backgroundColor = 'rgb(' + 42 + ',' + 157 + ',' + 143 +  ',' + 1 + ')';
        document.getElementById('showArchivedProjects').style.backgroundColor = 'rgb(' + 244 + ',' + 162 + ',' + 97 +  ',' + 0.5 + ')';
        document.getElementById('currentProjects').style.display = "flex";
        document.getElementById('archivedProjects').style.display = "none";
    });
}

function showArchivedProjects(){
    let showArchivedProjectsButton = document.getElementById('showArchivedProjects');
    showArchivedProjectsButton.addEventListener("click", function(){
        document.getElementById('showArchivedProjects').style.backgroundColor = 'rgb(' + 244 + ',' + 162 + ',' + 97 +  ',' + 1 +')';
        document.getElementById('showCurrentProjects').style.backgroundColor = 'rgb(' + 42 + ',' + 157 + ',' + 143 +  ',' + 0.5 + ')';
        document.getElementById('archivedProjects').style.display = "flex";
        document.getElementById('currentProjects').style.display = "none";
    });
}

setUpInviteUsers();
setUpRemoveUsers();
showCurrentProjects();
showArchivedProjects();