function setUpAddNewForumPost() {
    let createPostButton = document.querySelector("#createNewPostButton");
    createPostButton.addEventListener("click", function () {
        let projectID = document
            .querySelector(".new-post-content-input")
            .getAttribute("data-project-id");
        let postContent = document.querySelector(
            "#new-post-text-area-input"
        ).value;
        sendAjaxRequest(
            "put",
            "/project/" + projectID + "/forum",
            { content: postContent },
            genericResponseHandlerWithRefresh
        );
    });
    let inputNewPost=document.querySelector("#new-post-text-area-input");
    inputNewPost.addEventListener("keydown", function (e) {
        if (e.code === "Enter") {  
            let projectID = document
            .querySelector(".new-post-content-input")
            .getAttribute("data-project-id");
            let postContent = document.querySelector(
                "#new-post-text-area-input"
            ).value;
            sendAjaxRequest(
                "put",
                "/project/" + projectID + "/forum",
                { content: postContent },
                genericResponseHandlerWithRefresh
            );
        }
    });
}

function setUpForumPostOptions() {
    let forumPostOptionsContainers = document.querySelectorAll(
        ".forum-post-options-container"
    );
    if (forumPostOptionsContainers == null) return;
    forumPostOptionsContainers.forEach((element) => {
        element.addEventListener("click", function () {
            for (let i = 0; i < forumPostOptionsContainers.length; i++) {
                if (forumPostOptionsContainers[i] == this) continue;
                forumPostOptionsContainers[i].querySelector(
                    ".forum-post-options-menu"
                ).style.display = "none";
            }
            let elementToDisplay = this.querySelector(
                ".forum-post-options-menu"
            );
            if (
                elementToDisplay.style.display == "" ||
                elementToDisplay.style.display == "none"
            )
                elementToDisplay.style.display = "block";
            else if (elementToDisplay.style.display == "block")
                elementToDisplay.style.display = "none";
        });
    });
}

function setUpDeleteForumPost() {
    let deleteButtons = document.querySelectorAll(
        ".forum-post-delete-post-button"
    );
    deleteButtons.forEach((element) => {
        element.addEventListener("click", function () {
            sendAjaxRequest(
                "delete",
                "/project/forum/" + element.getAttribute("data-id"),
                null,
                genericResponseHandlerWithRefresh
            );
        });
    });
}

function setUpEditForumPost() {
    let editButtons = document.querySelectorAll(
        ".forum-post-edit-post-button"
    );
    editButtons.forEach((element) => {
        element.addEventListener("click", function () {
            let id = element.getAttribute("data-id");
            let p = document.querySelector("#fpc" + id);
            let saveButton= document.createElement("div");
            saveButton.setAttribute("id","edit-forum-post-save-button");

            saveButton.innerHTML="Save";
            p.style.display = "none";
            let textarea = document.createElement("textarea");
            textarea.innerHTML=p.innerHTML;
            textarea.setAttribute("id","edit-forum-post-textarea");
            let container=p.parentElement;
            p.parentNode.replaceChild(textarea,p);
            container.appendChild(saveButton);
            saveButton.addEventListener("click",function(){
                sendAjaxRequest('post','/project/forum/'+id,{newContent:textarea.value},genericResponseHandlerWithRefresh);
            })
        });
    });
}

setUpAddNewForumPost();
setUpForumPostOptions();
setUpDeleteForumPost();
setUpEditForumPost();
