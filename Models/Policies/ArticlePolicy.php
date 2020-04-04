<?php

namespace Modules\Blog\Models\Policies;

use Modules\Xot\Models\Policies\XotBasePolicy;

class ArticlePolicy extends XotBasePolicy {

    public function rate($user,$post){

        return true;
    }

    public function changePos($user,$post){

        return true;
    }
}
