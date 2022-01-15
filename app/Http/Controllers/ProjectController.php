<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $this->authorize('userAccess', Project::class);
        $user = Auth::user();
        $projects = Auth::user()->projects()->orderBy('id')->get();
        $project = Project::find($id);
        $this->authorize('memberAccess', $project);
        return view('pages.project', ['user' => $user, 'project' => $project,'projects' =>$projects]);
    }


    public function list()
    {
        if (!Auth::check()) return redirect('/login');
        $this->authorize('userAccess', Project::class);
        $projects = Auth::user()->projects()->orderBy('id')->get();
        return view('pages.projects', ['projects' => $projects]);
    }

    public function taskSearch(Request $request, $id)
    {
        if (!Auth::check()) return redirect('/login');
        $project = Project::find($id);
        $this->authorize('memberAccess',$project);
        $this->authorize('userAccess', Project::class);
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
        $this->authorize('coordinatorAccess',$project);
        $project->archived=TRUE;
        $project->save();
        $project->usersFavorite()->detach();
        $project->usersInvited()->detach();
        $this->authorize('userAccess', Project::class);
        $projects = Auth::user()->projects()->orderBy('id')->get();
        return view('pages.projects', ['projects' => $projects]);
    }

    public function getSettings($project_id)
    {
        if (!Auth::check()) return redirect('/login');
        $this->authorize('userAccess', Project::class);
        $projects = Auth::user()->projects()->orderBy('id')->get();
        $project = Project::find($project_id);
        $this->authorize('memberAccess', $project);
        return view('pages.project-settings', ['project' => $project,'projects' =>$projects]);
    }

    public function addCoordinator(Request $request,$project_id)
    {
        if (!Auth::check()) return redirect('/login');
        if ($request['coordinator']==null) return redirect()->back();
        $project = Project::find($project_id);
        $this->authorize('coordinatorAccess',$project);
        $user=User::find($request['coordinator']);
        if($project->isCoordinator($user)){

            http_response_code(403);
            echo "<script>alert('This member is already a coordinator')</script>";
        }
        else{
            $project->coordinators()->attach($user->id);
        }
        return redirect()->back();
    }

    public function removeMember(Request $request,$project_id)
    {
        if (!Auth::check()) return redirect('/login');
        if ($request['member-to-remove']==null) return redirect()->back();
        $project = Project::find($project_id);
        $this->authorize('coordinatorAccess',$project);
        $user=User::find($request['member-to-remove']);
        if($project->isCoordinator($user)) $project->coordinators()->detach($user);
        $project->usersInvited()->detach($user->id);
        foreach($user->tasks as $task){
            if($task->project_id==$project_id){
                $user->tasks()->detach($task);
            }
        }
        $project->members()->detach($user);
        $user->save();
        $project->save();
        return redirect()->back();
    }

    public function addMember(Request $request,$project_id){
        if (!Auth::check()) return redirect('/login');

        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);
        $validator->validate();
        

        $project = Project::find($project_id);
        $this->authorize('memberAccess',$project);
        $email=$request['email'];
        if($project->isMember($email)){
            $validator->errors()->add('email', 'That user is already a member');
            return redirect()->back()->withErrors($validator);
        }

        $userToInvite=User::where('email',$email)->first();
        if($userToInvite!=null){
            foreach($userToInvite->projectInvitations as $invite){
                
                if($project->id==$invite->id){
                    $validator->errors()->add('email', 'That user already has a pending invite');
                    return redirect()->back()->withErrors($validator);
                }
            }
            $userToInvite->projectInvitations()->attach($project);
        }
        $userToInvite->save();
        return redirect()->back()->withErrors($validator);
    }


}
