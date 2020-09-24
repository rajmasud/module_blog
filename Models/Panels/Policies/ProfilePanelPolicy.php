<?php

namespace Modules\Blog\Models\Panels\Policies;

use Modules\Xot\Contracts\UserContract as User;
use Modules\Xot\Models\Panels\Policies\XotBasePanelPolicy;

class ProfilePanelPolicy extends XotBasePanelPolicy {
    /**
     * caso particalare.
     */
    public function index($user, $panel) {
        return false;
    }

    public function create(?User $user, $panel) {
        return true;
    }

    public function edit(User $user, $panel) {
        return false;
    }

    /**
     * caso particalare.
     */
    public function store(?User $user, $panel) {
        return true;
    }

    public function personalInfo(User $user, $panel) {
        return true;
    }

    public function userSecurity(User $user, $panel) {
        return true;
    }
}
