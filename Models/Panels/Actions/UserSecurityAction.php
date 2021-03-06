<?php

namespace Modules\Blog\Models\Panels\Actions;

//-------- models -----------

//-------- services --------
use Illuminate\Support\Facades\Session;
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

//-------- bases -----------

class UserSecurityAction extends XotBasePanelAction {
    public $onContainer = false; //onlyContainer
    public $onItem = true; //onlyContainer
    public $icon = '<i class="far fa-file-excel fa-1x"></i>';

    public function handle() {
        return $this->panel->view();

        /*
        $view = 'pub_theme::profile.'.$this->getName();

        return ThemeService::view($view)
        ->with('row', $this->row);
        */
    }

    public function postHandle() {
        $data = request()->all();

        \Validator::make($data, [
            'passwd' => 'required|confirmed|min:6',
        ])->validate();

        //dddx($data['passwd']);
        $profile = $this->row;
        $user = $profile->user;
        $user->update(['passwd' => $data['passwd']]);

        $swal = [
            'icon' => 'success',
            'title' => 'Aggiornamento riuscito',
        ];
        Session::flash('swal', $swal);

        return $this->handle();
    }

    //end handle
}
