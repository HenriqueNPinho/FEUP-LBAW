@extends('layouts.app')
@section('content')
<script type="text/javascript" src={{ asset('js/user-page.js') }} defer></script>
<div class = "profileDiv">


    
    <div class = "userpageSetUp">
        <div class = "textSpace">
            <div class="userpageInfo">
                <h2>Your Profile</h2>
                <hr class = "userPageHR">
                <h1>{{ $user->name }}</h1>
                
            </div>
            <div class="userpageInfo">
                <div id = "emailSpace">
                    <p class="userEmail">{{ $user->email }}</p>
                </div>
            </div>
            @if (!is_null($user->profile_description))
            <div class = "descriptionBox">
                <div class = "userpageParam"> 
                    <p class="userDescription">{{ $user->profile_description }}</p>
                </div>
            </div>
            @endif

            <div class="textSpaceButtons">
                <a  class="profileButton" href="{{ url('/edituserpage') }}" id = "editProfileButtonText">Edit Profile </a>


                <form method="GET" action="{{'/deleteuser'}}" >
                    <input type="hidden" id= "deleteaccountButton" onchange="sofi(event)">
                    <button type="submit" id="profileButtonDelete" class= "profileButton" >Delete Account</button>
                </form>
            </div>
            

        </div>  
        <div class = "photoSpace">
            <div id = "profilePhoto">
                <div id = "containerEditPhoto" >
                    <div class = "profilePhotoCropper">
                        @if(empty(Auth::user()->profile_image))
                            <img src = "/images/avatars/profile-pic-2.png" class = "roundPhoto" id = "tempProfilePhoto">
                        @else
                            <img src ="{{Auth::user()->profile_image}}" class = "roundPhoto" id = "tempProfilePhoto"> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <div class="project-invites">
        <h2>Project Invites</h2>
        <hr class = "userPageHR">
        @if(count($projectInvitations)==0)
            <h4>You currently have no project invitations.</h4>
        @endif
        @foreach ($projectInvitations as $projectInvitation)
            <div class="project-invite" >
                <h4>Project Name: {{$projectInvitation->name}}</h4>
                <p>Description: {{$projectInvitation->description}}</p>
                <div class="accept-icons-container">
                    <div class="accept-reject-icon">
                        <img class="accept-project-icon" data-id="{{$projectInvitation->pivot->project_id}}" src="/images/icons/accept.png" alt="">
                        <h5>Join</h5>
                    </div>
                    <div class="accept-reject-icon">
                        <img class="reject-project-icon" data-id="{{$projectInvitation->pivot->project_id}}" src="/images/icons/reject.png" alt="">
                        <h5>Ignore</h5>
                    </div>
                    
                </div>
            </div>
        @endforeach
    </div>

    
</div>
@endsection

