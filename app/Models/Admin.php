<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends User{
    public $timestamps = false;

    protected $table = 'administrators';

    protected $primary_key = 'user_id';

    public function user(){
        return $this->hasOne('User', 'id', 'user_id');
    }
} 