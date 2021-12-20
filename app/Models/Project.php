<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  /**
   * The user this card belongs to
   */
  public function members() {
    return $this->belongsToMany('App\Models\User','project_member','project_id','users_id');
  }

  public function tasks(){
    return $this->hasMany('App\Models\Task');
  }

  // public function tasksDone(){
  //   return tasks()->where('status','Complete')->get();
  // }

  // public function tasksToDo(){
  //   return tasks()->where('status','Not Started')->get();
  // }
  /**
   * Items inside this card
   */
  // public function items() {
  //   return $this->hasMany('App\Models\Item');
  // }
}
