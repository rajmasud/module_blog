<?php

namespace Modules\Blog\Models\Policies;

use Modules\Xot\Models\Policies\XotBasePolicy;
use Modules\Xot\Contracts\UserContract as User;

class ProfilePolicy extends XotBasePolicy
{

    /**
     * caso particalare
     */
    public function create(?User $user, $post)
    {
        return true;
    }

    /**
     * caso particalare
     */
    public function store(?User $user, $post)
    {
        return true;
    }
}
