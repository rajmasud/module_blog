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
        return '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#myModalAjax" data-title="'.$title.'" data-href="'.$url.'">
            <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </button>';
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
        return $this->updateRow(['row'=>$this->row]);
    }

}
