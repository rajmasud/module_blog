<?php

namespace Modules\Blog\Models\Panels;

use Illuminate\Http\Request;
//--- Services --
use Modules\Blog\Rules\PivotRequiredRule;
//-------- rules ---
use Modules\Blog\Rules\PrivacyCheckRule;
use Modules\Xot\Models\Panels\XotBasePanel;

//----- bases ---------

/*
Validator::extendImplicit()
*/

class PrivacyMorphPanel extends XotBasePanel {
    protected static $model = 'Modules\Blog\Models\PrivacyMorph';
    protected static $title = 'title';
    protected static $search = [];

    public static function with() {
        return [];
    }

    public function optionId($row) {
        return $row->area_id;
    }

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
            (object) [
                'type' => 'Hidden',
                'name' => 'title',
                'rules' => 'required',
            ],
            (object) [
                'type' => 'Hidden',
                'name' => 'obligatory',
                'rules' => ['boolean', 'nullable'], //,new PivotRequiredRule('privacy.obligatory','value')],

                //'rules' => 'required_if:payment_type,cc',
                /*
                accepted
The field under validation must be yes, on, 1, or true. This is useful for validating "Terms of Service" acceptance.
                */
            ],
            (object) [
                'type' => 'BooleanAccept',
                'name' => 'value',
                'rules' => ['boolean', 'nullable', new PrivacyCheckRule('value', 'obligatory')],
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

        return [];
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
