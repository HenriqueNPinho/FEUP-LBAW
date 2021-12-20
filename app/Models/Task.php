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

  
}
