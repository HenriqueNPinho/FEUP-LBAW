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
                @if($forumPost->deleted)
                <div class = "forumPost">
                    
                    <img class="forum-post-profile-image" src="{{$forumPost->postAuthor->profile_image}}" alt="">
                    <div class="forum-post-name-date-options-content">
                        <div class="forum-post-name-date-options">
                            <div class="forum-post-name-plus-date">
                                <h5>{{$forumPost->postAuthor->name}}</h5>
                                <h6 class="forum-post-date-value">{{$forumPost->post_date}}</h6>
                            </div>
                            @if($forumPost->isAuthor(Auth::user()))
                            <div class="forum-post-options-container">
                                <div class="forum-post-options-menu">
                                    <div data-id="{{$forumPost->id}}" class="forum-post-edit-post-button"><h4>Edit post</h4></div>
                                    <div data-id="{{$forumPost->id}}" class="forum-post-delete-post-button"><h4>Delete post</h4></div>
                                </div>
                                <img class="forum-post-options-button" src="/images/icons/3points.png" alt="">
                            </div>
                            @endif
                        </div>
                        <div>   
                            <p class="delete-post-content">This post was deleted by the post's author.</p>
                        </div>
                        <!-- <textarea name="" id=""></textarea>
                        <div id="edit-forum-post-save-button">Save</div> -->
                    </div>
                    
                </div>
                @else
                <div class = "forumPost">
                    
                    <img class="forum-post-profile-image" src="{{$forumPost->postAuthor->profile_image}}" alt="">
                    <div class="forum-post-name-date-options-content">
                        <div class="forum-post-name-date-options">
                            <div class="forum-post-name-plus-date">
                                <h5>{{$forumPost->postAuthor->name}}</h5>
                                <h6 class="forum-post-date-value">{{$forumPost->post_date}}</h6>
                            </div>
                            @if($forumPost->isAuthor(Auth::user()))
                            <div class="forum-post-options-container">
                                <div class="forum-post-options-menu">
                                    <div data-id="{{$forumPost->id}}" class="forum-post-edit-post-button"><h4>Edit post</h4></div>
                                    <div data-id="{{$forumPost->id}}" class="forum-post-delete-post-button"><h4>Delete post</h4></div>
                                </div>
                                <img class="forum-post-options-button" src="/images/icons/3points.png" alt="">
                            </div>
                            @endif
                        </div>
                        <p>{{$forumPost->content}}</p>
                        <!-- <textarea name="" id=""></textarea>
                        <div id="edit-forum-post-save-button">Save</div> -->
                    </div>
                    

                </div>
                @endif
                @endforeach
            </div>
            <div class="new-post-content-input"  data-project-id="{{$project->id}}">
                <textarea id="new-post-text-area-input" name="content" placeholder="Type a new message..." cols="120" rows="4"></textarea>
                <img id="createNewPostButton" src="/images/icons/send.png" alt="">
            </div>
        </div>
    </div>
</div>

@endsection
