<div id="full-member-list">
    <div id="full-member-list-header">
        <h2>Project Members</h2>
        <img id="close-full-member-list" src="/images/icons/close.png" alt="">
    </div>
    <div id="full-member-list-content">
        @foreach($project->members as $member)
        <a href="/project/userpage/{{$member->id}}">
            <div class="noselect">
                @if($member->profile_image==null)
                <img src="/images/avatars/profile-pic-2.png" alt="">
                @else
                <img src="{{$member->profile_image}}" alt="">
                @endif
                <h2>{{$member->name}}</h2>
            </div>
        </a>
        @endforeach
    </div>
</div>