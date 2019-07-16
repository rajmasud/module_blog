<?php
namespace Modules\Blog\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Blog\Models\Event as Post;
use Modules\LU\Models\User;

class EventPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if (is_object($user->perm) && $user->perm->perm_type >= 5) {  //superadmin
            return true;
        }
       
    }

    public function create(User $user, Post $post)
    {
        return true;  //se e' loggato puo' creare ristorante non proprietario ristorante
    }

    public function edit(User $user, Post $post)
    {
        if ($post->created_by == $user->handle) {
            return true;
        }

        return false;
    }
    public function update(User $user, Post $post)
    {
        if ($post->created_by == $user->handle) {
            return true;
        }

        return false;
    }


}