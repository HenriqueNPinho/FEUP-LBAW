let dragged;

function setUpDragAndDropTasks() {
    var dragged;

    let taskPreviews = document.querySelectorAll(".task-preview");

    /* events fired on the draggable target */
    document.addEventListener("drag", function (event) {}, false);

    taskPreviews.forEach(function (item, i) {
        item.addEventListener(
            "dragstart",
            function (event) {
                // store a ref. on the dragged elem
                dragged = item;
                // make it transparent
                item.style.opacity = 0.5;
            },
            false
        );
    });

    document.addEventListener(
        "dragend",
        function (event) {
            // reset the transparency
            event.target.style.opacity = "";
        },
        false
    );

    document.addEventListener(
        "dragover",
        function (event) {
            // prevent default to allow drop
            event.preventDefault();
        },
        false
    );

    document.addEventListener(
        "dragenter",
        function (event) {
            // highlight potential drop target when the draggable element enters it
            if (event.target.className == "board" && dragged != null) {
                event.target.style.background = "gray";
            }
        },
        false
    );

    document.addEventListener(
        "dragleave",
        function (event) {
            // reset background of potential drop target when the draggable element leaves it
            if (event.target.className == "board") {
                event.target.style.background = "";
            }
        },
        false
    );

    document.addEventListener(
        "drop",
        function (event) {
            // prevent default action (open as link for some elements)
            event.preventDefault();
            // move dragged elem to the selected drop target
            if (event.target.className == "board" && dragged != null) {
                event.target.style.background = "";
                sendTaskUpdateStatusRequest(
                    dragged.getAttribute("data-id"),
                    dragged.parentNode.getAttribute("id"),
                    event.target.getAttribute("id")
                );
                dragged.parentNode.removeChild(dragged);
                event.target.appendChild(dragged);
            }
            dragged = null;
        },
        false
    );
}

function sendTaskUpdateStatusRequest(id, previousStatus, newStatus) {
    if (previousStatus == newStatus) return false;
    let statusString;
    switch (newStatus) {
        case "not-started":
            statusString = "Not Started";
            break;
        case "started":
            statusString = "In Progress";
            break;
        case "complete":
            statusString = "Complete";
            break;
        default:
            return false;
    }
    return sendAjaxRequest(
        "post",
        "/api/task/updateStatus/" + id,
        { status: statusString },
        genericResponseHandler
    );
}

function setUpAddNewTask() {
    let addTaskIcons = document.querySelectorAll(".new-task-plus");
    addTaskIcons.forEach(function (item, index) {
        item.addEventListener("click", createNewTask);
    });
}

function createNewTask() {
    let projectAreaCover = document.querySelector(
        "#project-overview-opaque-cover"
    );
    projectAreaCover.style.display = "block";
    let taskForm = document.querySelector("#new-task-form");
    taskForm.style.display = "flex";


    let createTaskButton = document.querySelector("#createNewTaskButton");
    let taskStatus = this.getAttribute("data-id");

    let memberSelectionInput = document.querySelectorAll(
        ".new-member-selection-option-input"
    );
    memberSelectionInput.forEach(function (item) {
        item.checked=false;
    });
    document.querySelector(
        "#new-task-description-input"
    ).value="";
    document.querySelector("#new-task-name-input").value="";
    createTaskButton.addEventListener("click", function () {
        let id = document
            .querySelector(".project-overview")
            .getAttribute("data-id");
        let taskName = document.querySelector("#new-task-name-input").value;
        let taskDescription = document.querySelector(
            "#new-task-description-input"
        ).value;
        let selectedMembers = [];
        memberSelectionInput.forEach(function (item) {
            if (item.checked)
                selectedMembers.push(item.getAttribute("data-id"));
        });
        if (selectedMembers.length == 0) selectedMembers = "";
        let taskDeliveryDate =
            document.querySelector("#new-task-end-date").value;
        if (new Date(taskDeliveryDate) < new Date()) {
            alert("The delivery date isn't valid!");
            return;
        }

        sendAjaxRequest(
            "put",
            "/api/task/" + id,
            {
                name: taskName,
                description: taskDescription,
                members: selectedMembers,
                status: taskStatus,
                date: taskDeliveryDate,
            },
            genericResponseHandlerWithRefresh
        );
    });

    let closeTaskIcon = document.querySelector("#close-new-task-form");
    closeTaskIcon.addEventListener("click", function () {
        projectAreaCover.style.display = "none";
        taskForm.style.display = "none";
        let clone=taskForm.cloneNode(true);
        taskForm.replaceWith(clone);
    });
}

