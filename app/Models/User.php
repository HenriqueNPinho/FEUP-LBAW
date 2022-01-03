<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_image','description'
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
        return $this->belongsToMany('App\Models\Project','project_member','users_id','project_id');
    }

    public function tasks() {
        return $this->belongsToMany('App\Models\Task','task_assigned','project_member_id','task_id');
    }

    public function companies(){
        return $this->belongsToMany('App\Models\Company','work','users_id','company_id');
    }

    public function projectInvitations(){
        return $this->belongsToMany('App\Models\Project','invitation','users_id','project_id')->withPivot('accepted');
    }
}
