<?php

namespace Modules\Blog\Listeners;

use Modules\Blog\Events\PostWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUsersOfANewPost
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param PostWasCreated $event
     * @return void
     */
    public function handle(PostWasCreated $event)
    {
        //
    }
}
