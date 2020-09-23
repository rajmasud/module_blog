<?php

namespace Modules\Blog\Models\Panels\Policies;

use Modules\Xot\Models\Policies\XotBasePolicy;

class HomePanelPolicy extends XotBasePolicy {
    public function artisan($user, $panel) {
        return true;
    }

    public function test($user, $panel) {
        return true;
    }
}
