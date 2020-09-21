<?php

namespace Modules\Blog\Models\Panels\Policies;

use Modules\Xot\Contracts\UserContract as User;
use Modules\Xot\Models\Policies\XotBasePolicy;

class PostPanelPolicy extends XotBasePolicy {
    public function deleteNoPostId(User $user, $panel) {
        return true;
    }

    public function clearDuplicates(User $user, $panel) {
        return true;
    }
}
