<?php

namespace Modules\Blog\Models\Policies;

use Modules\Xot\Models\Policies\XotBasePolicy;

class PhotoPolicy extends XotBasePolicy {

    public function rate($user,$post){
        return true;
    }
}
