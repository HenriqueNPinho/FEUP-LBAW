@extends('layouts.app')

@section('content')
<script type="text/javascript" src={{ asset('js/forum.js') }} defer></script>

<div id="project-area">



  @include('partials.projects-bar')

  @include('partials.slide-right-menu')

    <div class="project-overview" data-id="{{$project->id}}">
        <div id="project-overview-top-bar">
            <div id="project-overview-top-bar-left">
                <h2 id="project-title">{{$project->name}}</h2>

                @if(count($project->members)>3)
                    @for($i = 0; $i <= 2; $i++)
                        <img src="{{$project->members[$i]->profile_image}}" alt="">
                        @if((count($project->members)-3)>9)
                            <div><h2>9+</h2></div>
                        @else
                            <div><h2>{{count($$project->members)}}+</h2></div>
                        @endif

                    @endfor
                @else
                    @foreach($project->members as $member)
                        <img src="{{$member->profile_image}}" alt="">
                    @endforeach
                @endif
            </div>
        </div>
        <div id = "forum">
            <div id="forum-posts-container">
                @foreach($project->forumPosts as $forumPost)
                
                <div class = "forumPost">
                    
                    <img class="forum-post-profile-image" src="{{$forumPost->projectMember->profile_image}}" alt="">
                    <div class="forum-post-name-date-options-content">
                        <div class="forum-post-name-date-options">
                            <div class="forum-post-name-plus-date">
                                <h5>{{$forumPost->projectMember->name}}</h5>
                                <h6> Post Date: {{$forumPost->post_date}}</h6>
                            </div>
                            <img class="forum-post-options-button" src="/images/icons/3points.png" alt="">
                        </div>
                        <p>{{$forumPost->content}}</p>
                    </div>
                    
                </div>
                @endforeach
            </div>
            <textarea id="new-post-content-input" data-project-id="{{$project->id}}" name="content" placeholder="Type a new message..." cols="120" rows="4"></textarea>
            <div id="createNewPostButton" type="button" ><h4>Add Post</h4></div>
        </div>
    </div>
</div>

@endsection
