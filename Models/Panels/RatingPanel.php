<?php
namespace Modules\Blog\Models\Panels;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;

//--- Services --
use Modules\Extend\Services\StubService;
use Modules\Extend\Services\RouteService;


class RatingPanel 
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
    public static $search = array (
) ;
    /**
    * The relationships that should be eager loaded on index queries.
    *
    * @var array
    */
    public static function with()
    {
      return [];
    }

    /**
    * The relationships that should be eager loaded on index queries.
    *
    * @var array
    */
    public static function with()
    {
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
    public static function fields()
    {
        return array (
  0 => 
  (object) array(
     'type' => 'BigInt',
     'name' => 'post_id',
  ),
  1 => 
  (object) array(
     'type' => 'Text',
     'name' => 'my_rating',
  ),
  2 => 
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
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }

}
