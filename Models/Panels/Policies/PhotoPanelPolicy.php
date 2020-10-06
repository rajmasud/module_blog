<?php

namespace Modules\Blog\Models\Panels\Policies;

use Modules\Xot\Models\Panels\Policies\XotBasePanelPolicy;

class PhotoPanelPolicy extends XotBasePanelPolicy {
    public function rate($user, $panel) {
        return true;
    }
}
