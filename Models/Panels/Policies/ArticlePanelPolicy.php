<?php

namespace Modules\Blog\Models\Panels\Policies;

use Modules\Xot\Models\Policies\XotBasePolicy;

class ArticlePanelPolicy extends XotBasePolicy {
    public function rate($user, $panel) {
        return true;
    }

    public function changePos($user, $panel) {
        return true;
    }
}
