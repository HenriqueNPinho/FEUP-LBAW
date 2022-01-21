<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use App\Mail\ProjectInvite;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

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

        $searchQuery = $request->input('search-tasks-query');
        if ($searchQuery !== null) {
            $searchResults = $project->tasks()->whereRaw('tsvectors @@ plainto_tsquery(\'english\', ?)', $searchQuery)->get();
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
        if($request->input('company')!=null){
            $project->company_id=$request->input('company');
        }
        $project->save();
        $project->members()->attach(Auth::user()->id);
        $project->coordinators()->attach(Auth::user()->id);
		
        $membersToInvite=explode(";",$request->input("members"));
        foreach($membersToInvite as $member){
            $user=User::where('email',$member)->first();
            if($user!=NULL){
                if($project->company_id==null){
                    $user->projectInvitations()->attach($project->id);
                }
                else{
                    if($project->company->worksHere($user->id)){
                        $user->projectInvitations()->attach($project->id);
                    }
                    else return response("Some of the users doesn't belong to your company's workspace. Ask your company administrator to invite them. Only then, can you invite them to a project.",207);
                }
            } 
        }
    }
    public function archive($project_id){
        if (!Auth::check()) return redirect('/login');
        $project = Project::find($project_id);
        if(Gate::denies('adminAccess',$project)){
            $this->authorize('coordinatorAccess',$project);
        }
        $project->archived=TRUE;
        $project->save();
        $project->usersFavorite()->detach();
        $project->usersInvited()->detach();
        if(Gate::allows('adminAccess',$project)) return;
        $this->authorize('userAccess', Project::class);
        $projects = Auth::user()->projects()->orderBy('id')->get();
        return view('pages.projects', ['projects' => $projects]);
    }

    public function unarchive($project_id){
        if (!Auth::check()) return redirect('/login');
        $project = Project::find($project_id);
        $this->authorize('adminAccess',$project);
        $project->archived=FALSE;
        $project->save();
        return;
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
        $company=$project->company;
        if(($company!=null && $userToInvite==null)||($company!=null && !$company->worksHere($userToInvite->id))){
            $validator->errors()->add('email', "That user doesn't belong to your company's workspace. Ask your company administrator to invite him. Only then, can you invite him to a project.");
            return redirect()->back()->withErrors($validator);
        }
        $token=Str::random(60);
        if($userToInvite!=null){
            foreach($userToInvite->projectInvitations as $invite){
                
                if($project->id==$invite->id){
                    $validator->errors()->add('email', 'That user already has a pending invite');
                    return redirect()->back()->withErrors($validator);
                }
            }
            $userToInvite->projectInvitations()->attach($project->id,['token'=>$token]);
        }
        
        $userToInvite->save();
        $url=URL::temporarySignedRoute(
            'acceptEmailProjectInvite', now()->addDays(7), ['token'=>$token]
        );
        Mail::to($userToInvite)->send(new ProjectInvite ($project,$url));
        return redirect()->back()->withErrors($validator);
    }


}
