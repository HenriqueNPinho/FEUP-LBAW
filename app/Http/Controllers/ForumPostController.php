<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ForumPostController extends Controller
{

    public function getProjectForum($project_id) {
        if (!Auth::check()) return redirect ('/login');

        $projects = Auth::user()->projects()->orderBy('id')->get();
        $project = Project::find($project_id);
        $this->authorize('memberAccess', $project);

        return view('pages.project-forum', ['project'=>$project, 'projects'=>$projects]);
    }

    public function create(Request $request, $project_id) {
        if (!Auth::check()) return redirect ('/login');
        $project = Project::find($project_id);
        $this->authorize('memberAccess', $project);
        $forumPost = new ForumPost();
        $forumPost->project_id = $project_id;
        $forumPost->project_member_id = Auth::user()->id;
        $forumPost->content = $request->input('content');
        $forumPost->post_date = date('Y-m-d H:i:s+00');
        $forumPost->deleted = false;
        $forumPost->save();

        return $forumPost;
    }

    public function delete($post_id)
    {
        if (!Auth::check()) return redirect ('/login');
        $post=ForumPost::find($post_id);
        $this->authorize('postAuthorAccess',$post);
        $post->deleted=true;
        $post->save();
        return;
    }

}
