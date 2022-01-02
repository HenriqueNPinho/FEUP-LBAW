<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Shows the project for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if (!Auth::check()) return redirect('/login');
        $this->authorize('list', Project::class);
        $projects = Auth::user()->projects()->orderBy('id')->get();
        $project = Project::find($id);
        $this->authorize('access', $project);
        return view('pages.project', ['project' => $project,'projects' =>$projects]);
    }

    /**
     * Shows all cards.
     *
     * @return Response
     */
    public function list()
    {
        if (!Auth::check()) return redirect('/login');
        $this->authorize('list', Project::class);
        $projects = Auth::user()->projects()->orderBy('id')->get();
        
        return view('pages.projects', ['projects' => $projects]);
    }

    public function taskSearch(Request $request, $id)
    {
        if (!Auth::check()) return redirect('/login');
        $project = Project::find($id);
        $this->authorize('access',$project);
        $this->authorize('list', Project::class);
        $projects = Auth::user()->projects()->orderBy('id')->get();
        $project = Project::find($id);
        $searchQuery=$request["search-tasks-query"];
        $searchResults=array();
        foreach($project->tasks as $task){
            if(str_contains(strtoupper($task->name),strtoupper($searchQuery)) || str_contains(strtoupper($task->description),strtoupper($searchQuery))){
                array_push($searchResults,$task);
            }
        }
        return view('pages.task-search-results',['searchResults'=>$searchResults,'project' => $project,'projects' =>$projects]);
    }
    public function createproject()
    {
        if (Auth::check()){
          $projects = Auth::user()->projects()->orderBy('id')->get();
          return view('pages.createProject', ['projects'=>$projects]);
        }
    }
    public function create()
    {
        
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
