<div id="task-page">
    <div id="task-page-header">
        <h1 id="task-page-task-name">TASK NAME GOES HERE</h1>
        <div>
            <img id="edit-task-icon" src="/images/icons/edit.png" alt="edit-task-icon">
            <img id="delete-task-icon" src="/images/icons/delete.png" alt="delete-task-icon">
            <img id="close-task-page" src="/images/icons/close.png" alt="close-task-icon">
            
        </div>
    </div>
    <div id="task-page-members">
    </div>
    
    <div>
        <div>
            <div id="task-description-container">
                <h2>DESCRIPTION</h2>
                <p id="task-page-task-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos laudantium eveniet tenetur alias facere iste tempore fugiat cumque? Ex, dolore?</p>
            </div>
            <div id="task-page-task-date-container">
                <img src="/images/icons/calendar.png" alt="date-icon">
                <p id="task-page-task-date">I got my first real six string Bought it at the five and dime Played it till my fingers bled Was the summer of '69…</p>
            </div>
            <div id="task-comments-container">
                <h2>COMMENTS</h2>
                <div id="add-task-page-comment" class="task-page-comment">
                    @if(Auth::user()->profile_image==null)
                    <img src="/images/avatars/profile-pic-2.png" alt="user-profile-image">
                    @else
                    <img src="{{Auth::user()->profile_image}}" alt="user-profile-image">
                    @endif
                    <div>
                        <h5>{{Auth::user()->name}}</h5>
                        <textarea id="add-task-comment-content-input" placeholder="Write your comment here." name="comment"></textarea>
                        <h4 id="add-task-comment-button">Comment</h4>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
</div>