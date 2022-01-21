<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;
    use SoftDeletes;
    /**
     * The user this card belongs to
     */
    public function members() {
    return $this->belongsToMany('App\Models\User','project_member','project_id','users_id');
    }

    public function tasks(){
    return $this->hasMany('App\Models\Task');
    }

    public function forumPosts(){
    return $this->hasMany('App\Models\ForumPost');
    }

    public function coordinators(){
    return $this->belongsToMany('App\Models\User','project_coordinator','project_id','users_id');
    }

    public function usersInvited(){
        return $this->belongsToMany('App\Models\User','invitation','project_id','users_id');
    }
    
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function usersFavorite(){
        return $this->belongsToMany('App\Models\User','favorite','project_id','users_id');
    }

    public function isCoordinator(User $user){
        
        foreach($this->coordinators as $coordinator){
            if($user->id==$coordinator->id){
                return TRUE;
            }
        }
        return FALSE;
    }

    public function isMember($email){
        foreach($this->members as $member){
            if(strcmp($member->email,$email)==0){
                return TRUE;
            }
        }
        return FALSE;
    }

}
