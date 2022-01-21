<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TaskComment extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;
  use SoftDeletes;

  protected $table = 'task_comment';
  /**
   * The card this item belongs to.
   **/
    public function task() {
        return $this->belongsTo('App\Models\Task','task_id');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User','project_member_id');
    }

}
