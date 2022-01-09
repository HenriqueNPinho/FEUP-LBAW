<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function memberAccess(User $user, Project $project)
    {
      // Only a project member can see it
      if($project->archived) return FALSE;
      foreach ($project->members as $member) {
        if($user->id==$member->id) return TRUE;
      }
      return FALSE;
    }

    public function userAccess()
    {
      return Auth::check();
    }

    public function coordinatorAccess(User $user, Project $project){
        foreach ($project->coordinators as $coordinator) {
            if($user->id==$coordinator->id) return TRUE;
        }
        return FALSE;
    }

    public function coworkerAccess(User $coworker)
    {
        $user=Auth::user();
        return TRUE;
        echo $coworker->id;
        foreach($user->projects as $project){ 
            if($project->isMember($coworker->email)) return TRUE;
        }
        return FALSE;
    }
    
    // public function delete(User $user, Card $card)
    // {
    //   // Only a card owner can delete it
    //   return $user->id == $card->user_id;
    // }
}
