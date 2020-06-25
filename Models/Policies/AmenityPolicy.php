<?php

namespace Modules\Blog\Models\Policies;

use Modules\Xot\Models\Policies\XotBasePolicy;

class AmenityPolicy extends XotBasePolicy {
    public function indexEdit($user, $post) {
        return true;
    }
}
