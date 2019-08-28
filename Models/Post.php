<?php
namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
//--- traits ---
use Modules\Xot\Traits\Updater;
//---- services --
use Modules\Xot\Services\ImageService;
use Modules\Xot\Services\ImportService;
use Modules\Theme\Services\ThemeService;


//--- models ---
use Modules\LU\Models\User;

//NO BaseModel
class Post extends Model {
	use Updater;

	protected $fillable = [
		'id','post_id','lang','guid',
		'title',
		'subtitle',
		'post_type', 
		'txt',
		'image_src', 'image_alt', 'image_title', //image
		
		'meta_description','meta_keyword', // seo
		'author_id',
		'url','url_lang', //buffer
		'image_resize_src', // buffer

	];

	protected $appends = []; 

	protected $primaryKey = 'id';  
	public $incrementing = true;

	protected $dates = [
		'created_at','updated_at','deleted_at',
		'published_at',
	];


	protected $casts = [
		'image_resize_src' => 'array',
		'url_lang' => 'array',
	];


	public function getRouteKeyName(){
		return in_admin()?'guid':'post_id';
	}

	//-------- relationship ------
	public function linkable(){
		return $this->morphTo('post');
	}
	public function archive(){
		$lang=$this->lang;
		$post_type=$this->post_type;
		$obj=$this->getLinkedModel();
		$table=$obj->getTable();
		//*
		$rows=$obj->join('blog_posts','blog_posts.post_id',$table.'.post_id')
                    ->where('lang',$lang)
                    ->where('blog_posts.post_type',$post_type)
                    ->where('blog_posts.guid','!=',$post_type)
                    ->orderBy($table.'.updated_at','desc')
                    ->with('post')
                    ;
        return $rows;
	}//end function


}//end class
