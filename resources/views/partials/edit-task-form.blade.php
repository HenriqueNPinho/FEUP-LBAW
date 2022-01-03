<div id="edit-task-form">
    <div id="edit-task-form-header">
        <h2>EDIT TASK</h2>
        <img id="close-edit-task-form" src="/images/icons/close.png" alt="">
    </div>
    
    <input id="edit-task-name-input" type="text" name="name" placeholder="Task Name">
    <textarea id="edit-task-description-input" name="description" placeholder="Description of your task" cols="40" rows="5"></textarea>
    <div class="two-column-container">
        <div id="edit-member-selection">
            <h4>ASSIGN MEMBERS TO THE TASK</h4>
            @foreach ($project->members as $member)
            <div id="edit-member-selection-option">
                <input class="edit-member-selection-option-input" type = "checkbox" data-id = "{{$member->id}}" name = "{{$member->name}}" >
                <label for = "{{$member->id}}"> {{$member->name}}</label>
            </div>
            @endforeach
        </div>
        <div id="edit-task-end-date-selection">
            <h4>DELIVERY (MM/DD/YY)</h4>
            <input type="date" id="edit-task-end-date" value="2021-12-22" required pattern="\d{4}-\d{2}-\d{2}">
        </div>
    </div>
    
    <div id="editTaskButton" class="button"><h4>UPDATE TASK</h4></div>
</div>