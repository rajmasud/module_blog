<?php

namespace Modules\Blog\Models\Panels;

use Illuminate\Http\Request;
//--- Services --
use Modules\Xot\Models\Panels\XotBasePanel;
//---- bases --

class RatingPanel extends XotBasePanel {
    protected static $model = 'Modules\Blog\Models\Rating';
    protected static $title = 'title';
    protected static $search = [];

    public function search() {
        return [];
    }

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
        return $row->post_id;
    }

    /**
     * on select the option label.
     */
    public function optionLabel($row) {
        return $row->title;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public static function fields() {
        return [
              (object) [
                 'type' => 'Id',
                 'name' => 'post_id',
              ],
              (object) [
                 'type' => 'Text',
                 'name' => 'related_type',
              ],
              (object) [
                 'type' => 'Text',
                 'name' => 'post.title',
              ],
              (object) [
                 'type' => 'Text',
                 'name' => 'post.subtitle',
              ],
              (object) [
                 'type' => 'Textarea',
                 'name' => 'post.txt',
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

    /*
    public function actions()
    {
        return [];
    }

    public function indexEdit(){
        $params = \Route::current()->parameters();
        list($containers,$items)=params2ContainerItem($params);
    }
    public function bodyContentView($params=[]){
        extract($params);
        $route_params = \Route::current()->parameters();
        list($containers,$items)=params2ContainerItem($route_params);
        //return $_layout->view_extend.'.body.multi_select';
        return $_layout->view_extend.'.body.rating';
    }
    */
}
