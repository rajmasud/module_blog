<?php

namespace Modules\Blog\Models\Panels\Policies;

use Modules\Xot\Models\Panels\Policies\XotBasePanelPolicy;

class HomePanelPolicy extends XotBasePanelPolicy {
    public function artisan($user, $panel) {
        return true;
    }

    public function test($user, $panel) {
        return true;
    }
}
