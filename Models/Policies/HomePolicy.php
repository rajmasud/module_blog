<?php

namespace Modules\Blog\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Blog\Models\Home as Post;
use Modules\LU\Models\User;
use Modules\Xot\Models\Policies\XotBasePolicy;

class HomePolicy extends XotBasePolicy{
}
