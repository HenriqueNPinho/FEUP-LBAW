@extends('layouts.app')
@section('content')
<script type="text/javascript" src={{ asset('js/edit-userpage.js') }} defer></script>
<div class = "profileDiv">

    <div class = "BigDivEditProfile">
        <form action="{{route('userpage')}}" method="POST" enctype="multipart/form-data" id="edituserpageForm">
            {{ csrf_field() }}
            <div class = "userpageSetUp">
                <div class = "textSpace">
                    <div class = "userpageParam"> 
                        <div class = "editprofileText"> Name </div>
                        <input type="text" class="edituserpagePlaceholder" value="{{Auth::user()->name}}" id ="name" name="name">
                        @if ($errors->has('name'))
                            <span class="error">
                                {{ $errors->first('name') }}
                            </span>
                        @endif
                        <hr class = "hrText">
                    </div>
                    <div class = "userpageParam">
                        <div class = "editprofileText"> Email </div>
                        <input type="email" class="edituserpagePlaceholder" id ="email" value="{{Auth::user()->email}}" name="email">
                        @if ($errors->has('email'))
                            <span class="error">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                    <div class = "userpageParam"> 
                        <div class = "editprofileText"> Bio </div>
                        @if(empty(Auth::user()->profile_description))
                            <input type="text" class="editdescriptionBox" id ="profile_description" name="profile_description" placeholder="You can add here some brief description abouot yourself">
                        @else
                            <input type="text" class="editdescriptionBox" id ="profile_description" name="profile_description" value="{{Auth::user()->profile_description}}">
                        @endif

                        @if ($errors->has('name'))
                            <span class="error">
                                {{ $errors->first('name') }}

                            </span>
                        @endif
                    </div>
                    <div id="userpage-edit-buttons">
                        <a href="{{ url('/userpage') }}" class="goBackButton"> GO BACK TO YOUR PROFILE </a>
                        <button type="submit" id ="buttonUpdate">Update Profile</button>
                    </div>
                    
                </div>
                
            </div>
            <div class = "photoSpace">
                <div class = "editprofileText"> Profile Picture </div>
                <div id = "profilePhoto">
                    <div id = "containerEditPhoto">
                        <div class = "profilePhotoCropper">
                            @if(empty(Auth::user()->profile_image))
                                <img src = "/images/avatars/profile-pic-2.png" class = "roundPhoto" id = "tempProfilePhoto">
                            @else
                                <img src ="{{Auth::user()->profile_image}}" class = "roundPhoto" id = "tempProfilePhoto"> 
                            @endif
                        </div>
                        <div class = "uploadImage">
                            <input type="file"  accept="image/*" name="profile_image" id="profile_image"  onchange="loadFile(event)" style="display: none;">
                            <div class = "editImageButton">
                                <i class="fas fa-pencil-alt blackIcon"></i>
                                <p><label for="profile_image" class= "deleteImageText" id= "uploadImageButton"> Edit</label></p>
                            </div>
                        </div>
                    </div>
                </div>
                <button class= "deleteImageText" id="deleteImageButtonID"  >
                    <i class="fas fa-trash-alt blackIcon"></i>
                    Delete Image
                </button>
            
            </div>
            
        </form>
        <!-- <form method="GET" action="{{'/deleteUserPhoto'}}" >
            <input type="hidden">

            
        </form> -->
        
        <!-- <hr id = "changePasswordHR">
        <div class="editprofileText" id = "changeP">
            Change your password
        </div>
        <form method="POST" action="{{ route('changePassword') }}" enctype="multipart/form-data"  id = "passwordForm">
        @csrf 
        @foreach ($errors->all() as $error)
        <span id = "errorEditProfile" >
            {{ $error }}
        </span>
        @endforeach 
            <div class = "userpageParam"> 
                <label for="password" class="editprofileText">Current Password</label>
                <input id="password" type="password" class="edituserpagePlaceholder" name="current_password">
        
                <label for="password" class="editprofileText">New Password</label>
                <input id="new_password" type="password" class="edituserpagePlaceholder" name="new_password">

                <label for="password" class="editprofileText">New Confirm Password</label>
                <input id="new_confirm_password" type="password" class="edituserpagePlaceholder" name="new_confirm_password">
            </div>
            <button type="submit" id = "passButton">
                Update Password
            </button>
        </form> -->
    </div>
</div>

@endsection