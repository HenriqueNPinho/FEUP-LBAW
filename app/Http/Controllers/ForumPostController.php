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
        $this->authorize('access', $project);

        return view('pages.project-forum', ['project'=>$project, 'projects'=>$projects]);
    }

    public function create(Request $request, $project_id) {
        if (!Auth::check()) return redirect ('/login');

        $forumPost = new ForumPost();
        $forumPost->project_id = $project_id;
        $forumPost->project_member_id = Auth::user()->id;
        $forumPost->content = $request->input('content');
        $forumPost->post_date = date('Y-m-d H:i:s+00');
        $forumPost->deleted = false;
        $forumPost->save();

        return $forumPost;
    }
   
    /**
     * Creates a new card.
     *
     * @return Card The card created.
     */
    // public function create(Request $request)
    // {
    //   $card = new Card();

    //   $this->authorize('create', $card);

    //   $card->name = $request->input('name');
    //   $card->user_id = Auth::user()->id;
    //   $card->save();

    //   return $card;
    // }

    // public function delete(Request $request, $id)
    // {
    //   $card = Card::find($id);

    //   $this->authorize('delete', $card);
    //   $card->delete();

    //   return $card;
    // }
}
