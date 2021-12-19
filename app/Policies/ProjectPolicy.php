<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Project $project)
    {
      // Only a project member can see it
      foreach ($project->members as $member) {
        if($user->id==$member->id) return TRUE;
      }
      return FALSE;
    }

    public function list(User $user)
    {
      // Any user can list its own cards
      return Auth::check();
    }

    public function create(User $user)
    {
      // Any user can create a new card
      return Auth::check();
    }

    // public function delete(User $user, Card $card)
    // {
    //   // Only a card owner can delete it
    //   return $user->id == $card->user_id;
    // }
}
