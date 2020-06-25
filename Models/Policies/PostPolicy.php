<?php

namespace Modules\Blog\Models\Policies;

use Modules\Xot\Contracts\UserContract as User;
use Modules\Xot\Models\Policies\XotBasePolicy;

class PostPolicy extends XotBasePolicy {
    public function deleteNoPostId(User $user, $post) {
        return true;
    }

    public function clearDuplicates(User $user, $post) {
        return true;
    }
}
