<?php
namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

use Carbon\Carbon;

//use Illuminate\Database\Eloquent\Model;
//use Laravel\Scout\Searchable;

//--- TRAITS ---
//use Modules\Blog\Models\Traits\LinkedTrait;
//use Modules\Extend\Traits\Updater;

/**
 * { item_description }
 * da fare php artisan scout:import Modules\Blog\Models\Post.
 *
 * @mixin \Eloquent
 */
class RatingMorph 
    //extends BaseModel 
    extends MorphPivot
    {
    //use Searchable; //se non si crea prima indice da un sacco di errori
    //use Updater;
    //use LinkedTrait;
    //*
    //protected $table = 'blog_post_events';
    protected $fillable = ['id','post_id','post_type','related_id','related_type','rating','auth_user_id'];
    protected $appends = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $primaryKey = 'id';
    public $incrementing = true;

    public function rating(){
        return $this->hasOne(Rating::class,'post_id','related_id');
    }

    public function getTitleAttribute($value){
        return 'ooo';
    }

    
}