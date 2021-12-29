<div draggable="true" class="task-preview" data-id="{{$task->id}}">
    <div class="task-preview-info">
        <h3>{{ $task->name }}</h3>
        <p>{{$task->description}}</p>
        <h4>{{$task->delivery_date}}</h4>
    </div>
    <div>
        @if(count($task->members)>9)
        <div class="alternate-member-count"><h2>{{count($task->members)}}+</h2></div>
        @elseif(count($task->members)>0)
        <div class="alternate-member-count"><h2>{{count($task->members)}}</h2></div>
        @endif
    </div>
</div>