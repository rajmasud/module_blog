<?php
namespace Modules\Blog\Models\Panels;

use Illuminate\Http\Request;

//-------- Services -----
use Modules\Extend\Services\StubService;
use Modules\Extend\Services\RouteService;

class ArticlePanel 
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Modules\Blog\Models\Article';

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
      return ['post'];
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
          (object) array(
             'type' => 'Id',
             'name' => 'post_id',
          ),
          (object) array(
             'type' => 'String',
             'name' => 'article_type',
          ),
          (object) array(
             'type' => 'DateTime',
             'name' => 'published_at',
          ),
          (object) array(
             'type' => 'Text',
             'name' => 'post[title]',
          ),
          (object) array(
             'type' => 'Text',
             'name' => 'post[subtitle]',
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
