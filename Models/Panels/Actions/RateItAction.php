<?php

namespace Modules\Blog\Models\Panels\Actions;

//-------- services --------
use Illuminate\Support\Facades\Session;
use Modules\Theme\Services\ThemeService;
use Modules\Xot\Models\Panels\Actions\XotBasePanelAction;

//-------- bases -----------

class RateItAction extends XotBasePanelAction {
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
        $parz = [];
        $parz['rating_avg'] = round($ratings->avg('pivot.rating'), 2);
        $parz['rating_count'] = $ratings->count('pivot.rating');
        $parz['rating_url'] = $url;
        $parz['title'] = $title;
        $view = 'blog::actions.rate.btn';

        return view($view)->with($parz);

        /*
        //$msg='<div class="rateit" data-rateit-value="'.$pivot_avg.'" data-rateit-ispreset="true" data-rateit-readonly="true"></div>';
        //$msg .= '('.$pivot_avg.') '.$pivot_cout.' Votes ';
        $msg=view('theme::layouts.partials.rating.item',['label'=>'','rating_avg'=>$pivot_avg,'rating_count'=>$pivot_cout]);
        $btn0='<a href="'.$url.'" class="btn btn-red btn-danger"> Vota</a>';

        $btn='<a href="'.$url.'" class="btn btn-red btn-danger" data-toggle="modal" data-target="#vueModal" data-title="'.$title.'" data-href="'.$url.'">
        <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </a>';

        $btn_iframe='<button type="button" class="btn btn-red btn-danger" data-toggle="modal" data-target="#vueIframeModal" data-title="'.$title.'" data-href="'.$url.'">
        <span class="font-white"><i class="fa fa-star"></i> Vota ! </span>
        </button>';

        return $msg.$btn0;
        */
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

        return ThemeService::view($view)
            ->with('row', $this->row)
            ;
    }

    //end handle

    public function postHandle() {
        $panel = $this->updateRow(['row' => $this->row]);
        $swal = [
            'icon' => 'success',
            'title' => 'Grazie di aver votato',
            //'text'=> 'clicca su back per torn!',
        ];
        Session::flash('swal', $swal);
        $this->setRow($panel->row);

        return $this->handle();
    }
}
