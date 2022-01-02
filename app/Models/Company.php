<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
  protected $table='company';
  // Don't add create and update timestamps in database.
  public $timestamps  = false;


     public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }
}