function setUpViewFullTask() {
    let taskPreviews = document.querySelectorAll(".task-preview");
    taskPreviews.forEach(function (item) {
        item.addEventListener("click", function () {
            let taskID = this.getAttribute("data-id");
            sendAjaxRequest("get", "/api/task/" + taskID, null, viewFullTask);
        });
    });
}

function viewFullTask() {
    if (this.status != 200) {
        location.reload();
    }

    let task = JSON.parse(this.response);
    console.log(task);
    let taskPage = document.querySelector("#task-page");
    taskPage.style.display = "block";
    let projectAreaCover = document.querySelector(
        "#project-overview-opaque-cover"
    );
    projectAreaCover.style.display = "block";


    let deleteTaskIcon = document.querySelector("#delete-task-icon");
    deleteTaskIcon.addEventListener("click", function () {
        if (!confirm("Are you sure you want to delete this task?")) return;
        projectAreaCover.style.display = "none";
        taskPage.style.display = "none";
        let taskID = task["id"];
        sendAjaxRequest(
            "delete",
            "/api/task/" + taskID,
            null,
            genericResponseHandlerWithRefresh
        );
    });

    let taskPageMembersContainer = document.querySelector("#task-page-members");
    taskPageMembersContainer.style.display = "flex";

    document.querySelector("#task-page-task-name").innerHTML = task["name"];
    document.querySelector("#task-page-task-description").innerHTML =
        task["description"];
    document.querySelector("#task-page-task-date").innerHTML =
        task["delivery_date"];

    taskPageMembersContainer.innerHTML = "";
    task["members"].forEach(function (item, index) {
        let image = document.createElement("img");
        if(task["members"][index]["profile_image"]!=null){
            image.setAttribute("src", task["members"][index]["profile_image"]);
            image.setAttribute("title",task["members"][index]["name"]);
            image.addEventListener("click",function(){
                location.href="/project/userpage/"+task["members"][index]["id"];
            })
        }
        else image.setAttribute("src", "/images/avatars/profile-pic-2.png");
        
        image.setAttribute("data-id", task["members"][index]["id"]);
        document.querySelector("#task-page-members").appendChild(image);
    });

    let commentContainer=document.querySelector('#task-comments-container');
    let addTaskElement=document.querySelector('#add-task-page-comment');
    commentContainer.innerHTML="";
    commentContainer.appendChild(addTaskElement);
    task["comments"].forEach(function(item,index){
        let comment=document.createElement("div");
        comment.setAttribute("class","task-page-comment");
        let image=document.createElement("img");
        let commentAuthorID=item["project_member_id"];
        let commentAuthor;
        for(let i=0;i<task["project"]["members"].length;i++){
            if(task["project"]["members"][i]["id"]==commentAuthorID){
                commentAuthor=task["project"]["members"][i];
            }
        }
        image.setAttribute("src",commentAuthor["profile_image"]);
        let commentDiv=document.createElement("div");
        let commentAuthorH5=document.createElement("h5");
        commentAuthorH5.innerHTML=commentAuthor["name"];
        let commentContentP=document.createElement("p");
        commentContentP.innerHTML=item["content"];
        commentDiv.appendChild(commentAuthorH5);
        commentDiv.appendChild(commentContentP);
        comment.appendChild(image);
        comment.appendChild(commentDiv);
        commentContainer.appendChild(comment);
    });

    let editTaskIcon = document.querySelector("#edit-task-icon");
    editTaskIcon.addEventListener("click", function () {
        projectAreaCover.style.display = "none";
        taskPage.style.display = "none";
        editTask(task);
    });

    let addCommentButton = document.querySelector("#add-task-comment-button");
    addCommentButton.addEventListener("click",function(){
        let content=document.querySelector('#add-task-comment-content-input');
        if(content.value=="") return;
        sendAjaxRequest('put','/api/task/'+task["id"]+'/addComment',{content:content.value},function(){
            let responseHandler=genericResponseHandler.bind(this);
            responseHandler();
            let comment=document.createElement("div");
            comment.setAttribute("class","task-page-comment");
            let image=addTaskElement.querySelector("img").getAttribute("src");
            let imageCopy=document.createElement("img");
            imageCopy.setAttribute("src",image);
            let commentDiv=document.createElement("div");
            let commentAuthor=addTaskElement.querySelector("h5").innerText;
            let commentAuthorH5=document.createElement("h5");
            commentAuthorH5.innerHTML=commentAuthor;
            let commentContentP=document.createElement("p");
            commentContentP.innerHTML=content.value;
            commentDiv.appendChild(commentAuthorH5);
            commentDiv.appendChild(commentContentP);
            comment.appendChild(imageCopy);
            comment.appendChild(commentDiv);
            commentContainer.appendChild(comment);
            content.value="";
        })
    })

    let closeTaskIcon = document.querySelector("#close-task-page");
    closeTaskIcon.addEventListener("click", function () {
        projectAreaCover.style.display = "none";
        taskPage.style.display = "none";
        let clone=taskPage.cloneNode(true);
        taskPage.replaceWith(clone);
    });

}


