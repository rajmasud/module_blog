<?php

namespace Modules\Blog\Models\Policies;

/*
use App\User;
use App\Post;
*/
//use Modules\Food\Models\Post;

use Modules\Xot\Models\Policies\XotBasePolicy;

class PagePolicy extends XotBasePolicy {
    public function sendMsg($user,$post){
        return true;
    }
}
