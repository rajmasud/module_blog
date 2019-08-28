<?php
namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

use Carbon\Carbon;

class RatingMorph extends MorphPivot{
    protected   $fillable       = ['id','post_id','post_type','related_id','related_type','rating','auth_user_id'];
    protected   $appends        = [];
    protected   $dates          = ['created_at', 'updated_at'];
    protected   $primaryKey     = 'id';
    public      $incrementing   = true;

    //-------- RELATIONSHIP -----------
    public function rating(){
        return $this->hasOne(Rating::class,'post_id','related_id');
    }


    
}