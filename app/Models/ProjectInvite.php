<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectInvite extends Model
{
    protected $table='project_invites';
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    public function user()
    {
        return $this->belongsTo('App\Models\User','users_id');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\User','project_id');
    }
}
