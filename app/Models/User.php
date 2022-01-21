<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;

use App\Models\Project;
use App\Models\Admin;
use App\Models\Company;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail,CanResetPassword
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'users';

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_image','description', 'is_admin', 'company_id'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The projects this user is a member of.
     */
    public function projects() {
        return $this->belongsToMany('App\Models\Project','project_member','users_id','project_id')->where('archived',FALSE);
    }

    public function tasks() {
        return $this->belongsToMany('App\Models\Task','task_assigned','project_member_id','task_id')->withPivot('assigned_by_id','assigned_on','new_comment','notified');
    }

    public function companies(){
        return $this->belongsToMany('App\Models\Company','work','users_id','company_id');
    }

    public function projectInvitations(){
        return $this->belongsToMany('App\Models\Project','project_invites','users_id','project_id');
    }

    public function favoriteProjects(){
        return $this->belongsToMany('App\Models\Project','favorite','users_id','project_id');
    }

    public function isFavorite(Project $project){
        $favProjects=$this->favoriteProjects;
        foreach($favProjects as $favProject){
            if($favProject->id==$project->id)
                return TRUE;
        }
        return FALSE;
    }

    public function numberNotifications($project_id){
        $assignedTasks=$this->tasks()->where('project_id',$project_id)->get();
        $count=0;
        foreach($assignedTasks as $task){
            if($task->project_id!=$project_id) continue;
            if($task->pivot->notified===false){
                $count=$count+1;
            }
            if($task->pivot->new_comment===true){
                $count=$count+1;
            }
        }
        return $count;
    }

}
