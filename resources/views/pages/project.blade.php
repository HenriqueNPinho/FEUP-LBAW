@extends('layouts.app')

@section('content')
<script type="text/javascript" src={{ asset('js/project-page.js') }} defer></script>

@if (!($user->is_admin))
    <div id="project-area">
    @include('partials.projects-bar')

    @include('partials.slide-right-menu')
        <div class="project-overview" data-id="{{$project->id}}">
            <div id="project-overview-opaque-cover"></div>
            @include('partials.new-task-form')
            @include('partials.edit-task-form')
            @include('partials.task-page')
            @include('partials.project-members-page')
            
            <div id="project-overview-top-bar">
                <div id="project-overview-top-bar-left">
                    <h2 id="project-title">{{$project->name}}</h2>
                    
                    @if(count($project->members)>3)
                        @for($i = 0; $i <= 2; $i++)
                            @if(empty($project->members[$i]->profile_image))
                                <img data-id="{{$project->members[$i]->id}}" title="{{$project->members[$i]->name}}" alt="{{$project->members[$i]->name}}" class="profile-image-link" src = "/images/avatars/profile-pic-2.png">
                            @else
                                <img data-id="{{$project->members[$i]->id}}" title="{{$project->members[$i]->name}}" alt="{{$project->members[$i]->name}}" class="profile-image-link" src ="{{$project->members[$i]->profile_image}}"> 
                            @endif
                        @endfor
                        @if((count($project->members)-3)>9)
                            <div class="extra-members-count-div"><h2>9+</h2></div>
                        @else
                            <div class="extra-members-count-div"><h2>+{{count($project->members)-3}}</h2></div>
                        @endif
                    @else
                        @foreach($project->members as $member)
                            @if(empty($member->profile_image))
                                <img data-id="{{$member->id}}" title="{{$member->name}}" alt="{{$member->name}}" class="profile-image-link" src = "/images/avatars/profile-pic-2.png">
                            @else
                                <img data-id="{{$member->id}}" title="{{$member->name}}" alt="{{$member->name}}" class="profile-image-link" src ="{{$member->profile_image}}"> 
                            @endif
                        @endforeach
                    @endif
                </div>
                <div id="project-overview-top-bar-right">
                    <form method="GET" action="{{'/project/'.$project->id.'/search'}}" id="search-tasks-form" role="search">
                        <label for="search">Search for stuff</label>
                        <input name="search-tasks-query" id="search-tasks-query" type="search" placeholder="Search for tasks here..." autofocus required />
                        <button type="submit">Go</button>    
                    </form>
                    <div id="project-options-container">
                        <img id="project-options-3points-icon" src="/images/icons/3points.png" alt="">
                        <div id="project-options">
                            @if(Auth::user()->isFavorite($project))
                                <div id="remove-from-favorites-button"><h4>Remove from favorites</h4></div>
                            @else
                                <div id="add-to-favorites-button"><h4>Mark project as favorite</h4></div>
                            @endif
                            @if($project->isCoordinator(Auth::user()))
                                <div id="archive-project-button"><h4>Archive project</h4></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="boards-container">
                <div id="not-started" class="board">
                    <div class="board-header">
                        <h2>TO DO</h2>
                        <img class="new-task-plus" src="/images/icons/plus-blue.png" data-id="Not Started">
                    </div>
                    @each('partials.task-preview',$project->tasks()->where('status','Not Started')->get(),'task')
                </div>
                <div id="started" class="board">
                    <div class="board-header">
                        <h2>DOING</h2>
                        <img class="new-task-plus" src="/images/icons/plus-blue.png" data-id="In Progress">
                    </div>
                    @each('partials.task-preview',$project->tasks()->where('status','In Progress')->get(),'task')
                </div>
                <div id="complete" class="board">
                    <div class="board-header">
                        <h2>DONE</h2>
                        <img class="new-task-plus" src="/images/icons/plus-blue.png" data-id="Complete">
                    </div>
                    @each('partials.task-preview',$project->tasks()->where('status','Complete')->get(),'task')
                </div>
            </div>

        
        </div>
    </div>
@elseif ($user->is_admin)
    <div>
        Hi BOSS
    </div>
@endif
@endsection
