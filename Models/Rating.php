<?php

namespace Modules\Blog\Models;

class Rating extends BaseModelLang
{
    protected $fillable = ['id', 'related_type'];

    //-------- relationship -----
    //-------- mutators ---------
    /*
    public function getRatingAvgAttribute($value){
        return $this->ratingMorph()->avg('rating');
    }
    */
}
