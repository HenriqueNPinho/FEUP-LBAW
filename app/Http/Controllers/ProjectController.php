<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Project;
use App\Models\User;

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
    public function getCreateProject()
    {
        if (Auth::check()){
          $projects = Auth::user()->projects()->orderBy('id')->get();
          return view('pages.create-project', ['projects'=>$projects]);
        }
        else return redirect('/login');
    }

    public function create(Request $request)
    {
        if (!Auth::check()) return redirect('/login');
        $project=new Project();
        //$company=$request->input('company');
        //if($company!="none")
         // $project->company_id=$request->input('company');
        $project->name=$request->input('name');
        $project->delivery_date=$request->input('date');
        $project->start_date=date('Y-m-d');
        $project->description=$request->input('description');
        

        $project->save();
		
        $project->members()->attach(Auth::user()->id);
        $project->coordinators()->attach(Auth::user()->id);
		
        $membersToInvite=explode(";",$request->input("members"));
        foreach($membersToInvite as $member){
            $user=User::where('email',$member)->first();
            if($user!=NULL){
                $user->projectInvitations()->attach($project->id);
            } 
        }
    }
   
    public function archive($project_id){
        if (!Auth::check()) return redirect('/login');
        $project = Project::find($project_id);
        $this->authorize('archive',$project);
        $project->archived=TRUE;
        $project->save();
        $project->usersFavorite()->detach();
        return;
    }

    public function getSettings($project_id)
    {
        if (!Auth::check()) return redirect('/login');
        $this->authorize('list', Project::class);
        $projects = Auth::user()->projects()->orderBy('id')->get();
        $project = Project::find($id);
        $this->authorize('access', $project);
        return view('pages.project-settings', ['project' => $project,'projects' =>$projects]);
    }

}
