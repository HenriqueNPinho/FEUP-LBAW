<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Project;
use App\Models\Admin;
use App\Models\Company;

class User extends Authenticatable
{
    use Notifiable;

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

    /*
    public function isAdmin(){
        return Admin::find($this->id) != null ? true : false;
    }*/

    /**
     * The projects this user is a member of.
     */
    public function projects() {
        return $this->belongsToMany('App\Models\Project','project_member','users_id','project_id')->where('archived',FALSE);
    }

    public function tasks() {
        return $this->belongsToMany('App\Models\Task','task_assigned','project_member_id','task_id');
    }

    public function companies(){
        return $this->belongsToMany('App\Models\Company','work','users_id','company_id');
    }

    public function projectInvitations(){
        return $this->belongsToMany('App\Models\Project','invitation','users_id','project_id');
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
}
