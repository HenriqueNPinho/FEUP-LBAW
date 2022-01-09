@extends('layouts.app')
@section('content')
<div class = "profileDiv">
    
    <div class = "userpageSetUp">
        <div class = "textSpace">
            <div class="userpageInfo">
                <h2>Your Profile</h2>
                <hr class = "userPageHR">
                <h1>{{ $user->name }}</h1>
                <script>console.log("{{$user}}")</script>
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
        </div>  
        <div class = "photoSpace">
            <div id = "profilePhoto">
                <div id = "containerEditPhoto" >
                    <div class = "profilePhotoCropper">
                        @if(empty($user->profile_image))
                            <img src = "/images/avatars/profile-pic-2.png" class = "roundPhoto" id = "tempProfilePhoto">
                        @else
                            <img src ="{{$user->profile_image}}" class = "roundPhoto" id = "tempProfilePhoto"> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection

