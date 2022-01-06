<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function access(User $user, Project $project)
    {
      // Only a project member can see it
      if($project->archived) return FALSE;
      foreach ($project->members as $member) {
        if($user->id==$member->id) return TRUE;
      }
      return FALSE;
    }

    public function list()
    {
      // Any user can list its own cards
      return Auth::check();
    }

    public function create()
    {
      // Any user can create a new card
      return Auth::check();
    }

    public function archive(User $user, Project $project){
        foreach ($project->coordinators as $coordinator) {
            if($user->id==$coordinator->id) return TRUE;
        }
        return FALSE;
    }


    // public function delete(User $user, Card $card)
    // {
    //   // Only a card owner can delete it
    //   return $user->id == $card->user_id;
    // }
}
