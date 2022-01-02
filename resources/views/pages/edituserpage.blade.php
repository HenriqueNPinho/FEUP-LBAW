@extends('layouts.app')
@section('content')

<div class = "profileDiv">
    <div class = "profileTitle">
        {{Auth::user()->name}}'s Profile
    </div>

    <hr class = "edituserpageHR">

    <div class = "BigDivEditProfile">
        <div class ="goBack">
            <a href="{{ url('/userpage') }}" class= "goBackButton"> Go back to your profile </a>
        </div>

        <div class = "userpageParam">
            <form method="GET" action="{{'/deleteUserPhoto'}}" >
                <input type="hidden">

                <button type="submit" class= "deleteImageText" id="deleteImageButtonID" onclick="return confirm('Are you sure you want to delete your profile image?')" >
                    <i class="fas fa-trash-alt blackIcon"></i>
                    Delete Image
                </button>
            </form>
        </div>

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
                                <p><input type="file"  accept="image/*" name="profile_image" id="profile_image"  onchange="loadFile(event)" style="display: none;"></p>
                                <div class = "editImageButton">
                                    <i class="fas fa-pencil-alt blackIcon"></i>
                                    <p><label for="profile_image" class= "deleteImageText" id= "uploadImageButton"> Edit</label></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id = "divButtonUpdate">
                        <button type="submit" id = "buttonUpdate">Update Profile</button>
                    </div>
                </div>
            </div>
        </form>
        <hr id = "changePasswordHR">
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
                <input id="password" type="password" class="edituserpagePlaceholder" name="current_password" autocomplete="current-password">
        
                <label for="password" class="editprofileText">New Password</label>
                <input id="new_password" type="password" class="edituserpagePlaceholder" name="new_password" autocomplete="current-password">

                <label for="password" class="editprofileText">New Confirm Password</label>
                <input id="new_confirm_password" type="password" class="edituserpagePlaceholder" name="new_confirm_password" autocomplete="current-password">
            </div>
            <button type="submit" id = "passButton">
                Update Password
            </button>
        </form>
    </div>
</div>

@endsection