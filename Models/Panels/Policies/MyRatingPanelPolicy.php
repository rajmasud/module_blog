<?php

namespace Modules\Blog\Models\Panels\Policies;

use Modules\Xot\Models\Policies\XotBasePolicy;

class MyRatingPanelPolicy extends XotBasePolicy {
    public function create($user, $panel) {
        return false;
    }
}
