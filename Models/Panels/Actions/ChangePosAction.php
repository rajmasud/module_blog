<?php

namespace Modules\Blog\Models\Panels\Actions;

//-------- services --------
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;
use Modules\Theme\Services\ThemeService;


//-------- bases -----------
class ChangePosAction extends XotBasePanelAction {

    //public $onContainer = false;
    public $onItem = true; //onlyContainer
    //mettere freccette su e giù
    public $icon = '<i class="fa fa-arrow-up"></i><i class="fa fa-arrow-down"></i>';

    //-- Perform the action on the given models.
    public function handle() {

        //return 'ciao';
        ddd($this->row);
    }
}