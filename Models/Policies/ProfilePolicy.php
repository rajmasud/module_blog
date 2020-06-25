<?php

namespace Modules\Blog\Models\Policies;

use Modules\Xot\Contracts\UserContract as User;
use Modules\Xot\Models\Policies\XotBasePolicy;

class ProfilePolicy extends XotBasePolicy {
    /**
     * caso particalare.
     */
    public function create(?User $user, $post) {
        return true;
    }

    public function edit(User $user, $post) {
        return false;
    }

    /**
     * caso particalare.
     */
    public function store(?User $user, $post) {
        return true;
    }

    public function personalInfo(User $user, $post) {
        return true;
    }

    public function userSecurity(User $user, $post) {
        return true;
    }
}
