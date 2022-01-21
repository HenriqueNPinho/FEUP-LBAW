@extends('layouts.app')
@section('title', $project->name." Settings")
@section('content')


<div id="project-area">
    @include('partials.projects-bar')

    @include('partials.slide-right-menu')

    <div class="project-overview" data-id="{{$project->id}}">
        <div id="project-overview-top-bar">
            <div id="project-overview-top-bar-left">
                <h2 id="project-title">{{$project->name}} - Settings</h2>
            </div>
        </div>
        @if($project->company!=null)
        <div id="project-overview-company-info">
            <i class="fas fa-briefcase iconUserPage fa-2x"></i>
            <h3>{{$project->company->name}}</h3>
        </div>
        @endif
        
        <div id="project-settings-columns-container">
            <div>
                <form class="settings-form" method="POST" action="/project/{{$project->id}}/addMember">
                    @csrf
                    <h3>Assign a new member</h3>
                    <p id="assign-member-settings-form-explain">The person you invite will receive an email they can use to join the project. They can also access their profile and accept the invitation there</p>
                    @if ($errors->has('email'))
                    @foreach ($errors->get('email') as $message)
                        <span class="error">
                            {{ $message}}
                        </span>
                    
                    @endforeach   
                    @endif
                    <input type="text" name="email" placeholder="ex: email@emailprovider.com">
                    <button type="submit">ADD MEMBER</button>
                </form>
                @if($project->isCoordinator(Auth::user()))
                    <form class="settings-form" method="POST" action="/project/{{$project->id}}/removeMember">
                        @csrf
                        <h3>Remove members from the project</h3>
                        <select name="member-to-remove" id="member-to-remove-select">
                        @foreach ($project->members as $member)
                            <option value="{{$member->id}}">{{$member->name}}</option>
                        @endforeach
                        </select>
                        <button id="settings-form-remove-member-button" type="submit">REMOVE MEMBER</button>
                    </form>
                    <form class="settings-form" method="POST" action="/project/{{$project->id}}/addCoordinator">
                        @csrf
                        <h3>Assign a new project coordinator</h3>
                        <select name="coordinator" id="new-coordinator-select">
                        @foreach ($project->members as $member)
                            @if(!$project->isCoordinator($member))
                                <option value="{{$member->id}}">{{$member->name}}</option>
                            @endif
                        @endforeach
                        </select>
                        <button type="submit">ADD COORDINATOR</button>
                    </form>
                @endif
            </div>
            <div>
                @if($project->isCoordinator(Auth::user()))
                    <form method="POST" class="settings-form" action="/project/{{$project->id}}/archive">
                        @csrf
                        <h3>Archive this project</h3>
                        <p>If you archive this project only the system administrator will be able unarchive it.</p>
                        <button type="submit" id="settings-form-archive-button">ARCHIVE PROJECT</button>
                    </form>
                @endif
                <form method="POST" class="settings-form" action="/user/{{$project->id}}/leave">
                    @csrf
                    <h3>Leave this project</h3>
                    <p>If you leave this project you will loose access to all its content.</p>
                    <button type="submit" id="settings-form-leave-button">LEAVE PROJECT</button>
                </form>
            </div>
            
            
        </div>
        
    </div>
</div>

@endsection
