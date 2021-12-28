@extends('layouts.app')
@section('content')

<div class="container">
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
      <li>
        {{$error}}
      </li>
      @endforeach
    </ul>
   </div>
  @endif
  @if(session()->get('message'))
  <div class="alert alert-success" role="alert">
    <strong>Success: </strong>{{session()->get('message')}}
  </div>
  @endif
    <div>
        <div >
            <div>
                <div id = "edituserpageTitle">
                    {{Auth::user()->name}}'s Profile
                </div>
                
                <hr class = "edituserpageHR">

                <div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($message = Session::get('success'))
                      <div class="alert alert-success">
                            p>{{$message}}</p>
                      </div>
                   @endif

                   <div class = "userpageSetUp">
                        <div class = "photoSpace">
                            <div id = "userPhoto">
                                <img src="/images/profile-pic.png">
                            </div>
                        </div>
                        <div class = "textSpace">
                            <form action="{{route('edituserpage')}}" method="POST">
                            @csrf
                            <div class = "userpageParam"> 
                                <input type="text" class="edituserpagePlaceholder" id ="name" name="name" value="{{Auth::user()->name}}">
                            </div>
                            <div class = "userpageParam">
                                <input type="text" class="edituserpagePlaceholder" id ="email" value="{{Auth::user()->email}}" name="email">
                            </div>
                            <div id = "buttonUpdate">
                                <button type="submit">Update Profile</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection