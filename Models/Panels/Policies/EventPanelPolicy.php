<?php

namespace Modules\Blog\Models\Panels\Policies;

use Modules\Xot\Models\Policies\XotBasePolicy;

/*
use Modules\Xot\Models\Policies\XotBasePolicy;
se estendo
Declaration of Modules\Blog\Models\Policies\EventPolicy::index(Modules\LU\Models\User $user, Modules\Blog\Models\Event $post) should be compatible with Modules\Xot\Models\Policies\XotBasePolicy::index(Modules\LU\Models\User $user, $post)
*/

class EventPanelPolicy extends XotBasePolicy {
}
