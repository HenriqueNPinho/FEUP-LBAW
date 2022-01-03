var loadFile = function (event) {
    var image = document.getElementById("tempProfilePhoto");
    image.src = URL.createObjectURL(event.target.files[0]);
    image.onload = function () {
        URL.revokeObjectURL(image.src); // free memory
    };
};


function setUpConfirmDeleteAccount(){
    let deleteAccountButton=document.querySelector("#profileButtonDelete");
    deleteAccountButton.addEventListener("click",function(evt){
        if(!confirm("Are you sure you want to delete your account?")){
            evt.preventDefault();
        }
    },false);
}

function setUpAcceptRejectProject(){
    let projectInvitesAccept=document.querySelectorAll('.accept-project-icon');
    for(let i=0;i<projectInvitesAccept.length;i++){
        projectInvitesAccept[i].addEventListener("click",function(){
            let project=this.getAttribute("data-id");
            sendAjaxRequest('post','/api/user/projectInvite',{projectID:project,accepted:"true"},genericResponseHandlerWithRefresh);
        });
    }
}

setUpConfirmDeleteAccount();
setUpAcceptRejectProject();