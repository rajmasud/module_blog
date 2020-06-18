<?php

namespace Modules\Blog\Models\Panels\Actions;

//-------- models -----------
use Modules\Blog\Models\Post;
//-------- services --------
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

//-------- bases -----------

class DeleteNoPostIdAction extends XotBasePanelAction {
    public $onContainer = true;

    public $icon = '<i class="fas fa-heart-broken"></i>';

    public function handle() {
        $rows = Post::where('post_id', '')->delete();

        return '<h3>+Fatto</h3>';
    }

    //end handle
}
