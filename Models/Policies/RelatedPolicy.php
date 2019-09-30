<?php

namespace Modules\Blog\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Blog\Models\Related as Post;
use Modules\LU\Models\User as User;
use Modules\Xot\Models\Policies\XotBasePolicy;

class RelatedPolicy extends XotBasePolicy{
}
