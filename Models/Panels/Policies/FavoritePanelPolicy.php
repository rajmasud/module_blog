<?php

namespace Modules\Blog\Models\Panels\Policies;

use Modules\Xot\Models\Policies\XotBasePolicy;

class FavoritePanelPolicy extends XotBasePolicy {
    public function noMoreFavorite($user, $panel) {
        return true;
    }
}
