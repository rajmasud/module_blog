<?php

namespace Modules\Blog\Models\Policies;

use Modules\Xot\Models\Policies\XotBasePolicy;

class ProfilePolicy extends XotBasePolicy {
    
    public function create($user,$post){
        return true;
    }

}
