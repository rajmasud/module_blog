<?php

namespace Modules\Blog\Models;


use Modules\Blog\Models\Rating;
use Modules\Blog\Models\RatingMorph;


//------- services ----
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
//------- traits ---
use Modules\Xot\Traits\Updater;

//------- services ----

class Comment extends Model {
    use Updater;
    protected $fillable = ['id', 'post_id', 'post_type', 'related_type', 'auth_user_id', 'txt', 'lang'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $primaryKey = 'id';
    //protected $dateFormat = 'U';
    public $incrementing = true;


    public function ratingObjectives(){
        return $this->hasMany(Rating::class,'related_type','post_type');
        
    }

    public function ratings(){
        return $this->hasMany(RatingMorph::class, 'post_id', 'post_id')
                ->where('post_type',$this->post_type)
                ->where('auth_user_id',$this->auth_user_id);
    }
}