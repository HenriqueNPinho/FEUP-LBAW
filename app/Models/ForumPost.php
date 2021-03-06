<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'forum_post';

  public function project() {
    return $this->belongsTo('App\Models\Project');
  }

  public function postAuthor() {
    return $this->belongsTo('App\Models\User','project_member_id');
  }

  public function postEdition(){
    return $this->hasMany('App\Models\PostEdition');
  }

  public function isAuthor(User $user)
  {
    if($this->postAuthor->id==$user->id) return TRUE;
    return FALSE;
  }

}
