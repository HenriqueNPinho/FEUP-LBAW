<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  /**
   * The card this item belongs to.
   */
  public function project() {
    return $this->belongsTo('App\Models\Project');
  }

  public function members() {
    return $this->belongsToMany('App\Models\User','task_assigned','task_id','project_member_id');
  }

    public function comments(){
      return $this->hasMany('App\Models\TaskComment');
    }
  
}
