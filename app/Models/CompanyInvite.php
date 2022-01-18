<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInvite extends Model
{
    protected $table='company_invites';
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $fillable = [
        'token', 'email', 'company_id','created_at'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
