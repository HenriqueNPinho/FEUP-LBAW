@extends('layouts.app')
@section('title', 'Edit Profile Info')
@section('content')
<script src={{ asset('js/edit-userpage.js') }} defer></script>

@if (!($user->is_admin))
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
                                    <img src = "/images/avatars/profile-pic-2.png" class = "roundPhoto" id = "tempProfilePhoto" alt="user-profile-pic">
                                @else
                                    <img src ="{{Auth::user()->profile_image}}" class = "roundPhoto" id = "tempProfilePhoto" alt="user-profile-pic"> 
                                @endif
                            </div>
                            <div class = "uploadImage">
                                <input type="file"  accept="image/*" name="profile_image" id="profile_image"  onchange="loadFile(event)" style="display: none;">
                                <div class = "editImageButton">
                                    <!-- <i class="fas fa-pencil-alt blackIcon"></i> -->
                                    <label for="profile_image" class= "deleteImageText" id= "uploadImageButton"> Edit</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class= "deleteImageText" id="deleteImageButtonID"  >
                        <!-- <i class="fas fa-trash-alt blackIcon"></i> -->
                        Delete Image
                    </button>
                
                </div>
                
            </form>
        </div>
    </div>
@elseif (($user->is_admin))
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
                        <div class = "editprofileText"> Company's Name </div>
                        <input type="text" class="edituserpagePlaceholder" id ="companyName" value="{{$companyName}}" name="companyName">
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
                                <img src = "/images/avatars/profile-pic-2.png" class = "roundPhoto" id = "tempProfilePhoto" alt="user-profile-pic">
                            @else
                                <img src ="{{Auth::user()->profile_image}}" class = "roundPhoto" id = "tempProfilePhoto" alt="user-profile-pic"> 
                            @endif
                        </div>
                        <div class = "uploadImage">
                            <input type="file"  accept="image/*" name="profile_image" id="profile_image"  onchange="loadFile(event)" style="display: none;">
                            <div class = "editImageButton">
                                <!-- <i class="fas fa-pencil-alt blackIcon"></i> -->
                                <label for="profile_image" class= "deleteImageText" id= "uploadImageButton"> Edit</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button class= "deleteImageText" id="deleteImageButtonID"  >
                    <!-- <i class="fas fa-trash-alt blackIcon"></i> -->
                    Delete Image
                </button>
            
            </div>
            
        </form>
    </div>
</div>

@endif
@endsection