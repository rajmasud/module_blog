<?php
namespace Modules\Blog\Models;

use Carbon\Carbon;
//------services---------
use Modules\Theme\Services\ThemeService;
//--- models ---

class Article extends BaseModel {
    protected $fillable = ['post_id', 'article_type', 'published_at','parent_id','parent_type'];
    protected $appends=[];
    protected $casts = [];
    protected $dates = ['published_at', 'created_at', 'updated_at' ];
    protected $primaryKey = 'post_id';
    public $incrementing = true;
    //--------- relationship ---------------
    public function sons(){
        return $this->hasMany(Article::class,'post_id','parent_id');
    }
    //---------- mututars -----------
    public function getParentIdAttribute($value){
        if($value!='') return $value;
        $value=0;
        $this->parent_id=$value;
        $this->save();
        return $value;
    }

    public function setPublishedAtAttribute($value){
        if (\is_string($value)) {
            $value=Carbon::now();
        }
        $this->attributes['published_at'] = $value; 
    }

}//end model
