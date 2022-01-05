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

class UserController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        $projectInvitations=$user->projectInvitations()->whereNull('accepted')->get();
        return view('pages.userpage',['user' => $user, 'projectInvitations'=> $projectInvitations]);
    }

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
        $projectInvitations=$user->projectInvitations()->whereNull('accepted')->get();
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
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {

        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'string', 'min:6' , 'confirmed'],
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
        
        $projectInvitations=$user->projectInvitations()->whereNull('accepted')->get();
       
        foreach($projectInvitations as $projectInvitation){
            
            if($projectInvitation->pivot->project_id==$responseProjectID){
            
                if($response=="true"){
                    $user->projects()->attach($responseProjectID);
                    $projectInvitation->pivot->accepted=TRUE;
                    $projectInvitation->pivot->save();    
                }
                else if($response=="false"){
                    $user->projects()->attach($responseProjectID);
                    $projectInvitation->pivot->accepted=FALSE;
                    $projectInvitation->pivot->save();   
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

    
}