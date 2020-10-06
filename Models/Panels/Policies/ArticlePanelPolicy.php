<?php

namespace Modules\Blog\Models\Panels\Policies;

use Modules\Xot\Models\Panels\Policies\XotBasePanelPolicy;

class ArticlePanelPolicy extends XotBasePanelPolicy {
    public function rate($user, $panel) {
        return true;
    }

    public function changePos($user, $panel) {
        return true;
    }
}
