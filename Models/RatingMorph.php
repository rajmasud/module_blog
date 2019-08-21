<?php
namespace Modules\Blog\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

>>>>>>> 44adda4afca837381a42d347e2970d1e23ee648e
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
<<<<<<< HEAD
class RatingMorph extends BaseModel
{
=======
    //extends BaseModel 
class RatingMorph extends MorphPivot{
>>>>>>> 44adda4afca837381a42d347e2970d1e23ee648e
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
<<<<<<< HEAD
=======

    public function rating(){
        return $this->hasOne(Rating::class,'post_id','related_id');
    }

    public function getTitleAttribute($value){
        return 'ooo';
    }

>>>>>>> 44adda4afca837381a42d347e2970d1e23ee648e
    
}