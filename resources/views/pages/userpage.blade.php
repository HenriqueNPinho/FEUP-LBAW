@extends('layouts.app')
@section('content')

<div class = "profileDiv">
    <div class = "profileTitle">
        {{Auth::user()->name}}'s Profile
    </div>
    <hr class = "edituserpageHR">
    <div class ="goBack">
        <form method="GET" action="{{'/deleteuser'}}" >
            <input type="hidden" id= "deleteaccountButton" onchange="sofi(event)">
            <button type="submit" class= "goBackButton" >Delete Account</button>
        </form>
    </div>
    <div class = "userpageSetUp">
        <div class = "textSpace">
            <div class="userpageInfo">
                <p class="userName">{{ $user->name }}</p>
                <hr id = "userPageHR">
            </div>
            <div class="userpageInfo">
                <div id = "emailSpace">
                    <i class="fas fa-envelope icon" id = "emailIcon" ></i>
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
            <div id ="editProfileButton">
                <a href="{{ url('/edituserpage') }}" id = "editProfileButtonText">Edit Profile </a>
            </div>
        </div>  
        <div class = "photoSpace">
            <div id = "profilePhoto">
                <div id = "containerEditPhoto">
                    <div class = "profilePhotoCropper">
                        @if(empty(Auth::user()->profile_image))
                            <script>
                                console.log("não tem profile_image")
                            </script>
                            <img src = "/images/avatars/profile-pic-2.png" class = "roundPhoto" id = "tempProfilePhoto">
                        @else
                            <img src ="{{Auth::user()->profile_image}}" class = "roundPhoto" id = "tempProfilePhoto"> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

