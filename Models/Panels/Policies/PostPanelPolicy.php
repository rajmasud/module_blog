<?php

namespace Modules\Blog\Models\Panels\Policies;

use Modules\Xot\Contracts\UserContract as User;
use Modules\Xot\Models\Panels\Policies\XotBasePanelPolicy;

class PostPanelPolicy extends XotBasePanelPolicy {
    public function deleteNoPostId(User $user, $panel) {
        return true;
    }

    public function clearDuplicates(User $user, $panel) {
        return true;
    }
}