function editTask(task) {
    let projectAreaCover = document.querySelector(
        "#project-overview-opaque-cover"
    );
    projectAreaCover.style.display = "block";
    let taskForm = document.querySelector("#edit-task-form");
    taskForm.style.display = "flex";

    let taskName = document.querySelector("#edit-task-name-input");
    taskName.value = task["name"];
    let taskDescription = document.querySelector(
        "#edit-task-description-input"
    );
    taskDescription.value = task["description"];
    let selectedMembers = [];
    let memberSelectionInput = document.querySelectorAll(
        ".edit-member-selection-option-input"
    );
    memberSelectionInput.forEach(function (item) {
        item.checked=false;
        for (let i = 0; i < task["members"].length; i++) {
            if (item.getAttribute("data-id") == task["members"][i]["id"]) {
                item.checked = true;
            }
        }
    });
    let taskDeliveryDate = document.querySelector("#edit-task-end-date");
    taskDeliveryDate.value = task["delivery_date"];

    
    let createTaskButton = document.querySelector("#editTaskButton");
    createTaskButton.addEventListener("click", function () {
        memberSelectionInput.forEach(function (item) {
            if (item.checked)
                selectedMembers.push(item.getAttribute("data-id"));
        });
        if (selectedMembers.length == 0) selectedMembers = "";

        if (new Date(taskDeliveryDate) < new Date()) {
            alert("The delivery date isn't valid!");
            return;
        }

        sendAjaxRequest(
            "post",
            "/api/task/" + task["id"],
            {
                name: taskName.value,
                description: taskDescription.value,
                members: selectedMembers,
                date: taskDeliveryDate.value,
            },
            genericResponseHandlerWithRefresh
        );
    });

    let closeTaskIcon = document.querySelector("#close-edit-task-form");
    closeTaskIcon.addEventListener("click", function () {
        projectAreaCover.style.display = "none";
        taskForm.style.display = "none";
        let clone=taskForm.cloneNode(true);
        taskForm.replaceWith(clone);
    });
}

function setUpProjectOptions(){
    let projectOptionsIcon=document.querySelector('#project-options-3points-icon');
    let projectOptions=document.querySelector("#project-options");
    if(projectOptionsIcon==null) return;
    projectOptionsIcon.addEventListener("click",function(){
        if(projectOptions.style.display==""||projectOptions.style.display=="none")
            projectOptions.style.display="block"
        else if(projectOptions.style.display=="block"){
            projectOptions.style.display="none"
        }
            
    })
}

function setUpRemoveFromFavorites(){
    if(document.querySelector('.project-overview')==null) return;
    let projectID=document.querySelector('.project-overview').getAttribute('data-id');
    let removeFromFavoritesButton=document.querySelector('#remove-from-favorites-button');
    if(removeFromFavoritesButton==null) return;
    removeFromFavoritesButton.addEventListener("click",function(){
        sendAjaxRequest('post','/api/user/removeFavorite/'+projectID,null,genericResponseHandlerWithRefresh);
    })
}

function setUpAddToFavorites(){
    if(document.querySelector('.project-overview')==null) return;
    let projectID=document.querySelector('.project-overview').getAttribute('data-id');
    let addToFavoritesButton=document.querySelector('#add-to-favorites-button');
    if(addToFavoritesButton==null) return;
    addToFavoritesButton.addEventListener("click",function(){
        sendAjaxRequest('post','/api/user/addFavorite/'+projectID,null,genericResponseHandlerWithRefresh);
    })
}

