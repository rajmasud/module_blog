<?php

namespace Modules\Blog\Models\Panels;

use Illuminate\Http\Request;
//--- Services --
use Modules\Xot\Models\Panels\XotBasePanel;

//---- bases --

class PhotoPanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    protected static $model = 'Modules\Blog\Models\Photo';

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

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function fields() {
        return [
   /*
  (object) array(
     'type' => 'Integer',
     'name' => 'post_id',
  ),
  */
  //*
  (object) [
     'type' => 'Text',
     'name' => 'title',
  ],

  (object) [
     'type' => 'Text',
     'name' => 'subtitle',
  ],
  /*
  (object) array(
     'type' => 'Text',
     'name' => 'post[title]',
  ),
  */
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
