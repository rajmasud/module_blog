<?php

namespace Modules\Blog\Models\Policies;

use Modules\Xot\Models\Policies\XotBasePolicy;
use Modules\Xot\Contracts\UserContract as User;

class ProfilePolicy extends XotBasePolicy
{

    public function create(?User $user, $post)
    {
        return true;
    }
}
