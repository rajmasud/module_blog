<?php

namespace Modules\Blog\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendWeeklyPostsEmail extends Mailable {
    use Queueable;
    use SerializesModels;

    public function __construct() {
    }

    public function build() {
        return $this->view('view.name');
    }
}
