<?php
namespace Modules\Blog\Listeners;

use Modules\Blog\Events\PostWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUsersOfANewPost{
    public function __construct(){
        //
    }

    public function handle(PostWasCreated $event){
        //
    }
}
