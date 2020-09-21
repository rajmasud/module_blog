<?php

namespace Modules\Blog\Models\Panels\Policies;

use Modules\Xot\Models\Policies\XotBasePolicy;

class PhotoPanelPolicy extends XotBasePolicy {
    public function rate($user, $panel) {
        return true;
    }
}
