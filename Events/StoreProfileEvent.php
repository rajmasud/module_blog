<?php

namespace Modules\Blog\Events;

use Illuminate\Queue\SerializesModels;

class StoreProfileEvent {
    use SerializesModels;

    public $msg;

    /**
     * Create a new event instance.
     *
     * @param \XRA\LU\User $user
     */
    public function __construct($user) {
        $this->user = $user;
    }
}
