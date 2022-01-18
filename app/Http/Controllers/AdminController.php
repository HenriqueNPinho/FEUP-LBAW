<?php

namespace App\Http\Controllers;

use App\Mail\CompanyInvite;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;


use App\Models\User;
use App\Models\Company;
use App\Models\CompanyInvite as ModelsCompanyInvite;

class AdminController extends Controller
{
    public function showAdminPage()
    {
        if (!Auth::check()) return redirect('/login');
        if(!Auth::user()->is_admin) return redirect('/');
        $company=Company::find(Auth::user()->company_id);
        return view('pages.admin-homepage',['company'=>$company]);
    }

    public function inviteUser($user_email)
    {
        if(!Auth::user()->is_admin) return redirect('/');
        $user=User::where('email',$user_email)->first();
        $token=Str::random(60);
        $company=Company::find(Auth::user()->company_id);
        if($user==null){
            $url=URL::temporarySignedRoute(
                'newUserAcceptCompanyInvite', now()->addDays(7), ['token'=>$token]
            );
        }
        else{
            foreach($user->companies as $userCompany){
                if($userCompany->id==$company->id){
                    return "User is already a member";
                }
            }
            $url=URL::temporarySignedRoute(
                'existingUserAcceptCompanyInvite', now()->addDays(7), ['token'=>$token]
            );
        }
        $invite=ModelsCompanyInvite::where('email',$user_email)->first();
        if($invite!=null) $invite->delete();
        $invite=new ModelsCompanyInvite;
        $invite->token=$token;
        $invite->email=$user_email;
        $invite->company_id=$company->id;
        $invite->created_at=date('Y-m-d H:i:s+00');
        Mail::to($user_email)->send(new CompanyInvite ($company,$url));
        $invite->save();
        return "Invite Sent";
    }

    public function removeUser($user_id)
    {
        $user=User::find($user_id);
        if($user==null) return;
        if (!Auth::check()) return redirect('/login');  
        if(!Auth::user()->is_admin) return redirect('/');
        $company=Company::find(Auth::user()->company_id);
        $user->companies()->detach($company);
        $projects=$user->projects()->get();
        foreach($projects as $project){
            if($project->company->id==$company->id){
                $project_id=$project->id;
                foreach($user->tasks as $task){
                    if($task->project_id==$project_id){
                        $user->tasks()->detach($task);
                    }
                }
                $project->members()->detach($user);
            }
        }
        return;
    }
}