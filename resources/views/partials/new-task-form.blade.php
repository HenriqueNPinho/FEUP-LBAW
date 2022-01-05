<div id="new-task-form">
    <div id="new-task-form-header">
        <h2>Create a new task</h2>
        <img id="close-new-task-form" src="/images/icons/close.png" alt="">
        
    </div>
    
    <input id="new-task-name-input" type="text" name="name" placeholder="Task Name">
    <textarea id="new-task-description-input" name="description" placeholder="Description of your task" cols="40" rows="5"></textarea>
    <div class="two-column-container">
        <div id="new-member-selection">
            <h4>ASSIGN MEMBERS TO THE TASK</h4>
            @foreach ($project->members as $member)
            <div id="new-member-selection-option">
                <input class="new-member-selection-option-input" type = "checkbox" data-id = "{{$member->id}}" name = "{{$member->name}}" >
                <label for = "{{$member->id}}"> {{$member->name}}</label>
            </div>
            @endforeach
        </div>
        <div id="new-task-end-date-selection">
            <h4>DELIVERY (MM/DD/YY)</h4>
            <input type="date" id="new-task-end-date" value='<?php echo date('Y-m-d',time()+86400);?>' min='<?php echo date('Y-m-d',time()+86400);?>' required pattern="\d{4}-\d{2}-\d{2}">
        </div>
    </div>
    
    <div id="createNewTaskButton" class="button"><h4>ADD TASK</h4></div>
</div>