<?php
namespace Modules\Blog\Models\Policies;

/*
use App\User;
use App\Post;
*/
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Blog\Models\Page as Post;
//use Modules\Food\Models\Post;
use Modules\LU\Models\User;

class PagePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if (isset($user->perm) && $user->perm->perm_type >= 5) {  //superadmin
            return true;
        }
    }

    /*
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
    */

    public function create(User $user)
    {
        return true;
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

    public function show(User $user, Post $post)
    {
        return false;
    }

    public function indexEdit(User $user, Post $post){
        return true;
    }
}
