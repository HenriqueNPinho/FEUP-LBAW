@extends('layouts.app')
@section('content')

<div class = "userpageSetUp">
    <div class = "photoSpace">
        <div id = "userPhoto">
            <img src="/images/profile-pic.png">
        </div>
        <button type="button" id='editPhoto'>Edit Photo</button>
        <form id='editImagenput'>
        @csrf
            <div>
                <input class="form-control" type="file" accept="image/png, image/gif, image/jpeg" id='fileAvatar'>
                <button type="button" id='cancelImage'><i class="bi bi-x"></i></button>
                <button type="button" id='saveImage'><i class="bi bi-check"></i></button>
            </div>
        </form>
    </div>
    <div class = "textSpace">

    </div>
</div>



@endsection