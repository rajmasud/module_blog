<?php

namespace Modules\Blog\Models\Policies;

use Modules\Xot\Models\Policies\XotBasePolicy;

class MyRatingPolicy extends XotBasePolicy {
    public function create($user, $post) {
        return false;
    }
}
