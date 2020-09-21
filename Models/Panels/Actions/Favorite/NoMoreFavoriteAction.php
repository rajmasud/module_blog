<?php

namespace Modules\Blog\Models\Panels\Actions\Favorite;

use Illuminate\Support\Facades\Route;
//-------- services --------
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

//-------- bases -----------
class NoMoreFavoriteAction extends XotBasePanelAction {
    public $onContainer = true;
    //public $onItem = true; //onlyContainer
    //mettere freccette su e giù
    public $icon = '<i class="fa fa-arrow-up"></i><i class="fa fa-arrow-down"></i>';

    public $auth_user_id;

    public function __construct($auth_user_id) {
        $this->auth_user_id = $auth_user_id;
    }

    //-- Perform the action on the given models.
    public function handle() {
        //dddx($this);
        //return 'ciao';
        //ddd($this->row);
        dddx($this->rows);
    }

    public function postHandle() {
        //$this->rows->where('auth_user_id', $this->auth_user_id);
        $route_params = Route::current()->parameters();
        [$containers,$items] = params2ContainerItem($route_params);
        $func = 'favorites';
        last($items)->$func()->where('auth_user_id', $this->auth_user_id)->delete();

        return 'fatto';
    }
}
