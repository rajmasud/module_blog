<?php

namespace Modules\Blog\Events;

use Illuminate\Queue\SerializesModels;

class BlogPostWasUpdated {
    use SerializesModels;

    public function __construct() {
    }

    public function broadcastOn() {
        return [];
    }
}
