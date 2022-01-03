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
                item.style.opacity = 0.001;
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

    let closeTaskIcon = document.querySelector("#close-new-task-form");
    closeTaskIcon.addEventListener("click", function () {
        projectAreaCover.style.display = "none";
        taskForm.style.display = "none";
    });
    let createTaskButton = document.querySelector("#createNewTaskButton");
    let taskStatus = this.getAttribute("data-id");
    createTaskButton.addEventListener("click", function () {
        let id = document
            .querySelector(".project-overview")
            .getAttribute("data-id");
        let taskName = document.querySelector("#new-task-name-input").value;
        let taskDescription = document.querySelector(
            "#new-task-description-input"
        ).value;
        let selectedMembers = [];
        let memberSelectionInput = document.querySelectorAll(
            ".new-member-selection-option-input"
        );
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

    let closeTaskIcon = document.querySelector("#close-task-page");
    closeTaskIcon.addEventListener("click", function () {
        projectAreaCover.style.display = "none";
        taskPage.style.display = "none";
    });

    let deleteTaskIcon = document.querySelector("#delete-task-icon");
    deleteTaskIcon.addEventListener("click", function () {
        if (!confirm("Are you sure you want to delete this task?")) return;
        projectAreaCover.style.display = "none";
        taskPage.style.display = "none";
        let taskID = task[0]["id"];
        sendAjaxRequest(
            "delete",
            "/api/task/" + taskID,
            null,
            genericResponseHandler
        );
    });

    let taskPageMembersContainer = document.querySelector("#task-page-members");
    taskPageMembersContainer.style.display = "flex";

    document.querySelector("#task-page-task-name").innerHTML = task[0]["name"];
    document.querySelector("#task-page-task-description").innerHTML =
        task[0]["description"];
    document.querySelector("#task-page-task-date").innerHTML =
        task[0]["delivery_date"];

    taskPageMembersContainer.innerHTML = "";
    task[1].forEach(function (item, index) {
        let image = document.createElement("img");
        if(task[1][index]["profile_image"]!=null){
            image.setAttribute("src", task[1][index]["profile_image"]);
        }
        else image.setAttribute("src", "/images/avatars/profile-pic-2.png");
        
        image.setAttribute("data-id", task[1][index]["id"]);
        document.querySelector("#task-page-members").appendChild(image);
    });

    let editTaskIcon = document.querySelector("#edit-task-icon");
    editTaskIcon.addEventListener("click", function () {
        projectAreaCover.style.display = "none";
        taskPage.style.display = "none";
        editTask(task);
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
    taskName.value = task[0]["name"];
    let taskDescription = document.querySelector(
        "#edit-task-description-input"
    );
    taskDescription.value = task[0]["description"];
    let selectedMembers = [];
    let memberSelectionInput = document.querySelectorAll(
        ".edit-member-selection-option-input"
    );
    memberSelectionInput.forEach(function (item) {
        for (let i = 0; i < task[1].length; i++) {
            if (item.getAttribute("data-id") == task[1][i]["id"]) {
                item.checked = true;
            }
        }
    });
    let taskDeliveryDate = document.querySelector("#edit-task-end-date");
    taskDeliveryDate.value = task[0]["delivery_date"];

    let closeTaskIcon = document.querySelector("#close-edit-task-form");
    closeTaskIcon.addEventListener("click", function () {
        projectAreaCover.style.display = "none";
        taskForm.style.display = "none";
    });
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
            "/api/task/" + task[0]["id"],
            {
                name: taskName.value,
                description: taskDescription.value,
                members: selectedMembers,
                date: taskDeliveryDate.value,
            },
            genericResponseHandlerWithRefresh
        );
    });
}


setUpDragAndDropTasks();
setUpAddNewTask();
setUpViewFullTask();