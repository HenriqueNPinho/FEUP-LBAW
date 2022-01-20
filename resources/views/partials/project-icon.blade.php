
<div class="project-icon-container-grow">
    <div class="project-icon" data-title="{{ $project->name }}" data-id="{{ $project->id }}">
        <h5 class="noselect" >{{ $project->name }}</h5>
    </div>
</div>
@if(Auth::user()->numberNotifications($project->id)>0)
<div data-id="{{ $project->id }}" class="project-icon-number-notifications-container">
    <div class="noselect project-icon-number-notifications">
        <h6>{{Auth::user()->numberNotifications($project->id)}}</h6>
    </div>
</div>
@endif
