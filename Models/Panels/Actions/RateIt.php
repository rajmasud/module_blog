<?php

namespace Modules\Blog\Models\Panels\Actions;

//-------- services --------
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;
use Modules\Theme\Services\ThemeService;


//-------- bases -----------

class RateIt extends XotBasePanelAction {
    public $name = 'rate'; //name for calling Action
    //public $rows;
    //public $row;
    //public $onContainer = false;
    public $onItem = true; //onlyContainer
    public $icon = '<span class="font-white"><i class="fa fa-star"></i> Vota !</span>';
    //*
    public function btn($params = []) {
        extract($params);
        $this->setRow($row);
        $url = $this->urlItem($params);
        $title = 'Vota '.$this->row->title;

        $ratings = $row->ratings;
        $pivot_avg=round($ratings->avg('pivot.rating'),2);
        $pivot_cout=$ratings->count('pivot.rating');

        $msg='<div class="rateit" data-rateit-value="'.$pivot_avg.'" data-rateit-ispreset="true" data-rateit-readonly="true"></div>';
        $msg .= '('.$pivot_avg.') '.$pivot_cout.' Votes ';

        $btn0='<a href="'.$url.'" class="btn btn-red btn-danger"> Vota</a>';

        $btn='<a href="'.$url.'" class="btn btn-red btn-danger" data-toggle="modal" data-target="#vueModal" data-title="'.$title.'" data-href="'.$url.'">
        <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </a>';

        $btn_iframe='<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#vueIframeModal" data-title="'.$title.'" data-href="'.$url.'">
        <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </button>';

        return $msg.$btn0;
        /*
        return $msg.'<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#myModalAjax" data-title="'.$title.'" data-href="'.$url.'">
            <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </button>';
        */
    }
    //*/

    //-- Perform the action on the given models.
    public function handle() {

        $view = 'blog::actions.rate';
        if(request()->ajax()){
            $view.='_ajax';
        }

        return ThemeService ::view($view)
            ->with('row', $this->row)
            ;
    }

    //end handle

    public function postHandle() {

        $panel= $this->updateRow(['row'=>$this->row]);

        $this->setRow($panel->row);
        return $this->handle();
    }

}
