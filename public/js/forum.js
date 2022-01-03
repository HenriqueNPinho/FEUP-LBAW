function setUpAddNewForumPost() {
    let createPostButton = document.querySelector("#createNewPostButton");
    createPostButton.addEventListener("click", function () {
        let projectID = document.querySelector("#new-post-content-input").getAttribute("data-project-id");
        let postContent = document.querySelector("#new-post-content-input").value;

        console.log("projectID = "+ projectID);
        console.log("postContent = "+ postContent);
        sendAjaxRequest("post", "/project/" + projectID + "/forum", {content: postContent}, genericResponseHandlerWithRefresh);
    });
}

setUpAddNewForumPost();