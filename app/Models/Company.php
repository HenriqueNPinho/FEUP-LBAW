<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table='companys';
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $fillable = ['name'];

     public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }
}
