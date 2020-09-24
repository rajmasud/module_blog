<?php

namespace Modules\Blog\Models\Panels\Policies;

use Modules\Xot\Models\Panels\Policies\XotBasePanelPolicy;

class FavoritePanelPolicy extends XotBasePanelPolicy {
    public function noMoreFavorite($user, $panel) {
        return true;
    }
}
