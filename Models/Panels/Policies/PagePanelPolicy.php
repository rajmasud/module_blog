<?php

namespace Modules\Blog\Models\Panels\Policies;

/*
use App\Post;
use App\User;
*/
//use Modules\Food\Models\Post;

use Modules\Xot\Models\Panels\Policies\XotBasePanelPolicy;

class PagePanelPolicy extends XotBasePanelPolicy {
    public function sendMsg($user, $panel) {
        return true;
    }
}
