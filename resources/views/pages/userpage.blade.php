@extends('layouts.app')
@section('content')

<div class = "profileDiv">
    <div class = "profileTitle">
        {{Auth::user()->name}}'s Profile
    </div>
    <hr class = "edituserpageHR">
    <div class = "userpageSetUp">
        <div class = "photoSpace">
            <div id = "userPhoto">
                @if(empty(Auth::user()->profile_image))
                    <img src = "/images/avatars/profile-pic.png" id = "defaultProfilePhoto">
                @else
                <img src ="{{Auth::user()->profile_image}}"  id = "defaultProfilePhoto"> 
                @endif
            </div>
        </div>
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
        </div>  
    </div>
    @if (!is_null($user->profile_description))
        <div class = "descriptionBox">
            <div class = "userpageParam"> 
                <p class="userDescription">{{ $user->profile_description }}</p>
            </div>
        </div>
    @endif

    <a href="{{ url('/edituserpage') }}" id = "editprofileButton">Edit Profile </a>
</div>
@endsection

