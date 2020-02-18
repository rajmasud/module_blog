<?php

namespace Modules\Blog\Models\Panels\Actions;

//-------- services --------
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

//-------- bases -----------

class RateIt extends XotBasePanelAction {
    public $name = 'rate'; //name for calling Action
    //public $rows;
    //public $row;
    public $onContainer = false;
    public $onItem = true; //onlyContainer
    public $icon = '<span class="font-white"><i class="fa fa-star"></i> Vota !</span>';

    public function btn($params = []) {
        extract($params);
        $this->setRow($row);
        $url = $this->urlItem($params);

        return '<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#myModalAjax" data-title="rate it" data-href="'.$url.'">
            <span class="font-white"><i class="fa fa-star"></i> Vota ! ['.$url.']</span>
        </button>';
    }

    //-- Perform the action on the given models.
    public function handle() { //devo aggiungere 77
        /*
        $stato = request()->stato;
        $row = $this->rows;
        $row->last_stato = $stato;
        $row->save();
        MyLog::log($row);
        die(redirect()->back());
        //ddd($this->rows);
        */
        return 'ciao ['.$this->row->post_id.']';
        //return view('blog::actions.rate')->with('row', $this->row)->with('lang', \App::getLocale());
    }

    //end handle
}
