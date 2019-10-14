<?php

namespace Modules\Blog\Models\Panels;

use Illuminate\Http\Request;
//--- Services --
use Modules\Xot\Models\Panels\XotBasePanel;
use Modules\Xot\Services\RouteService;

class RelatedPanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    protected static $model = 'Modules\Blog\Models\Related';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    protected static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    protected static $search = [
];

    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static function with() {
        return [];
    }

    public function search() {
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
     * @param Request                               $request
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function relatableQuery(Request $request, $query) {
        //return $query->where('auth_user_id', $request->user()->auth_user_id);
         //return $query->where('user_id', $request->user()->id);
    }

    public static function fields() {
        return [
  0 => (object) [
     'type' => 'Text',
     'name' => 'guid',
     'comment' => 'not in Doctrine',
  ],
  1 => (object) [
     'type' => 'Text',
     'name' => 'lang',
     'comment' => 'not in Doctrine',
  ],
  2 => (object) [
     'type' => 'Text',
     'name' => 'title',
     'comment' => 'not in Doctrine',
  ],
  3 => (object) [
     'type' => 'Text',
     'name' => 'type',
     'comment' => 'not in Doctrine',
  ],
  4 => (object) [
     'type' => 'Text',
     'name' => 'user_id',
     'comment' => 'not in Doctrine',
  ],
  5 => (object) [
     'type' => 'Text',
     'name' => 'category_id',
     'comment' => 'not in Doctrine',
  ],
  6 => (object) [
     'type' => 'Text',
     'name' => 'title',
     'comment' => 'not in Doctrine',
  ],
  7 => (object) [
     'type' => 'Text',
     'name' => 'description',
     'comment' => 'not in Doctrine',
  ],
  8 => (object) [
     'type' => 'Text',
     'name' => 'content',
     'comment' => 'not in Doctrine',
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
    public function actions(Request $request = null) {
        return [];
    }
}
