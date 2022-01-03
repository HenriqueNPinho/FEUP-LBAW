<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;

use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function create(User $user, Task $task)
    {
      foreach($task->project->members as $member){
        if($user->id == $member->id) return TRUE;
      }
      return FALSE;
    }

    public function access(User $user, Task $task)
    {
      foreach($task->project->members as $member){
        if($user->id == $member->id) return TRUE;
      }
      return FALSE;
    }

    public function update(User $user, Task $task)
    {
      // User can only update items in cards they own
      foreach($task->project->members as $member){
        if($user->id == $member->id) return TRUE;
      }
      return FALSE;
    }

    public function delete(User $user, Task $task)
    {
      
      foreach($task->project->members as $member){
        if($user->id == $member->id) return TRUE;
      }
      return FALSE;
    }
}
