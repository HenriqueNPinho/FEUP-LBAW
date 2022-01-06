

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

            notifications.addEventListener("click",function(){
                notificationsContainer.style.display="flex";
                mainOptionsContainer.style.display="none"
                
            })
        });
    });
}



function genericResponseHandlerWithRefresh() {
    if (this.status >= 400) {
        if(this.response!=""||this.response!=null)
            alert(this.response);
        //console.log(this.response);
    }
    location.reload(true);
    return;
}

function genericResponseHandler() {
    if (this.status >= 400) {
        if(this.response!=""||this.response!=null)
            alert(this.response);
        location.reload(true);
    }
    console.log(this.status);
    console.log(this.response);
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

/* ======================================================== */
/* ADMIN CODE */

function adminCollapse(elementID){
    var content = document.getElementById(elementID);
    if (content.style.display === "block") {
        content.style.display = "none";
    } else {
        content.style.display = "block";
    }
}
