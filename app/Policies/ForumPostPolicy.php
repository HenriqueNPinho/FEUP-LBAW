<?php

namespace App\Policies;

use App\Models\ForumPost;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ForumPostPolicy
{
    use HandlesAuthorization;

    public function postAuthorAccess(User $user,ForumPost $post)
    {
        if($post->isAuthor($user)) return TRUE;
        return FALSE;
    }
}
