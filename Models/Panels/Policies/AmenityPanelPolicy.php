<?php

namespace Modules\Blog\Models\Panels\Policies;

use Modules\Xot\Models\Panels\Policies\XotBasePanelPolicy;

class AmenityPanelPolicy extends XotBasePanelPolicy {
    public function indexEdit($user, $panel) {
        return true;
    }
}
