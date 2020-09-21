<?php

namespace Modules\Blog\Models\Panels\Actions;

//-------- services --------
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;
//use Modules\Theme\Services\ThemeService;


//-------- bases -----------
class SendMsgAction extends XotBasePanelAction {

    //public $onContainer = false;
    public $onItem = true; //onlyContainer
    //mettere freccette su e giù
    public $icon = '<i class="far fa-paper-plane"></i>';

    //-- Perform the action on the given models.
    public function handle() {

        return 'invio messaggio';
        //ddd($this->row);
    }
}