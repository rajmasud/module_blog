<?php

namespace Modules\Blog\Models\Policies;

use Modules\Xot\Models\Policies\XotBasePolicy;

class PostPolicy extends XotBasePolicy {
    public function deleteNoPostId($user, $post) {
        return true;
    }

    public function clearDuplicates($user, $post) {
        return true;
    }
}
