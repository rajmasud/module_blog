<?php
namespace Modules\Blog\Models\Panels;

use Illuminate\Http\Request;

//-------- Services -----
use Modules\Extend\Services\StubService;
use Modules\Extend\Services\RouteService;
//---- bases --
use Modules\Xot\Models\Panels\XotBasePanel;

class PlacePanel extends XotBasePanel
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Modules\Blog\Models\Place';

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
     'type' => 'Text',
     'name' => 'id',
  ),
  1 => 
  (object) array(
     'type' => 'Integer',
     'name' => 'post_id',
  ),
  2 => 
  (object) array(
     'type' => 'Text',
     'name' => 'post_type',
  ),
  3 => 
  (object) array(
     'type' => 'String',
     'name' => 'premise',
  ),
  4 => 
  (object) array(
     'type' => 'String',
     'name' => 'locality',
  ),
  5 => 
  (object) array(
     'type' => 'String',
     'name' => 'postal_town',
  ),
  6 => 
  (object) array(
     'type' => 'String',
     'name' => 'administrative_area_level_3',
  ),
  7 => 
  (object) array(
     'type' => 'String',
     'name' => 'administrative_area_level_2',
  ),
  8 => 
  (object) array(
     'type' => 'String',
     'name' => 'administrative_area_level_1',
  ),
  9 => 
  (object) array(
     'type' => 'String',
     'name' => 'country',
  ),
  10 => 
  (object) array(
     'type' => 'String',
     'name' => 'street_number',
  ),
  11 => 
  (object) array(
     'type' => 'String',
     'name' => 'route',
  ),
  12 => 
  (object) array(
     'type' => 'String',
     'name' => 'postal_code',
  ),
  13 => 
  (object) array(
     'type' => 'String',
     'name' => 'googleplace_url',
  ),
  14 => 
  (object) array(
     'type' => 'String',
     'name' => 'point_of_interest',
  ),
  15 => 
  (object) array(
     'type' => 'String',
     'name' => 'political',
  ),
  16 => 
  (object) array(
     'type' => 'String',
     'name' => 'campground',
  ),
  17 => 
  (object) array(
     'type' => 'Text',
     'name' => 'latitude',
  ),
  18 => 
  (object) array(
     'type' => 'Text',
     'name' => 'longitude',
  ),
  19 => 
  (object) array(
     'type' => 'Text',
     'name' => 'formatted_address',
  ),
  20 => 
  (object) array(
     'type' => 'Text',
     'name' => 'nearest_street',
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
    public function filters(Request $request=null)
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
    public function actions()
    {
        return [];
    }
}
