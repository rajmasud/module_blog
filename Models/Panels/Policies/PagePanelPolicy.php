<?php

namespace Modules\Blog\Models\Panels\Policies;

/*
use App\User;
use App\Post;
*/
//use Modules\Food\Models\Post;

use Modules\Xot\Models\Policies\XotBasePolicy;

class PagePanelPolicy extends XotBasePolicy {
    public function sendMsg($user, $panel) {
        return true;
    }
}
