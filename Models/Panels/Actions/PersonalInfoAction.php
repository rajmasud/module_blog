<?php

namespace Modules\Blog\Models\Panels\Actions;

//-------- models -----------

//-------- services --------
use Illuminate\Support\Facades\Session;
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

//-------- bases -----------

class PersonalInfoAction extends XotBasePanelAction {
    public $onContainer = false; //onlyContainer
    public $onItem = true; //onlyContainer
    public $icon = '<i class="far fa-file-excel fa-1x"></i>';

    public function handle() {
        /*$view = 'pub_theme::profile.'.$this->getName();*/
        //dddx(get_defined_vars());

        /*return ThemeService::view($view)
            ->with('row', $this->row);*/

        return $this->panel->view();
    }

    public function postHandle() {
        $data = request()->all();
        //dddx($data['handle']);
        /*
        \Validator::make($data, [
            //'name' => '',
            //'surname' => '',
            //'email' => 'required|email|unique:users',
            //'phone' => 'integer',
            //'bio' => 'max:200',
            ])->validate();
        */

        //dddx($data);
        $profile = $this->row;
        $profile->update($data);
        $profile->user->update([
            'handle' => $data['handle'],
            'first_name' => $data['firstname'],
            'last_name' => $data['surname'],
        ]);

        $swal = [
            'icon' => 'success',
            'title' => 'Aggiornamento riuscito',
        ];
        Session::flash('swal', $swal);

        return $this->handle();
    }

    //end handle
}
