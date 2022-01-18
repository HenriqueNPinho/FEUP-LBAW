<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table='companies';
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $fillable = ['name'];

    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }

    public function invites()
    {
        return $this->hasMany('App\Models\CompanyInvite','company_id');
    }

    public function workers(){
        return $this->belongsToMany('App\Models\User','work','company_id','users_id');
    }

    public function worksHere($user_id){
        foreach($this->workers as $user){
            if($user->id==$user_id){
                return TRUE;
            }
        }
        return FALSE;
    }
}
