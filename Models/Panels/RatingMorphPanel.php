<?php

namespace Modules\Blog\Models\Panels;

use Illuminate\Http\Request;
//--- Services --
use Modules\Xot\Models\Panels\XotBasePanel;

//----- actions ---
//use Modules\Blog\Models\Panels\Actions\RateItAction;

class RatingMorphPanel extends XotBasePanel {
    protected static $model = 'Modules\Blog\Models\RatingMorph';
    protected static $title = 'title';
    protected static $search = [];

    public static function with() {
        return [];
    }

    public function search() {
        return [];
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
    public function indexNav() {
        return null;
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param Request                               $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery($data, $query) {
        //return $query->where('auth_user_id', $request->user()->auth_user_id);
        return $query;
    }

    /**
     * Build a "relatable" query for the given resource.
     *
     * This query determines which instances of the model may be attached to other resources.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function relatableQuery(Request $request, $query) {
        //return $query->where('auth_user_id', $request->user()->auth_user_id);
        //return $query->where('user_id', $request->user()->id);
    }

    public function fields() {
        //$route_params = \Route::current()->parameters();
        [$containers, $items] = params2ContainerItem();

        return [
            /*
            (object) [
            'type' => 'Id',
            'name' => 'id',
            ],
            (object) [
            'type' => 'Integer',
            'name' => 'post_id',
            ],
            (object) [
            'type' => 'Text',
            'name' => 'post_type',
            ],
            (object) [
            'type' => 'Text',
            'name' => 'related_id',
            ],
             */
            /*
            (object) [
            'type' => 'Hidden',
            'name' => 'related_type',
            ],
             */
            /*
            (object) [
            'type' => 'Text',
            'name' => 'title',
            'comment' => 'not in Doctrine',
            ],
             */
            /*
            (object) [
            'type'     => 'Decimal',
            'sub_type' => 'JqStar',
            //'sub_type'=>'VueStar',
            'name'     => 'rating',
            ],
             */
            (object) [
                'type' => 'Rating',
                //'sub_type' => 'JqStar',
                //'sub_type'=>'VueStar',
                'name' => 'myRatings',
                'parent' => last($items),
            ],
            /*
        (object) [
        'type' => 'Hidden',
        'name' => 'auth_user_id',
        ],
        //*/
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
        return [
            new Actions\RateItAction(),
        ];
    }
}
