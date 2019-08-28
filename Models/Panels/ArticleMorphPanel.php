<?php
namespace Modules\Blog\Models\Panels;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

//--- Services --
use Modules\Xot\Services\StubService;
use Modules\Xot\Services\RouteService;


use Modules\Xot\Models\Panels\XotBasePanel;

class ArticleMorphPanel extends XotBasePanel {
	public static $model = 'Modules\Blog\Models\ArticleMorph';
	public static $title = "title"; 
	public static $search = [];
	public static function with(){
	  return [];
	}

	public function search(){
		return [];
	}

	public function optionId($row){
		return $row->area_id;
	}


	public function optionLabel($row){
		return $row->area_define_name;
	}

	public function indexNav(){
		return null;
	}

	public static function fields()
	{
		return array (
  (object) array(
     'type' => 'Text',
     'name' => 'id',
     'comment' => 'not in Doctrine',
  ),
  (object) array(
     'type' => 'Text',
     'name' => 'post_id',
     'comment' => 'not in Doctrine',
  ),
  (object) array(
     'type' => 'Text',
     'name' => 'post_type',
     'comment' => 'not in Doctrine',
  ),
  (object) array(
     'type' => 'Text',
     'name' => 'related_id',
     'comment' => 'not in Doctrine',
  ),
  (object) array(
     'type' => 'Text',
     'name' => 'related_type',
     'comment' => 'not in Doctrine',
  ),
  (object) array(
     'type' => 'Text',
     'name' => 'auth_user_id',
     'comment' => 'not in Doctrine',
  ),
);
	}
	 
	public function tabs(){
		$tabs_name = [];
		return RouteService::tabs([
			'tabs_name'=>$tabs_name,
			'model'=>self::$model
		]);
		
	}
	
	public function cards(Request $request)
	{
		return [];
	}

	
	public function filters(Request $request=null)
	{
		return [];
	}


	public function lenses(Request $request)
	{
		return [];
	}


	public function actions(Request $request=null)
	{
		return [];
	}

}
