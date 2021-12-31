@extends('layouts.app')
@section('content')

<div class = "profileDiv">
    <div class = "profileTitle">
        {{Auth::user()->name}}'s Profile
    </div>

    <hr class = "edituserpageHR">

    <div class ="goBack">
        <a href="{{ url('/userpage') }}" class= "goBackButton"> Go back to your profile </a>
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
            </div>
        </div>
        <div id = "divButtonUpdate">
            <button type="submit" id = "buttonUpdate">Update Profile</button>
        </div>
    </form>
    <div class = "userpageParam">
        <div id = "deleteImageButton">
            <i class="fas fa-trash-alt blackIcon"></i>
            <form method="GET" action="{{'/deleteUserPhoto'}}" >
                <input type="hidden">
                <button type="submit" class= "deleteImageText" id="deleteImageButtonID" >Delete Image</button>
            </form>
        </div>
    </div>
    <script>
        function sofi(event){
            console.log("clickei");
        };
    </script>
</div>
</div>


@endsection