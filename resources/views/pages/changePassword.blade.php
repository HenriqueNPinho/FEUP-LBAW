@extends('layouts.app')

@section('content')

<div class = "userpageSetUp">
    <div class = "textSpace">
        <div class="userpageInfo">
                <h2>Reset Password</h2>
                <hr class = "userPageHR">
                <div class="editprofileText" id = "changeP">
                    <form method="POST" action="{{ route('changePassword') }}" enctype="multipart/form-data"  id = "passwordForm">
                        @csrf 
                        @foreach ($errors->all() as $error)
                        <span id = "errorEditProfile" >
                            {{ $error }}
                        </span>
                        @endforeach 
                        <div class = "userpageParam"> 
                            <label for="password" class="editprofileText passInputPlaceHolder">Current Password</label>
                            <input id="password" type="password" class="edituserpagePlaceholder passInputPlaceHolder" name="current_password">
                    
                            <label for="password" class="editprofileText">New Password</label>
                            <input id="new_password" type="password" class="edituserpagePlaceholder passInputPlaceHolder" name="new_password">

                            <label for="password" class="editprofileText">New Confirm Password</label>
                            <input id="new_confirm_password" type="password" class="edituserpagePlaceholder passInputPlaceHolder" name="new_confirm_password">
                        </div>
                        <div id="userpage-edit-buttons">
                            <a href="{{ url('/userpage') }}" class="goBackButton"> GO BACK TO YOUR PROFILE </a>
                            <button type="submit" >Save New Password</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
@endsection
