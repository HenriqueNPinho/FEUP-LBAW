function setUpConfirmDeleteAccount(){
    let deleteAccountButton=document.querySelector("#profileButtonDelete");
    deleteAccountButton.addEventListener("click",function(evt){
        if(!confirm("Are you sure you want to delete your account?")){
            evt.preventDefault();
        }
    },false);
}

function setUpAcceptProject(){
    let projectInvitesAccept=document.querySelectorAll('.accept-project-icon');
    for(let i=0;i<projectInvitesAccept.length;i++){
        projectInvitesAccept[i].addEventListener("click",function(){
            let project=this.getAttribute("data-id");
            sendAjaxRequest('post','/api/user/projectInvite',{projectID:project,accepted:"true"},genericResponseHandlerWithRefresh);
        });
    }
}

function setUpRejectProject(){
    let projectInvitesReject=document.querySelectorAll('.reject-project-icon');
    for(let i=0;i<projectInvitesReject.length;i++){
        projectInvitesReject[i].addEventListener("click",function(){
            let project=this.getAttribute("data-id");
            sendAjaxRequest('post','/api/user/projectInvite',{projectID:project,accepted:"false"},genericResponseHandlerWithRefresh);
        });
    }
}


setUpConfirmDeleteAccount();
setUpAcceptProject();
setUpRejectProject();