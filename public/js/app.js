function fadeOut(element) {
    var op = 1;  // initial opacity
    var timer = setInterval(function () {
        if (op <= 0.1){
            clearInterval(timer);
            element.style.display = 'none';
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op -= op * 0.1;
    }, 50);
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function fadeIn(element) {
    var op = 0.1;  // initial opacity
    element.style.opacity=0.1;
    element.style.display = 'flex';
    var timer = setInterval(function () {
        if (op >= 1){
            clearInterval(timer);
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op += op * 0.1;
    }, 10);
}

function successMessage(message){
    let messageContainer=document.createElement("div");
    messageContainer.setAttribute("class","success-message-alert");
    let i=document.createElement("i");
    i.setAttribute("class","far fa-check-circle fa-4x");
    let text=document.createElement("h4");
    text.innerHTML=message;
    messageContainer.appendChild(i);
    messageContainer.appendChild(text);
    document.body.appendChild(messageContainer);
    fadeIn(messageContainer);
    setTimeout(function(){
        fadeOut(messageContainer)
    }, 1700);
}

function setUpDropDownMenu() {
    let dropDownMenuIcon = document.querySelector(".navbar-collapse-item");
    let dropDownMenu = document.querySelector(".navbar-collapse");
    dropDownMenuIcon.addEventListener("click", function () {
        if (
            dropDownMenu.style.display == "" ||
            dropDownMenu.style.display == "none"
        )
            dropDownMenu.style.display = "block";
        else dropDownMenu.style.display = "none";
    });
}

function setUpSlideRightMenu() {
    let projectIcons = document.querySelectorAll(".project-icon");
    let slideRightMenu = document.querySelector("#slide-right-menu");
    let projectOverview = document.querySelector(
        "#slide-right-project-overview-link"
    );
    let projectForum = document.querySelector("#slide-right-project-forum-link");
    let notifications= document.querySelector("#slide-right-project-notifications-link");
    let settings = document.querySelector('#slide-right-project-settings-link')
    let mainOptionsContainer=document.querySelector("#slide-right-menu-main-options");
    let notificationsContainer =document.querySelector("#notification-container");
    let id = -1;

    projectIcons.forEach(function (item, index) {
        item.addEventListener("click", function () {
            notificationsContainer.style.display="none";
            mainOptionsContainer.style.display="flex"
            id = item.getAttribute("data-id");

            if (
                slideRightMenu.style.display == "" ||
                slideRightMenu.style.display == "none"
            ) {
                slideRightMenu.style.display = "block";
            } else {
                slideRightMenu.style.display = "none";
            }

            projectOverview.setAttribute("href", "/project/" + id);
            projectForum.setAttribute("href", "/project/"+ id + "/forum");
            settings.setAttribute("href", "/project/"+ id + "/settings")
            

            notifications.addEventListener("click",function(){
                notificationsContainer.style.display="flex";
                mainOptionsContainer.style.display="none"
                let notificationBalls=document.querySelectorAll('.project-icon-number-notifications-container');
                
                sendAjaxRequest('get','/api/user/notifications/'+id,null,function(){
                    notificationsContainer.innerHTML="";
                    let responseHandler=genericResponseHandler.bind(this);
                    responseHandler();
                    let assignedTaskNotifications=JSON.parse(this.response)[0];
                    let taskCommentNotifications=JSON.parse(this.response)[1];
                    let projectMembers=JSON.parse(this.response)[2];
                    let divsToAppend=[];

                    console.log(JSON.parse(this.response));
                    assignedTaskNotifications.forEach(element => {
                        let newAssignedTaskNotification=document.createElement("div");
                        newAssignedTaskNotification.setAttribute("class","notification assigned-notification");
                        let firstText=document.createElement("p");
                    
        
                        let assignedByName;
                        projectMembers.forEach(member => {
                            if(element["pivot"]["assigned_by_id"]==member["id"]){
                                assignedByName=member["name"];
                            }
                        });

                        firstText.innerHTML=assignedByName+" assigned you a task:";
                        newAssignedTaskNotification.appendChild(firstText);
                        let innerDiv=document.createElement("div");
                        innerDiv.setAttribute("class","notification-more-info")
                        let taskName=document.createElement("h4");
                        taskName.innerHTML=element["name"];
                        let taskDescription=document.createElement("p");
                        taskDescription.innerHTML=element["description"].substring(0,30);
                        innerDiv.appendChild(taskName);
                        innerDiv.appendChild(taskDescription);
                        newAssignedTaskNotification.appendChild(innerDiv);
                        let date=document.createElement("h6");
                        date.setAttribute("id","notification-date-time")
                        let dateValue=new Date(element["pivot"]["assigned_on"]);
                        date.setAttribute('data-value',dateValue)
                        date.innerHTML=dateValue.toLocaleString('pt-PT');
                        newAssignedTaskNotification.appendChild(date);
                        divsToAppend.push(newAssignedTaskNotification);
                        
                    });

                    taskCommentNotifications.forEach(element => {
                        let newCommentNotification=document.createElement("div");
                        newCommentNotification.setAttribute("class","notification assigned-notification");
                        let firstText=document.createElement("p");
                        
                        let commentedByName;
                        projectMembers.forEach(member => {
                            if(element["project_member_id"]==member["id"]){
                                commentedByName=member["name"];
                            }
                        });

                        firstText.innerHTML=commentedByName+" commented on a task you are assigned to:";
                        newCommentNotification.appendChild(firstText);
                        let innerDiv=document.createElement("div");
                        innerDiv.setAttribute("class","notification-more-info")
                        let taskName=document.createElement("h4");
                        taskName.innerHTML="Comment:";
                        let taskDescription=document.createElement("p");
                        taskDescription.innerHTML=element["content"].substring(0,30);
                        innerDiv.appendChild(taskName);
                        innerDiv.appendChild(taskDescription);
                        newCommentNotification.appendChild(innerDiv);
                        let date=document.createElement("h6");
                        date.setAttribute("id","notification-date-time")
                        let dateValue=new Date(element["comment_date"]);
                        date.setAttribute('data-value',dateValue)
                        date.innerHTML=dateValue.toLocaleString('pt-PT');
                        newCommentNotification.appendChild(date);
                        divsToAppend.push(newCommentNotification);
                    });

                    divsToAppend.sort(function(a,b){
                        
                        if (new Date(a.querySelector('#notification-date-time').getAttribute('data-value'))>new Date(b.querySelector('#notification-date-time').getAttribute('data-value'))){
                            return -1;
                        }
                        if (new Date(a.querySelector('#notification-date-time').getAttribute('data-value'))<new Date(b.querySelector('#notification-date-time').getAttribute('data-value'))){
                            return 1;
                        }
                        return 0;
                    })

                    divsToAppend.forEach(element => {
                        let divider=document.createElement("div");
                        divider.setAttribute("class","slide-right-menu-divider");   
                        notificationsContainer.appendChild(divider);
                        notificationsContainer.appendChild(element);
                    });
                    
                })
                notificationBalls.forEach(element => {
                    if(element.getAttribute("data-id")==id){
                        element.style.display="none";
                    }
                });
                
            })
        });
    });
}



function genericResponseHandlerWithRefresh() {
    if (this.status == 207) {
        alert(this.response);
    }
    location.reload(true);
    return;
}

function genericResponseHandler() {
    console.log(this.status);
    if (this.status >= 400) {
        location.reload(true);
    }
    else if (this.status == '207') {
        alert(this.response);
    }
    return;
}




function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data)
        .map(function (k) {
            return encodeURIComponent(k) + "=" + encodeURIComponent(data[k]);
        })
        .join("&");
}

function sendAjaxRequest(method, url, data, handler) {
    let request = new XMLHttpRequest();

    request.open(method, url, true);
    request.setRequestHeader(
        "X-CSRF-TOKEN",
        document.querySelector('meta[name="csrf-token"]').content
    );
    request.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
    );
    request.addEventListener("load", handler);
    request.send(encodeForAjax(data));
}

setUpDropDownMenu();
setUpSlideRightMenu();