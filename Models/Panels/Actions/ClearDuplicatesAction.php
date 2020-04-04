<?php

namespace Modules\Blog\Models\Panels\Actions;

//-------- services --------
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;
use Modules\Theme\Services\ThemeService;
use Modules\Blog\Models\Post;


//-------- bases -----------

class ClearDuplicatesAction extends XotBasePanelAction {
    public $onContainer = true;
    public $onItem = false;
    public $icon = '<i class="fas fa-heart-broken"></i>';

    public function handle(){
        /*
        SELECT post_id,post_type,count(post_id) as q
        FROM posts
        WHERE lang='it'
        GROUP BY post_id,post_type
        HAVING q>1
        */
        $lang=\App::getLocale();
        $rows=Post::selectRaw('post_id,post_type,count(post_id) as q')
            ->where('lang', $lang)
            ->groupBy('post_id', 'post_type')
            ->having('q', '>', 1)
            //->limit(2)
            ->get();
        $tot=0;
        foreach ($rows as $v){
            $duplicate=Post::where('post_id',$v->post_id)
                ->where('post_type',$v->post_type)
                ->where('lang',$lang)
                ->orderByDesc('id')
                ->limit($v->q -1)
                ->delete();
            //ddd($duplicate);
            $tot+=$duplicate;
        }
        return '<h3>'.$tot.' clear duplicates</h3>';
    }
}
