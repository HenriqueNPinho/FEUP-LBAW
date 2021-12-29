@extends('layouts.app')
@section('content')
<div class = "profileDiv">
    <div class = "profileTitle">
        {{Auth::user()->name}}'s Profile
    </div>

    <hr class = "edituserpageHR">
    <form action="{{route('edituserpage')}}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class = "userpageSetUp">
            <div class = "photoSpace">
                <div id = "profilePhoto">
                    @if(empty(Auth::user()->profile_image))
                        <img src = "/images/avatars/profile-pic.png" id = "ProfilePhoto">
                    @else
                        <img src ="{{Auth::user()->profile_image}}" id = "ProfilePhoto"> 
                    @endif
                </div>
                <div class = "userpageParam">
                    <!--
                    <input type="fyle" accept="image/png, image/gif, image/jpeg" id ="profile_image" onchange="loadFile(event)">
                    
                    @if ($errors->has('profile_image'))
                    
                        <span class="error">
                            {{ $errors->first('profile_image') }}
                        </span>
                    @endif 
                    <script>
                        var loadFile = function(event) {
                            var image = document.getElementById('output');
                            image.src = URL.createObjectURL(event.target.files[0]);
                        };
                    </script> -->
                    <p><input type="file"  accept="image/*" name="profile_image" id="profile_image"  onchange="loadFile(event)" style="display: none;"></p>
                    <p><label for="profile_image" id= "uploadImageButton"> Upload Image</label></p>
                    <!--<p><img id="output" width="200" src = "/images/avatars/profile-pic.png"></p>-->

                    <script>
                        var loadFile = function(event) {
                            
                            var image = document.getElementById('ProfilePhoto');
                            image.src = URL.createObjectURL(event.target.files[0]);
                            
                            //image.style.border-radius= '50%';

                            //Auth::user()->profile_image = image;
                            image.onload = function() {
                                URL.revokeObjectURL(image.src) // free memory
                            }
                        };
                    </script>
                </div>
                <!--
                <div id = "savePhoto">
                    <button type= "button" class= "red"> Confirm Photo</button>
                </div> 
                -->
            </div>
            <div class = "textSpace">
                    <div class = "userpageParam"> 
                        <i class="fas fa-user-tie editProfileIcon fa-2x" ></i>
                        <input type="text" class="edituserpagePlaceholder" id ="name" name="name" value="{{Auth::user()->name}}">
                        @if ($errors->has('name'))
                            <span class="error">
                                {{ $errors->first('name') }}
                            </span>
                        @endif
                    </div>
                    <div class = "userpageParam">
                        <i class="fas fa-envelope icon editProfileIcon fa-2x" ></i>
                        <input type="email" class="edituserpagePlaceholder" id ="email" value="{{Auth::user()->email}}" name="email">
                        @if ($errors->has('email'))
                            <span class="error">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
            </div>
    </div>
    <div class = "descriptionBox">
        <div class = "userpageParam"> 
            <input type="text" class="editdescriptionBox" id ="profile_description" name="profile_description" value="{{Auth::user()->profile_description}}">
            @if ($errors->has('name'))
                <span class="error">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>
    </div>
    <div id = "buttonUpdate">
        <button type="submit">Update Profile</button>
    </div>
    </form>
    <!--
    <form id="profile-image-form" method="POST" action="{{route('edituserpage')}}" enctype="multipart/form-data">
        @csrf
        <div class="col mb-3">
            <label for="formFile" class="form-label">
                <i class="fa fa-cog edit-cog" aria-hidden="true" style="cursor: pointer;"></i>
            </label>
            <input class="form-control" type="file" id="formFile" style = "display: none;" name="profile_image" accept="image/png, image/jpeg">
        </div>
    </form>

    <script>
        document.getElementById("formFile").onchange = function() {
            console.log("estou a editar a imagem com sucesso kkkk");
            document.getElementById("profile-image-form").submit();
        };
    -->

    <!--
    <p><input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;"></p>
    <p><label for="file" style="cursor: pointer;">Upload Image</label></p>
    <p><img id="output" width="200" /></p>

    <script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    </script>
    -->
</div>

@endsection