<?php
namespace Modules\Blog\Models\Panels;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

//--- Services --
use Modules\Extend\Services\StubService;
use Modules\Extend\Services\RouteService;


use Modules\Xot\Models\Panels\XotBasePanel;

<<<<<<< HEAD
class PrivacyPanel extends XotBasePanel{
=======
class PrivacyPanel extends XotBasePanel
{
>>>>>>> the first commit
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Modules\Blog\Models\Privacy';

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
        return $row->title.' ['.$row->related_type.']';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array

        'col_bs_size' => 6,
        'sortable' => 1,
        'rules' => 'required',
        'rules_messages' => ['it'=>['required'=>'Nome Obbligatorio']],
        'value'=>'..',

     */
    public static function fields(){
        return array (
              (object) array(
                 'type' => 'Id',
                 'name' => 'post_id',
              ),
              (object) array(
                 'type' => 'Text',
                 'name' => 'related_type',
              ),
              (object) array(
                 'type' => 'Text',
                 'name' => 'post.title',
              ),
              (object) array(
                 'type' => 'Integer',
                 'name' => 'obligatory',
              ),
              (object) array(
                 'type' => 'Text',
                 'name' => 'post.subtitle',
              ),
              (object) array(
                 'type' => 'Textarea',
                 'name' => 'post.txt',
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
