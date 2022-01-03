<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostEdition extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'post_edition';

  public function forumPost() {
    return $this->belongsTo('App\Models\ForumPost');
  } 
}
