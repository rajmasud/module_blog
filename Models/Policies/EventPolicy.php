<?php

namespace Modules\Blog\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Blog\Models\Event as Post;
use Modules\LU\Models\User as User;
use Modules\Xot\Models\Policies\XotBasePolicy;

/*
use Modules\Xot\Models\Policies\XotBasePolicy;
se estendo
Declaration of Modules\Blog\Models\Policies\EventPolicy::index(Modules\LU\Models\User $user, Modules\Blog\Models\Event $post) should be compatible with Modules\Xot\Models\Policies\XotBasePolicy::index(Modules\LU\Models\User $user, $post)
*/

class EventPolicy extends XotBasePolicy{
}
