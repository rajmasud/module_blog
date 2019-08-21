<?php
namespace Modules\Blog\Models\Panels;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

//--- Services --
use Modules\Extend\Services\StubService;
use Modules\Extend\Services\RouteService;

//---- bases --
use Modules\Xot\Models\Panels\XotBasePanel;


<<<<<<< HEAD
class RatingPanel extends XotBasePanel
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Modules\Blog\Models\Rating';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = "title"; 

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [];
    
    public function search()
    {
=======
class RatingPanel extends XotBasePanel{
    public static $model = 'Modules\Blog\Models\Rating';
    public static $title = "title"; 
    public static $search = [];
    
    public function search(){
>>>>>>> 44adda4afca837381a42d347e2970d1e23ee648e
      return [];
    }

    /**
    * The relationships that should be eager loaded on index queries.
    *
    * @var array
    */
<<<<<<< HEAD
    public static function with()
    {
=======
    public static function with(){
>>>>>>> 44adda4afca837381a42d347e2970d1e23ee648e
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
<<<<<<< HEAD
    public static function fields()
    {
=======
    public static function fields(){
>>>>>>> 44adda4afca837381a42d347e2970d1e23ee648e
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
<<<<<<< HEAD
    public function cards(Request $request)
    {
=======
    public function cards(Request $request){
>>>>>>> 44adda4afca837381a42d347e2970d1e23ee648e
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
<<<<<<< HEAD
    public function filters(Request $request=null)
    {
=======
    public function filters(Request $request=null){
>>>>>>> 44adda4afca837381a42d347e2970d1e23ee648e
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
<<<<<<< HEAD
    public function lenses(Request $request)
    {
=======
    public function lenses(Request $request){
>>>>>>> 44adda4afca837381a42d347e2970d1e23ee648e
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
<<<<<<< HEAD
=======
    public function actions(){
        return [];
    }
    /*
>>>>>>> 44adda4afca837381a42d347e2970d1e23ee648e
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
<<<<<<< HEAD

=======
    */
>>>>>>> 44adda4afca837381a42d347e2970d1e23ee648e
}
