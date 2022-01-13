function setUpAddNewForumPost() {
    let createPostButton = document.querySelector("#createNewPostButton");
    createPostButton.addEventListener("click", function () {
        let projectID = document.querySelector(".new-post-content-input").getAttribute("data-project-id");
        let postContent = document.querySelector("#new-post-text-area-input").value;
        sendAjaxRequest("put", "/project/" + projectID + "/forum", {content: postContent}, genericResponseHandlerWithRefresh);
    });
}

function setUpForumPostOptions(){
    let forumPostOptionsContainers = document.querySelectorAll('.forum-post-options-container');
    if(forumPostOptionsContainers==null) return;
    forumPostOptionsContainers.forEach(element => {
        element.addEventListener("click",function(){
            for(let i=0;i<forumPostOptionsContainers.length;i++){
                if(forumPostOptionsContainers[i]==this) continue;
                forumPostOptionsContainers[i].querySelector('.forum-post-options-menu').style.display="none";
            }
            let elementToDisplay=this.querySelector('.forum-post-options-menu');
            if(elementToDisplay.style.display==""||elementToDisplay.style.display=="none")
                elementToDisplay.style.display="block"
            else if(elementToDisplay.style.display=="block")
                elementToDisplay.style.display="none";
        })
    });
}

function setUpDeleteForumPost(){
    let deleteButtons=document.querySelectorAll('.forum-post-delete-post-button');
    deleteButtons.forEach(element => {
        element.addEventListener("click",function(){
            sendAjaxRequest('delete','/project/forum/'+element.getAttribute('data-id'),null,genericResponseHandlerWithRefresh);
        })
    });
}

setUpAddNewForumPost();
setUpForumPostOptions();
setUpDeleteForumPost();