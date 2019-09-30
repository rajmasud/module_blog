<?php

namespace Modules\Blog\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Blog\Models\Article as Post;
use Modules\Xot\Models\Policies\XotBasePolicy;

class ArticleCatPolicy extends XotBasePolicy{
}
