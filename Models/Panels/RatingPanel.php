<?php
namespace Modules\Blog\Models\Panels;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

//--- Services --
use Modules\Extend\Services\StubService;
use Modules\Extend\Services\RouteService;

//---- bases --
use Modules\Xot\Models\Panels\XotBasePanel;


class RatingPanel extends XotBasePanel{
    public static $model = 'Modules\Blog\Models\Rating';
    public static $title = "title"; 
    public static $search = [];
    
    public function search(){
      return [];
    }

    /**
    * The relationships that should be eager loaded on index queries.
    *
    * @var array
    */
    public static function with(){
      return [];
    }


    /**
     * on select the option id
     *
     */

    public function optionId($row){
        return $row->post_id;
    }

    /**
     * on select the option label 
     *
     */

    public function optionLabel($row){
        return $row->title;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static function fields(){
        return array (
              (object) array(
                 'type' => 'BigInt',
                 'name' => 'post_id',
              ),
              (object) array(
                 'type' => 'Text',
                 'name' => 'my_rating',
              ),
              (object) array(
                 'type' => 'String',
                 'name' => 'related_type',
              ),
            );
    }
     
    /**
     * Get the tabs available 
     *
     * @return array  
     */
    public function tabs(){
        $tabs_name = [];
        return RouteService::tabs([
            'tabs_name'=>$tabs_name,
            'model'=>self::$model
        ]);
        
    }
    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request){
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request=null){
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request){
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(){
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
