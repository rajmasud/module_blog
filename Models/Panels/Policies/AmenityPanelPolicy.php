<?php

namespace Modules\Blog\Models\Panels\Policies;

use Modules\Xot\Models\Policies\XotBasePolicy;

class AmenityPanelPolicy extends XotBasePolicy {
    public function indexEdit($user, $panel) {
        return true;
    }
}
