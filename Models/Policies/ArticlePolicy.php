<?php
namespace Modules\Blog\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Blog\Models\Article as Post;
use Modules\LU\Models\User;

<<<<<<< HEAD
class ArticlePolicy
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
    public function index(User $user, Post $post)
    {
        return true;
    }

    public function create(User $user, Post $post)
    {
        return true;
    }

    public function destroy(User $user, Post $post)
    {
        if ($post->created_by == $user->handle) {
            return true;
        }

        return false;
    }

    public function detach(User $user, Post $post)
    {
        if ($post->created_by == $user->handle) {
            return true;
        }

        return false;
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
    public function store(User $user, Post $post)
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

    public function delete(User $user, Post $post){
        return true;
    }
    public function indexEdit(User $user, Post $post){
        return true;
    }
=======
use Modules\Xot\Models\Policies\XotBasePolicy;

class ArticlePolicy extends XotBasePolicy{

>>>>>>> 44adda4afca837381a42d347e2970d1e23ee648e
}
