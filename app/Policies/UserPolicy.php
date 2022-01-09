<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function coworkerAccess(User $user,User $coworker)
    {
        foreach($user->projects as $project){
            if($project->isMember($coworker->email)) return TRUE;
        }
        return FALSE;
    }
}
