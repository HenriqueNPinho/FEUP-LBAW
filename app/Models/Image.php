<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'image';

    /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'path'
  ];

}