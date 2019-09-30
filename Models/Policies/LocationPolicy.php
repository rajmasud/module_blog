<?php

namespace Modules\Blog\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Blog\Models\Location as Post;
use Modules\LU\Models\User as User;
use Modules\Xot\Models\Policies\XotBasePolicy;

class LocationPolicy extends XotBasePolicy{
}
