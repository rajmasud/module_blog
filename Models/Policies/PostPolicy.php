<<<<<<< HEAD
<?php

namespace Modules\Blog\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Blog\Models\Post as Post;
use Modules\LU\Models\User;

class PostPolicy {
    use HandlesAuthorization;

    public function before($user, $ability) {
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

    public function create(User $user) {
        return true;
    }

    public function edit(User $user, Post $post) {
        if ($post->created_by == $user->handle) {
            return true;
        }

        return false;
    }

    public function update(User $user, Post $post) {
        if ($post->created_by == $user->handle) {
            return true;
        }

        return false;
    }

    public function index(User $user, Post $post) {
        return true;
    }

    public function show(User $user, Post $post) {
        return true;
    }

    public function indexEdit(User $user, Post $post) {
        return true;
    }
}
=======
<?php

namespace Modules\Blog\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Blog\Models\Post as Post;
use Modules\LU\Models\User;

class PostPolicy {
    use HandlesAuthorization;

    public function before($user, $ability) {
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

    public function create(User $user) {
        return true;
    }

    public function edit(User $user, Post $post) {
        if ($post->created_by == $user->handle) {
            return true;
        }

        return false;
    }

    public function update(User $user, Post $post) {
        if ($post->created_by == $user->handle) {
            return true;
        }

        return false;
    }

    public function index(User $user, Post $post) {
        return true;
    }

    public function show(User $user, Post $post) {
        return true;
    }

    public function indexEdit(User $user, Post $post) {
        return true;
    }
}
>>>>>>> ,
