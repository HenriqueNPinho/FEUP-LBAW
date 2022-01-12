<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Project;
use App\Rules\MatchOldPassword;
use App\Models\Company;

class UserController extends Controller
{
    /**
     * Show the form for editing the specified User.
     *
     * @return Response
     * 
     */
    public function edit()
    {
        $user = Auth::user();

        return view('pages.edit-userpage', ['user' => $user]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);
    }

    public function userpageUpdate(Request $request){
        //validation rules
        $user = Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->profile_description = $request['profile_description'];

        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');
            $fileNameExtension = ".jpg";

            $user->profile_image = '/images/avatars/' . (Auth::user()->id). '.jpg';


            $file->move(public_path('/images/avatars'), (Auth::user()->id) . $fileNameExtension);
        }
        $user->save();
        $projectInvitations=$user->projectInvitations()->get();
        return view('pages.userpage',['user' => $user, 'projectInvitations'=> $projectInvitations]);
    }

    public function deletePhoto(){
        $user = Auth::user();
        File::delete($user->profile_image);
        $user->profile_image = '/images/avatars/profile-pic-2.png';
        $user->save();
        return $user;
    }

    public function delete() 
    {
        $user = Auth::user();
        File::delete($user->profile_image);
        Auth::logout();
        $user->delete();
        
        return Redirect::route('homepage'); 
    }

    public function getNotifications()
    {
        $user = Auth::user();
        return $user->projectInvitations;
    }
    
    public function showChangePassword(Request $request){
        $user = Auth::user();
        return view('pages.changePassword',['user' => $user]);
    }


    public function store(Request $request)
    {

        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'string', 'min:6' ],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $user = Auth::user();
        $user->update(['password'=> Hash::make($request->new_password)]);

        return view('pages.edit-userpage', ['user' => $user]);
    } 

    public function inviteResponse(Request $request)
    {
        
        $user = Auth::user();
        $responseProjectID=$request->input("projectID");
        $response=$request->input("accepted");
        
        $projectInvitations=$user->projectInvitations()->get();
       
        foreach($projectInvitations as $projectInvitation){
            
            if($projectInvitation->pivot->project_id==$responseProjectID){
            
                if($response=="true"){
                    $user->projects()->attach($responseProjectID);
                    $user->projectInvitations()->detach($responseProjectID);
                }
                else if($response=="false"){
                    $user->projects()->detach($responseProjectID);
                    $user->projectInvitations()->detach($responseProjectID);
                }
            }
        }
        
        return view('pages.userpage',['user' => $user, 'projectInvitations'=> $projectInvitations]);
    }

    public function removeFavorite($project_id){
        $user = Auth::user();
        $projects = $user->favoriteProjects()->get();
        foreach($projects as $project){
            if($project->id==$project_id){
                $user->favoriteProjects()->detach($project);
                return;
            }
        }
        return;
    }

    public function addFavorite($project_id){
        $user = Auth::user();
        $projects = $user->projects()->get();
        if(count($user->favoriteProjects()->get())==5){
            http_response_code(403);
            echo "You can't have more than 5 favorite projects.";
            exit;
        }

        foreach($projects as $project){
            if($project->id==$project_id){
                $user->favoriteProjects()->attach($project);
                return;
            }
        }
        return;
    }

    public function leaveProject($project_id)
    {
        $user = Auth::user();
        $projects=$user->projects()->get();
        $tasks=$user->tasks()->get();
        foreach($tasks as $task){
            if($task->pivot->project_id==$project_id){
                $user->tasks()->detach($task);
            }
        }
        foreach($projects as $project){
            if($project->id==$project_id){
                $user->projects()->detach($project);
                if($project->isCoordinator($user)) $project->coordinators()->detach($user);
                break;
            }
        }
        
        $user->save();
        $projects=$user->projects()->get();
        return view('pages.projects', ['projects' => $projects]);
    }

    public function showCoworkerPage($user_id)
    {
        if (!Auth::check()) return redirect('/login');
        $coworker = User::find($user_id);
        $this->authorize('coworkerAccess',$coworker);
        return view('pages.view-only-userpage',['user'=>$coworker]);
    }

    public function showUserPage(){
        if (Auth::check()) {
            $user = Auth::user();
            if($user->is_admin){
                $company = Company::find($user->company_id);
                if($company==null){
                    echo "toma la";
                    return;
                }
                return view('pages.userpage', ['user' => $user, 'companyName' => $company->name]);
            }
            else if(!($user->is_admin)){
                $projectInvitations=$user->projectInvitations()->get();
                return view('pages.userpage',['user' => $user, 'projectInvitations'=> $projectInvitations]);
            }
        }

        return view('pages.homepage');
    }
}