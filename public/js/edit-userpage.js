var loadFile = function (event) {
    var image = document.getElementById("tempProfilePhoto");
    image.src = URL.createObjectURL(event.target.files[0]);
    image.onload = function () {
        URL.revokeObjectURL(image.src); // free memory
    };
};

function setUpDeletePhoto(){
    let deletePhotoButton=document.querySelector("#deleteImageButtonID");
    deletePhotoButton.addEventListener("click",function(){
        if(!confirm("Are you sure you want to delete your current profile picture?")) return;
        sendAjaxRequest("get","api/user/deleteUserPhoto",null,genericResponseHandlerWithRefresh);
    })
}

setUpDeletePhoto();