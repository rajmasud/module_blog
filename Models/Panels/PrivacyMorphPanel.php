<?php

namespace Modules\Blog\Models\Panels;

use Illuminate\Http\Request;
//--- Services --
use Modules\Blog\Rules\PivotRequiredRule;
//-------- rules ---
use Modules\Blog\Rules\PrivacyCheckRule;
use Modules\Xot\Models\Panels\XotBasePanel;
//----- bases ---------
use Modules\Xot\Services\RouteService;

/*
Validator::extendImplicit()
*/

class PrivacyMorphPanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Modules\Blog\Models\PrivacyMorph';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [];

    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static function with() {
        return [];
    }

    /**
     * on select the option id.
     */
    public function optionId($row) {
        return $row->area_id;
    }

    /**
     * on select the option label.
     */
    public function optionLabel($row) {
        return $row->area_define_name;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
        'col_bs_size' => 6,
        'sortable' => 1,
        'rules' => 'required',
        'rules_messages' => ['it'=>['required'=>'Nome Obbligatorio']],
        'value'=>'..',
     */
    public static function fields() {
        return [
            /*
            (object) array(
                'type' => 'Id',
                'name' => 'id',
            ),
            (object) array(
                'type' => 'Integer',
                'name' => 'post_id',
            ),
            (object) array(
                'type' => 'String',
                'name' => 'post_type',
            ),
            (object) array(
                'type' => 'Integer',
                'name' => 'related_id',
            ),
            (object) array(
                'type' => 'String',
                'name' => 'related_type',
            ),

            (object) array(
                'type' => 'Integer',
                'name' => 'auth_user_id',
            ),
            */
            (object) [
                'type' => 'Hidden',
                'name' => 'title',
                'rules' => 'required',
            ],
            (object) [
                'type' => 'Hidden',
                'name' => 'privacy.obligatory',
                'rules' => ['boolean', 'nullable'], //,new PivotRequiredRule('privacy.obligatory','value')],

                //'rules' => 'required_if:payment_type,cc',
                /*
                accepted
The field under validation must be yes, on, 1, or true. This is useful for validating "Terms of Service" acceptance.
                */
            ],
            (object) [
                'type' => 'Boolean',
                'name' => 'value',
                //'rules' => ['boolean','nullable'],
                'rules' => ['boolean', 'nullable', new PrivacyCheckRule('value', 'privacy.obligatory')],
                //'attributes'=>['label' => 'label test'],
                //'attributes'=>['label'=>'test label' ],
                //'rules' => 'required_if:payment_type,cc',
                /*
                accepted
The field under validation must be yes, on, 1, or true. This is useful for validating "Terms of Service" acceptance.
                */
            ],
        ];
    }

    /**
     * Get the tabs available.
     *
     * @return array
     */
    public function tabs() {
        $tabs_name = [];

        return RouteService::tabs([
            'tabs_name' => $tabs_name,
            'model' => self::$model,
        ]);
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function cards(Request $request) {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function filters(Request $request = null) {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function lenses(Request $request) {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function actions() {
        return [];
    }
}