function setUpArchiveProject(){
    if(document.querySelector('.project-overview')==null) return;
    let projectID=document.querySelector('.project-overview').getAttribute('data-id');
    let archiveProjectButton = document.querySelector('#archive-project-button');
    if(archiveProjectButton==null) return;
    archiveProjectButton.addEventListener("click",function(){
        sendAjaxRequest('post','/api/project/archive/'+projectID,null,function(){
            if(this.status<400)
                location.href='/'
            else
                console.log(this.response);
        });
    })

}

function setUpProfileImagesLinks(){
    let profileImages=document.querySelectorAll('.profile-image-link');
    profileImages.forEach(element => {
        element.addEventListener("click",function(){
            let id=element.getAttribute('data-id');
            location.href="/project/userpage/"+id;
        })
    });
}

function setUpViewFullMemberList(){
    let extraMemberCountIcon=document.querySelector('.extra-members-count-div');
    if(extraMemberCountIcon==null) return;
    extraMemberCountIcon.addEventListener("click",function(){
        let projectAreaCover = document.querySelector(
            "#project-overview-opaque-cover"
        );
        projectAreaCover.style.display = "block";
        let memberList=document.querySelector("#full-member-list");
        memberList.style.display="flex";
        let closeTaskIcon = document.querySelector("#close-full-member-list");
        closeTaskIcon.addEventListener("click", function () {
            projectAreaCover.style.display = "none";
            memberList.style.display = "none";
        });
    });
}

function setUpSearchFilters(){
    if(document.querySelector('.search-results-filters')==null) return;
    let allTasksInput=document.querySelector('#all-tasks-filter');
    let toDoTasksInput=document.querySelector('#to-do-tasks-filter');
    let doingTasksInput=document.querySelector('#doing-tasks-filter');
    let doneTasksInput=document.querySelector('#done-tasks-filter');
    let tasks=document.querySelectorAll(".task-preview");
    allTasksInput.addEventListener("click",function(){
        toDoTasksInput.checked=false;
        doingTasksInput.checked=false;
        doneTasksInput.checked=false;
        if(allTasksInput.checked==true){
            tasks.forEach(element => {
                element.style.display="flex";
            });
        }
        else{
            tasks.forEach(element => {
                element.style.display="none";
            });
        }
    })
    toDoTasksInput.addEventListener("click",function(){
        
        if(allTasksInput.checked==true){
            allTasksInput.checked=false;
            tasks.forEach(element => {
                element.style.display="none";
            });
        }
        if(toDoTasksInput.checked==true){
            tasks.forEach(element => {
                if(element.getAttribute("data-status")=="Not Started"){
                    element.style.display="flex";
                }
            });
        }
        else{
            tasks.forEach(element => {
                if(element.getAttribute("data-status")=="Not Started"){
                    element.style.display="none";
                }
            });
        }
        

    })

    doingTasksInput.addEventListener("click",function(){
        
        if(allTasksInput.checked==true){
            allTasksInput.checked=false;
            tasks.forEach(element => {
                element.style.display="none";
            });
        }
        if(doingTasksInput.checked==true){
            tasks.forEach(element => {
                if(element.getAttribute("data-status")=="In Progress"){
                    element.style.display="flex";
                }
            });
        }
        else{
            tasks.forEach(element => {
                if(element.getAttribute("data-status")=="In Progress"){
                    element.style.display="none";
                }
            });
        }

    })

    doneTasksInput.addEventListener("click",function(){
        
        if(allTasksInput.checked==true){
            allTasksInput.checked=false;
            tasks.forEach(element => {
                element.style.display="none";
            });
        }
        if(doneTasksInput.checked==true){
            tasks.forEach(element => {
                if(element.getAttribute("data-status")=="Complete"){
                    element.style.display="flex";
                }
            });
        }
        else{
            tasks.forEach(element => {
                if(element.getAttribute("data-status")=="Complete"){
                    element.style.display="none";
                }
            });
        }
        

    })
}

setUpDragAndDropTasks();
setUpAddNewTask();
setUpViewFullTask();
setUpProjectOptions();
setUpRemoveFromFavorites();
setUpAddToFavorites();
setUpArchiveProject();
setUpProfileImagesLinks();
setUpViewFullMemberList();
setUpSearchFilters();