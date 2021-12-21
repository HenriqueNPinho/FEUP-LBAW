<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;

use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    // public function create(User $user, Task $task)
    // {
    //   // User can only create items in cards they own
    //   return $user->id == $item->card->user_id;
    // }

    public function update(User $user, Task $task)
    {
      // User can only update items in cards they own
      foreach($task->project->members as $member){
        if($user->id == $member->id) return TRUE;
      }
      return FALSE;
    }

    // public function delete(User $user, Item $item)
    // {
    //   // User can only delete items in cards they own
    //   return $user->id == $item->card->user_id;
    // }
}
